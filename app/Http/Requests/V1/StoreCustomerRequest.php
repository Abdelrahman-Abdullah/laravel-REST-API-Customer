<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user != null && $user->tokenCan('create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'       => ['required'],
            'city'       => ['required'],
            'state'      => ['required'],
            'address'    => ['required'],
            'postalCode' => ['required'],
            'email'      => ['required' , 'email'],
            'type'       => ['required' ,Rule::in(['I' ,'B'])]

        ];
    }
    protected  function prepareForValidation()
    {
        $this->mergeIfMissing([
            'postal_code' => $this->postalCode
        ]);
    }
}
