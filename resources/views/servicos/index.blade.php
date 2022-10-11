<x-layout :status="$status">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-auto">
                    <div class="col-sm-6 col-6">
                        <h1 class="m-0">Painel de Serviços</h1>
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
                                <h3>{{ $listaServicos->count() }}</h3>
                                <p>Serviços</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-screwdriver"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-6">

                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ number_format($totalCusto, 2, ',', '.') }}</h3>
                                <p>Total de Custos</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-12">

                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ number_format($totalValor, 2, ',', '.') }}</h3>
                                <p>Valor Total de Serviços</p>
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
                            <form action="{{ route('servicos.filter') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nomecliente">Nome do Cliente</label>
                                                <input  type="text" class="form-control" id="nomecliente" name="nomecliente" placeholder="Nome do Cliente" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="pagamento">Forma de Pagamento</label>
                                                <select  name="pagamento" id="pagamento" class="form-control">
                                                    <option value="">Selecione</option>
                                                    <option value="D">Dinheiro</option>
                                                    <option value="CD">Cartão de Debito</option>
                                                    <option value="CC">Cartão de Crédito</option>
                                                    <option value="Pix">Pix</option>
                                                    <option value="TB">Transferências Bancaria</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="datainicio">Data Inicio</label>
                                                <input  type="date" class="form-control" id="datainicio" name="datainicio" value="">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="datafim">Data Fim</label>
                                                <input  type="date" class="form-control" id="datafim" name="datafim" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn bg-primary">Filtros</button>
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
                                <h3 class="card-title">Registros</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body ">
                                <table id="example1" class="table table-bordered table-striped" style="text-align: center">
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
                                    @forelse ($listaServicos as $servico)
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
<script src="{{ asset('/plugins/pdfmake/vfs_fonts.js') }}"></script>
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
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });

    //DESABILITA INPUT DEPENDENDO DA SELEÇÃO
    $('#datainicio').on("change", function() {
        $("#datafim").attr('required', '') ;
        $("#mes").attr('disabled', '') ;

    });

    $('#datafim').on("change", function() {
        $("#datainicio").attr('required', '') ;
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
