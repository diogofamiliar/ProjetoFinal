<?php
include __DIR__.'/../scenes/login.php';?>

<div class="container-fluid">
<nav class="navbar navbar-light navbar-expand-md bg-light justify-content-between fixed-top">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse dual-nav w-50 order-1 order-md-0">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link pl-0" href="../index.php"  id="navbar-text">Página Inicial <span class="sr-only">Página Inicial</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../index.php#services">Serviços</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../index.php#responsaveis">Responsáveis</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../index.php#equipa">Equipa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../index.php#multiplatform">Dispositivos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../index.php#contato">Contactos</a>
                </li>
            </ul>
        </div>
        <a class="navbar-brand" href="../index.php"><img src="https://i.imgur.com/SzFkxr6.png" style="width:40px;"></a>
        <div class="navbar-collapse collapse dual-nav w-50 order-2">
            <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="modal" data-target="#loginModal">Iniciar Sessão</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="registar_utilizador.php">Registar</a>
                    </li>
                
            </ul>
        </div>
    </div>
</nav>
</div>
