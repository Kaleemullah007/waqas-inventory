<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class StoreCustomerRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'name' => 'required',
            'email' => 'sometimes|nullable|required|unique:users,email',
            'phone' => 'required',
            'user_type' => 'required',
            'owner_id' => 'required',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'owner_id' => auth()->id(),
            'user_type' => 'customer',
            'name' => $this->first_name.' '.$this->last_name,
            'password' => Hash::make('password'),
        ]);
    }
}
