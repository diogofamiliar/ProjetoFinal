<?php/* DEPOIS TIRAR O COMENTARIO E MUDAR O ID_GRUPO PARA O NOME DO GRUPO
session_start();
if(isset($_SESSION['id_grupo'])=='7' || isset($_SESSION['id_utilizador'])){
}else header('Location: ../../index.php');
*/

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/custom.css">

    <title>elVecino | Manutenções</title>
  </head>

<body>

	<?php
  include __DIR__.'/../../headers/admin_header.php';
	?>
  
<h1 id="h1-centered">Manutenções</h1>
<div class="container">
  <div class="row justify-content-center"> <!--justify-content-center alinha os conteudos ao meio sem os "escalar"  -->
    <div class="col-sm-3 my-2">
      <div class="card h-100">
        <img class="card-img-top mx-auto my-2" src="../../assets/admin/manutencoes/agendar.png" alt="Card image">
        <div class="card-body d-flex flex-column">
          <h4 class="card-title">Inserir Manutenção</h4>
          <p class="card-text">Inicie o processo de manutenção ao agendar reparações</p>
          <a href="inserir_manutencoes.php" class="mt-auto btn btn-primary">Inserir</a>
        </div>
      </div>
    </div>
    <div class="col-sm-3 my-2">
      <div class="card h-100">
        <img class="card-img-top mx-auto my-2" src="../../assets/admin/manutencoes/editar.png" alt="Card image cap">
        <div class="card-body d-flex flex-column">
          <h4 class="card-title">Lista de manutenções</h4>
          <p class="card-text">Pode editar ou eliminar manutenções já inseridas no sistema.</p>
          <div class="mt-auto btn-group mx-auto" role="group">
            <button type="button" class="btn btn-primary">Editar</button>
            <button type="button" class="btn btn-primary">Eliminar</button>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-3 my-2">
      <div class="card h-100">
        <img class="card-img-top mx-auto my-2" src="../../assets/admin/manutencoes/repair.png" alt="Card image cap">
        <div class="card-body d-flex flex-column">
          <h4 class="card-title">Alterar estado</h4>
          <p class="card-text">Altere o estado das suas manutenções.</p>
          <a href="#" class="mt-auto btn btn-primary">Alterar estado</a>
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