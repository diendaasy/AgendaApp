<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME; ?></title>
    <!-- icon -->
    <link rel="icon" type="image/x-icon" href="<?= APP_URL; ?>/img/logo_bps.png">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/plugins/summernote/summernote-bs4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= APP_URL; ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= APP_URL; ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= APP_URL; ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/css/style.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars">
                            Hello, <?= $_SESSION['user']['nama_karyawan'] ?>
                        </i>
                    </a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <div class="dropdown-divider"></div>
                            <a href="<?= APP_URL; ?>/auth/logout" class="dropdown-item dropdown-footer">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </ul>

        </nav>
        <!-- /.navbar -->

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Sidebar -->
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= APP_URL; ?>/img/icon_user.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= $_SESSION['user']['nama_karyawan'] ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="<?= APP_URL; ?>" class="nav-link">
                                <i class='fas fa-chevron-circle-right'></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= APP_URL; ?>/agendas" class="nav-link">
                                <i class='fas fa-chevron-circle-right'></i>
                                <p>Manajemen Agenda</p>
                            </a>
                        </li>
                        <?php
                        if ($_SESSION['user']['user_role'] === 'admin') :
                        ?>
                            <li class="nav-item">
                                <a href="<?= APP_URL; ?>/users" class="nav-link">
                                    <i class='fas fa-chevron-circle-right'></i>
                                    <p>Manajemen User</p>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="content-header">
            </div>

            <section class="content">