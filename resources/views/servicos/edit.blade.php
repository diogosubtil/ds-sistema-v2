<x-layout>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edição de Serviços</h1>
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
                            <form action="{{ route('servicos.update', $servico->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nomecliente">Nome do Cliente</label>
                                                <input  type="text" class="form-control" id="nomecliente" name="nomecliente" placeholder="Nome do Cliente" value="{{ $servico->nomecliente }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="pagamento">Forma de Pagamento</label>
                                                <select  name="pagamento" id="pagamento" class="form-control" required>
                                                    <option value="">Selecione</option>
                                                    <option @if ($servico->pagamento === 'D') selected @endif value="D">Dinheiro</option>
                                                    <option @if ($servico->pagamento === 'CD') selected @endif value="CD">Cartão de Debito</option>
                                                    <option @if ($servico->pagamento === 'CC') selected @endif value="CC">Cartão de Crédito</option>
                                                    <option @if ($servico->pagamento === 'Pix') selected @endif value="Pix">Pix</option>
                                                    <option @if ($servico->pagamento === 'TB') selected @endif value="TB">Transferências Bancaria</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="servico">Serviço</label>
                                                <input  type="text" class="form-control" id="servico" name="servico" placeholder="Serviço realizado" value="{{ $servico->servico }}" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="custo">Custo do Serviço</label>
                                                <input  type="number" class="form-control" step="0.010" min="0" id="custo" name="custo" placeholder="Valor dos custos" value="{{ $servico->custo }}" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="valor">Valor Total do Serviço</label>
                                                <input  type="number" class="form-control" step="0.010" min="0" id="valor" name="valor" placeholder="Valor total do serviço" value="{{ $servico->valor }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="data">Data</label>
                                                <input  type="date" class="form-control" id="data" name="data"  value="{{ $servico->data }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4" hidden>
                                            <div class="form-group">
                                                <label for="nomevendedor">Valor Total do Serviço</label>
                                                <input  type="text" class="form-control" id="nomevendedor" name="nomevendedor" value="{{ $servico->nomevendedor }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4" hidden>
                                            <div class="form-group">
                                                <label for="unidade">Valor Total do Serviço</label>
                                                <input  type="text" class="form-control" id="unidade" name="unidade" value="{{ $servico->unidade }}" required>
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


