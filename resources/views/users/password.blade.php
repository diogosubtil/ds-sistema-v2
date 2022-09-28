<x-layout>
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Alterar Senha</h1>
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

                @isset($senha)
                    <div class="alert alert-danger">{{ $senha }}</div>
                @endisset

                <div class="row">
                    <div class="col">

                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title"><strong>{{ $user->nome }}</strong></h3>
                            </div>

                            <form action="{{ route('users.editPassword', $user->id) }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <label for="old-password">Senha Antiga</label>
                                                <input type="password" class="form-control" id="oldPassword" name="oldPassword" value="" placeholder="Senha Antiga">
                                            </div>

                                        </div>

                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <label for="passsword">Nova Senha</label>
                                                <input type="password" class="form-control" id="password" name="password" value="" placeholder="Nova Senha">
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Editar</button>
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

