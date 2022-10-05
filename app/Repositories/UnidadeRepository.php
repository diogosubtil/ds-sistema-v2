<?php

namespace App\Repositories;

use App\Http\Requests\UnidadeFormRequest;
use App\Models\Unidade;
use Illuminate\Support\Facades\DB;

class UnidadeRepository
{
    //METODO PARA ADICIONAR NO BANCO DE DADOS
    public function add(UnidadeFormRequest $request): Unidade
    {
        $unidade = Unidade::create($request->all());

        return $unidade;
    }

    //FUNÇÃO PARA EDITAR NO BANCO DE DADOS
    public function edit(UnidadeFormRequest $request, Unidade $unidade)
    {
        //INICIA A TRANSAÇÃO
        DB::beginTransaction();

        //SALVA NO BANCO DE DADOS
        $unidade->fill($request->all());
        $unidade->save();

        //ENVIA A TRANSAÇÃO (COMMIT)
        DB::commit();
    }

    //FUNÇÃO PARA DELETAR DO BANCO DE DADOS
    public function delete(Unidade $unidade)
    {
        //DELETA DO BANCO DE DADOS
        $unidade->delete();
    }

}
