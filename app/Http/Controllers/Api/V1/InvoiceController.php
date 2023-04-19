<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\BulkStoreInvoiceRequest;
use App\Http\Requests\V1\StoreInvoiceRequest;
use App\Http\Requests\V1\UpdateInvoiceRequest;
use App\Http\Resources\V1\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Support\Arr;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::filter(
            request(['customerId' , 'status'])
        );
        //
        return InvoiceResource::collection(
            $invoices->get()
        );
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request)
    {
        $dataWithoutCamleCase = Arr::except($request->toArray() ,['customerId' , 'paidDate' , 'billedDate']);
        Invoice::create($dataWithoutCamleCase);
    }
    public function bulkStore(BulkStoreInvoiceRequest $request)
    {
        // Because of the request still has the camelCase attributes
        // We need to get rهd of them to can store data in DB without Error

        $bulkWithoutCamelCase = collect($request->all())->map(function ($arrData , $key){
            // Getting rid of camelCase attributes
            return Arr::except($arrData , ['customerId' , 'paidDate' , 'billedDate']);
        });

        // we can't insert collection to database, so we should turn it into array
        // we  use insert because we insert multiple rows
        Invoice::insert($bulkWithoutCamelCase->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        return new InvoiceResource($invoice);
    }

    /**

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
        $invoice->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return response(['message' => 'Invoices Was deleted'] , 200);
    }
}
