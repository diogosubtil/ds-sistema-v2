<x-layout>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edição do Caixa</h1>
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
                            <form action="{{ route('caixa.update', $caixa->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="descricao">Motivo da Movimentação</label>
                                                <input  type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição da Movimentação" value="{{ $caixa->descricao }}"  required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="tipo">Tipo</label>
                                                <select  name="tipo" id="tipo" class="form-control" required>
                                                    <option value="">Selecione</option>
                                                    <option @if($caixa->tipo === 'Entrada') selected @endif value="Entrada">Entrada</option>
                                                    <option @if($caixa->tipo === 'Saida') selected @endif value="Saida">Saida</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="valor">Valor</label>
                                                <input  type="number" class="form-control" step="0.010" id="valor" name="valor" placeholder="Valor da movimentção" value="{{ $caixa->valor }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="data">Data</label>
                                                <input  type="date" class="form-control" id="data" name="data" value="{{ $caixa->data }}" required>
                                            </div>
                                        </div>
                                        <div hidden>
                                            <div class="form-group">
                                                <label for="usuario">Usuario</label>
                                                <input  type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" value="{{ $caixa->usuario }}"  required>
                                            </div>
                                        </div>
                                        <div hidden>
                                            <div class="form-group">
                                                <label for="unidade">Usuario</label>
                                                <input  type="text" class="form-control" id="unidade" name="unidade" placeholder="Usuario" value="{{ $caixa->unidade }}"  required>
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



