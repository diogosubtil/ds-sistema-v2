<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnidadeFormRequest;
use App\Models\Unidade;
use App\Models\User;
use App\Repositories\UnidadeRepository;
use Illuminate\Http\Request;

class UnidadesController extends Controller
{
    //FUNÇÃO PARA EXIBIR A VIEW (LISTAR)
    public function index()
    {
        //OBTEM TODAS AS UNIDADES
        $unidades = Unidade::all();

        //OBTEM A FLASH MENSAGE
        $status = session('status');

        return view('unidades.index')
            ->with('unidades', $unidades)
            ->with('status', $status);
    }

    //FUNÇÃO PARA EXIBIR A VIEW (CADASTRAR)
    public function create()
    {
        //OBTEM TODOS OS USUARIOS
        $usuarios = User::all();

        //TIMEZONES BRASIL
        $timezones = array(
            'AC' => 'America/Rio_branco',   'AL' => 'America/Maceio',
            'AP' => 'America/Belem',        'AM' => 'America/Manaus',
            'BA' => 'America/Bahia',        'CE' => 'America/Fortaleza',
            'DF' => 'America/Sao_Paulo',    'ES' => 'America/Sao_Paulo',
            'GO' => 'America/Sao_Paulo',    'MA' => 'America/Fortaleza',
            'MT' => 'America/Cuiaba',       'MS' => 'America/Campo_Grande',
            'MG' => 'America/Sao_Paulo',    'PR' => 'America/Sao_Paulo',
            'PB' => 'America/Fortaleza',    'PA' => 'America/Belem',
            'PE' => 'America/Recife',       'PI' => 'America/Fortaleza',
            'RJ' => 'America/Sao_Paulo',    'RN' => 'America/Fortaleza',
            'RS' => 'America/Sao_Paulo',    'RO' => 'America/Porto_Velho',
            'RR' => 'America/Boa_Vista',    'SC' => 'America/Sao_Paulo',
            'SE' => 'America/Maceio',       'SP' => 'America/Sao_Paulo',
            'TO' => 'America/Araguaia',
        );

        return view('unidades.create')
            ->with('usuarios', $usuarios)
            ->with('timezones', $timezones);
    }

    //FUNÇÃO PARA CADASTRAR NO BANCO DE DADOS
    public function store(UnidadeFormRequest $request, UnidadeRepository $repository)
    {
        //OBTEM O REQUEST E CADASTRAR NO BANCO VIA UNIDADES REPOSITORY
        $repository->add($request);

        return to_route('unidades.index')
            ->with('status', 'success');
    }

    //FUNÇÃO PARA EXEBIR A VIEW (EDITAR)
    public function edit(Unidade $unidade)
    {
       //OBTEM TODOS OS USUARIOS
       $usuarios = User::all();

        //TIMEZONES BRASIL
        $timezones = array(
            'AC' => 'America/Rio_branco',   'AL' => 'America/Maceio',
            'AP' => 'America/Belem',        'AM' => 'America/Manaus',
            'BA' => 'America/Bahia',        'CE' => 'America/Fortaleza',
            'DF' => 'America/Sao_Paulo',    'ES' => 'America/Sao_Paulo',
            'GO' => 'America/Sao_Paulo',    'MA' => 'America/Fortaleza',
            'MT' => 'America/Cuiaba',       'MS' => 'America/Campo_Grande',
            'MG' => 'America/Sao_Paulo',    'PR' => 'America/Sao_Paulo',
            'PB' => 'America/Fortaleza',    'PA' => 'America/Belem',
            'PE' => 'America/Recife',       'PI' => 'America/Fortaleza',
            'RJ' => 'America/Sao_Paulo',    'RN' => 'America/Fortaleza',
            'RS' => 'America/Sao_Paulo',    'RO' => 'America/Porto_Velho',
            'RR' => 'America/Boa_Vista',    'SC' => 'America/Sao_Paulo',
            'SE' => 'America/Maceio',       'SP' => 'America/Sao_Paulo',
            'TO' => 'America/Araguaia',
        );

       return view('unidades.edit')
           ->with('unidade', $unidade)
           ->with('usuarios', $usuarios)
           ->with('timezones', $timezones);
    }
    public function update(UnidadeFormRequest $request, Unidade $unidade, UnidadeRepository $repository)
    {
        //OBTEM O REQUEST E FAZ UPDATE NO BANCO VIA UNIDADES REPOSITORY
        $repository->edit($request, $unidade);

        return to_route('unidades.index')
            ->with('status', 'editado');
    }

    //FUNÇÃO PARA DELETAR DO BANCO DE DADOS
    public function destroy(Unidade $unidade,UnidadeRepository $repository)
    {
        //OBTEM O REQUEST E DELETA DO BANCO VIA UNIDADES REPOSITORY
        $repository->delete($unidade);

        return to_route('unidades.index')
            ->with('status', 'success');
    }

    //FUNÇÃO PARA OBTEM O NOME DA UNIDADE
    public static function nomeUnidade($unidade)
    {
        //OBTEM A UNIDADE
        $unidade = Unidade::query()->where('id','=', $unidade)->first();

        //OBTEM O NOME COMPLETO DA UNIDADE
        $unidade = $unidade->bairro . ' - ' . $unidade->cidade . ' - ' . $unidade->estado;

        return $unidade;
    }
}
