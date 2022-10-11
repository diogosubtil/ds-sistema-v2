<?php

namespace App\Http\Controllers;

use App\Http\Requests\CaixaFormRequest;
use App\Models\Caixa;
use App\Repositories\CaixaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CaixasController extends Controller
{
    //FUNCAO PARA EXIBIR A VIEW DA PAGINA (PAINEL CAIXA)
    public function index()
    {
        //OBTEM A LISTAGEM DE REGISTRO DO CAIXA
        $listaCaixa = Caixa::query()->where('unidade','=', Auth::user()->set_unidade)->get();

        //OBTEM A SOMA TOTAL DO VALOR
        $balancoCaixa = Caixa::query()->where('unidade','=', Auth::user()->set_unidade)->sum('valor');

        //OBTEM A SOMA TOTAL DE ENTRADAS
        $totalEntradas = Caixa::query()->where('unidade','=', Auth::user()->set_unidade)->whereIn('tipo', ['entrada'])->sum('valor');

        //OBTEM A SOMA TOTAL DE SAIDAS
        $totalSaidas = Caixa::query()->where('unidade','=', Auth::user()->set_unidade)->whereIn('tipo', ['saida'])->sum('valor');

        //OBTEM A FLASH MENSAGE
        $status = session('status');

        //RETORNA O RESULTADO NA PAGINA
        return view('caixa.index')->with('listaCaixa', $listaCaixa)
                                       ->with('balancoCaixa', $balancoCaixa)
                                       ->with('totalEntradas', $totalEntradas)
                                       ->with('totalSaidas', $totalSaidas)
                                       ->with('status', $status);
    }

    //FUNCÃO PARA FILTRAR A LISTAGEM NA PAGINA (PAINEL CAIXA)
    public function filter(Request $request)
    {
        //OBTEM O FILTRO
        $listaCaixa = Caixa::query()
            ->where('descricao', 'LIKE', "%$request->descricao%")
            ->where('tipo', 'LIKE', "%$request->tipo%")
            ->where('unidade','=', Auth::user()->set_unidade)
            ->get();

        //VERIFICA SE EXISTE O FILTRO POR DATA
        if ($request->datainicio){
            $listaCaixa = Caixa::query()->whereBetween('data', [$request->datainicio,$request->datafim])
                ->get();
        }

        //OBTEM A SOMA TOTAL DO VALOR
        $balancoCaixa = Caixa::query()
            ->where('descricao', 'LIKE', "%$request->descricao%")
            ->where('tipo', 'LIKE', "%$request->tipo%")
            ->where('unidade','=', Auth::user()->set_unidade)
            ->sum('valor');

        //OBTEM A SOMA TOTAL DO VALOR
        $totalEntradas = Caixa::query()
            ->where('descricao', 'LIKE', "%$request->descricao%")
            ->where('tipo', 'LIKE', "%$request->tipo%")
            ->where('unidade','=', Auth::user()->set_unidade)
            ->whereIn('tipo', ['entrada'])
            ->sum('valor');

        //OBTEM A SOMA TOTAL DO VALOR
        $totalSaidas = Caixa::query()
            ->where('descricao', 'LIKE', "%$request->descricao%")
            ->where('tipo', 'LIKE', "%$request->tipo%")
            ->where('unidade','=', Auth::user()->set_unidade)
            ->whereIn('tipo', ['saida'])
            ->sum('valor');


        //RETORNA O FILTRO NA PAGINA
        return view('caixa.index')->with('listaCaixa', $listaCaixa)
                                        ->with('balancoCaixa', $balancoCaixa)
                                        ->with('totalEntradas', $totalEntradas)
                                        ->with('totalSaidas', $totalSaidas)
                                        ->with('status', '');
    }

    //FUNÇÃO PARA EXIBIR A VIEW DA PAGINA (CADASTRAR)
    public function create()
    {
        //OBTEM A LISTA DE REGISTRO COM MAXIMO 10
        $listaCaixa = Caixa::query()->where('unidade','=', Auth::user()->set_unidade)->get()->take(10);

        //OBTEM O FLASH MENSAGE
        $status = session('status');

        return view('caixa.create')
            ->with('listaCaixa', $listaCaixa)
            ->with('status', $status);
    }

    //FUNÇÃO PARA ADICIONAR UM REGISTRO NO CAIXA
    public function store(CaixaFormRequest $request, CaixaRepository $repository)
    {
        //OBTEM OS DADOS E CADASTRAR VIA CAIXA REPOSITORY
        $repository->add($request);

        return to_route('caixa.create')
            ->with('status', 'success');
    }

    //FUNÇÃO PARA DELETAR UM REGISTRO
    public function destroy(Caixa $caixa,CaixaRepository $repository)
    {
        //OBTEM OS DADOS E DELETA VIA CAIXA REPOSITORY
        $repository->delete($caixa);

        //RETORNA PARA A PAGINA
        return to_route('caixa.index')
            ->with('status', 'success');
    }

    //FUNÇÃO PARA EXIBIR A VIEW DA PAGINA (EDITAR)
    public function edit(Caixa $caixa)
    {
        return view('caixa.edit')->with('caixa', $caixa);
    }

    //FUNÇÃO FAZ O UPDATE DO REGISTRO
    public function update(Caixa $caixa, CaixaFormRequest $request, CaixaRepository $repository)
    {

        //OBTEM OS DADOS E FAZ UPDATE VIA CAIXA REPOSITORY
        $repository->edit($request, $caixa);

        //RETORNA PARA A PAGINA
        return to_route('caixa.index')
            ->with('status', 'editado');
    }
}
