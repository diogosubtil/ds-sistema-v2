<x-layout>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edição do Produto</h1>
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
                            <form action="{{ route('estoque.update', $estoque->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nome">Nome do produto</label>
                                                <input  type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Produto" value="{{ $estoque->nome }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="tipo">Categoria</label>
                                                <select  name="tipo" id="tipo" class="form-control" required>
                                                    <option value="">Selecione</option>
                                                    <option @if($estoque->tipo === 'capa') selected @endif value="capa">Capa para Celular</option>
                                                    <option @if($estoque->tipo === 'fonedeouvido') selected @endif value="fonedeouvido">Fone de Ouvido</option>
                                                    <option @if($estoque->tipo === 'carregador') selected @endif value="carregador">Carregador</option>
                                                    <option @if($estoque->tipo === 'caixadesom') selected @endif value="caixadesom">Caixa de Som</option>
                                                    <option @if($estoque->tipo === 'celular') selected @endif value="celular">Celular</option>
                                                    <option @if($estoque->tipo === 'acessorios') selected @endif value="acessorios">Acessorios</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="descricao">Descrição</label>
                                                <input  type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição do Produto" value="{{ $estoque->descricao }}"  required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="quantidade">Quantidade</label>
                                                <input  type="number" class="form-control" min="0" id="quantidade" name="quantidade" placeholder="Valor da movimentção" value="{{ $estoque->quantidade }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="valor">Valor de Custo</label>
                                                <input  type="number" class="form-control" step="0.010" min="0" id="valor" name="valor" placeholder="Valor de custo do produto" value="{{ $estoque->valor }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="valorvenda">Valor de Venda</label>
                                                <input  type="number" class="form-control" step="0.010" min="0" id="valorvenda" name="valorvenda" placeholder="Valor de venda do produto" value="{{ $estoque->valorvenda }}" required>
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


