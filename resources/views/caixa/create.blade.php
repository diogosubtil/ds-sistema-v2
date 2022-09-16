<x-layout :status="$status">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Cadastro do Caixa</h1>
                    </div>

                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="card card-secondary">
                            <div class="card-header bg-info">
                                <h3 class="card-title">Insira as informações</h3>
                            </div>
                            <form action="{{ route('caixa.store') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="descricao">Motivo da Movimentação</label>
                                                <input  type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição da Movimentação"  required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="tipo">Tipo</label>
                                                <select  name="tipo" id="tipo" class="form-control" required>
                                                    <option value="">Selecione</option>
                                                    <option value="Entrada">Entrada</option>
                                                    <option value="Saida">Saida</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="valor">Valor</label>
                                                <input  type="number" class="form-control" step="0.010" min="0" id="valor" name="valor" placeholder="Valor da movimentção" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="data">Data</label>
                                                <input  type="date" class="form-control" id="data" name="data" value="{{ date('Y-m-d') }}" required>
                                            </div>
                                        </div>
                                        <div hidden>
                                            <div class="form-group">
                                                <label for="usuario">Usuario</label>
                                                <input  type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" value="Diogo"  required>
                                            </div>
                                        </div>
                                        <div hidden>
                                            <div class="form-group">
                                                <label for="unidade">Usuario</label>
                                                <input  type="text" class="form-control" id="unidade" name="unidade" placeholder="Usuario" value="1"  required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn bg-primary">Cadastrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="card card-secondary">
                            <div class="card-header bg-info">
                                <h3 class="card-title">Ultimos Registros</h3>
                            </div>
                            <div class="col-12" style="text-align: center">
                                <div class="" style="margin: 5px">
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap"  >
                                            <thead>
                                            <tr>
                                                <th>Vendedor</th>
                                                <th>Descrição</th>
                                                <th>Tipo</th>
                                                <th>Valor</th>
                                                <th>Data</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($listaCaixa as $caixa)
                                                <tr>
                                                    <td>{{ $caixa->usuario }}</td>
                                                    <td>{{ $caixa->descricao }}</td>
                                                    <td>{{ $caixa->tipo }}</td>
                                                    <td>{{ number_format($caixa->valor, 2, ',', '.') }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($caixa->data)) }}</td>
                                                    <td class="d-flex justify-content-center">
                                                        @if( empty($caixa->idservico) && empty($caixa->idvenda))
                                                            <a href="{{ route('caixa.edit', $caixa->id) }}"><button type="button" class="btn btn-primary toastrDefaultSuccess mr-2"><i class="fas fa-pen"></i></button></a>
                                                        @endif
                                                        <form action="{{ route('caixa.destroy', $caixa->id) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button onclick="return excluir()" id="excluirconfirm" type="submit" class="btn btn-danger toastrDefaultSuccess" ><i class="fas fa-trash"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div style="font-size: 20px">
                                            @if (empty($listaCaixa))
                                                'Nenhum registro encontrado!'
                                            @endif
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>



