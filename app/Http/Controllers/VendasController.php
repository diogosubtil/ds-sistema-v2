<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendasFormRequest;
use App\Models\Estoque;
use App\Models\Venda;
use App\Repositories\EstoqueRepository;
use App\Repositories\VendaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendasController extends Controller
{
    //FUNÇÃO PARA EXIBIR A VIEW DA PAGINA (PAINEL VENDAS)
    public function index()
    {
        //OBTEM A LISTAGEM
        $listaVenda = Venda::query()->where('unidade', '=', Auth::user()->set_unidade)->get();

        //OBTEM QUANTIDADE DE PRODUTOS VENDIDOS
        $produtosVendidos = Venda::query()->where('unidade', '=', Auth::user()->set_unidade)->sum('quantidade');

        //OBTEM TOTAL DE VENDAS
        $totalVendas = Venda::query()->where('unidade', '=', Auth::user()->set_unidade)->sum('valortotal');

        //OBTEM FLASH MENSAGE
        $status = session('status');

        //RETORNA O RESULTADO NA PAGINA
        return view('vendas.index')
            ->with('listaVenda', $listaVenda)
            ->with('produtosVendidos', $produtosVendidos)
            ->with('totalVendas', $totalVendas)
            ->with('status', $status);
    }

    public function filter(Request $request)
    {
        //OBTEM A LISTAGEM
        $listaVenda = Venda::query()->where('nomecliente', 'LIKE', "%$request->nomecliente%")
                                    ->where('tipo', 'LIKE', "%$request->tipo%")
                                    ->where('unidade', '=', Auth::user()->set_unidade)
                                    ->get();

        if ($request->datainicio){
            $listaVenda = Venda::query()->whereBetween('data', [$request->datainicio, $request->datafim])
                                        ->get();
        }

        //OBTEM QUANTIDADE DE PRODUTOS VENDIDOS
        $produtosVendidos = Venda::query()
            ->where('nomecliente', 'LIKE', "%$request->nomecliente%")
            ->where('tipo', 'LIKE', "%$request->tipo%")
            ->where('unidade', '=', Auth::user()->set_unidade)
            ->sum('quantidade');

        //OBTEM TOTAL DE VENDAS
        $totalVendas = Venda::query()
            ->where('nomecliente', 'LIKE', "%$request->nomecliente%")
            ->where('tipo', 'LIKE', "%$request->tipo%")
            ->where('unidade', '=', Auth::user()->set_unidade)
            ->sum('valortotal');

        //RETORNA O RESULTADO NA PAGINA
        return view('vendas.index')
            ->with('listaVenda', $listaVenda)
            ->with('produtosVendidos', $produtosVendidos)
            ->with('totalVendas', $totalVendas)
            ->with('status', '');
    }

    //FUNÇÃO EXIBIR A VIEW DA PAGINA (CADASTRAR)
    public function create()
    {
        //OBTEM LISTAGEM COM LIMITE 10
        $listaVenda = Venda::query()->where('unidade', '=',Auth::user()->set_unidade)->get()->take(10);

        //OBTEM LISTA DE PRODUTOS
        $listaEstoque = Estoque::query()->where('unidade', '=', Auth::user()->set_unidade)->get();

        //OBTEM FLASH MENSAGE
        $status = session('status');

        //RETORNA PARA A PAGINA
        return view('vendas.create')
            ->with('listaVenda', $listaVenda)
            ->with('listaEstoque', $listaEstoque)
            ->with('status', $status);
    }

    //FUNÇÃO PARA ADICIONAR REGISTRO NAS VENDAS
    public function store(VendasFormRequest $request, VendaRepository $repository)
    {
        //OBTEM OS DADOS E CADASTRAR VIA VENDAS REPOSITORY
        $repository->add($request);

        //RETORNA PARA A PAGINA
        return to_route('vendas.create')
            ->with('status', 'success');
    }

    //FUNÇÃO PARA EXIBIR A VIEW DA PAGINA (EDITAR)
    public function edit(Venda $venda)
    {
        //OBTEM A LISTA DE PRODUTOS DO ESTOQUE
        $listaEstoque = Estoque::all();

        //RETORNA PARA A PAGINA
        return view('vendas.edit')
            ->with('venda', $venda)
            ->with('listaEstoque', $listaEstoque);
    }

    //FUNÇÃO PARA FAZER UPDATE DO REGISTRO DA VENDA
    public function update(Venda $venda,VendasFormRequest $request, VendaRepository $repository)
    {
        //OBTEM OS DADOS E FAZ UPDATE VIA VENDA REPOSITORY
        $repository->edit($request, $venda);

        //RETORNA PARA A PAGINA
        return to_route('vendas.index')
            ->with('status', 'editado');
    }

    //FUNÇÃO PARA EXCLUIR REGISTRO DA VENDA
    public function destroy(Venda $venda, VendaRepository $repository)
    {
        //OBTEM OS DADOS E DELETA VIA VENDA REPOSITORY
        $repository->delete($venda);

        //RETORNA PARA A PAGINA
        return to_route('vendas.index')
            ->with('status', 'success');
    }


    //FUNÇÃO BUSCAR VALOR DO PRODUTO NO ESTOQUE
    public function buscavalorestoque(Estoque $estoque, EstoqueRepository $repository)
    {
        //BUSCAO VALOR DO PRODUTO
        $produto = $repository->buscaValor($estoque);

        //RETORNA PARA A PAGINA
        return response()->json([
            'produto' => $produto
        ]);
    }

}
