<?php

use App\Http\Controllers\UnidadesController;

//FUNÇÃO PARA OBTEM A FUNÇÃO DO USUARIO LOGADO
function nomefuncao(){

    //OBTEM A FUNÇÃO
    $usuario = Auth::user()->funcao;

    //VERIFICA
    if ($usuario == '1'){
        $funcao = 'Função: Master';
    } elseif ($usuario == '2'){
        $funcao = 'Função: Gerente';
    } elseif ($usuario == '4'){
        $funcao = 'Função: Recepção/Vendedor';
    }

    //RETORNA
    return $funcao;
}


// FUNCAO PARA PEGAR A PÁGINA CORRENTE
function active($currect_page)
{
    $url_array =  explode('/', $_SERVER['REQUEST_URI']);
    if ($currect_page == $url_array[1]) {
        echo 'menu-is-opening menu-open active';
    }
}

// FUNCAO PARA PEGAR A PÁGINA CORRENTE
function activemenu($currect_page)
{
    $url2 = '';
    $url_array =  explode('/', $_SERVER['REQUEST_URI']);
    if (!empty($url_array[2])){
        $url2 = $url_array[2];
    }
    if ($currect_page == $url_array[1].'/'.$url2) {
        echo 'active';
    }
}

//ORGANIZA AS UNIDADES DO USUÁRIO
$unidadesUsuario = explode(',', Auth::user()->unidade);

?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Gestão</title>
    <link rel="shortcut icon" type="imagex/png" href="{{ asset('/img/icons/DSicone.ico') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/css/adminlte.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- SweetAlert -->
    <link rel="stylesheet" href="{{ asset('/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Alert Toastr -->
    <link rel="stylesheet" href="{{ asset('/plugins/toastr/toastr.min.css') }}">

    <!-- Ajustes -->
    <link rel="stylesheet" href="{{ asset('/css/ajustes.css') }}">

</head>

