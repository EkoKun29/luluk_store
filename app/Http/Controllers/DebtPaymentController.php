<?php

namespace App\Http\Controllers;

use App\Enums\PaymentMethod;
use App\Enums\PurchaseMethod;
use App\Models\DebtPayment;
use App\Http\Requests\StoreDebtPaymentRequest;
use App\Http\Requests\UpdateDebtPaymentRequest;
use App\Models\Bank;
use App\Models\NoRekening;
use App\Models\Purchase;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class DebtPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function cashIndex()
    {
        $debtPayments = DebtPayment::query()
            ->with('purchase.purchaseDetails')
            ->where('method', '=', PaymentMethod::CASH)
            ->get();
        return view('debt-payment.cash.index', compact('debtPayments'));
    }

    public function cashCreate()
    {
        $purchases = Purchase::with(['purchaseDetails.product', 'debtPurchase'])
            ->where('method', PurchaseMethod::HUTANG)
            ->get()
            ->filter(fn (Purchase $purchase) => ($purchase->amount_paid + $purchase->debt_paid_off) < $purchase->total)
            ->values();
        return view('debt-payment.cash.create', compact('purchases'));
    }

    public function transferIndex()
    {
        $debtPayments = DebtPayment::query()
            ->with('purchase.purchaseDetails')
            ->with('debtPaymentTransfer')
            ->where('method', '=', PaymentMethod::TRANSFER)
            ->get();
        return view('debt-payment.transfer.index', compact('debtPayments'));
    }

    public function transferCreate()
    {
        $purchases = Purchase::query()
            ->with(['purchaseDetails.product', 'debtPurchase'])
            ->where('method', PurchaseMethod::HUTANG)
            ->get()
            ->filter(fn (Purchase $purchase) => ($purchase->amount_paid + $purchase->debt_paid_off) < $purchase->total)
            ->values();
        $banks = Bank::all();
        return view('debt-payment.transfer.create', compact('purchases', 'banks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $purchases = Purchase::with(['purchaseDetails.product', 'debtPurchase'])->get();
        $methods = PaymentMethod::cases();
        return view('debt-payment.create', compact('purchases', 'methods'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDebtPaymentRequest $request)
    {
        DB::beginTransaction();
        $input = $request->validated();
        try {
            $purchase = Purchase::query()->find($request->input('purchase_id'));
            if ($request->input('amount_paid') > ($purchase->total - ($purchase->amount_paid + $purchase->debt_paid_off))) {
                throw new \Exception('Jumlah Yang dibayarkan tidak sesuai total transaksi');
            }

            $debtPayment = DebtPayment::query()->create($request->safe()->except(['bank_id', 'no_rekening_id', 'account_name']));
            if ($debtPayment->method === 1) {
                $bank_id = (Bank::query()->findOr($input['bank_id'], function () use ($input) {
                    return Bank::query()->create([
                        'name' => $input['bank_id']
                    ]);
                }))->id;
                $no_rekening_id = (NoRekening::query()->findOr($input['no_rekening_id'], function () use ($input, $bank_id) {
                    return NoRekening::query()->create([
                        'bank_id' => $bank_id,
                        'account_number' => $input['no_rekening_id'],
                        'name' => $input['account_name']
                    ]);
                }))->id;
                $debtPayment->debtPaymentTransfer()->create([
                    'no_rekening_id' => $no_rekening_id
                ]);
            }

            DB::commit();
            if ($request->input('method') == 0) {
                return to_route('debt-payments.cash.index');
            }
            return to_route('debt-payments.transfer.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DebtPayment $debtPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DebtPayment $debtPayment)
    {
        $purchases = Purchase::with('purchaseDetails.product')->get();
        $debtPayment->load('purchase.purchaseDetail.product');
        return view('debt-payment.edit', compact('purchases', 'debtPayment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDebtPaymentRequest $request, DebtPayment $debtPayment)
    {
        DB::beginTransaction();
        $transferAttribute = ['bank_name', 'account_number', 'account_name'];
        try {
            $debtPayment->update($request->safe()->except($transferAttribute));
            if ($debtPayment->method === 2) {
                $debtPayment->debtPaymentTransfer()->update($request->safe()->only($transferAttribute));
            }

            DB::commit();
            return to_route('debt-payments.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DebtPayment $debtPayment)
    {
        $route = '';
        if ($debtPayment->method->value == 0) {
            $route = 'debt-payments.cash.index';
        } else {
            $route = 'debt-payments.transfer.index';
        }

        $debtPayment->delete();
        return to_route($route);
    }

    public function reportIndex()
    {
        $debtPayments = DebtPayment::query()
            ->with('purchase.purchaseDetails.product')
            ->when(request()->filled('start_date'), function (Builder $query) {
                $query->whereDate('date', '>=', request()->input('start_date'));
            })
            ->when(request()->filled('end_date'), function (Builder $query) {
                $query->whereDate('date', '<=', request()->input('end_date'));
            })
            ->latest()
            ->get();
        return view('report.debt-payment', compact('debtPayments'));
    }
}
