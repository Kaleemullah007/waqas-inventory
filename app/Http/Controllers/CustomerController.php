<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\DepositHistory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CustomerController extends Controller
{

    public function __construct()
    {

        $this->middleware(['auth', 'verified']);
    }

    public function recordsQuery($request)
    {
        $search = $request->search;

        $customers = Customer::query()->
                            //withSum(
                            // ['customerSale'],'sale_price')
                             withSum('customerSale','discount')
                            ->withSum('customerSale','remaining_amount')
                            ->withSum('customerSale','total')
                            ->withSum('customerSale','paid_amount')
                            ->withSum('DespositSum','amount')
                            ->where('user_type','customer');
                            if($search != null)
                                $customers = $customers->where('name','like',"%".$search."%");





        return $customers ;
    }


    /**
     * Display a listing of the resource.
     */
    public function index( Request $request)
    {
        $customers = $this->recordsQuery($request)
        ->paginate(config('services.per_page',10));

        if($customers->lastPage() >= request('page')){
            return view('pages.customer',compact('customers'));
        }

        return to_route('customer.index',['page'=>$customers->lastPage()]);

    }




    public function getCustomers(Request $request)
    {


        $customers = $this->recordsQuery($request)->get();
        $customer_html = view('pages.ajax-customer',compact('customers'))->render();
        $pagination_html = view('pages.pagination',compact('customers'))->render();
        return response()->json(['html'=>$customer_html,'phtml'=>$pagination_html]);
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
        if($request->ajax())
            return response()->json(['message'=>'Successfully created','error'=>true,'data'=>$user]);

        $request->session()->flash('success','Customer created successfully.');
        return redirect('customer');


    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer):View
    {
        $DepositHistory = DepositHistory::where('user_id',$customer->id)->get();
        $customers = Customer::where('user_type','customer')->get();
        return view('pages.create-deposit',compact('customer','customers','DepositHistory'));
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
        $data = $request->validated();
        $validated = collect($data)->except(['last_name','first_name','page'])->toArray();
        // dd($validated);
        Customer::where('id',$customer->id)->update($validated);
        $request->session()->flash('success','Customer updated successfully.');
        return redirect('customer?page='.$request->page);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer): RedirectResponse
    {
        //
    }
}
