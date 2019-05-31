<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lustres e Cia - Painel Administrativo</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
            folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet"
        href="<?php echo BASE_URL; ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet"
        href="<?php echo BASE_URL; ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">
    <!-- <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/estilo.css"> -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper d-print-none">

        <header class="main-header">
            <!-- Logo -->
            <a href="<?php echo BASE_PAINEL; ?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>L</b>eC</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Lustres </b>e Cia</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo BASE_SITE; ?>">Voltar ao Portal</a></li>
                        <li><a href="<?php echo BASE_PAINEL; ?>admin/logout">Sair</a></li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar  d-print-none">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?php echo BASE_URL; ?>assets/img/logo_lustresecia.png" class="img-circle"
                            alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p>Lustres e Cia</p>
                    </div>
                </div>
                <br>
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">NAVEGAÇÃO</li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-cogs"></i> <span><b>Produtos</b></span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo BASE_PAINEL; ?>products/see_all"><i class="fa fa-circle-o"></i>Ver
                                    Todos</a></li>
                            <li><a href="<?php echo BASE_PAINEL; ?>products/insert"><i class="fa fa-circle-o"></i>Inserir
                                    Produto</a></li>
                            <li><a href="<?php echo BASE_PAINEL; ?>products/insert_option"><i
                                        class="fa fa-circle-o"></i>Inserir Opções de Produto</a></li>
                            <li><a href="<?php echo BASE_PAINEL; ?>products/stock"><i
                                        class="fa fa-circle-o"></i>Estoque</a></li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-tags"></i> <span><b>Categorias</b></span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo BASE_PAINEL; ?>category/see_all"><i class="fa fa-circle-o"></i>Ver
                                    Todos</a></li>
                            <li><a href="<?php echo BASE_PAINEL; ?>category/insert"><i
                                        class="fa fa-circle-o"></i>Inserir</a></li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-building"></i> <span><b>Fornecedores</b></span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo BASE_PAINEL; ?>brands"><i class="fa fa-circle-o"></i>Ver Todos</a></li>
                            <li><a href="<?php echo BASE_PAINEL; ?>brands/insert"><i class="fa fa-circle-o"></i>Inserir
                                    Novo</a></li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-shopping-cart"></i> <span><b>Vendas</b></span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo BASE_PAINEL; ?>sales/see_all"><i class="fa fa-circle-o"></i>Ver
                                    Todas</a></li>
                            <li><a href="<?php echo BASE_PAINEL; ?>sales/last"><i class="fa fa-circle-o"></i>Últimas
                                    Vendas</a></li>
                            <li><a href="<?php echo BASE_PAINEL; ?>sales/approved"><i class="fa fa-circle-o"></i>Pagamentos
                                    Aprovados</a></li>
                            <li><a href="<?php echo BASE_PAINEL; ?>sales/repproved"><i
                                        class="fa fa-circle-o"></i>Pagamentos Recusados</a></li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-users"></i> <span><b>Usuários</b></span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo BASE_PAINEL; ?>user"><i class="fa fa-circle-o"></i>Ver Todos</a></li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-users"></i> <span><b>Relatórios</b></span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo BASE_PAINEL; ?>products/list_stock"><i
                                        class="fa fa-circle-o"></i>Listagem de produtos</a></li>
                        </ul>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper d-print-block">
            <section class="content">
                <div class="container-fluid">
                    <?php $this->loadViewInTemplate($viewName, $viewData); ?>
                </div>
            </section>
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer d-print-none">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.4.0
            </div>
            <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
            reserved.
        </footer>
        <!-- Add the sidebar's background. This div must be placed
                immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->
    <script src="<?php echo BASE_URL; ?>/assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo BASE_URL; ?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Morris.js charts -->
    <script src="<?php echo BASE_URL; ?>assets/bower_components/raphael/raphael.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/bower_components/morris.js/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="<?php echo BASE_URL; ?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="<?php echo BASE_URL; ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo BASE_URL; ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo BASE_URL; ?>assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="<?php echo BASE_URL; ?>assets/bower_components/moment/min/moment.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script
        src="<?php echo BASE_URL; ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
    </script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo BASE_URL; ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="<?php echo BASE_URL; ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo BASE_URL; ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo BASE_URL; ?>assets/js/adminlte.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
    <script src="<?php echo BASE_URL; ?>tinymce/tinymce.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/script.js"></script>
    <script>
        tinymce.init({
            selector: '#editor',
        });
    </script>
</body>

</html>