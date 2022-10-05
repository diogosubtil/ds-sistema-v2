<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordFormRequest;
use App\Http\Requests\UsersFormRequest;
use App\Models\Unidade;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Request;

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

    //FUNÇÃO PARA CADASTRAR
    public function store(UsersFormRequest $request, UserRepository $repository)
    {
        //OBTEM OS DADOS E CADASTRAR VIA USER REPOSITORY
        $repository->add($request);

        return to_route('users.index')->with(['status' => 'success']);
    }

    //FUNÇÃO PARA EXIBIR A VIEW (EDITAR)
    public function edit(User $user)
    {
        //OBTEM AS UNIDADES
        $unidades = Unidade::all();

        return view('users.edit')
            ->with('unidades', $unidades)
            ->with('user', $user);
    }

    //FUNÇÃO PARA FAZER UPDATE NO USUARIO
    public function update(UsersFormRequest $request, User $user, UserRepository $repository)
    {
        //OBTEM OS DADOS E FAZ UPDATE VIA USER REPOSITORY
        $repository->edit($request, $user);

        return to_route('users.index');
    }

    //FUNÇÂO PARA DELETAR O USUARIO
    public function destroy(User $user, UserRepository $repository)
    {
        $repository->delete($user);

        return to_route('users.index')->with(['status' => 'success']);
    }


    //FUNÇÃO PARA EXIVIR A VIEW DE ALTERAR A SENHA
    public function password(User $user)
    {
        return view('users.password')->with('user', $user);
    }

    //FUNÇÃO PARA ALTERAR A SENHA
    public function editPassword(PasswordFormRequest $request, User $user, UserRepository $repository)
    {
        //OBTEM OS DADOS E FAZ UPDATE VIA USER REPOSITORY
        $senha = $repository->alterPassword($request, $user);

        //VERIFICA SE O UPDATE RETORNA FALSE
        if ($senha === false) {
            $senha = 'Senha antiga não confere';
            return view('users.password')->with('user', $user)->with('senha', $senha);
        } else {
            return to_route('users.index')->with(['status' => 'success']);
        }

    }

    //FUNÇÃO PARA OBTER O NOME DO USUARIO COM BASE NO SEU ID
    public static function nomeUsuario($id)
    {
        return User::query()->where('id', '=', $id)->first()->nome;
    }
}
