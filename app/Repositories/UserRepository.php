<?php

namespace App\Repositories;

use App\Http\Requests\PasswordFormRequest;
use App\Http\Requests\UsersFormRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class UserRepository
{
    //METODO PARA CADASTRAR NO BANCO DE DADOS
    public function add(UsersFormRequest $request): User
    {
        //INICIA A TRANSAÇÃO
        DB::beginTransaction();

        $data = $request->except('_token');
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        //ENVIA A TRASAÇÃO (COMMIT)
        DB::commit();

        return $user;
    }

    //METODO PARA UPDATE NO BANCO DE DADOS
    public function edit(UsersFormRequest $request, User $user)
    {
        //INICIA A TRANSAÇÃO
        DB::beginTransaction();

        //OBTEM OS DADOS DO REQUEST E FAZ O UPDATE
        $data = $request->except('_token');
        $data['password'] = $user->password;
        $user->fill($data);
        $user->save();

        //ENVIA A TRANSAÇÃO (COMMIT)
        DB::commit();
    }

    //METODO PARA ALTERAS A SENHA DO USUARIO
    public function alterPassword(PasswordFormRequest $request, User $user)
    {
        //VERIFICA SE A SENHA ANTIGA SÃO IGUAIS
        if (!Hash::check($request->oldPassword, $user->password)){
            //SE NAO FOR IGUAIS RETORNA FALSE
            return false;
        } else {
            //SE FOREM IGUAIS FAZ O UPDATE
            //INICIA A TARNSAÇÃO
            DB::beginTransaction();

            $user->password = Hash::make($request->password);
            $user->save();

            //ENVIA A ATRANSAÇÃO (COMMIT)
            DB::commit();

            //RETORNA TRUE
            return true;
        }
    }

    //METODO PARA DELETER UM USUARIO
    public function delete(User $user)
    {
        //OBTEM E DELETA O USUARIO
        $user->delete();
    }

    //FUNÇÃO PARA ALTERAR NO BANCO DE DADOS A UNIDADE PARA EXIBIR INFORMAÇÕES NO SISTEMA
    public function setUnidade(Request $request, User $user)
    {
        //INICIA A TARNSAÇÃO
        DB::beginTransaction();

        $user->set_unidade = $request->unidade;
        $user->save();

        //ENVIA A ATRANSAÇÃO (COMMIT)
        DB::commit();
    }
}
