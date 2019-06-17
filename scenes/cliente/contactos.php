<?php
	include __DIR__.'/../../headers/cliente_header.php';

if(isset($_SESSION['id_grupo'])=='7' || isset($_SESSION['id_utilizador'])){
  $id_utilizador=$_SESSION['id_utilizador'];  
    include __DIR__.'/../../core/connect.php';
   
    $id_utilizador=$_SESSION['id_utilizador'];
    //seleciona o condominio a que esta associado o utilizador
    $condominio= "SELECT condominio.id_condominio FROM utilizador INNER JOIN zona ON utilizador.id_zona=zona.id_zona INNER JOIN condominio ON condominio.id_condominio=zona.id_condominio WHERE utilizador.id_utilizador=$id_utilizador";
    $resultado = mysqli_query($conn, $condominio);
    $row = mysqli_fetch_assoc($resultado);
    // query que mostra os contactos que estao relacionados com o condominio do utilizador
    $query ="SELECT contacto_util.contacto, contacto_util.tipo_de_contacto FROM contacto_util INNER JOIN condominio_contacto ON contacto_util.id_contacto_util=condominio_contacto.id_contacto_util INNER JOIN condominio ON condominio_contacto.id_condominio=condominio.id_condominio WHERE condominio.id_condominio=$row[id_condominio]";  
    $result = mysqli_query($conn, $query);
}else header('Location: ../../index.php');
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

    <!-- datatables CSS -->
    <link rel="stylesheet" type="text/css" href="../../css/jquery.dataTables.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="https://i.imgur.com/SzFkxr6.png" />
    <title>elVecino | Contactos Úteis</title>
  </head>
 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <body>

	
  
  <h1 id="h1-centered">Contactos Úteis</h1>
<?php
    if ($result->num_rows > 0) {
        while($row = mysqli_fetch_assoc($result)) {
?>
 
<div class="container">
    <div class="card">
        <div class="card-body">
            <h3><?php echo utf8_encode($row["tipo_de_contacto"]);?></h3>
            <p class="card-text"><?php echo utf8_encode($row["contacto"]);?></p>
        </div>
    </div> 
</div>        
<?php
        }
    }
?>
    
</body>
</html> 