<x-layout  :status="$status">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-auto">
                    <div class="col-sm-6 col-6">
                        <h1 class="m-0">Painel do Estoque</h1>
                    </div>

                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-6">

                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $listaEstoque->count() }}</h3>
                                <p>Produtos em Estoque</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-coins"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-6">

                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $totalProdutos }}</h3>
                                <p>Itens em Estoque</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-12">

                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ number_format($totalValor, 2, ',', '.') }}</h3>
                                <p>Valor total do Estoque</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <a href="#" class="small-box-footer">

                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="card card-secondary">
                            <div class="card-header bg-primary">
                                <h3 class="card-title">Filtro</h3>
                            </div>
                            <form action="{{ route('estoque.filter') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="nome">Nome do produto</label>
                                                <input  type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Produto" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="tipo">Categoria</label>
                                                <select  name="tipo" id="tipo" class="form-control">
                                                    <option value="">Selecione</option>
                                                    <option value="capa" >Capa para Celular</option>
                                                    <option value="fonedeouvido" >Fone de Ouvido</option>
                                                    <option value="carregador" >Carregador</option>
                                                    <option value="caixadesom" >Caixa de Som</option>
                                                    <option value="celular" >Celular</option>
                                                    <option value="acessorios" >Acessorios</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="descricao">Descrição</label>
                                                <input  type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição do Produto" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="datainicio">Data Inicio</label>
                                                <input  type="date" class="form-control" id="datainicio" name="datainicio" value="">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="datafim">Data Fim</label>
                                                <input  type="date" class="form-control" id="datafim" name="datafim" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn bg-primary">Filtrar</button>
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-primary">
                                <h3 class="card-title">Lista de Produtos</h3>
                            </div>
                                <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped" style="text-align: center">
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
                                    @forelse($listaEstoque as $estoque)
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
                                    @empty
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
    <!-- DataTables  & Plugins -->
<script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('/pugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>

<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,"ordering": false,
            "buttons": ["excel", "pdf", "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });

    //DESABILITA IMPUT DEPENDENDO DA SELEÇÃO
    $('#datainicio').on("change", function() {
        $("#datafim").attr('required', '') ;
        $("#mes").attr('disabled', '') ;

    });
    $('#mes').on("change", function() {
        $("#datainicio").attr('disabled', '') ;
        $("#datafim").attr('disabled', '') ;
    });

</script>
<style>
    #example1_filter{
        float: right;
    }
    #example1_paginate {
        float: right;
    }
</style>
