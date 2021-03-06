<?php

session_start();
if(empty($_SESSION['login']) || $_SESSION['login']['expirate'] < date("d-m-Y H:i:s")){
    $_SESSION['return']['msg'] = "Você foi redirecionado, pois não está logado";
    $_SESSION['return']['class'] = "bg-danger";
    header('location: ../../');
}
include '../Controllers/ControllerImoveis.php';

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Serviços de locação de imoveis">
    <meta name="author" content="Juan Almeida">
    <link rel="icon" href="../../public/img/favicon.ico">
    <title>Locação de Imoveis</title>


    <!-- Custom fonts for this template -->
    <link href="../../public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../public/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../../public/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <li class="nav-item">
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../views/acessado.php">
                <div class="sidebar-brand-text mx-3">BrunSker Tecnologia <sup></sup></div>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Páginas
            </div>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="../views/acessado.php">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Imóveis</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>

        <!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <form class="form-inline">
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
        </form>


        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">


            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['login']['user'] ?></span>
                    <i class="fas fa-user"></i>
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Sair
                    </a>
                </div>
            </li>

        </ul>

    </nav>