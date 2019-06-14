<?php/*
session_start();
if(isset($_SESSION['nome_grupo'])=='inquilino' && isset($_SESSION['id_utilizador'])){
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
    <!-- Sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <title>ElVecino - Àrea técnica</title>

</head>

<body>

	<?php
  include '../../headers/tecnico_header.php';
  include '../../core/connect.php';
  //include '../../../core/notificacao.php'; //verifica o nr_notificacoes por ler
  //$id_utilizador=$_SESSION['id_utilizador'];
	?>
    
    <h1 id="h1-centered">
        <?php/*
        $id_utilizador=$_SESSION['id_utilizador'];
        $sql = "SELECT nome FROM utilizador WHERE id_utilizador='$id_utilizador'";
        $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
        $row = mysqli_fetch_assoc($resultset);
        */?>
        Bem-vindo <?php/* echo $row['nome'];*/?>
    </h1>
	<div class="container col-11">

    </div>

    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<?php
  if(isset($_COOKIE["registo_efetuado"])){
?>
      <script>
      swal({
            title: "Sucesso!",
            text: "Pedido de manutenção inserido com sucesso!",
            icon: "success",
            button: "Continuar",
      });
      </script>
<?php
  }
?>

</body>
</html>
