<?php

namespace App\Repositories;

use App\Http\Requests\EstoqueFormRequest;
use App\Models\Estoque;
use Illuminate\Support\Facades\DB;

class EstoqueRepository
{
    //METODO PARA ADICIONAR REGISTRO NO BANCO DE DADOS
    public function add(EstoqueFormRequest $request): Estoque
    {
        //INICIA A TRANSAÇÃO
        DB::beginTransaction();

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

        //ENVIA A TRASAÇÃO (COMMIT)
        DB::commit();

        return $estoque;
    }

    //METODO PARA UPDATE DE REGISTRO NO BANCO DE DADOS
    public function edit(EstoqueFormRequest $request, Estoque $estoque)
    {
        //INICIA A TRANSAÇÃO
        DB::beginTransaction();

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

        //ENVIA A TRASAÇÃO (COMMIT)
        DB::commit();
    }

    //METODO PARA DELETAR DO BANDO DE DADOS
    public function delete(Estoque $estoque)
    {
        //OBTEM O OBJETO E DELETA
        $estoque->delete();
    }

    //METODO PARA BUSCAR VALOR DO PRODUTO
    public function buscaValor(Estoque $estoque)
    {
        //BUSCAO VALOR DO PRODUTO
        $produto = Estoque::query()->where('id', '=', $estoque->id)->get('valorvenda');

        return $produto;
    }
}
