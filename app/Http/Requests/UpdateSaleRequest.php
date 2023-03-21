<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSaleRequest extends FormRequest
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
            'discount'=>'required|integer',
            'payment_status'=>'required',
            'payment_method'=>'required',
            'paid_amount'=>'required|integer',
            'remaining_amount'=>'required|integer',
            'total'=>'required|integer',
        ];
    }

    // Adding Owner Id To all Requests
    protected function prepareForValidation(){

        // $product = Product::find($this->product_id);
        // $flag = false;
        // if($product->stock > $this->qty)
        //   $flag = true;
        $total = $this->qty*$this->sale_price;
        $this->merge([
            'owner_id'=>auth()->id(),
            'total'=>$total,
            'remaining_amount'=> $total-$this->paid_amount-$this->discount
            // 'flag'=>$flag,
        ]);
    }
}
