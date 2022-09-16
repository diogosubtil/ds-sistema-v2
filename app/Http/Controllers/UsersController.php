<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    //FUNÇÃO PARA EXIBIR A VIEW (LISTAR)
    public function index()
    {
        $usuarios = User::all();

        $status = session('status');


        //RETORNA PARA A PAGINA
        return view('users.index')
            ->with('usuarios', $usuarios)
            ->with('status', $status);
    }

    //FUNÇÂO PARA EXIBIR A VIEW (CADASTRAR)
    public function create()
    {
        //OBTEM AS UNIDADES
        $unidades = Unidade::all();

        //RETORNA PARA A PAGINA
        return view('users.create')
            ->with('unidades', $unidades);
    }

    public function store(Request $request)
    {

        $data = $request->except('_token');
        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return to_route('users.index')->with(['status' => 'success']);
    }
}
