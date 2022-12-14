<x-layout :status="$status">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Usuários</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <a href="{{ route('users.create')  }}" class="btn btn-lg bg-primary mb-3">Cadastrar Usuário</a>
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="list" class="list table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Função</th>
                                <th>Unidade</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($usuarios as $usuario)
                                <tr>
                                    <td>{{ $usuario->nome }}</td>
                                    <td>{{ $usuario->email }}</td>
                                    <td>{{ $usuario->funcao }}</td>
                                    <td>{{ $usuario->unidade }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a class="ml-2" href="{{ route('users.edit', $usuario->id) }}">
                                                <button type="button" class="btn btn-primary">Editar</button>
                                            </a>
                                            <a class="ml-2" href="{{ route('users.password', $usuario->id) }}">
                                                <button type="button" class="btn btn-warning">Alterar Senha</button>
                                            </a>

                                            @if (Auth::user()['funcao'] === '1' || Auth::user()['funcao'] === '2')
                                                @if (Auth::user()['funcao'] == '1' && Auth::user()['funcao'] !== $usuario->funcao )
                                                    <form class="ml-2" action="{{ route('users.destroy', $usuario->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" onclick="return confirm('Deseja realmente excluir?');">
                                                            Excluir
                                                        </button>
                                                    </form>

                                                @elseif (Auth::user()['funcao'] == '2' && $usuario->funcao == '4' || $usuario->funcao == '10' )
                                                    <form class="ml-2" action="{{ route('users.destroy', $usuario->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" onclick="return confirm('Deseja realmente excluir?');">
                                                            Excluir
                                                        </button>
                                                    </form>
                                                @endif
                                            @endif
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                            @if (empty($usuarios))
                                <tr>
                                    <td colspan="5" class="text-center">
                                        Nenhum usuário encontrado
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Função</th>
                                <th>Unidade</th>
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
