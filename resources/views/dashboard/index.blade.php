<?php

//BUSCA
$mes      = filter_input(INPUT_GET, 'mes', FILTER_SANITIZE_STRING);

//OBTEM O MES ATUAL
if (empty($mes)){
    $mesAtual = '-';
} else {
    $mesAtual = $mes;
}


?>
<x-layout>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-auto">
                <div class="col-sm-6 col-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-1 col-6">
                    <h1 class="m-0">Mês :</h1>
                </div>
                <div class="col-sm-2 col-9">
                    <form method="get">
                        <div class="">
                            <div class="form-group">
                                <select  name="mes" id="mes" class="form-control" >
                                    <option value="<?php echo '-'.date('m').'-'?>">Mês atual</option>
                                    <option value="-01-"<?=$mesAtual == '-01-' ? 'selected' : ''?>>Janeiro</option>
                                    <option value="-02-"<?=$mesAtual == '-02-' ? 'selected' : ''?>>Fevereiro</option>
                                    <option value="-03-"<?=$mesAtual == '-03-' ? 'selected' : ''?>>Março</option>
                                    <option value="-04-"<?=$mesAtual == '-04-' ? 'selected' : ''?>>Abril</option>
                                    <option value="-05-"<?=$mesAtual == '-05-' ? 'selected' : ''?>>Maio</option>
                                    <option value="-06-"<?=$mesAtual == '-06-' ? 'selected' : ''?>>Junho</option>
                                    <option value="-07-"<?=$mesAtual == '-07-' ? 'selected' : ''?>>Julho</option>
                                    <option value="-08-"<?=$mesAtual == '-08-' ? 'selected' : ''?>>Agosto</option>
                                    <option value="-09-"<?=$mesAtual == '-09-' ? 'selected' : ''?>>Setembro</option>
                                    <option value="-10-"<?=$mesAtual == '-10-' ? 'selected' : ''?>>Outubro</option>
                                    <option value="-11-"<?=$mesAtual == '-11-' ? 'selected' : ''?>>Novembro</option>
                                    <option value="-12-"<?=$mesAtual == '-12-' ? 'selected' : ''?>>Dezembro</option>
                                    <option value="-"<?=$mesAtual == '-' ? 'selected' : ''?>>Todos</option>
                                </select>
                            </div>
                        </div>
                </div>
                <div class="col-sm-1 col-3">
                    <button type="submit" class="btn bg-primary">Filtrar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-4 col-12 ">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ number_format($balancoCaixa, 2, ',', '.') }}</h3>

                            <p>Balanço do caixa</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-dollar-sign"></i>
                        </div>
                        <a href="{{ route('caixa.index') }}" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ number_format($totalVendas, 2, ',', '.') }}</h3>

                            <p>Vendas</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <a href="{{ route('vendas.index') }}" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ number_format($totalServicos, 2, ',', '.') }}</h3>

                            <p>Serviços</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-screwdriver"></i>
                        </div>
                        <a href="{{ route('servicos.index') }}" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h5 class="card-title">Caixa</h5>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class=" col-md-8">
                                    <div class="d-flex">
                                        <p class="d-flex flex-column">
                                            <span>Total</span>

                                            <span class="text-bold text-lg"><?php if (empty($qtdTotalCaixaGrafico)){
                                                    echo "0";
                                                } else {
                                                    echo number_format($qtdTotalCaixaGrafico,2,',', '.');
                                                } ?></span>
                                        </p>
                                    </div>
                                    <!-- /.d-flex -->
                                    <div class="position-relative mb-4">
                                        <canvas id="sales-chart" height="200"></canvas>
                                    </div>
                                    <div class="d-flex flex-row justify-content-end">
                                        <span class="mr-2">
                                            <i class="fas fa-square" style="color: #28A745"></i> Vendas
                                        </span>
                                        <span>
                                            <i class="fas fa-square" style="color: #E5AD06"></i> Serviços
                                        </span>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class=" col-md-4" >
                                    <div class="col-12" style="text-align: center;" >
                                        <div class="card-body table-responsive p-0" >
                                            <table class="table table-hover text-nowrap"  >
                                                <thead>
                                                <tr>
                                                    <th>Vendedor</th>
                                                    <th>Descrição</th>
                                                    <th>Tipo</th>
                                                    <th>Valor</th>
                                                    <th>Data</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>USUARIO</td>
                                                    <td>DESCRICAO</td>
                                                    <td>TIPO</td>
                                                    <td >VALOR</td>
                                                    <td>DATA</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <div style="font-size: 20px">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- ./card-body -->
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-3 col-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-success"><i class="fas fa-clipboard-check"></i></span>
                                        <h5 class="description-header"><?php if (empty($qtdRegistros)){
                                                echo "0";
                                            } else {
                                                echo $qtdRegistros;
                                            } ?></h5>
                                        <span class="description-text">Registros</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 col-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-warning"><i class="ion ion-stats-bars"></i></span>
                                        <h5 class="description-header"><?php if (empty($qtdTotalCaixa)){
                                                echo "0";
                                            } else {
                                                echo 'R$ '.number_format($qtdTotalCaixa,2,',', '.');
                                            } ?></h5>
                                        <span class="description-text">Balanço do Caixa</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 col-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-success"><i class="fas fa-arrow-up"></i></span>
                                        <h5 class="description-header"><?php if (empty($qtdEntrada)){
                                                echo "0";
                                            } else {
                                                echo 'R$ '.number_format($qtdEntrada,2,',', '.');
                                            } ?></h5>
                                        <span class="description-text">Entradas</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 col-6">
                                    <div class="description-block">
                                        <span class="description-percentage text-danger"><i class="fas fa-arrow-down"></i></span>
                                        <h5 class="description-header"><?php if (empty($qtdSaida)){
                                                echo "0";
                                            } else {
                                                echo 'R$ '.number_format($qtdSaida,2,',', '.');
                                            } ?></h5>
                                        <span class="description-text">Saidas</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h3 class="card-title">Ultimas vendas realizadas</h3>
                        </div>


                        <div class="col-12" style="text-align: center;padding: 7px">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>Nome do Cliente</th>
                                        <th>Produto</th>
                                        <th>Forma de Pagamento</th>
                                        <th>Valor da Venda</th>
                                        <th>Data</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>NOME CLIENTE</td>
                                        <td>'NOME PRODUTO</td>
                                        <td>FORMA DE PAGAMENTO</td>
                                        <td style="color: green">VALOR</td>
                                        <td>DATA</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div style="font-size: 20px">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Estoque</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="chart-responsive">
                                        <canvas id="pieChart" height="150"></canvas>
                                    </div>
                                    <!-- ./chart-responsive -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-4">
                                    <ul class="chart-legend clearfix">
                                        <li><i class="far fa-circle text-danger"></i> Acessorios</li>
                                        <li><i class="far fa-circle text-success"></i> Carregador</li>
                                        <li><i class="far fa-circle text-warning"></i> Celular</li>
                                        <li><i class="far fa-circle text-info"></i> Caixa de Som</li>
                                        <li><i class="far fa-circle text-primary"></i> Fone de Ouvido</li>
                                        <li><i class="far fa-circle text-secondary"></i> Capa para Celular</li>
                                    </ul>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="card-footer text-center">
                            <span class="description-text">Valores dos produtos em estoque</span>
                            <div class="row">
                                <div class="col-sm-2 col-4">
                                    <div class="description-block border-right">
                                        <h5 class="description-header">'R$ 1000'</h5>
                                        <span class="">Acessorios</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <div class="col-sm-2 col-4">
                                    <div class="description-block border-right">
                                        <h5 class="description-header">'R$ 2000'</h5>
                                        <span class="">Carregador</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <div class="col-sm-2 col-4">
                                    <div class="description-block border-right">
                                        <h5 class="description-header">'R$ 30000'</h5>
                                        <span class="">Celular</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-2 col-4">
                                    <div class="description-block border-right">
                                        <h5 class="description-header">'R$ 50000'</h5>
                                        <span class="">Caixa de Som</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-2 col-4">
                                    <div class="description-block border-right">
                                        <h5 class="description-header">'R$ 60000'</h5>
                                        <span class="">Fone</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-2 col-4">
                                    <div class="description-block">
                                        <h5 class="description-header">'R$ 540000'</h5>
                                        <span class="">Capa</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
