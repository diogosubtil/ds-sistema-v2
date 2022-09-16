<?php

namespace App\Http\Controllers;

use App\Models\Caixa;
use Illuminate\Http\Request;

class CaixasController extends Controller
{
    //FUNCAO PARA EXIBIR A VIEW DA PAGINA (PAINEL CAIXA)
    public function index()
    {
        //OBTEM A LISTAGEM DE REGISTRO DO CAIXA
        $listaCaixa = Caixa::all();

        //OBTEM A SOMA TOTAL DO VALOR
        $balancoCaixa = $listaCaixa->sum('valor');

        //OBTEM A SOMA TOTAL DE ENTRADAS
        $totalEntradas = $listaCaixa->toQuery()->whereIn('tipo', ['entrada'])->sum('valor');

        //OBTEM A SOMA TOTAL DE SAIDAS
        $totalSaidas = $listaCaixa->toQuery()->whereIn('tipo', ['saida'])->sum('valor');

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
        $listaCaixa = Caixa::query()->where('descricao', 'LIKE', "%$request->descricao%")
                                    ->where('tipo', 'LIKE', "%$request->tipo%")
                                    ->get();

        //VERIFICA SE EXISTE O FILTRO POR DATA
        if ($request->datainicio){
            $listaCaixa = Caixa::query()->whereBetween('data', [$request->datainicio,$request->datafim])
                ->get();
        }

        //OBTEM A SOMA TOTAL DO VALOR
        $balancoCaixa = $listaCaixa->sum('valor');

        //OBTEM A SOMA TOTAL DO VALOR
        $totalEntradas = $listaCaixa->toQuery()->whereIn('tipo', ['entrada'])->sum('valor');

        //OBTEM A SOMA TOTAL DO VALOR
        $totalSaidas = $listaCaixa->toQuery()->whereIn('tipo', ['saida'])->sum('valor');


        //RETORNA O FILTRO NA PAGINA
        return view('caixa.index')->with('listaCaixa', $listaCaixa)
                                        ->with('balancoCaixa', $balancoCaixa)
                                        ->with('totalEntradas', $totalEntradas)
                                        ->with('totalSaidas', $totalSaidas);
    }

    //FUNÇÃO PARA EXIBIR A VIEW DA PAGINA (CADASTRAR)
    public function create()
    {
        //OBTEM A LISTA DE REGISTRO COM MAXIMO 10
        $listaCaixa = Caixa::all()->take(10);

        //OBTEM O FLASH MENSAGE
        $status = session('status');

        return view('caixa.create')
            ->with('listaCaixa', $listaCaixa)
            ->with('status', $status);
    }

    //FUNÇÃO PARA ADICIONAR UM REGISTRO NO CAIXA
    public function store(Request $request)
    {
        //OBTEM TODOS OS INPUTS E VERIFICA
        $caixa = new Caixa();
        $caixa->descricao = $request->descricao;
        $caixa->tipo = $request->tipo;
        if ($request->tipo == 'Saida'){
            $caixa->valor = '-'.$request->valor;
        } else {
            $caixa->valor = $request->valor;
        }
        $caixa->data = $request->data;
        $caixa->usuario = $request->usuario;
        $caixa->unidade = $request->unidade;
        $caixa->save();

        return to_route('caixa.create')
            ->with('status', 'success');
    }

    //FUNÇÃO PARA DELETAR UM REGISTRO
    public function destroy(Caixa $caixa)
    {
        //DELETA O REGISTRO
        $caixa->delete();

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
    public function update(Caixa $caixa, Request $request)
    {
        //OBTEM TODOS OS INPUTS E FAZ Mass assignment
        $caixa->fill($request->all());
        //VERIFICA SE É UMA SAIDA E FAZ O VALOR FICAR NEGATIVO
        if ($request->tipo == 'Saida'){
            $caixa->valor = '-'.$request->valor;
        }
        //SALVA A EDIÇÃO
        $caixa->save();

        //RETORNA PARA A PAGINA
        return to_route('caixa.index')
            ->with('status', 'editado');
    }
}
