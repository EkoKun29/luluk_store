<?php

namespace App\Http\Controllers;

use App\Models\ProductPrice;
use App\Http\Requests\StoreProductPriceRequest;
use App\Http\Requests\UpdateProductPriceRequest;
use App\Models\Product;

class ProductPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Product $product, StoreProductPriceRequest $request)
    {
        $product->productPrice()->create($request->validated());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductPrice $productPrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductPrice $productPrice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductPriceRequest $request, ProductPrice $productPrice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductPrice $productPrice)
    {
        //
    }
}
