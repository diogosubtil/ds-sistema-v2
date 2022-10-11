<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServicosFormRequest;
use App\Models\Servico;
use App\Repositories\ServicoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServicosController extends Controller
{
    //FUNÇÃO PARA EXIBIR  A VIEW DA PAGINA (PAINEL SERVIÇOS)
    public function index()
    {
        //OBTEM A LISTAGEM DE REGISTRO DE SERVICOS
        $listaSevicos = Servico::query()->where('unidade', '=', Auth::user()->set_unidade)->get();

        //OBTEM O TOTAL DE CUSTOS
        $totalCusto = Servico::query()->where('unidade', '=', Auth::user()->set_unidade)->sum('custo');

        //OBTEM O VALOR TOTAL
        $totalValor = Servico::query()->where('unidade', '=', Auth::user()->set_unidade)->sum('valor');

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
                                        ->where('unidade', '=', Auth::user()->set_unidade)
                                        ->get();

        //VERIFICA SE EXISTE O FILTRO POR DATA
        if ($request->datainicio){
            $listaSevicos = Servico::query()->whereBetween('data', [$request->datainicio, $request->datafim])
                                            ->get();
        }

        //OBTEM O TOTAL DE CUSTOS
        $totalCusto = Servico::query()
            ->where('nomecliente', 'LIKE', "%$request->nomecliente%")
            ->where('pagamento', 'LIKE', "%$request->pagamento%")
            ->where('unidade', '=', Auth::user()->set_unidade)
            ->sum('custo');

        //OBTEM O VALOR TOTAL
        $totalValor = Servico::query()
            ->where('nomecliente', 'LIKE', "%$request->nomecliente%")
            ->where('pagamento', 'LIKE', "%$request->pagamento%")
            ->where('unidade', '=', Auth::user()->set_unidade)
            ->sum('valor');

        //RETORNA O FILTRO NA PAGINA
        return view('servicos.index')
            ->with('listaServicos', $listaSevicos)
            ->with('totalCusto', $totalCusto)
            ->with('totalValor', $totalValor)
            ->with('status', '');
    }

    //FUNÇÃO PARA EXIBIR  A VIEW DA PAGINA (CADASTRAR)
    public function create()
    {
        //OBTEM A LISTA DE REGISTRO DOS SERVIÇOS (LIMITE 10)
        $listaServicos = Servico::query()->where('unidade', '=', Auth::user()->set_unidade)->get()->take(10);

        //OBTEM FLASH MENSAGE
        $status = session('status');

        //RETORNA PARA A PAGINA
        return view('servicos.create')
            ->with('listaServicos', $listaServicos)
            ->with('status', $status);
    }

    //FUNÇÃO PARA CADASTRAR UM REGISTRO DE SERVIÇOS
    public function store(ServicosFormRequest $request, ServicoRepository $repository)
    {
        //OBTEM OS DADOS E CADASTRAR VIA SERVÇOS REPOSITORY
        $repository->add($request);

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
    public function update(Servico $servico, ServicosFormRequest $request, ServicoRepository $repository)
    {
        //OBTEM OS DADOS E FAZ UPDATE VIA ESTOQUE REPOSITORY
        $repository->edit($request, $servico);

        //RETORNA PARA A PAGINA
        return to_route('servicos.index')
            ->with('status', 'editado');
    }

    //FUNÇÃO PARA EXCLUIR REGISTRO DE SERVIÇOS
    public function destroy(Servico $servico, ServicoRepository $repository)
    {
        //OBTEM OS DADOS E DELETA VIA ESTOQUE REPOSITORY
        $repository->delete($servico);

        //RETORNA PARA A PAGINA
        return to_route('servicos.index')
            ->with('status', 'success');
    }
}
