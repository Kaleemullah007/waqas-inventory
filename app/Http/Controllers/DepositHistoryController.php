<?php

namespace App\Http\Controllers;

use App\Models\DepositHistory;
use App\Http\Requests\StoreDepositHistoryRequest;
use App\Http\Requests\UpdateDepositHistoryRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class DepositHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepositHistoryRequest $request): RedirectResponse
    {
        $expenses = DepositHistory::create($request->validated());
        $request->session()->flash('success','Deposit added successfully.');
        return redirect()->route('customer.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(DepositHistory $depositHistory): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DepositHistory $depositHistory): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepositHistoryRequest $request, DepositHistory $depositHistory): RedirectResponse
    {
        DepositHistory::where('id',$depositHistory->id)->update($request->validated());
        $request->session()->flash('success','Deposit Amount updated successfully.');
        return redirect()->route('customer.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DepositHistory $depositHistory): RedirectResponse
    {
        //
    }
}
