<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use Illuminate\Http\Request;

class UnidadesController extends Controller
{
    //FUNÇÃO PARA OBTEM O NOME DA UNIDADE
    public static function nomeUnidade($unidade)
    {
        $unidade = Unidade::query()->where('id','=', $unidade)->get()->first();

        $unidade = $unidade->bairro . ' - ' . $unidade->cidade . ' - ' . $unidade->estado;

        return $unidade;
    }
}
