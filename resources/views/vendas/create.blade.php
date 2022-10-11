<x-layout :status="$status">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Cadastro de Vendas</h1>
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
                            <form action="{{ route('vendas.store') }}" method="POST">
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
                                                <label for="tipo">Forma de Pagamento</label>
                                                <select  name="tipo" id="tipo" class="form-control" required>
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
                                                <label for="data">Data</label>
                                                <input  type="date" class="form-control" id="data" name="data" value="{{ date('Y-m-d') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="idproduto">Produto</label>
                                                <select  name="idproduto" id="idproduto" class="form-control" required>
                                                    <option value="">Selecione</option>
                                                    @forelse($listaEstoque as $lista)
                                                    <option value="{{ $lista->id }}">{{  $lista->id." - ".$lista->nome." (".$lista->descricao.")"  }}</option>
                                                    @empty
                                                        <option value="">Nenhum produto em estoque!</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="valorproduto">Valor do Produto</label>
                                                <input  type="number" class="form-control" step="0.010" min="0" id="valorproduto" name="valorproduto" placeholder="Valor do Produto" value="" required>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="quantidade">Quantidade</label>
                                                <input  type="number" class="form-control"  min="0" id="quantidade" name="quantidade" placeholder="Quantidade de produtos" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="valortotal">Valor Total</label>
                                                <input  type="number" class="form-control" step="0.010" min="0" id="valortotal" name="valortotal" placeholder="Valor total da venda" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3" hidden>
                                            <div class="form-group">
                                                <label for="unidade">Valor Total</label>
                                                <input  type="text" class="form-control" id="unidade" name="unidade" value="1" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3" hidden>
                                            <div class="form-group">
                                                <label for="nomevendedor">Valor Total</label>
                                                <input  type="text" class="form-control" id="nomevendedor" name="nomevendedor" value="Diogo" required>
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
                                                <th>Produto</th>
                                                <th>Quantidade</th>
                                                <th>Forma de Pagamento</th>
                                                <th>Valor do Produto</th>
                                                <th>Valor total da Venda</th>
                                                <th>Data</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($listaVenda as $lista)
                                                <?php
                                                if ($lista->tipo == 'D'){
                                                    $FormPag = 'Dinheiro';
                                                } elseif ($lista->tipo == 'CD') {
                                                    $FormPag = 'Cartão de Debito';
                                                } elseif ($lista->tipo == 'CC') {
                                                    $FormPag = 'Cartão de Crédito';
                                                } elseif ($lista->tipo == 'Pix') {
                                                    $FormPag = 'Pix';
                                                } elseif ($lista->tipo == 'TB') {
                                                    $FormPag = 'Tranferência Bancaria';
                                                } ?>
                                                <tr>
                                                    <td>{{$lista->nomecliente}}</td>
                                                    <td>{{$lista->nomevendedor}}</td>
                                                    <td>{{$lista->idproduto}}</td>
                                                    <td>{{$lista->quantidade}}</td>
                                                    <td>{{$FormPag}}</td>
                                                    <td>{{number_format($lista->valorproduto,2,',', '.')}}</td>
                                                    <td>{{number_format($lista->valortotal,2,',', '.')}}</td>
                                                    <td>{{date('d/m/Y',strtotime($lista->data))}}</td>
                                                    <td class="d-flex justify-content-center">
                                                        <a href="{{ route('vendas.edit', $lista->id)}}"><button type="button" class="btn btn-primary toastrDefaultSuccess" ><i class="fas fa-pen"></i></button></a>
                                                        <form action="{{ route('vendas.destroy', $lista->id) }}" method="post" class="ml-2">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button onclick="return excluir()" type="submit" class="btn btn-danger toastrDefaultSuccess" ><i class="fas fa-trash"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <td class="position-absolute col-12">Nenhum registro encontrado!</td>
                                            @endforelse
                                            </tbody>
                                        </table>

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

<script type='text/javascript'>
    $('#idproduto').on('change', function (){
        $.ajax({
            url: '{{ route('vendas.buscavalor', '_id_') }}'.replace('_id_', $(this).val()),
            type: 'GET',
            dataType: 'json',
            success: function(data){
                $('#valorproduto').val(data.produto[0].valorvenda);
            },
            error: function(data){
                console.log(data)
            }
        });
    });
</script>
<script>
    let idproduto = window.document.getElementById('idproduto')
    idproduto.addEventListener('blur',  function (e){
        e.preventDefault();
        const quantidade = window.document.getElementById('quantidade');
        const valuequantidade = quantidade.value;
        const valor = window.document.getElementById('valorproduto');
        const valuevalor = valor.value;
        const somar = valuequantidade*valuevalor;
        const valortotal = window.document.getElementById('valortotal');
        valortotal.value = somar;
    })
    let quantidade = window.document.getElementById('quantidade')
    quantidade.addEventListener('blur',  function (e){
        e.preventDefault();
        const quantidade = window.document.getElementById('quantidade');
        const valuequantidade = quantidade.value;
        const valor = window.document.getElementById('valorproduto');
        const valuevalor = valor.value;
        const somar = valuequantidade*valuevalor;
        const valortotal = window.document.getElementById('valortotal');
        valortotal.value = somar;
    })
    let valorproduto = window.document.getElementById('valorproduto')
    valorproduto.addEventListener('blur',  function (e){
        e.preventDefault();
        const quantidade = window.document.getElementById('quantidade');
        const valuequantidade = quantidade.value;
        const valor = window.document.getElementById('valorproduto');
        const valuevalor = valor.value;
        const somar = valuequantidade*valuevalor;
        const valortotal = window.document.getElementById('valortotal');
        valortotal.value = somar;
    })
</script>


