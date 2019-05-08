<nav class="navbar navbar-light navbar-expand-md bg-light justify-content-between fixed-top">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse dual-nav w-50 order-1 order-md-0">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link pl-0" href="../index.php"  id="navbar-text">Home <span class="sr-only">Home</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Informações</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contatos Uteis</a>
                </li>
        </div>
        <a class="navbar-brand" href="../scenes/index.php"><img src="../assets/navbar/icon_navbar.png" style="width:40px;"></a>
        <div class="navbar-collapse collapse dual-nav w-50 order-2">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#loginModal">Iniciar sessão</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Registar</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<?php
include 'login.php';
?>