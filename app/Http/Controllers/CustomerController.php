<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $customers = Customer:://withSum(
                            // ['customerSale'],'sale_price')
                            withSum('customerSale','discount')
                            ->withSum('customerSale','remaining_amount')
                            ->withSum('customerSale','total')
                            ->withSum('customerSale','paid_amount')
                            ->paginate(10);
        return view('pages.customer',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        
        return view('pages.create-customer');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
       $user = Customer::create($request->only([
        'name',
        'email',
        'phone',
        'user_type',
        'owner_id',
        'password'
        ]));
       return response()->json(['message'=>'Successfully created','error'=>true,'data'=>$user]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer): View
    {
        return view('pages.edit-customer',compact('customer'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer): RedirectResponse
    {
        //
    }
}
