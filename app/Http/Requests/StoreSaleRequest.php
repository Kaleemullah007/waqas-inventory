<?php

namespace App\Http\Requests;

use App\Models\Product;
use App\Rules\ProductStockRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class StoreSaleRequest extends FormRequest
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

            'products.*.product_id' => 'required|integer|max:255',
            'products'=>[new ProductStockRule()],
            'products.*.qty'=>'required',
            'products.*.sale_price'=>'required',
            'owner_id'=>'required|integer',
            'discount'=>'required|decimal:0,2',
            'payment_status'=>'required',
            'payment_method'=>'required',
            'paid_amount'=>'required|decimal:0,2',
            'remaining_amount'=>'required|decimal:0,2',
            'total'=>'required|decimal:0,2',
        ];
    }
    // Adding Owner Id To all Requests
    protected function prepareForValidation(){

        $this->merge([
            'owner_id'=>auth()->id(),
            'total'=>0.0,
            // 'flag'=>$flag,
        ]);
    }
}