<div class="wrapper ">
    <!-- MENSAGENS DE STATUS -->
    @if (isset($status) && $status === 'success')
    <input type="hidden" id="success">
    @endif
    @if (isset($status) && $status === 'error')
    <input type="hidden" id="error">
    @endif
    @if (isset($status) && $status === 'editado')
    <input type="hidden" id="editado">
    @endif
        <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <body class="hold-transition sidebar-mini layout-fixed">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item mt-2">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('users.setUnidade', Auth::user()->id) }}" method="post">
                        @csrf
                        <div class="row align-items-center">
                            <div class="col-md-4 col-8 mt-2">
                                <label>
                                    <select id="unidade" name="unidade" class="form-control" required>
                                        <option selected disabled>Selecionar...</option>
                                        @foreach ($unidadesUsuario as $unidadeUsuario)
                                        <option value="{{ $unidadeUsuario }}">{{ UnidadesController::nomeUnidade($unidadeUsuario) }}</option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>
                            <div class="col-md-2 col-2 d-flex align-items-end loja">
                                <button type="submit" class="btn btn-primary">Filtrar</button>
                            </div>
                            <div class="col-md-6 col-12">
                                Loja: <strong>{{ UnidadesController::nomeUnidade(Auth::user()->set_unidade) }}</strong>
                            </div>
                        </div>
                    </form>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge" style="font-size: 12px"><?php
                            if (!empty($QTNotificacao)){
                                echo $QTNotificacao;
                            }
                            $obNotificacao = 'noti'
                            ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="min-width: 350px ;max-width: 450px">
                        <span class="dropdown-item dropdown-header"><i class="fas fa-envelope mr-2"></i><?php echo 10 ?> Notificações</span>
                        <div class="dropdown-divider"></div>

                        <div class="col-md-12 col-12">
                            <?php
                            if ($obNotificacao == 'noti') {
                                echo '<div class="info-box bg-green">';

                            } else {
                                echo '<div class="info-box bg-primary">';
                            }
                            ?>
                            <span class="info-box-icon"><?php
                                if ($obNotificacao == 'noti') {
                                    echo '<i class="far fa-envelope"></i>';

                                } else {
                                    echo '<i class="far fa-check-circle"></i>';
                                }
                                ?>
                                </span>
                            <div class="info-box-content">
                                    <span class="info-box-text" style="font-size: 10px">
                                        <?php
                                        if ($obNotificacao == 'noti'){
                                            echo 'Notificação';
                                        } else {
                                            echo 'Atualização';
                                        }
                                        ?>
                                    </span>
                                <span class="info-box-number" style="font-size: 14px"><?php echo 'TITULO' ?></span>
                                <span class="" style="font-size: 12px">
                                        <?php echo 'DESCRICAO' ?>
                                    </span>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a href="../app/Ajax/notificacao.php" class="dropdown-item dropdown-footer">Marcar todos como lido</a>
                </li>


                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <i class="far fa-user"></i>
                        <span class="d-none d-md-inline">{{ Auth::user()['nome'] }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <li class="card card-widget widget-user">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-info">
                                <h3 class="widget-user-username">{{ Auth::user()['nome'] }}</h3>
                                <h5 class="widget-user-desc">{{ nomefuncao() }}</h5>
                            </div>

                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <a href="{{ route('users.password', Auth::user()['id']) }}" class="btn btn-default btn-flat">Alterar Senha</a>
                            <a href="{{ route('deslogar') }}" class="btn btn-default btn-flat float-right">Sair</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </body>
    </nav>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar  elevation-4 sidebar-light-warning">
        <!-- Brand Logo -->
        <a href="{{ route('dashboard.index') }}" class="brand-link">
            <b class="brand-image img-circle elevation-3" style="color: silver ;padding: 8px">DS</b>
            <span class="brand-text font-weight-light">Sistema de Gestão</span>
        </a>
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Painel Usuario -->

            <nav class="mt-3 ">
                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->

                    <li class="nav-item <?php active('dashboard'); ?>">
                        <a id="menudash" href="{{ route('dashboard.index')  }}" class="nav-link <?php active('dashboard'); ?>">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Dashborad
                            </p>
                        </a>
                    </li>
                    <li class="nav-item <?php active('caixa'); ?>">
                        <a  href="#" class="nav-link <?php active('caixa'); ?>">
                            <i class="nav-icon fas fa-dollar-sign"></i>
                            <p>
                                Caixa
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ">
                            <li class="nav-item ">
                                <a href="{{ route('caixa.index') }}" class="nav-link <?php activemenu('caixa/'); ?>">
                                    <i class="fas fa-chart-bar nav-icon"></i>
                                    <p>Painel do Caixa</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('caixa.create') }}" class="nav-link <?php activemenu('caixa/create'); ?>">
                                    <i class="fas fa-pen nav-icon"></i>
                                    <p>Cadastrar</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item <?php active('vendas'); ?>">
                        <a href="#" class="nav-link <?php active('vendas'); ?>">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>
                                Vendas
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('vendas.index') }}" class="nav-link <?php activemenu('vendas/'); ?>">
                                    <i class="fas fa-chart-bar nav-icon"></i>
                                    <p>Painel de Vendas</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('vendas.create') }}" class="nav-link <?php activemenu('vendas/create'); ?>">
                                    <i class="fas fa-pen nav-icon"></i>
                                    <p>Cadastrar</p>
                                </a>
                            </li>
                        </ul>

                    </li>
                    <li class="nav-item <?php active('servicos'); ?>">
                        <a href="#" class="nav-link <?php active('servicos'); ?>">
                            <i class="nav-icon fas fa-screwdriver"></i>
                            <p>
                                Serviços
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('servicos.index') }}" class="nav-link <?php activemenu('servicos/'); ?>">
                                    <i class="fas fa-chart-bar nav-icon"></i>
                                    <p>Painel de Serviços</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('servicos.create') }}" class="nav-link <?php activemenu('servicos/create'); ?>">
                                    <i class="fas fa-pen nav-icon"></i>
                                    <p>Cadastrar</p>
                                </a>
                            </li>
                        </ul>

                    </li>
                    <li class="nav-item <?php active('estoque'); ?>">
                        <a href="#" class="nav-link <?php active('estoque'); ?>">
                            <i class="nav-icon fas fa-coins"></i>
                            <p>
                                Estoque
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('estoque.index') }}" class="nav-link <?php activemenu('estoque/'); ?>">
                                    <i class="fas fa-chart-bar nav-icon"></i>
                                    <p>Painel do Estoque</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('estoque.create') }}" class="nav-link <?php activemenu('estoque/create'); ?>">
                                    <i class="fas fa-pen nav-icon"></i>
                                    <p>Cadastrar</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item <?php active('master'); ?><?php active('unidades'); ?><?php active('users'); ?>">
                        <a href="#" class="nav-link <?php active('master'); ?><?php active('unidades'); ?><?php active('users'); ?>">
                            <i class="nav-icon fas fa-user-tie"></i>
                            <p>
                                Administração
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item <?php active('users'); ?>">
                                <a href="#" class="nav-link <?php active('users'); ?>">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Usuarios
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('users.create') }}" class="nav-link <?php activemenu('users/create'); ?>">
                                            <i class="fas fa-pen nav-icon"></i>
                                            <p>Cadastrar</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('users.index') }}" class="nav-link <?php activemenu('users/'); ?>">
                                            <i class="fas fa-list nav-icon"></i>
                                            <p>Lista</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item <?php active('unidades'); ?>">
                                <a href="#" class="nav-link <?php active('unidades'); ?>">
                                    <i class="nav-icon fas fa-warehouse"></i>
                                    <p>
                                        Lojas
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item ">
                                        <a href="{{ route('unidades.create') }}" class="nav-link <?php activemenu('unidades/create'); ?>">
                                            <i class="fas fa-pen nav-icon"></i>
                                            <p>Cadastrar</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('unidades.index') }}" class="nav-link <?php activemenu('unidades/'); ?>">
                                            <i class="fas fa-list nav-icon"></i>
                                            <p>Lista</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('master.index') }}" class="nav-link <?php activemenu('master/'); ?>">
                                    <i class="fas fa-chalkboard nav-icon"></i>
                                    <p>Painel Master</p>
                                </a>
                            </li>
                        </ul>

                    </li>
<!--                    --><?php //} ?>
                </ul>
            </nav>
        </div>
    </aside>
    <body>
    {{ $slot }}
    </body>
    <!-- Main Footer -->
    <footer class="main-footer" style="">
        <strong>Copyright &copy;<a target="_blank" href="https://diogosubtil.com.br">Diogo Subtil</a></strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Versão</b> 2.0
        </div>
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/js/adminlte.js') }}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset('/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<script src="{{ asset('/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('/plugins/jquery-knob/jquery.knob.min.js') }}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ asset('/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('/js/pages/dashboard2.js') }}"></script>
<!-- Menu Scripts -->
<script src="{{ asset('/js/pages/menu.js') }}"></script>
<!-- SweetAlert -->
<script src="{{ asset('/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Alert Toastr -->
<script src="{{ asset('/plugins/toastr/toastr.min.js') }}"></script>
<!-- Toast Alert -->
<script src="{{ asset('/js/toast-alert.js') }}"></script>
<!-- CONSULTA CEP -->
<script src="{{ asset('/js/cep.js') }}"></script>

<script>
    $.widget.bridge('uibutton', $.ui.button)

    function excluir() {
        return confirm('Você realmente deseja excluir?');
    }
</script>

</html>
