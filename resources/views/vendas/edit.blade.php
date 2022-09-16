<x-layout>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edição de Vendas</h1>
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
                            <form action="{{ route('vendas.update', $venda->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nomecliente">Nome do Cliente</label>
                                                <input  type="text" class="form-control" id="nomecliente" name="nomecliente" placeholder="Nome do Cliente" value="{{ $venda->nomecliente }}"  required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="tipo">Forma de Pagamento</label>
                                                <select  name="tipo" id="tipo" class="form-control" required>
                                                    <option value="">Selecione</option>
                                                    <option @if($venda->tipo == 'D') selected @endif value="D">Dinheiro</option>
                                                    <option @if($venda->tipo == 'CD') selected @endif value="CD">Cartão de Debito</option>
                                                    <option @if($venda->tipo == 'CC') selected @endif value="CC">Cartão de Crédito</option>
                                                    <option @if($venda->tipo == 'Pix') selected @endif value="Pix">Pix</option>
                                                    <option @if($venda->tipo == 'TB') selected @endif value="TB">Transferências Bancaria</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="data">Data</label>
                                                <input  type="date" class="form-control" id="data" name="data" value="{{ $venda->data }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="idproduto">Produto</label>
                                                <select  name="idproduto" id="idproduto" class="form-control" required>
                                                    <option value="">Selecione</option>
                                                    @foreach($listaEstoque as $lista)
                                                        <option @if($venda->idproduto == $lista->id) selected @endif  value="{{ $lista->id }}">{{  $lista->id." - ".$lista->nome." (".$lista->descricao.")"  }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="valorproduto">Valor do Produto</label>
                                                <input  type="number" class="form-control" step="0.010" min="0" id="valorproduto" name="valorproduto" placeholder="Valor do Produto" value="{{ $venda->valorproduto }}" required>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="quantidade">Quantidade</label>
                                                <input  type="number" class="form-control"  min="0" id="quantidade" name="quantidade" placeholder="Quantidade de produtos" value="{{ $venda->quantidade }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="valortotal">Valor Total</label>
                                                <input  type="number" class="form-control" step="0.010" min="0" id="valortotal" name="valortotal" placeholder="Valor total da venda" value="{{ $venda->valortotal }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3" hidden>
                                            <div class="form-group">
                                                <label for="unidade">Valor Total</label>
                                                <input  type="text" class="form-control" id="unidade" name="unidade" value="{{ $venda->unidade }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3" hidden>
                                            <div class="form-group">
                                                <label for="nomevendedor">Valor Total</label>
                                                <input  type="text" class="form-control" id="nomevendedor" name="nomevendedor" value="{{ $venda->nomevendedor }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn bg-primary">Editar</button>
                                </div>
                            </form>
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

