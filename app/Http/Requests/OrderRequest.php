<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(){
        $this->merge([
            'products' => json_decode($this->products, 1),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'titleSupplier' => 'required|max:255',
            'clientName' => 'required|max:255',
            'inn' => 'required|max:30',
            'kppClient' => 'required|max:30',
            'innClient' => 'required|max:30',
            'logo' => 'required|image',
            'products' => 'required|array',
            'products.*.name' => 'required|max:255',
            'products.*.quantity' => 'required|integer|gt:0',
            'products.*.price' => 'required|numeric|gte:0',
            'products.*.sum' => 'required|numeric|gte:0',
        ];
    }
}
