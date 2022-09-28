<?php

namespace App\Repositories;

use App\Http\Requests\VendasFormRequest;
use App\Models\Estoque;
use App\Models\Venda;
use Illuminate\Support\Facades\DB;

class VendaRepository
{
    //METODO PARA CADASTRAR NO BANCO DE DADOS
    public function add(VendasFormRequest $request): Venda
    {
        //INICIA A TRANSAÇÃO
        DB::beginTransaction();

        //OBTEM O ITEM DO ESTOQUE E FAZ UPDATE CONFORME A VENDA
        $estoque = Estoque::query()->where('id','=',$request->idproduto)->first();
        $estoque->quantidade = $estoque->quantidade - $request->quantidade;
        $estoque->totalvalor = $estoque->totalvalor - ($request->quantidade * $estoque->valorvenda);
        $estoque->save();

        //OBTEM TODOS OS INPUTS E FAZ Mass assignment
        $venda = Venda::create($request->all());

        //ENVIA A TRASAÇÃO (COMMIT)
        DB::commit();

        return $venda;
    }

    public function edit(VendasFormRequest $request, Venda $venda)
    {
        //INICIA A TRANSAÇÃO
        DB::beginTransaction();

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

        //ENVIA A TRASAÇÃO (COMMIT)
        DB::commit();
    }

    //METODO PARA DELETAR DO BANCO DE DADOS
    public function delete(Venda $venda)
    {
        //OBTEM O ITEM DO ESTOQUE E FAZ UPDATE CONFORME A VENDA
        $estoque = Estoque::query()->where('id','=',$venda->idproduto)->first();
        $estoque->quantidade = $estoque->quantidade + $venda->quantidade;
        $estoque->totalvalor = $estoque->totalvalor + ($venda->quantidade * $estoque->valorvenda);
        $estoque->save();

        //OBTEM O OBJETO E DELETA
        $venda->delete();
    }
}
