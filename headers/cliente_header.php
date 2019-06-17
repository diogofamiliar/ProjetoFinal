<?php
include __DIR__.'/../core/notificacao.php';
?>
    <!-- fontawesome CSS -->

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../css/custom.css">
<nav class="navbar navbar-light navbar-expand-md bg-light justify-content-between fixed-top">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse dual-nav w-50 order-1 order-md-0">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link pl-0" href="/ProjetoFinal/scenes/cliente/cliente.php"  id="navbar-text">Home <span class="sr-only">Home</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="incidentes.php">Incidentes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cliente_documentos.php">Documentos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/ProjetoFinal/scenes/cliente/contactos.php">Contatos Uteis</a>
                </li>
            </ul>
        </div>
        <a class="navbar-brand" href="../../index.php"><img src="https://i.imgur.com/SzFkxr6.png"></a>
        <div class="navbar-collapse collapse dual-nav w-50 order-2">
            <ul class="nav navbar-nav ml-auto">
            <li class="nav-item">
                    <a class="nav-link" href="/ProjetoFinal/scenes/cliente/notificacoes/notificacoes.php">
                        <span class="fa-stack has-badge" data-count="<?php echo $_SESSION['nr_notificacao'];?>" aria-hidden="true">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-bell fa-stack-1x fa-inverse"></i>
                        </span> Notificações
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/ProjetoFinal/scenes/cliente/edit_profile.php">
                        <span class="fa fa-user" aria-hidden="true" style="font-size:25px;"></span> Perfil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/ProjetoFinal/core/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
