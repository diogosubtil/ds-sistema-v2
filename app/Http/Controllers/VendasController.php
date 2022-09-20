<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Models\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendasController extends Controller
{
    //FUNÇÃO PARA EXIBIR A VIEW DA PAGINA (PAINEL VENDAS)
    public function index()
    {
        //OBTEM A LISTAGEM
        $listaVenda = Venda::all();

        //OBTEM QUANTIDADE DE PRODUTOS VENDIDOS
        $produtosVendidos = Venda::all()->sum('quantidade');

        //OBTEM TOTAL DE VENDAS
        $totalVendas = Venda::all()->sum('valortotal');

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
                                    ->get();

        if ($request->datainicio){
            $listaVenda = Venda::query()->whereBetween('data', [$request->datainicio, $request->datafim])
                                        ->get();
        }

        //OBTEM QUANTIDADE DE PRODUTOS VENDIDOS
        $produtosVendidos = $listaVenda->sum('quantidade');

        //OBTEM TOTAL DE VENDAS
        $totalVendas = $listaVenda->sum('valortotal');

        //RETORNA O RESULTADO NA PAGINA
        return view('vendas.index')
            ->with('listaVenda', $listaVenda)
            ->with('produtosVendidos', $produtosVendidos)
            ->with('totalVendas', $totalVendas);
    }

    //FUNÇÃO EXIBIR A VIEW DA PAGINA (CADASTRAR)
    public function create()
    {
        //OBTEM LISTAGEM COM LIMITE 10
        $listaVenda = Venda::all()->take(10);

        //OBTEM LISTA DE PRODUTOS
        $listaEstoque = Estoque::all();

        //OBTEM FLASH MENSAGE
        $status = session('status');

        //RETORNA PARA A PAGINA
        return view('vendas.create')
            ->with('listaVenda', $listaVenda)
            ->with('listaEstoque', $listaEstoque)
            ->with('status', $status);
    }

    //FUNÇÃO PARA ADICIONAR REGISTRO NAS VENDAS
    public function store(Request $request)
    {
        //OBTEM O ITEM DO ESTOQUE E FAZ UPDATE CONFORME A VENDA
        $estoque = Estoque::query()->where('id','=',$request->idproduto)->first();
        $estoque->quantidade = $estoque->quantidade - $request->quantidade;
        $estoque->totalvalor = $estoque->totalvalor - ($request->quantidade * $estoque->valorvenda);
        $estoque->save();

        //OBTEM TODOS OS INPUTS E FAZ Mass assignment
        Venda::create($request->all());

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
    public function update(Venda $venda,Request $request)
    {

        if ($venda->idproduto !== $request->idproduto || $venda->quantidade !== $request->quantidade){
            //OBTEM O ITEM DO ESTOQUE E FAZ UPDATE CONFORME A EDIÇÃO
            $estoque = Estoque::query()->where('id','=',$venda->idproduto)->first();
            $estoque->quantidade = $estoque->quantidade + $venda->quantidade;
            $estoque->totalvalor = $estoque->totalvalor + ($venda->quantidade * $estoque->valorvenda);
            $estoque->save();
        }

        //OBTEM O ITEM DO ESTOQUE E FAZ UPDATE CONFORME A EDIÇÃO
        $estoque = Estoque::query()->where('id','=',$request->idproduto)->first();
        $estoque->quantidade = $estoque->quantidade - $request->quantidade;
        $estoque->totalvalor = $estoque->totalvalor - ($request->quantidade * $estoque->valorvenda);
        $estoque->save();


        //OBTEM TODOS OS INPUTS E FAZ Mass assignment
        $venda->fill($request->all());
        $venda->save();

        //RETORNA PARA A PAGINA
        return to_route('vendas.index')
            ->with('status', 'editado');
    }

    //FUNÇÃO PARA EXCLUIR REGISTRO DA VENDA
    public function destroy(Venda $venda)
    {

        //OBTEM O ITEM DO ESTOQUE E FAZ UPDATE CONFORME A VENDA
        $estoque = Estoque::query()->where('id','=',$venda->idproduto)->first();
        $estoque->quantidade = $estoque->quantidade + $venda->quantidade;
        $estoque->totalvalor = $estoque->totalvalor + ($venda->quantidade * $estoque->valorvenda);
        $estoque->save();

        //FAZ A EXCLUSÃO
        $venda->delete();

        //RETORNA PARA A PAGINA
        return to_route('vendas.index')
            ->with('status', 'success');
    }


    //FUNÇÃO BUSCAR VALOR DO PRODUTO NO ESTOQUE
    public function buscavalorestoque(Estoque $estoque)
    {
        //BUSCAO VALOR DO PRODUTO
        $produto = Estoque::query()->where('id', '=', $estoque->id)->get('valorvenda');

        //RETORNA PARA A PAGINA
        return response()->json([
            'produto' => $produto
        ]);
    }

}
