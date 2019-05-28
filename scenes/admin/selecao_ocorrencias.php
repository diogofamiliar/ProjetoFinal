
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
    <!-- datatables CSS -->
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
          <div class="col-sm-4"><th><input type="checkbox" id="checkAll"/></th></div>
          <th class="col-sm-1">Data</th>
          <th class="col-sm-1">Condominio</th>
          <th class="col-sm-2">Local</th>
          <th class="col-sm-4">Descrição</th>
          <th class="col-sm-3">Avaria</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "select v.id_incidente, v.data_incidente, v.cod_condominio AS cod_condominio, v.entrada AS entrada, v.descricao, v.id_categoria_incidente from view_incidentes v LEFT JOIN incidente_manutencao t ON v.id_incidente = t.id_incidente WHERE t.id_incidente IS NULL";
        $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
        while($rows = mysqli_fetch_assoc($resultset)) {
        ?>
      <tr>
          <td class="col-sm-1"><input type="checkbox" name="id_incidente[]" value="<?php echo $rows['id_incidente']; ?>" multiple></td>
          <td class="col-sm-1"><?php echo utf8_encode($rows["data_incidente"]); ?></td>
          <td class="col-sm-1"><?php echo utf8_encode($rows["cod_condominio"]); ?></td>
          <td class="col-sm-2"><?php echo utf8_encode($rows["entrada"]); ?></td>
          <td class="col-sm-4"><?php echo utf8_encode($rows["descricao"]); ?></td>
          <td class="col-sm-3"><?php echo utf8_encode($rows["id_categoria_incidente"]); ?></td>
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