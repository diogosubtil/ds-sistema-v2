<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServicosFormRequest extends FormRequest
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
            'pagamento'      => ['required'],
            'servico'     => ['required','min:3'],
            'custo'      => ['required'],
            'valor'      => ['required'],
            'data'      => ['required'],
        ];
    }
}
