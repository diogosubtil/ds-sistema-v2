<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnidadeFormRequest extends FormRequest
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
            'cep' => 'required',
            'dataAbertura' => 'required',
            'whatsapp' => 'required',
            'meta' => 'required',
            'gerente' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'estado' => 'required',
            'endereco' => 'required',
            'numero' => 'required',
            'timezone' => 'required'
        ];
    }
}
