<?php

namespace App\Http\Controllers;

use App\Enums\PaymentMethod;
use App\Enums\SaleMethod;
use App\Models\ReceivablePayment;
use App\Http\Requests\StoreReceivablePaymentRequest;
use App\Http\Requests\UpdateReceivablePaymentRequest;
use App\Models\Bank;
use App\Models\NoRekening;
use App\Models\Sale;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ReceivablePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function cashIndex()
    {
        $receivablePayments = ReceivablePayment::with('sale')->where('method', PaymentMethod::CASH)->get();
        return view('receivable-payment.cash.index', compact('receivablePayments'));
    }

    public function cashCreate()
    {
        $sales = Sale::query()
            ->with(['receivableSale', 'saleDetails.productPrice.product'])
            ->where('method', SaleMethod::PIUTANG)
            ->get()
            ->filter(fn (Sale $sale) => ($sale->amount_paid + $sale->receivable_paid_off) < $sale->total)
            ->values();
        return view('receivable-payment.cash.create', compact('sales'));
    }

    public function transferIndex()
    {
        $receivablePayments = ReceivablePayment::with('sale')->with('receivablePaymentTransfer')->where('method', PaymentMethod::TRANSFER)->get();
        return view('receivable-payment.transfer.index', compact('receivablePayments'));
    }

    public function transferCreate()
    {
        $sales = Sale::query()
            ->with(['receivableSale', 'saleDetails.productPrice.product'])
            ->where('method', SaleMethod::PIUTANG)
            ->get()
            ->filter(fn (Sale $sale) => ($sale->amount_paid + $sale->receivable_paid_off) < $sale->total)
            ->values();
        $banks = Bank::all();
        return view('receivable-payment.transfer.create', compact('sales', 'banks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sales = Sale::query()
            ->with(['receivableSale', 'saleDetails.productPrice.product'])
            ->where('method', SaleMethod::PIUTANG)
            ->get()
            ->filter(fn (Sale $sale) => ($sale->amount_paid + $sale->receivable_paid_off) < $sale->total)
            ->values();
        return view('receivable-payment.create', compact('sales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReceivablePaymentRequest $request)
    {
        $input = $request->validated();
        DB::beginTransaction();
        try {
            $sale = Sale::query()->find($request->input('sale_id'));
            if ($request->input('amount_paid') > ($sale->total - ($sale->amount_paid + $sale->receivable_paid_off))) {
                throw new \Exception('Jumlah Yang dibayarkan tidak sesuai total transaksi');
            }
            $receivablePayment = ReceivablePayment::query()->create($request->safe()->except(['bank_id', 'no_rekening_id', 'account_name']));
            if ($request->input('method') == 1) {
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
                $receivablePayment->receivablePaymentTransfer()->create([
                    'no_rekening_id' => $no_rekening_id
                ]);
            }
            DB::commit();

            if ($request->input('method') == 0) {
                return to_route('receivable-payments.cash.index');
            }
            return to_route('receivable-payments.transfer.index');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ReceivablePayment $receivablePayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReceivablePayment $receivablePayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReceivablePaymentRequest $request, ReceivablePayment $receivablePayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReceivablePayment $receivablePayment)
    {
        $route = '';
        if ($receivablePayment->method->value == 0) {
            $route = 'receivable-payments.cash.index';
        } else {
            $route = 'receivable-payments.transfer.index';
        }

        $receivablePayment->delete();
        return to_route($route);
    }

    public function reportIndex()
    {
        $receivablePayments = ReceivablePayment::query()
            ->with(['sale.saleDetails.product'])
            ->when(request()->filled('start_date'), function (Builder $query) {
                $query->whereDate('date', '>=', request()->input('start_date'));
            })
            ->when(request()->filled('end_date'), function (Builder $query) {
                $query->whereDate('date', '<=', request()->input('end_date'));
            })
            ->latest()
            ->get();
        return view('report.receivable-payment', compact('receivablePayments'));
    }
}
