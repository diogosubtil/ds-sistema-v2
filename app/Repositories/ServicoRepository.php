<?php

namespace App\Repositories;

use App\Http\Requests\ServicosFormRequest;
use App\Models\Servico;
use Illuminate\Support\Facades\DB;

class ServicoRepository
{
    //METODO PARA CADASTRAR NO BANCO DE DADOS
    public function add(ServicosFormRequest $request): Servico
    {
        //INICIA A TRANSAÇÃO
        DB::beginTransaction();

        //OBTEM TODOS OS INPUTS E FAZ Mass assignment
        $servico = Servico::create($request->all());

        //ENVIA A TRASAÇÃO (COMMIT)
        DB::commit();

        return $servico;
    }

    //METODO PARA UPDATE DO BANCO DE DADOS
    public function edit(ServicosFormRequest $request, Servico $servico)
    {
        //INICIA A TRANSAÇÃO
        DB::beginTransaction();

        //OBTEM TODOS OS INPUTS E FAZ Mass assignment
        $servico->fill($request->all());

        //SALVA A EDIÇÃO
        $servico->save();

        //ENVIA A TRASAÇÃO (COMMIT)
        DB::commit();
    }

    //METODO PARA DELETAR DO BANCO DE DADOS
    public function delete(Servico $servico)
    {
        //OBTEM O OBJETO E DELETA
        $servico->delete();
    }
}
