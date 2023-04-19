<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkStoreInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        /*
         * The Request Has Multiple Object To Store So We Use [*] as Prefix To validate each property
         *      in each Object in the JSON Request
         * */
        return [
            '*.customerId'  => ['required' , 'integer'],
            '*.amount'      => ['required' , 'numeric'],
            '*.status'      => ['required' , Rule::in(['P' ,'B', 'V'])],
            '*.billedDate'  => ['required' , 'date_format:Y-m-d H:i:s'],
            '*.paidDate'    => ['nullable' , 'date_format:Y-m-d H:i:s'],
        ];
    }
    protected  function prepareForValidation()
    {
        $data = [];
        foreach ($this->toArray() as $obj)
        {
            // Assign every value of attribute with camelCase to snake_case attribute to can store it into Database
            $obj['customer_id'] = $obj['customerId'] ?? null;
            $obj['billed_date'] = $obj['billedDate'] ?? null;
            $obj['paid_date']   = $obj['paidDate'] ?? null;

            // Put Every Object after The process to data array
            $data[] = $obj;
        }

        // Merge Data After Assignment with the Request
        // Note :: the request still has the camelCase attributes and also has snake_case attributes after Assignment
        $this->merge($data);
    }
}
