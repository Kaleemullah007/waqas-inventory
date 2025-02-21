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
        $nameRule = $this->input('raw_id') == 1
        ? 'required|string|unique:purchases,name'
        : 'nullable|string';

        return [
            'user_id' => 'required|integer',
            'name' => $nameRule,
            'raw_id' => 'required|integer',
            'qty' => 'required',
            'price' => 'required',
            'sale_price' => 'required',
            'owner_id' => 'required|integer',
            'total' => 'required|decimal:0,2',
            'sale_price' => 'gte:price',
            'action' => 'required|string',
        ];
    }

    // Adding Owner Id To all Requests
    protected function prepareForValidation()
    {

        $action = 'update';
        if ($this->input('raw_id') == 1) {
            $action = 'add';
        }

        $this->merge([
            'owner_id' => auth()->id(),
            'total' => $this->qty * $this->price,
            'action' => $action,
        ]);
    }
}
