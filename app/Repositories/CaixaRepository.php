<?php

namespace App\Repositories;

use App\Http\Requests\CaixaFormRequest;
use App\Models\Caixa;
use Illuminate\Support\Facades\DB;

class CaixaRepository
{
    //METODO PARA CADASTRAR NO BANDO DE DADOS
    public function add(CaixaFormRequest $request): Caixa
    {
        //INICIA A TRANSAÇÃO
        DB::beginTransaction();

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

        //ENVIA A TRASAÇÃO (COMMIT)
        DB::commit();

        return $caixa;
    }

    //METODO PARA UPDATE DO BANCO DE DADOS
    public function edit(CaixaFormRequest $request, Caixa $caixa)
    {
        //INICIA A TRANSAÇÃO
        DB::beginTransaction();

        //OBTEM TODOS OS INPUTS E FAZ Mass assignment
        $caixa->fill($request->all());
        //VERIFICA SE É UMA SAIDA E FAZ O VALOR FICAR NEGATIVO
        if ($request->tipo == 'Saida'){
            $caixa->valor = '-'.$request->valor;
        }
        //SALVA A EDIÇÃO
        $caixa->save();

        //ENVIA A TRASAÇÃO (COMMIT)
        DB::commit();
    }

    //METODO PARA DELETAR DO BANCO DE DADOS
    public function delete(Caixa $caixa)
    {
        //OBTEM O OBEJTO E DELETA
        $caixa->delete();
    }
}
