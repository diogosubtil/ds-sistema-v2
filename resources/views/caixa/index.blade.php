<x-layout :status="$status">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid mb-3">
                <div class="row">
                    <div class="col-sm-6 col-6">
                        <h1 class="m-0">Painel do Caixa</h1>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-6">

                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $listaCaixa->count() }}</h3>
                                    <p>Registros</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-clipboard-check"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">

                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ number_format($balancoCaixa, 2, ',', '.') }}</h3>
                                    <p>Balanço do Caixa</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">

                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ number_format($totalEntradas, 2, ',', '.') }}</h3>
                                    <p>Entradas</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                <a href="#" class="small-box-footer">

                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">

                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ number_format($totalSaidas, 2, ',', '.') }}</h3>
                                    <p>Saidas</p>
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
                                    <h3 class="card-title">Filtros</h3>
                                </div>
                                <form action="{{ route('caixa.filter') }}" method="post">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="descricao">Descrição</label>
                                                    <input  type="text" class="form-control" id="descricao" name="descricao" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="tipo">Tipo</label>
                                                    <select  name="tipo" id="tipo" class="form-control" >
                                                        <option value="">Selecione</option>
                                                        <option @if(isset($_GET['tipo']) == 'Entrada') selected @endif value="Entrada">Entrada</option>
                                                        <option @if(isset($_GET['tipo']) == 'Saida') selected @endif value="Saida">Saida</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="datainicio">Data Inicio</label>
                                                    <input  type="date" class="form-control" id="datainicio" name="datainicio" @isset($_GET['datainicio']) value="{{ $_GET['datainicio'] }}" @endisset>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="datafim">Data Fim</label>
                                                    <input  type="date" class="form-control" id="datafim" name="datafim" @isset($_GET['datainicio']) value="{{ $_GET['datafim'] }}" @endisset>
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
                                    <h3 class="card-title">Registros</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body" >
                                    <table id="example1" class="table table-bordered table-striped" style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>Vendedor</th>
                                            <th>Descrição</th>
                                            <th>Tipo</th>
                                            <th>Valor</th>
                                            <th>Data</th>
                                            <th>Açoes</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($listaCaixa as $caixa)
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

    //AO SELECIONAR A DATA OS INPUTS FICAM COMO REQUIRED
    $('#datainicio').on("change", function() {
        $("#datafim").attr('required', '') ;
        $("#mes").attr('disabled', '') ;
    });
    $('#datafim').on("change", function() {
        $("#datainicio").attr('required', '') ;
        $("#mes").attr('disabled', '') ;

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
