<?php

namespace App\Http\Controllers;

use App\Models\CashDeposit;
use App\Http\Requests\StoreCashDepositRequest;
use App\Http\Requests\UpdateCashDepositRequest;

class CashDepositController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cashDeposits = CashDeposit::all();
        return view('cash-deposit.index', compact('cashDeposits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cash-deposit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCashDepositRequest $request)
    {
        CashDeposit::query()->create($request->validated());
        return to_route('cash-deposits.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(CashDeposit $cashDeposit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CashDeposit $cashDeposit)
    {
        return view('cash-deposit.edit', compact('cashDeposit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCashDepositRequest $request, CashDeposit $cashDeposit)
    {
        $cashDeposit->update($request->validated());
        return to_route('cash-deposits.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CashDeposit $cashDeposit)
    {
        $cashDeposit->delete();
        return to_route('cash-deposits.index');
    }
}
