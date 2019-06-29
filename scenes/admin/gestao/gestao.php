<?php
session_start();
if(($_SESSION['nome_grupo'])=='admin' || ($_SESSION['nome_grupo'])=='master' && isset($_SESSION['id_utilizador'])){
}else header('Location: /ProjetoFinal/index.php');
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../../css/custom.css">
    <link rel="shortcut icon" type="image/x-icon" href="https://i.imgur.com/SzFkxr6.png" />
    <title>elVecino | Manutenções</title>
  </head>

<body>

	<?php
  include __DIR__.'/../../../headers/admin_header.php';
	?>
  

<div class="container">
    <?php include "../../../assets/breadcrumbers/bc_gestao.php" ?>
    <h1 id="h1-centered">Gestão de utilizadores e condomínios</h1>    
    
    <div class="row"> <!--justify-content-center alinha os conteudos ao meio sem os "escalar"  -->
        <div class="col-sm-4 my-4">
            <div class="card h-100">
                <a class="card-img-top mx-auto my-2" href="utilizadores/gestao_utilizadores.php">
                    <img class="object-fit-cover" src="../../../assets/admin/gestao/gestao_utilizadores.jpg" alt="Card image">
                </a>
                <div class="card-body d-flex flex-column">
                    <h4 class="card-title">Gestão de utlizadores</h4>
                    <p class="card-text">Adicione um utilizador a um grupo de utilizadores.<br>Altere a função de um utilizador.</p>
                    <a href="utilizadores/gestao_utilizadores.php" class="mt-auto btn btn-primary">Entrar</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4 my-4">
            <div class="card h-100">
                <a class="card-img-top mx-auto my-2" href="#">
                    <img class="object-fit-cover" src="../../../assets/admin/gestao/gestao_condominio.png" alt="Card image">
                </a>
                <div class="card-body d-flex flex-column">
                    <h4 class="card-title">Gestão de condomínios e zonas</h4>
                    <p class="card-text"> Adicione novos condomínios ou altere um condomínio já existente.<br>Gestão zonas</p>
                    <div class="row">
                        <a href="condominios/gestao_condominios.php" class="m-auto btn btn-primary">Condomínios</a>
                        <a href="zonas/gestao_zonas.php" class="m-auto btn btn-primary">Zonas</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 my-4">
            <div class="card h-100">
                <a class="card-img-top mx-auto my-2" href="fornecedores/gestao_fornecedores.php">
                    <img class="object-fit-cover" src="../../../assets/admin/gestao/gestao_fornecedor.png" alt="Card image">
                </a>
                <div class="card-body d-flex flex-column">
                    <h4 class="card-title">Gestão de fornecedores</h4>
                    <p class="card-text"> Adicione novos fornecedores ou altere os dados de um fornecedor já existente.<br>Elimine Condomínios</p>
                    <a href="fornecedores/gestao_fornecedores.php" class="mt-auto btn btn-primary">Entrar</a>
                </div>
            </div>
        </div>
    </div>
</div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>