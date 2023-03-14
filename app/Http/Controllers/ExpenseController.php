<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $expenses = Expense::get();
        return view('expense',compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(StoreExpenseRequest $request): Response
    {
        
        // return view('expense');
        return view('pages.create-expense');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $expenses = Expense::create($request->validated());
        return redirect('expense');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense): Response
    {
        return redirect('edit-expense',compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense): Response
    {
        // return redirect('edit-expense',compact('expense'));
        return view('pages.edit-expense');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseRequest $request, Expense $expense): RedirectResponse
    {
        $expenses = Expense::udpate($request->validated())->where('id',$expense->id);
        return redirect('expense/'.$expense->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense): RedirectResponse
    {
        $expense->dalete();
        return redirect('expense/'.$expense->id);
    }
}
