<?php

use \App\Http\Controllers\UsersController;

?>
<x-layout>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Lojas</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <a href="{{ route('unidades.create') }}" class="btn btn-primary mb-3">Cadastrar Loja</a>
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="list" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Gerente</th>
                                <th>Bairro</th>
                                <th>Cidade</th>
                                <th>UF</th>
                                <th>Endereço</th>
                                <th>Número</th>
                                <th>Whatsapp</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>


                            @foreach ($unidades as $unidade)
                                <tr>
                                    <td>{{ UsersController::nomeUsuario($unidade->gerente) }}</td>
                                    <td>{{ $unidade->bairro }}</td>
                                    <td>{{ $unidade->cidade }}</td>
                                    <td>{{ $unidade->estado }}</td>
                                    <td>{{ $unidade->endereco }}</td>
                                    <td>{{ $unidade->numero }}</td>
                                    <td>{{ $unidade->whatsapp }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('unidades.edit', $unidade->id) }}">
                                            <button type="button" class="btn btn-primary">Editar</button>
                                        </a>
                                @if (Auth::user()['funcao'] === '1')
                                    <form method="post" action="{{ route('unidades.destroy', $unidade->id) }}" class="ml-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Deseja realmente excluir?');">
                                            Excluir
                                        </button>
                                    </form>
                                @endif
                                    </td>
                                </tr>

                            @endforeach

                            @if (empty($unidades))
                                <tr>
                                    <td colspan="10" class="text-center">
                                        Nenhuma unidade encontrada
                                    </td>
                                </tr>
                            @endif

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Gerente</th>
                                <th>Bairro</th>
                                <th>Cidade</th>
                                <th>UF</th>
                                <th>Endereço</th>
                                <th>Número</th>
                                <th>Whatsapp</th>
                                <th>Ações</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</x-layout>

