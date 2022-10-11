<?php

namespace App\Http\Controllers;

use App\Models\Caixa;
use App\Models\Servico;
use App\Models\User;
use App\Models\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        //OBTEM O BALANÇO DO MES DO CAIXA
        $balancoCaixa = Caixa::query()->where('unidade','=', Auth::user()->set_unidade)->sum('valor');

        //OBTEM O BALANÇO DO MES DAS VENDAS
        $totalVendas = Venda::query()->where('unidade','=', Auth::user()->set_unidade)->sum('valortotal');

        //OBTEM O BALANÇO DO MES DOS SERVICOS
        $totalServicos = Servico::query()->where('unidade','=', Auth::user()->set_unidade)->sum('valor');

        return view('dashboard.index')
            ->with('balancoCaixa', $balancoCaixa)
            ->with('totalVendas', $totalVendas)
            ->with('totalServicos', $totalServicos);
    }

}
