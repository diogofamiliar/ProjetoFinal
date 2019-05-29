<?php/*
session_start();
if(isset($_SESSION['nome_grupo'])=='admin' && isset($_SESSION['id_utilizador'])){
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

    <title>elVecino | Inserir Lista manutenções</title>
  </head>
  <script type="text/javascript">
  function submitForm(action) {
    var form = document.getElementById('form1');
    form.action = action;
    form.submit();
  }
</script>

<body>

	<?php
  include "../../core/connect.php";
	include __DIR__.'/../../headers/admin_header.php';
	?>
  
  <h1 id="h1-centered">Inserir lista de tarefas:</h1>
  <div class="container">
  <form method="POST" id="form1"> 
    <table id="data" class="table table-condensed table-hover table-striped bootgrid-table display" cellspacing="0" style="table-layout: fixed; width: 100%;">
      <thead>
        <tr>
          <th><input type="checkbox" id="checkAll"/></th>
          <th>Data</th>
          <th>Condominio</th>
          <th>Local</th>
          <th>Descrição</th>  
          <th>Avaria</th>
          <th>Sel equipa</th>
        </tr>
      </thead>
      <tbody>
      <?php
        $id_incidente=$_POST['id_incidente'];
            foreach ($id_incidente as $valor) {
                $sql="  SELECT incidente.data_incidente AS data_incidente, incidente.local as local, categoria_incidente.descricao as categoria_incidente, zona.nome AS entrada, incidente.descricao AS descricao, condominio.cod_condominio AS cod_condominio, condominio.morada AS morada
                FROM incidente 
                inner JOIN zona ON incidente.id_zona = zona.id_zona 
                Inner JOIN condominio ON zona.id_condominio = condominio.id_condominio 
                Inner Join categoria_incidente ON categoria_incidente.id_categoria_incidente = incidente.id_categoria_incidente WHERE id_incidente='$valor'";
                $result=mysqli_query($conn,$sql);
                $row=mysqli_fetch_array($result);
        ?>
      <tr>
          <td class="col-sm-1"><input type="checkbox" name="id_incidente[]" value="<?php echo $rows['id_incidente']; ?>" multiple></td>
          <td><?php echo utf8_encode($row["data_incidente"]); ?></td>
          <td><?php echo utf8_encode($row["cod_condominio"]); ?></td>
          <td><?php echo utf8_encode($row["entrada"]); ?></td>
          <td><?php echo utf8_encode($row["descricao"]); ?></td>
          <td><?php echo utf8_encode($row["categoria_incidente"]); ?></td>
      </tr>
      <?php
      }
      ?>
      </tbody>
    </table>
    <button type="button" onclick="submitForm('inserir_manutencao.php')" value="submit 1" class="btn btn-primary btn-lg">Criar manutenção</button>
    <button type="button" onclick="submitForm('inserir_lista.php')" value="submit 2" class="btn btn-primary btn-lg">Criar lista de tarefas</button>

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
          "columnDefs": [
            { "width": "50%", "targets": 0 },
            { "width": "60px", "targets": 1 },
            { "width": "60px", "targets": 2 },
            { "width": "100px", "targets": 3 },
            { "width": "200px", "targets": 4 },
            { "width": "50px", "targets": 5 }
          ],
          select: true,
          
          "searching": false
        });
      
        
      });
    </script>
    <script>
    $("#checkAll").change(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
});
    </script>
</body>