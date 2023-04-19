<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user != null && $user->tokenCan('update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $requestMethod = $this->method();
        if($requestMethod == "PUT"){
            return [
                'name'       => ['required'],
                'city'       => ['required'],
                'state'      => ['required'],
                'address'    => ['required'],
                'postalCode' => ['required'],
                'email'      => ['required' , 'email'],
                'type'       => ['required' ,Rule::in(['I' ,'B'])]

            ];
        }else{
            // sometimes => if the property exist then validate it and visa verse
            return [
                'name'       => ['sometimes' , 'required'],
                'city'       => ['sometimes' , 'required'],
                'state'      => ['sometimes' , 'required'],
                'address'    => ['sometimes' , 'required'],
                'postalCode' => ['sometimes' , 'required'],
                'email'      => ['sometimes' , 'required' , 'email'],
                'type'       => ['sometimes' , 'required' ,Rule::in(['I' ,'B'])]

            ];
        }
    }
    protected  function prepareForValidation()
    {
        if($this->postalCode){
            $this->merge([
                'postal_code' => $this->postalCode
            ]);
        }
    }
}
