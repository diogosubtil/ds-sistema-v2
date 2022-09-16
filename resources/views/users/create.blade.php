<x-layout>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Cadastrar Usuário</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col">

                        <div class="card card-secondary">
                            <div class="card-header bg-primary">
                                <h3 class="card-title">Insira as informações</h3>
                            </div>

                            <form action="{{ route('users.store') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-2">

                                            <div class="form-group">
                                                <label for="nome">Nome</label>
                                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>
                                            </div>

                                        </div>

                                        <div class="col-md-2">

                                            <div class="form-group">
                                                <label for="email">E-mail</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" required>
                                            </div>

                                        </div>

                                        <div class="col-md-2">

                                            <div class="form-group">
                                                <label for="senha">Usuario</label>
                                                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" required>
                                            </div>

                                        </div>

                                        <div class="col-md-2">

                                            <div class="form-group">
                                                <label for="senha">Senha</label>
                                                <input type="text" class="form-control" id="password" name="password" placeholder="Senha" required>
                                            </div>

                                        </div>

                                        <div class="col-md-2">

                                            <div class="form-group">
                                                <label for="telefone">Telefone</label>
                                                <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone">
                                            </div>

                                        </div>

                                        <div class="col-md-2">

                                            <div class="form-group">
                                                <label for="funcao">Função</label>
                                                <select name="funcao" id="funcao" class="form-control">
                                                    <option value="">Selecione...</option>
                                                    <option value="1">Master</option>
                                                    <option value="2">Gerente</option>
                                                    <option value="4">Recepção/Vendedor</option>
                                                    <option value="10">Cliente</option>
                                                </select>
                                            </div>

                                        </div>

                                        <div class="col-md-2">

                                            <div class="form-group">
                                                <label for="unidade">Unidade</label>
                                                <select name="unidade" id="unidade" class="form-control">
                                                    <option value="0">Selecione uma unidade...</option>
                                                    @foreach($unidades as $unidade)
                                                    <option value="{{ $unidade->id }}">{{ $unidade->bairro . ' - ' .$unidade->cidade }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn bg-primary">Cadastrar</button>
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

