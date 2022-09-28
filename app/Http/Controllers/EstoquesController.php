<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstoqueFormRequest;
use App\Models\Estoque;
use App\Repositories\EstoqueRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function store(EstoqueFormRequest $request, EstoqueRepository $repository)
    {
        //OBTEM OS DADOS E CADASTRAR VIA ESTOQUE REPOSITORY
        $repository->add($request);

        //RETORNA O RESULTADO NA PAGINA
        return to_route('estoque.create')
            ->with('status', 'success');
    }

    //FUNÇÃO PARA DELETAR UM REGISTRO
    public function destroy(Estoque $estoque, EstoqueRepository $repository)
    {
        //OBTEM OS DADOS E DELETA VIA ESTOQUE REPOSITORY
        $repository->delete($estoque);

        return to_route('estoque.index')
            ->with('status', 'success');
    }

    //FUNÇÃO PARA EXIBIR A VIEW DA PAGINA (EDITAR)
    public function edit(Estoque $estoque)
    {
        return view('estoque.edit')->with('estoque', $estoque);
    }

    //FUNÇÃO FAZ O UPDATE DO REGISTRO
    public function update(EstoqueFormRequest $request, Estoque $estoque, EstoqueRepository $repository)
    {
        //OBTEM OS DADOS E FAZ UPDATE VIA ESTOQUE REPOSITORY
        $repository->edit($request, $estoque);

        //RETORNA O RESULTADO NA PAGINA
        return to_route('estoque.index')
            ->with('status', 'editado');
    }
}
