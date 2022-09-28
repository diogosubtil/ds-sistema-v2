<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendasFormRequest extends FormRequest
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
            'nomecliente' => ['required', 'min:3'],
            'tipo'      => ['required'],
            'data'     => ['required'],
            'idproduto'      => ['required'],
            'valorproduto'      => ['required'],
            'quantidade'      => ['required'],
            'valortotal'      => ['required'],
        ];
    }
}
