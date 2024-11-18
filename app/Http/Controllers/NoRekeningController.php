<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoRekeningRequest;
use App\Http\Requests\UpdateNoRekeningRequest;
use App\Models\Bank;
use App\Models\NoRekening;
use Illuminate\Http\Request;

class NoRekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $noRekenings = NoRekening::with('bank')->get();
        $banks = Bank::all();
        return view('management.no-rekening.index', compact('noRekenings', 'banks'));
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
    public function store(StoreNoRekeningRequest $request)
    {
        NoRekening::create($request->validated());

        return redirect()->route('norekenings.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoRekeningRequest $request, NoRekening $norekening)
    {
        $norekening->update($request->validated());

        return redirect()->route('norekenings.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        NoRekening::find($id)->delete();

        return redirect()->route('norekenings.index');
    }
}
