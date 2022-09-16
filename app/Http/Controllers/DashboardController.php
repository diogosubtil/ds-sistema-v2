<?php

namespace App\Http\Controllers;

use App\Models\Caixa;
use App\Models\Servico;
use App\Models\Venda;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        //OBTEM O BALANÇO DO MES DO CAIXA
        $balancoCaixa = Caixa::all()->sum('valor');

        //OBTEM O BALANÇO DO MES DAS VENDAS
        $totalVendas = Venda::all()->sum('valortotal');

        //OBTEM O BALANÇO DO MES DOS SERVICOS
        $totalServicos = Servico::all()->sum('valor');

        return view('dashboard.index')
            ->with('balancoCaixa', $balancoCaixa)
            ->with('totalVendas', $totalVendas)
            ->with('totalServicos', $totalServicos);
    }

}
