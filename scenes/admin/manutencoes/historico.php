<?php
session_start();
if(($_SESSION['nome_grupo'])=='admin' || ($_SESSION['nome_grupo'])=='master' && isset($_SESSION['id_utilizador'])){
}else header('Location: /ProjetoFinal/index.php');
?>
<?php
  include "../../../core/connect.php";
	include '../../../headers/admin_header.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
    <!-- datatables CSS -->
    <link rel="stylesheet" type="text/css" href="../../../css/jquery.dataTables.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../../css/custom.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="https://i.imgur.com/SzFkxr6.png" />
    <title>Histórico reparações</title>


  </head>


<body>
<div class="container">
  <?php include "../../../assets/breadcrumbers/bc_historico.php" ?>
  <h2 id="h1-centered">Histórico das Manutenções</h2>
  <p>Lista das manutenções que foram concluídas e alguns detalhes das mesmas.</p>
  <div class="d-flex justify-content-center">
      <div class="card col-sm-12">
        <div class="card-body">
            <form method="POST" id="form1" action="eliminar_manutencoes.php">
            <table id="data" class="table table-condensed table-hover table-striped bootgrid-table display" cellspacing="0" style="table-layout: fixed; width: 100%;">
              <thead>
                <tr>
                  <th style="text-align: center;">Data reparação</th>
                  <th style="text-align: center;">Condomínio</th>
                  <th>Local</th>
                  <th>Descrição</th>  
                  <th>Fornecedor</th>
                  <th></th>
                  </tr>
              </thead>
              <tbody>
                <?php
                $sql = "SELECT manutencao.data_conclusao, manutencao.id_manutencao as id_manutencao, manutencao.data_planeada as data_planeada, incidente.id_incidente as id_incidente, incidente.local as local, manutencao.observacoes as observacoes, incidente_manutencao.estado as estado, zona.id_zona, condominio.cod_condominio as cod_condominio, manutencao.id_fornecedor as id_fornecedor, fornecedor.nome as fornecedor  FROM manutencao
                INNER JOIN incidente_manutencao ON manutencao.id_manutencao=incidente_manutencao.id_manutencao
                INNER JOIN incidente ON incidente.id_incidente=incidente_manutencao.id_incidente
                INNER JOIN zona ON zona.id_zona=incidente.id_zona
                INNER JOIN condominio ON condominio.id_condominio=zona.id_condominio
                INNER JOIN fornecedor ON fornecedor.id_fornecedor=manutencao.id_fornecedor
                WHERE manutencao.data_conclusao IS NOT NULL
                ORDER BY manutencao.data_planeada, manutencao.data_conclusao ASC";
                $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
                while($rows = mysqli_fetch_assoc($resultset)) {
                ?>
                  <tr>
                      <td style="text-align: center;"><?php echo utf8_encode($rows["data_conclusao"]); ?></td>
                      <td style="text-align: center;"><?php echo utf8_encode($rows["cod_condominio"]); ?></td>
                      <td><?php echo utf8_encode($rows["local"]); ?></td>
                      <td><?php echo utf8_encode($rows["observacoes"]); ?></td>
                      <td><?php echo utf8_encode($rows["fornecedor"]); ?></td>
                      <td class="d-flex justify-content-center">
                          <form method="POST" id="form2" action="historico_detalhes.php">
                              <input type="hidden" name="id_incidente" value="<?php echo "$id_incidente"?>">
                              <button form="form2" name="id_manutencao" class="btn btn-info" type="submit" value="<?php echo utf8_encode($rows["id_manutencao"]); ?>"> Detalhes</button>
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
        </div>
  </div>

</div>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../../../js/jquery-3.4.1.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready( function () {
    
    $('#data').DataTable({
      "columnDefs": [
        { "width": "10%", "targets": 0 },
        { "width": "10%", "targets": 1 },
        { "width": "10%", "targets": 2 },
        { "width": "25%", "targets": 3 },
        { "width": "10%", "targets": 4 },
        { "width": "10%", "targets": 5 }
      ],
      "dom": '<"top"<l>f>rt<"bottom"ip><"clear">',
      "language": {
        "search": "Pesquisar:",
        "info":           "A mostrar _START_ de _END_ num total de _TOTAL_ resultados",
        "lengthMenu":     "Resultados por página: _MENU_",
        "paginate": {
          "first":      "Primeiro",
          "last":       "Ultimo",
          "next":       "Próximo",
          "previous":   "Anterior"
        }
      },
      select: true,
      "scrollX": true
    });
  
    
  });
</script>
<script>
  $("#checkAll").change(function () {
  $("input:checkbox").prop('checked', $(this).prop("checked"));
  });
</script>

<?php
  if(isset($_COOKIE["condominio_alterado"])){
?>
      <script>
      swal({
            title: "Sucesso!",
            text: "O condomínio foi alterado com sucesso!",
            icon: "success",
            button: "Continuar",
      });
      </script>
<?php
  }
?>

<?php
  if(isset($_COOKIE["manutencao_eliminada"])){
?>
      <script>
      swal({
            title: "Manutenção eliminada!",
            text: "As manutenções foram eliminadas com sucesso!",
            icon: "success",
            button: "Continuar",
      });
      </script>
<?php
  }
?>

</body>
</html>
