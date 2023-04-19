<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreCustomerRequest;
use App\Http\Requests\V1\UpdateCustomerRequest;
use App\Http\Resources\V1\CustomerResource;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(\Illuminate\Http\Request $request)
    {
        // Resource To Convert Eloquent Data to JSON  Structure


        // All Customers Without Their Invoices
        $customers = Customer::filter(
            request(['name' , 'city' , 'type'])
        );

        //Check If User Wanna Invoices
        $includeInvoices = $request->query('includeInvoices');
        if($includeInvoices){
            // Add Invoices To Response
            $customers = $customers->with('invoices');
        }

        // Return Result With Invoices If their and vica verse
        return  CustomerResource::collection(
            $customers->get()
        );
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request): CustomerResource
    {
        return new CustomerResource(Customer::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
        $includeInvoices = request()->query('includeInvoices');
        if($includeInvoices){
            // Add Invoices To Response
             return new CustomerResource($customer->loadMissing('invoices'));
        }
             return new CustomerResource($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
       $customer->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response(['message' => 'Customer Was Deleted'],200);
    }
}
