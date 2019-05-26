
<?php /*
session_start();
if(isset($_SESSION['id_grupo'])=='7' || isset($_SESSION['id_utilizador'])){
}else header('Location: ../../index.php');
*/?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/custom.css">
    <link rel="stylesheet" type="text/css" href="../../css/jquery.dataTables.min.css">

    <title>elVecino | Manutenções</title>
  </head>

<body>

	<?php
  include "../../core/connect.php";
	include __DIR__.'/../../headers/admin_header.php';
	?>
  
  <h1 id="h1-centered">Inserir manutenções:</h1>
  <div class="container">
    <table id="data" class="table table-condensed table-hover table-striped bootgrid-table display" cellspacing="0">
      <thead>
        <tr>
          <th>Data</th>
          <th>Condominio</th>
          <th>Local</th>
          <th>Descrição</th>
          <th>Avaria</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT id_ocorrencia, data_ocorrencia, condominio.cod_condominio AS cod_condominio, zona.nome AS entrada, descricao, id_tipoocorrencia  FROM ocorrencia INNER JOIN zona ON ocorrencia.id_zona = zona.id_zona INNER JOIN condominio ON condominio.id_condominio = zona.id_condominio";
        $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
        while( $rows = mysqli_fetch_assoc($resultset) ) {
        ?>
          <tr id="<?php echo $rows["id_ocorrencia"]; ?>">
          <td><?php echo $rows["data_ocorrencia"]; ?></td>
          <td><?php echo $rows["cod_condominio"]; ?></td>
          <td><?php echo $rows["entrada"]; ?></td>
          <td><?php echo $rows["descricao"]; ?></td>
          <td><?php echo $rows["id_tipoocorrencia"]; ?></td>
      </tr>
      <?php
      }
      ?>
      </tbody>
    </table>
  </div>

    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready( function () {
        
        $('#data').DataTable({
          select: true
        });
      });
    </script>
</body>