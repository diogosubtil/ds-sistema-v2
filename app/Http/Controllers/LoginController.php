<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //FUNÇÃO PARA EXEBIR A VIEW (LOGIN)
    public function index()
    {
        //RETORNA PARA A PAGINA
        return view('login.index');
    }

    //FUNÇÃO QUE FAZ O LOGIN
    public function store(Request $request)
    {
        //VERIFICA O USUARIO
        if (!Auth::attempt($request->only('email', 'password'))){
            return redirect()->back()->withErrors(['Usuário ou senha Inválidos']);
        }

        //RETORNA PARA A PAGINA
        return to_route('dashboard.index');
    }

    //FUNÇÃO PARA DESLOGAR
    public function destroy()
    {
        //DESLOGA O USUARIO
        Auth::logout();

        //RETORNA PARA A PAGINA
        return to_route('login');
    }
}
