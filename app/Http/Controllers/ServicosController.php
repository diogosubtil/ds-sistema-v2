<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use Illuminate\Http\Request;

class ServicosController extends Controller
{
    //FUNÇÃO PARA EXIBIR  A VIEW DA PAGINA (PAINEL SERVIÇOS)
    public function index()
    {
        //OBTEM A LISTAGEM DE REGISTRO DE SERVICOS
        $listaSevicos = Servico::all();

        //OBTEM O TOTAL DE CUSTOS
        $totalCusto = Servico::all()->sum('custo');

        //OBTEM O VALOR TOTAL
        $totalValor = Servico::all()->sum('valor');

        //OBTEM FLASH MENSAGE
        $status = session('status');

        //RETORNA O RESULTADO NA PAGINA
        return view('servicos.index')
            ->with('listaServicos', $listaSevicos)
            ->with('totalCusto', $totalCusto)
            ->with('totalValor', $totalValor)
            ->with('status', $status);
    }

    //FUNCÃO PARA FILTRAR A LISTAGEM NA PAGINA (PAINEL CAIXA)
    public function filter(Request $request)
    {
        //OBTEM O FILTRO
        $listaSevicos = Servico::query()->where('nomecliente', 'LIKE', "%$request->nomecliente%")
                                        ->where('pagamento', 'LIKE', "%$request->pagamento%")
                                        ->get();

        //VERIFICA SE EXISTE O FILTRO POR DATA
        if ($request->datainicio){
            $listaSevicos = Servico::query()->whereBetween('data', [$request->datainicio, $request->datafim])
                                            ->get();
        }

        //OBTEM O TOTAL DE CUSTOS
        $totalCusto = $listaSevicos->sum('custo');

        //OBTEM O VALOR TOTAL
        $totalValor = $listaSevicos->sum('valor');

        //RETORNA O FILTRO NA PAGINA
        return view('servicos.index')
            ->with('listaServicos', $listaSevicos)
            ->with('totalCusto', $totalCusto)
            ->with('totalValor', $totalValor);
    }

    //FUNÇÃO PARA EXIBIR  A VIEW DA PAGINA (CADASTRAR)
    public function create()
    {
        //OBTEM A LISTA DE REGISTRO DOS SERVIÇOS (LIMITE 10)
        $listaServicos = Servico::all()->take(10);

        //OBTEM FLASH MENSAGE
        $status = session('status');

        //RETORNA PARA A PAGINA
        return view('servicos.create')
            ->with('listaServicos', $listaServicos)
            ->with('status', $status);
    }

    //FUNÇÃO PARA CADASTRAR UM REGISTRO DE SERVIÇOS
    public function store(Request $request)
    {
        //OBTEM TODOS OS INPUTS E FAZ Mass assignment
        Servico::create($request->all());

        //RETORNA PARA A PAGINA
        return to_route('servicos.create')
            ->with('status', 'success');
    }

    //FUNÇÃO PARA EXIBIR  A VIEW DA PAGINA (EDITAR)
    public function edit(Servico $servico)
    {
        //RETORNA PARA A PAGINA
        return view('servicos.edit')->with('servico', $servico);
    }

    //FUNÇÃO PARA FAZER UPDATE DO REGISTRO DE SERVIÇO
    public function update(Servico $servico, Request $request)
    {
        //OBTEM TODOS OS INPUTS E FAZ Mass assignment
        $servico->fill($request->all());

        //SALVA A EDIÇÃO
        $servico->save();

        //RETORNA PARA A PAGINA
        return to_route('servicos.index')
            ->with('status', 'editado');
    }

    //FUNÇÃO PARA EXCLUIR REGISTRO DE SERVIÇOS
    public function destroy(Servico $servico)
    {
        //DELELTA O REGISTRO
        $servico->delete();

        //RETORNA PARA A PAGINA
        return to_route('servicos.index')
            ->with('status', 'success');
    }
}
