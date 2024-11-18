<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use App\Http\Requests\StoreAuditRequest;
use App\Http\Requests\UpdateAuditRequest;
use App\Models\Product;

class AuditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $audits = Audit::with('product')->get();
        return view('audit.first.index', compact('audits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('audit.first.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuditRequest $request)
    {
        Audit::query()->create($request->validated());
        return to_route('audits.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Audit $audit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Audit $audit)
    {
        return view('audit.first.edit', [
            'audit' => $audit->load('product')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuditRequest $request, Audit $audit)
    {
        $audit->update($request->validated());
        return to_route('audits.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Audit $audit)
    {
        $audit->delete();
        return to_route('audits.index');
    }
}
