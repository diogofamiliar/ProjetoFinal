<?php
session_start();
if(($_SESSION['nome_grupo'])=='admin' || ($_SESSION['nome_grupo'])=='master' && isset($_SESSION['id_utilizador'])){
}else header('Location: /ProjetoFinal/index.php');
?>
<?php
include __DIR__.'/../../headers/admin_header.php';
include '../../core/connect.php';
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
    <title>Área administrativa</title>
  </head>

<body>

<h1 id="h1-centered">
    <?php
    $id_utilizador=$_SESSION['id_utilizador'];
    $sql = "SELECT nome FROM utilizador WHERE id_utilizador='$id_utilizador'";
    $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
    $row = mysqli_fetch_assoc($resultset);
    ?>
    Bem-vindo(a) <?php echo $row['nome'];?>
  </h1>
  <h2 id="h1-centered">Página inicial</h2>
  <div class="container">
    
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
<?php
  if(isset($_COOKIE["alter_user"])){
?>
    <script>
    swal({
          title: "Sucesso!",
          text: "User alterado com sucesso!",
          icon: "success",
          button: "Continuar",
    });
    </script>
<?php
  }
?>
</body>

</html>