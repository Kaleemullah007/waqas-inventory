<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseRequest extends FormRequest
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
        return [
            'user_id'=>'required|integer',
            'name'=>'required|string',
            'qty'=>'required',
            'price'=>'required',
            'sale_price'=>'required',
            'owner_id'=>'required|integer',
            'total'=>'required|integer'

        ];
    }

    // Adding Owner Id To all Requests
    protected function prepareForValidation(){
        $this->merge([
            'owner_id'=>auth()->id(),
            'total'=>$this->qty*$this->price
        ]);
    }
}
