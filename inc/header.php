<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>GLF Imobiliária</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="<?php echo BASEURL; ?>img/icon.ico"/>
    <link rel="stylesheet" href="<?php echo BASEURL; ?>css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo BASEURL; ?>css/fontawesome/all.min.css">
    <link rel="stylesheet" href="<?php echo BASEURL; ?>css/style1.css">
    
    <style>
        body {
            padding-top: 93px;
            padding-bottom: 20px;
        }
        .btn-light {
            background-color: #c6c6c6;
            color: #000000;
            border-color: #c6c6c6;
        }
        .btn-light:hover {
            background-color: #cccccc;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-primary fixed-top p-1" data-bs-theme="primary">
        <a href="<?php echo BASEURL; ?>index.php">
            <img src="<?php echo BASEURL; ?>img/logo.png" class="p-3 navbar-brand" alt="Logo">
        </a>
        <div class="container-fluid">
            <button class="navbar-toggler text-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon text-light"></span>
            </button>
            <div class="collapse navbar-collapse text-light" id="navbarSupportedContent">
                <!-- Grupo de itens padrão (à esquerda) -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user"></i> Clientes
                        </a>
                        <ul class="dropdown-menu">
                            <?php if (isset($_SESSION['user'])) : ?>
                                <li>
                                    <a class="dropdown-item" href="<?php echo BASEURL; ?>customers/add.php">
                                        <i class="fa-solid fa-user-plus"></i> 
                                        Novo Cliente
                                    </a>
                                </li>
                            <?php endif ?>
                            <li>
                                <a class="dropdown-item" href="<?php echo BASEURL; ?>customers">
                                    <i class="fa-solid fa-user-gear"></i>
                                    Gerenciar Clientes
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-warehouse"></i> Imóveis
                        </a>
                        <ul class="dropdown-menu">
                            <?php if (isset($_SESSION['user'])) : ?>
                                <li>
                                    <a class="dropdown-item" href="<?php echo BASEURL; ?>imoveis/add.php">
                                        <i class="fa-solid fa-folder-plus"></i> 
                                        Novo Imóvel
                                    </a>
                                </li>
                            <?php endif; ?>
                            <li>
                                <a class="dropdown-item" href="<?php echo BASEURL; ?>imoveis">
                                    <i class="fa-solid fa-house-user"></i>
                                    Gerenciar Imóveis
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php if (isset($_SESSION['user']) && $_SESSION['user'] == "admin") : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-users "></i> Usuários
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="<?php echo BASEURL; ?>usuarios/add.php">
                                        <i class="fa-solid fa-user-plus"></i> 
                                        Novo Usuário
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?php echo BASEURL; ?>usuarios">
                                        <i class="fa-solid fa-users"></i> 
                                        Gerenciar Usuários
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
                <!-- Grupo de itens alinhados à direita -->
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php if (isset($_SESSION['user'])) : ?>
                        <li class="nav-item">
                            <p class="nav-link text-light">Bem-vindo <?php echo $_SESSION['user'] ?>!</p>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="<?php echo BASEURL; ?>inc/logout.php">
                                <i class="fa-solid fa-person-walking-arrow-right"></i> Desconectar
                            </a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="<?php echo BASEURL; ?>inc/login.php">
                                <i class="fa-solid fa-users"></i> Login
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Fim navbar -->
    <main class="container">