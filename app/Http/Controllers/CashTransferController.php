<?php

namespace App\Http\Controllers;

use App\Models\CashTransfer;
use App\Http\Requests\StoreCashTransferRequest;
use App\Http\Requests\UpdateCashTransferRequest;

class CashTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cashTransfers = CashTransfer::all();
        return view('cash-transfer.index', compact('cashTransfers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cash-transfer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCashTransferRequest $request)
    {
        CashTransfer::query()->create($request->validated());
        return to_route('cash-transfer.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(CashTransfer $cashTransfer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CashTransfer $cashTransfer)
    {
        return view('cash-transfer.edit', compact('cashTransfer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCashTransferRequest $request, CashTransfer $cashTransfer)
    {
        $cashTransfer->update($request->validated());
        return to_route('cash-transfer.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CashTransfer $cashTransfer)
    {
        $cashTransfer->delete();
        return to_route('cash-transfer.index');
    }
}
