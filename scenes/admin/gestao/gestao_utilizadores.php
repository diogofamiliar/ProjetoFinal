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
    <link rel="stylesheet" type="text/css" href="../../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../../css/custom.css">
    <!-- Sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- datatables CSS -->
    <link rel="stylesheet" type="text/css" href="../../../css/jquery.dataTables.min.css">

    <title>elVecino - Gestão utilizadores</title>
</head>

<body>

	<?php
        include '../../../headers/admin_header.php';
        include '../../../core/connect.php';    
        $id_utilizador=$_SESSION['id_utilizador'];
	?>
  
  <h1 id="h1-centered">Gestão de utilizadores</h1>
    <div class="container">
        <form id="form1"> 
            <table id="data" class="table table-condensed table-hover table-striped bootgrid-table display" cellspacing="0" style="table-layout: fixed; width: 100%;">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT id_utilizador, nome FROM utilizador";
                    $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));

                    while($rows = mysqli_fetch_assoc($resultset)) {
                    ?>
                <tr>
                    <td><?php echo utf8_encode($rows["nome"]); ?></td>
                    <td class="d-flex justify-content-center">
                        <form method="POST" id="form2" action="alterar_utilizador.php">
                            <button form="form2" name="id_utilizador" class="btn btn-info" type="submit" value="<?php echo utf8_encode($rows["id_utilizador"]); ?>">Alterar</button>
                        </form>
                    </td>
                </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </form>
    </div>

    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../../../js/jquery-3.4.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready( function () {
        
        $('#data').DataTable({
          "columnDefs": [
            { "width": "90%", "targets": 0 },
            { "width": "10%", "targets": 1 }
          ],
          select: true
        });
      
        
      });
    </script>

<?php
  if(isset($_COOKIE["user_editado"])){
?>
      <script>
      swal({
            title: "Sucesso!",
            text: "Utilizador alterado com sucesso!",
            icon: "success",
            button: "Continuar",
      });
      </script>
<?php
  }
?>

</body>
</html>
