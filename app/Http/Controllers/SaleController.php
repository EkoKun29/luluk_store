<?php

namespace App\Http\Controllers;

use App\Enums\SaleMethod;
use App\Models\Sale;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Models\Bank;
use App\Models\NoRekening;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\SaleDetail;
use App\Services\SaleService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    protected Collection $products;
    public function __construct()
    {
        $this->products = Product::query()
            ->with(['productPrices', 'productPrice'])
            ->get();
    }
    public function cashIndex()
    {
        $sales = Sale::with('saleDetails.productPrice.product')->where('method', SaleMethod::CASH)->latest()->get();
        return view('sale.cash.index', compact('sales'));
    }

    public function cashCreate()
    {
        return view('sale.cash.create')->with('products', $this->products);
    }

    public function receivableIndex()
    {
        $sales = Sale::with(['saleDetails.productPrice.product', 'receivableSale'])->where('method', SaleMethod::PIUTANG)->latest()->get();
        return view('sale.receivable.index', compact('sales'));
    }

    public function receivableCreate()
    {
        return view('sale.receivable.create')->with('products', $this->products);
    }

    public function transferIndex()
    {
        $sales = Sale::with(['saleDetails.productPrice.product', 'transferSale'])->where('method', SaleMethod::TRANSFER)->latest()->get();
        return view('sale.transfer.index', compact('sales'));
    }

    public function transferCreate()
    {
        $banks = Bank::all();
        return view('sale.transfer.create')->with([
            'products' => $this->products,
            'banks' => $banks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request)
    {
        DB::beginTransaction();

        try {
            $saleService = new SaleService($request->validated());
            $sale = $saleService->saveSale();

            $route = '';
            if ($sale->method->value == 0) {
                $route = 'sales.cash.index';
            } elseif ($sale->method->value == 1) {
                $route = 'sales.receivable.index';
                $saleService->saveReceivable($sale);
            } elseif ($sale->method->value == 2) {
                $route = 'sales.transfer.index';
                $saleService->saveTransfer($sale);
            }

            DB::commit();
            return to_route($route)->with('success-sale', route('sale.print', $sale->id));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        return view('sale.show')->with([
            'sale' => $sale->load('saleDetails.product', 'receivableSale', 'transferSale')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        $route = '';

        DB::beginTransaction();
        try {
            switch ($sale->method->value) {
                case 0:
                    $route = 'sales.cash.index';
                    break;
                case 1:
                    $route = 'sales.receivable.index';
                    $sale->receivableSale()->delete();
                    break;
                case 2:
                    $route = 'sales.transfer.index';
                    $sale->transferSale()->delete();
                    break;
            }

            foreach ($sale->saleDetails as $saleDetail) {
                $saleDetail->delete();
            }

            $sale->delete();
            DB::commit();
            return to_route($route);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function print(Sale $sale)
    {
        return view('sale.print')->with([
            'sale' => $sale->load('saleDetails.productPrice.product')
        ]);
    }

    public function reportIndex()
    {
        $saleDetails = SaleDetail::query()
            ->whereHas('sale')
            ->with(['sale', 'productPrice.product'])
            ->when(request()->filled('start_date'), function (Builder $query) {
                $query->whereHas('sale', function (Builder $saleQuery) {
                    $saleQuery->whereDate('date', '>=', request()->input('start_date'));
                });
            })
            ->when(request()->filled('end_date'), function (Builder $query) {
                $query->whereHas('sale', function (Builder $saleQuery) {
                    $saleQuery->whereDate('date', '<=', request()->input('end_date'));
                });
            })
            ->latest()
            ->get();
        return view('report.sale', compact('saleDetails'));
    }
}
