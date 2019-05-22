<nav class="navbar navbar-light navbar-expand-md bg-light justify-content-between fixed-top">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse dual-nav w-50 order-1 order-md-0">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link pl-0" href="admin.php"  id="navbar-text">Home <span class="sr-only">Home</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Arquivo</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Manutenções
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Manutenções</a>
                        <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Relatórios</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Gestão de condomínios e utilizadores
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Gestão de condomínios</a>
                        <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Gestão de utilizadores</a>
                    </div>
                </li>
            </ul>
        </div>
        <a class="navbar-brand" href="../../index.php"><img src="https://i.imgur.com/SzFkxr6.png"></a>
        <div class="navbar-collapse collapse dual-nav w-50 order-2">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <img src="../../assets/navbar/messages_navbar.png" alt="logo" style="width:32px;"> Mensagens
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="edit_profile.php">
                        <img src="../../assets/navbar/perfil_navbar.png" alt="logo" style="width:30px;"> Perfil
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Definições
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Manutenções</a>
                        <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Relatórios</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../core/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
