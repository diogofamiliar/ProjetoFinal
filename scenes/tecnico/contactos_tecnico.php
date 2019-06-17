<?php 
session_start();
if(isset($_SESSION['nome_grupo'])=='tecnico' && isset($_SESSION['id_utilizador'])){
}else header('Location: /ProjetoFinal/index.php');
?>
<?php
  include '../../headers/tecnico_header.php';
    $id_utilizador=$_SESSION['id_utilizador'];  
    include __DIR__.'/../../core/connect.php';
    // query que mostra os contactos
    $query ="SELECT contacto_util.contacto, contacto_util.tipo_de_contacto, condominio.nome as nome_condominio FROM contacto_util INNER JOIN condominio_contacto ON contacto_util.id_contacto_util=condominio_contacto.id_contacto_util INNER JOIN condominio ON condominio_contacto.id_condominio=condominio.id_condominio";  
    $result = mysqli_query($conn, $query);
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
    <!-- Sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="https://i.imgur.com/SzFkxr6.png" />
    <title>Técnico - Contactos Úteis</title>

</head>

<body>


  
<h1 id="h1-centered">Contactos Úteis</h1>
<?php
    if ($result->num_rows > 0) {
        while($row = mysqli_fetch_assoc($result)) {
?>
 
<div class="container">
    <div class="card">
        <div class="card-body">
            <h3><?php echo utf8_encode($row["tipo_de_contacto"]);?> - <?php echo utf8_encode($row["nome_condominio"]);?></h3>
            <p class="card-text"><?php echo utf8_encode($row["contacto"]);?></p>
        </div>
    </div> 
</div>        
<?php
        }
    }
?>
	

    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- checkbox check all -->
   
    


</body>
</html>
