<x-layout>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Cadastrar Loja</h1>
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
                            <div class="card-header bg-primary">
                                <h3 class="card-title">Insira as informações</h3>
                            </div>

                            <form action="{{ route('unidades.store') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-2">

                                            <div class="form-group">
                                                <label for="cep">CEP</label>
                                                <input type="text" onblur="pesquisacep(this.value)" class="form-control" id="cep" name="cep" placeholder="CEP" required>
                                            </div>

                                        </div>

                                        <div class="col-md-2">

                                            <div class="form-group">
                                                <label for="dataAbertura">Data de Abertura</label>
                                                <input type="date" class="form-control" id="dataAbertura" name="dataAbertura" placeholder="Data de Abertura">
                                            </div>

                                        </div>

                                        <div hidden class="col-md-2">

                                            <div class="form-group">
                                                <label for="dataCadastro">Data de Cadastro</label>
                                                <input type="date" class="form-control" id="dataCadastro" name="dataCadastro"  value="{{ date('Y-m-d') }}" placeholder="Data de Abertura">
                                            </div>

                                        </div>

                                        <div class="col-md-2">

                                            <div class="form-group">
                                                <label for="whatsapp">Whatsapp</label>
                                                <input type="text" class="form-control" id="whatsapp" name="whatsapp" placeholder="Whatsapp">
                                            </div>

                                        </div>

                                        <div class="col-md-2">

                                            <div class="form-group">
                                                <label for="meta">Meta</label>
                                                <input type="number" class="form-control" id="meta" name="meta" placeholder="Meta">
                                            </div>

                                        </div>

                                        <div class="col-md-2">

                                            <div class="form-group">
                                                <label for="gerente">Gerente</label>
                                                <select name="gerente" id="gerente" class="form-control">
                                                    <option value="">Selecione um gerente...</option>
                                                    @foreach ($usuarios as $usuario)
                                                        <option value="{{ $usuario->id }}">{{ $usuario->nome }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-2">

                                            <div class="form-group">
                                                <label for="bairro">Bairro</label>
                                                <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro">
                                            </div>

                                        </div>

                                        <div class="col-md-2">

                                            <div class="form-group">
                                                <label for="cidade">Cidade</label>
                                                <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade">
                                            </div>

                                        </div>

                                        <div class="col-md-1">

                                            <div class="form-group">
                                                <label for="estado">Estado</label>
                                                <input type="text" class="form-control" id="estado" name="estado" placeholder="Estado">
                                            </div>

                                        </div>

                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <label for="endereco">Endereço</label>
                                                <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Endereço">
                                            </div>

                                        </div>

                                        <div class="col-md-1">

                                            <div class="form-group">
                                                <label for="numero">Número</label>
                                                <input type="text" class="form-control" id="numero" name="numero" placeholder="Número">
                                            </div>

                                        </div>

                                        <div class="col-md-2">

                                            <div class="form-group">
                                                <label for="timezone">Timezone</label>
                                                <select name="timezone" id="timezone" class="form-control">
                                                    <option value="">Selecione...</option>
                                                    @foreach ($timezones as $timezone)
                                                    <option value="{{ $timezone }}">{{ $timezone }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn bg-primary">Cadastrar</button>
                                    <a href="{{ route('unidades.index') }}" class="btn btn-danger">Cancelar</a>
                                </div>

                            </form>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layout>
