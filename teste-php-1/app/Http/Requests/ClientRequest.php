<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'cpf'=>'required|unique:clients,cpf',
            'email'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Campo nome obrigatorio',
            'cpf.required'=>'Campo cpf obrigatorio',
            'cpf.unique'=>'CPF ja cadastrado',
            'email.required'=>'Campo email obrigatorio',
        ];
    }
}
