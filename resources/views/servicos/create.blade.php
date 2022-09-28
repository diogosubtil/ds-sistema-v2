<x-layout :status="$status">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Cadastro de Serviços</h1>
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
                            <div class="card-header bg-info">
                                <h3 class="card-title">Insira as informações</h3>
                            </div>
                            <form action="{{ route('servicos.store') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nomecliente">Nome do Cliente</label>
                                                <input  type="text" class="form-control" id="nomecliente" name="nomecliente" placeholder="Nome do Cliente"  required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="pagamento">Forma de Pagamento</label>
                                                <select  name="pagamento" id="pagamento" class="form-control" required>
                                                    <option value="">Selecione</option>
                                                    <option value="D">Dinheiro</option>
                                                    <option value="CD">Cartão de Debito</option>
                                                    <option value="CC">Cartão de Crédito</option>
                                                    <option value="Pix">Pix</option>
                                                    <option value="TB">Transferências Bancaria</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="servico">Serviço</label>
                                                <input  type="text" class="form-control" id="servico" name="servico" placeholder="Serviço realizado" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="custo">Custo do Serviço</label>
                                                <input  type="number" class="form-control" step="0.010" min="0" id="custo" name="custo" placeholder="Valor dos custos" value="" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="valor">Valor Total do Serviço</label>
                                                <input  type="number" class="form-control" step="0.010" min="0" id="valor" name="valor" placeholder="Valor total do serviço" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="data">Data</label>
                                                <input  type="date" class="form-control" id="data" name="data"  value="{{ date('Y-m-d') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4" hidden>
                                            <div class="form-group">
                                                <label for="nomevendedor">Valor Total do Serviço</label>
                                                <input  type="text" class="form-control" id="nomevendedor" name="nomevendedor" value="Diogo" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4" hidden>
                                            <div class="form-group">
                                                <label for="unidade">Valor Total do Serviço</label>
                                                <input  type="text" class="form-control" id="unidade" name="unidade" value="1" required>
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
                                <h3 class="card-title">Ultimas Vendas</h3>
                            </div>
                            <div class="col-12" style="text-align: center">
                                <div class="" style="margin: 5px">
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                            <tr>
                                                <th>Nome do Cliente</th>
                                                <th>Vendedor</th>
                                                <th>Serviço</th>
                                                <th>Forma de Pagamento</th>
                                                <th>Custo do Serviço</th>
                                                <th>Valor do Serviço</th>
                                                <th>Data</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($listaServicos as $servico)
                                                <?php
                                                if ($servico->pagamento == 'D'){
                                                    $FormPag = 'Dinheiro';
                                                } elseif ($servico->pagamento == 'CD') {
                                                    $FormPag = 'Cartão de Debito';
                                                } elseif ($servico->pagamento == 'CC') {
                                                    $FormPag = 'Cartão de Crédito';
                                                } elseif ($servico->pagamento == 'Pix') {
                                                    $FormPag = 'Pix';
                                                } elseif ($servico->pagamento == 'TB') {
                                                    $FormPag = 'Tranferência Bancaria';
                                                }
                                                ?>
                                                <tr>
                                                    <td>{{$servico->nomecliente}}</td>
                                                    <td>{{$servico->nomevendedor}}</td>
                                                    <td>{{$servico->servico}}</td>
                                                    <td>{{$FormPag}}</td>
                                                    <td>{{number_format($servico->custo,2,',', '.')}}</td>
                                                    <td>{{number_format($servico->valor,2,',', '.')}}</td>
                                                    <td>{{date('d/m/Y',strtotime($servico->data))}}</td>
                                                    <td class="d-flex justify-content-center">
                                                        <a href="{{ route('servicos.edit', $servico->id) }}"><button type="button" class="btn btn-primary toastrDefaultSuccess"><i class="fas fa-pen"></i></button></a>
                                                        <form action="{{ route('servicos.destroy', $servico->id) }}" method="post" class="ml-2">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button onclick="return excluir()" type="button" class="btn btn-danger toastrDefaultSuccess"><i class="fas fa-trash"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div style="font-size: 20px">
                                            <?php if (empty($listaServicos)){
                                                echo 'Nenhum registro encontrado!';
                                            } ?>
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