</x-layout>

<!-- jQuery -->
<script src="{{ asset('/plugins/jquery/jquery.min.js') }}"></script>
<!-- OPTIONAL SCRIPTS -->
<script src="{{ asset('/plugins/chart.js/Chart.min.js') }}"></script>

<script type="text/javascript">
    $(function () {
        'use strict'

        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        }

        var mode = 'index'
        var intersect = true

        var $salesChart = $('#sales-chart')
        // eslint-disable-next-line no-unused-vars
        var salesChart = new Chart($salesChart, {
            type: 'bar',
            data: {
                labels: ['JAN','FEV','MAR','ABR','MAI','JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
                datasets: [
                    {
                        backgroundColor: '#28A745',
                        borderColor: '#28A745',
                        data: ['1000']
                    },                    {
                        backgroundColor: '#E5AD06',
                        borderColor: '#E5AD06',
                        data: ['1000']
                    },
                ]
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    mode: mode,
                    intersect: intersect
                },
                hover: {
                    mode: mode,
                    intersect: intersect
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        // display: false,
                        gridLines: {
                            display: true,
                            lineWidth: '4px',
                            color: 'rgba(0, 0, 0, .2)',
                            zeroLineColor: 'transparent'
                        },
                        ticks: $.extend({
                            beginAtZero: true,

                            // Include a dollar sign in the ticks
                            callback: function (value) {
                                if (value >= 1000) {
                                    value /= 1000
                                    value += '.0 M'
                                }

                                return 'R$ ' + value
                            }
                        }, ticksStyle)
                    }],
                    xAxes: [{
                        display: true,
                        gridLines: {
                            display: false
                        },
                        ticks: ticksStyle
                    }]
                }
            }
        })
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
        var pieData = {
            labels: [
                'Acessorios',
                'Carregador',
                'Celular',
                'Caixa de Som',
                'Fone de Ouvido',
                'Capa para Celular'
            ],
            datasets: [
                {
                    data: ['1000'],
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de']
                }
            ]
        }
        var pieOptions = {
            legend: {
                display: false
            }
        }
        // Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        // eslint-disable-next-line no-unused-vars
        var pieChart = new Chart(pieChartCanvas, {
            type: 'doughnut',
            data: pieData,
            options: pieOptions
        })
    });
</script>








