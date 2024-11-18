<?php

namespace App\Http\Controllers;

use App\Enums\PurchaseMethod;
use App\Models\Purchase;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\Bank;
use App\Models\NoRekening;
use App\Models\Product;
use App\Models\PurchaseDetail;
use App\Services\PurchaseService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function cashIndex()
    {
        $purchases = Purchase::with('purchaseDetails.product')->where('method', PurchaseMethod::CASH)->get();
        return view('purchase.cash.index', compact('purchases'));
    }

    public function cashCreate()
    {
        $products = Product::all();
        return view('purchase.cash.create', compact('products'));
    }

    public function debtIndex()
    {
        $purchases = Purchase::with('purchaseDetails.product')->where('method', PurchaseMethod::HUTANG)->get();
        return view('purchase.debt.index', compact('purchases'));
    }

    public function debtCreate()
    {
        $products = Product::all();
        return view('purchase.debt.create', compact('products'));
    }

    public function transferIndex()
    {
        $purchases = Purchase::with([
            'purchaseDetails.product',
            'transferPurchase.noRekening.bank'
        ])->where('method', PurchaseMethod::TRANSFER)->get();
        return view('purchase.transfer.index', compact('purchases'));
    }

    public function transferCreate()
    {
        $products = Product::all();
        $banks = Bank::all();
        return view('purchase.transfer.create', compact('products', 'banks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseRequest $request)
    {
        DB::beginTransaction();

        try {
            $purchaseService = new PurchaseService($request->validated());
            $purchase = $purchaseService->savePurchase();

            $route = '';
            if ($purchase->method->value == 0) {
                $route = 'purchases.cash.index';
            } elseif ($purchase->method->value == 1) {
                $route = 'purchases.debt.index';
            } elseif ($purchase->method->value == 2) {
                $route = 'purchases.transfer.index';
                $purchaseService->saveTransfer($purchase);
            }
            DB::commit();
            return to_route($route)->with('success-purchase', route('purchase.print', $purchase->id));
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withErrors(['error' => $th->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        return view('purchase.show')->with([
            'purchase' => $purchase->load('purchaseDetails.product', 'transferPurchase.noRekening.bank')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        $route = '';

        DB::beginTransaction();
        try {
            switch ($purchase->method->value) {
                case 0:
                    $route = 'purchases.cash.index';
                    break;
                case 1:
                    $route = 'purchases.debt.index';
                    $purchase->debtPurchase()->delete();
                    break;
                case 2:
                    $route = 'purchases.transfer.index';
                    $purchase->transferPurchase()->delete();
                    break;
            }

            foreach ($purchase->purchaseDetails as $purchaseDetail) {
                $purchaseDetail->delete();
            }
            $purchase->delete();
            DB::commit();
            return to_route($route);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function reportIndex()
    {
        $purchaseDetails = PurchaseDetail::query()
            ->whereHas('purchase')
            ->with(['purchase', 'product'])
            ->when(request()->filled('start_date'), function (Builder $query) {
                $query->whereHas('purchase', function (Builder $purchaseQuery) {
                    $purchaseQuery->whereDate('date', '>=', request()->input('start_date'));
                });
            })
            ->when(request()->filled('end_date'), function (Builder $query) {
                $query->whereHas('purchase', function (Builder $purchaseQuery) {
                    $purchaseQuery->whereDate('date', '<=', request()->input('end_date'));
                });
            })
            ->latest()
            ->get();
        return view('report.purchase', compact('purchaseDetails'));
    }

    public function print(Purchase $purchase)
    {
        return view('purchase.print')->with([
            'purchase' => $purchase->load('purchaseDetails.product')
        ]);
    }
}
