<?php

namespace App\Http\Requests;

use App\Models\Product;
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
            'product_id'=>'required|integer',
            'qty'=>'required',
            'sale_price'=>'required',
            'owner_id'=>'required|integer',
            'total'=>'required',
            // 'flag'=>['required','boolean',Rule::notIn([false])]
        ];
    }
    // Adding Owner Id To all Requests
    protected function prepareForValidation(){
        
        // $product = Product::find($this->product_id);
        
        // $flag = false;
        // if($product->stock > $this->qty)
        //   $flag = true;

        $this->merge([
            'owner_id'=>auth()->id(),
            'total'=>$this->qty*$this->sale_price,
            // 'flag'=>$flag,
        ]);
    }
}
