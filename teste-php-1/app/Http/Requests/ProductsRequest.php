<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'barcode'=>'required|unique:products,barcode',
            'unit_price'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Campo nome do produto obrigatorio',
            'barcode.required'=>'Campo código de barras obrigatorio',
            'barcode.unique'=>'código de barras ja cadastrado',
            'unit_price.required'=>'Campo preço obrigatorio',
        ];
    }
}