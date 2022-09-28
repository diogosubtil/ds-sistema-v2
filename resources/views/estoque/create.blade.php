<x-layout :status="$status">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Cadastro do Estoque</h1>
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
                            <form action="{{ route('estoque.store') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nome">Nome do produto</label>
                                                <input  type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Produto"  required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="tipo">Categoria</label>
                                                <select  name="tipo" id="tipo" class="form-control" required>
                                                    <option value="">Selecione</option>
                                                    <option value="capa">Capa para Celular</option>
                                                    <option value="fonedeouvido">Fone de Ouvido</option>
                                                    <option value="carregador">Carregador</option>
                                                    <option value="caixadesom">Caixa de Som</option>
                                                    <option value="celular">Celular</option>
                                                    <option value="acessorios">Acessorios</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="descricao">Descrição</label>
                                                <input  type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição do Produto"  required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="quantidade">Quantidade</label>
                                                <input  type="number" class="form-control" min="0" id="quantidade" name="quantidade" placeholder="Valor da movimentção" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="valor">Valor de Custo</label>
                                                <input  type="number" class="form-control" step="0.010" min="0" id="valor" name="valor" placeholder="Valor de custo do produto" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="valorvenda">Valor de Venda</label>
                                                <input  type="number" class="form-control" step="0.010" min="0" id="valorvenda" name="valorvenda" placeholder="Valor de venda do produto" required>
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
                                <h3 class="card-title">Ultimos produtos adicionados</h3>
                            </div>
                            <div class="col-12" style="text-align: center">
                                <div class="" style="margin: 5px">
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Categoria</th>
                                                <th>Descrição</th>
                                                <th>Custo</th>
                                                <th>Venda</th>
                                                <th>Quantidade</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($listaEstoque as $estoque)
                                                <?php
                                                if($estoque->tipo == 'capa'){
                                                    $tipo = 'Capa para Celular';
                                                } elseif ($estoque->tipo == 'fonedeouvido') {
                                                    $tipo = 'Fone de Ouvido';
                                                } elseif ($estoque->tipo == 'carregador'){
                                                    $tipo = 'Carregador';
                                                } elseif ($estoque->tipo == 'caixadesom'){
                                                    $tipo = 'Caixa de Som';
                                                } elseif ($estoque->tipo == 'celular'){
                                                    $tipo = 'Celular';
                                                } elseif ($estoque->tipo == 'acessorios'){
                                                    $tipo = 'Acessórios';
                                                }
                                                ?>
                                                <tr>
                                                    <td>{{ $estoque->nome }}</td>
                                                    <td>{{ $tipo }}</td>
                                                    <td>{{ $estoque->descricao }}</td>
                                                    <td>{{ number_format($estoque->valor,2,',', '.')}}</td>
                                                    <td>{{ number_format($estoque->valorvenda,2,',', '.') }}</td>
                                                    <td>{{ $estoque->quantidade }}</td>
                                                    <td class="d-flex justify-content-center">
                                                        <a href="{{ route('estoque.edit', $estoque->id) }}"><button type="button" class="btn btn-primary toastrDefaultSuccess"><i class="fas fa-pen"></i></button></a>
                                                        <form action="{{ route('estoque.destroy', $estoque->id) }}" method="post" class="ml-2">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button onclick="return excluir()" type="submit" class="btn btn-danger toastrDefaultSuccess"><i class="fas fa-trash"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div style="font-size: 20px">
                                            <?php if (empty($listaEstoque)){
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


