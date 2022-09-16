<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use Illuminate\Http\Request;

class EstoquesController extends Controller
{
    //FUNCAO PARA EXIBIR A VIEW DA PAGINA (PAINEL ESTOQUE)
    public function index()
    {
        //OBTEM A LISTA DE REGISTRO DO ESTOQUE
        $listaEstoque = Estoque::all();

        //OBTEM TOTAL DE PRODUTOS EM ESTOQUE
        $totalProdutos = Estoque::all()->sum('quantidade');

        //OBTEM VALOR TOTAL DO ESTOQUE
        $totalValor = Estoque::all()->sum('totalvalor');

        //OBTEM FLASH MENSAGE
        $status = session('status');

        //RETORNA O RESULTADO NA PAGINA
        return view('estoque.index')
            ->with('listaEstoque', $listaEstoque)
            ->with('totalProdutos', $totalProdutos)
            ->with('totalValor', $totalValor)
            ->with('status', $status);
    }

    //FUNCÃO PARA FILTRAR A LISTAGEM NA PAGINA (PAINEL ESTOQUE)
    public function filter(Request $request)
    {
        //OBTEM O FILTRO
        $listaEstoque = Estoque::query()->where('nome', 'LIKE', "%$request->nome%")
                                        ->where('tipo', 'LIKE', "%$request->tipo%")
                                        ->where('descricao', 'LIKE', "%$request->descricao%")
                                        ->get();

        //VERIFICA SE EXISTE O FILTRO POR DATA
        if ($request->datainicio){
            $listaEstoque = Estoque::query()->whereBetween('data', [$request->datainicio, $request->datafim])
                                            ->get();
        }

        //OBTEM TOTAL DE PRODUTOS EM ESTOQUE
        $totalProdutos = $listaEstoque->sum('quantidade');

        //OBTEM VALOR TOTAL DO ESTOQUE
        $totalValor = $listaEstoque->sum('totalvalor');

        //RETORNA O RESULTADO NA PAGINA
        return view('estoque.index')
            ->with('listaEstoque', $listaEstoque)
            ->with('totalProdutos', $totalProdutos)
            ->with('totalValor', $totalValor);
    }

    //FUNÇÃO PARA EXIBIR A VIEW DA PAGINA (CADASTRAR)
    public function create()
    {
        //OBTEM LISTA DE REGISTRO DO ESTOQUE
        $listaEstoque = Estoque::all()->take(10);

        //OBTEM FLASH MENSAGE
        $status = session('status');

        //RETORNA O RESULTADO NA PAGINA
        return view('estoque.create')
            ->with('listaEstoque', $listaEstoque)
            ->with('status', $status);
    }

    //FUNÇÃO PARA CRIAR REGISTRO NO ESTOQUE
    public function store(Request $request)
    {
        //OBTEM TODOS OS INPUTS E CADASTRAR
        $estoque = new Estoque();
        $estoque->nome = $request->nome;
        $estoque->tipo = $request->tipo;
        $estoque->descricao = $request->descricao;
        $estoque->valor = $request->valor;
        $estoque->quantidade = $request->quantidade;
        $estoque->valorvenda = $request->valorvenda;
        $estoque->unidade = 1;
        $estoque->totalvalor = $request->quantidade*$request->valorvenda;
        $estoque->data = date('Y-m-d');
        $estoque->save();


        //RETORNA O RESULTADO NA PAGINA
        return to_route('estoque.create')
            ->with('status', 'success');
    }

    //FUNÇÃO PARA DELETAR UM REGISTRO
    public function destroy(Estoque $estoque)
    {
        $estoque->delete();
        return to_route('estoque.index')
            ->with('status', 'success');
    }

    //FUNÇÃO PARA EXIBIR A VIEW DA PAGINA (EDITAR)
    public function edit(Estoque $estoque)
    {
        return view('estoque.edit')->with('estoque', $estoque);
    }

    //FUNÇÃO FAZ O UPDATE DO REGISTRO
    public function update(Request $request, Estoque $estoque)
    {
        //OBTEM TODOS OS INPUTS E CADASTRA
        $estoque->nome = $request->nome;
        $estoque->tipo = $request->tipo;
        $estoque->descricao = $request->descricao;
        $estoque->valor = $request->valor;
        $estoque->quantidade = $request->quantidade;
        $estoque->valorvenda = $request->valorvenda;
        $estoque->unidade = 1;
        $estoque->totalvalor = $request->quantidade*$request->valorvenda;
        $estoque->save();

        //RETORNA O RESULTADO NA PAGINA
        return to_route('estoque.index')
            ->with('status', 'editado');
    }
}
