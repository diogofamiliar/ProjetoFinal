
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
  <form action="inserir_manutencao.php" method="POST"> 
    <table id="data" class="table table-condensed table-hover table-striped bootgrid-table display" cellspacing="0">
      <thead>
        <tr>
          <th><input type="checkbox" id="checkAll"/></th>
          <th>Data</th>
          <th>Condominio</th>
          <th>Local</th>
          <th>Descrição</th>
          <th>Avaria</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT id_incidente, data_incidente, condominio.cod_condominio AS cod_condominio, zona.nome AS entrada, descricao, id_categoria_incidente  FROM incidente INNER JOIN zona ON incidente.id_zona = zona.id_zona INNER JOIN condominio ON condominio.id_condominio = zona.id_condominio";
        $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
        while($rows = mysqli_fetch_assoc($resultset)) {
        ?>
      <tr>
          <td class="col-sm-1"><input type="checkbox" name="id_incidente[]" value="<?php echo $rows['id_incidente']; ?>" multiple></td>
          <td><?php echo $rows["data_incidente"]; ?></td>
          <td><?php echo $rows["cod_condominio"]; ?></td>
          <td><?php echo $rows["entrada"]; ?></td>
          <td><?php echo $rows["descricao"]; ?></td>
          <td><?php echo $rows["id_categoria_incidente"]; ?></td>
      </tr>
      <?php
      }
      ?>
      </tbody>
    </table>
    <button type="submit" class="btn btn-primary btn-lg">Criar manutenção</button>
    <button type="submit" class="btn btn-primary btn-lg">Criar lista de tarefas</button>
    </form>
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
    <script>
    $("#checkAll").change(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
});
    </script>
</body>