<x-layout>
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Editar Usuário</h1>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col">

                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Editar as informações</h3>
                            </div>

                            <form action="{{ route('users.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-2">

                                            <div class="form-group">
                                                <label for="nome">Nome</label>
                                                <input type="text" class="form-control" value="{{ $user->nome }}" id="nome" name="nome" placeholder="Nome" required>
                                            </div>

                                        </div>

                                        <div class="col-md-2">

                                            <div class="form-group">
                                                <label for="email">E-mail</label>
                                                <input type="email" class="form-control" value="{{ $user->email }}" id="email" name="email" placeholder="E-mail" required>
                                            </div>

                                        </div>

                                        <div class="col-md-2">

                                            <div class="form-group">
                                                <label for="senha">Usuario</label>
                                                <input type="text" class="form-control" value="{{ $user->usuario }}" id="usuario" name="usuario" placeholder="Usuario" required>
                                            </div>

                                        </div>

                                        <div hidden class="col-md-2">

                                            <div class="form-group">
                                                <label for="senha">Senha</label>
                                                <input type="text" class="form-control" value="{{ 'VALIDAÇÂO NO BACK-END' }}" id="password" name="password" placeholder="Senha" required>
                                            </div>

                                        </div>

                                        <div class="col-md-2">

                                            <div class="form-group">
                                                <label for="telefone">Telefone</label>
                                                <input type="text" class="form-control" value="{{ $user->telefone }}" id="telefone" name="telefone" placeholder="Telefone">
                                            </div>

                                        </div>

                                        <div class="col-md-2">

                                            <div class="form-group">
                                                <label for="funcao">Função</label>
                                                <select name="funcao" id="funcao" class="form-control">
                                                    <option value="">Selecione...</option>
                                                    <option value="1" @if ($user->funcao == '1') selected @endif>Master</option>
                                                    <option value="2" @if ($user->funcao == '2') selected @endif>Gerente</option>
                                                    <option value="3" @if ($user->funcao == '3') selected @endif>Aplicador</option>
                                                    <option value="4" @if ($user->funcao == '4') selected @endif>Recepçãp/Vendedor</option>
                                                    <option value="10" @if ($user->funcao == '10') selected @endif>Cliente</option>
                                                </select>
                                            </div>

                                        </div>

                                        <div class="col-md-2">

                                            <div class="form-group">
                                                <label for="unidade">Unidade</label>
                                                <select name="unidade" id="unidade" class="form-control">
                                                    <option value="0">Selecione uma unidade...</option>
                                                    @foreach ($unidades as $unidade)
                                                    <option value="{{$unidade->id}}" @if ($user->unidade == $unidade->id) selected @endif>
                                                        {{ $unidade->bairro . ' - ' . $unidade->cidade }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">Editar</button>
                                    <a href="{{ route('users.index') }}" class="btn btn-danger">Cancelar</a>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layout>

