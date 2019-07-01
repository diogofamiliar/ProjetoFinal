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
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../../css/custom.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- datatables CSS -->
    <link rel="stylesheet" type="text/css" href="../../../css/jquery.dataTables.min.css">
    <!-- Sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="https://i.imgur.com/SzFkxr6.png" />
    <title>Manutenções agendadas</title>

<script language="JavaScript" type="text/javascript">
function checkDelete() {
    var x = $('[name="id_manutencao[]"]:checked').length;
        if(x>0){ 
        var confirmed = confirm("Pretende eliminar as manutenções?");
            if(confirmed){
            document.getElementById('form1').submit();
            return true;
            }
        }else{
        swal("Aviso!", 
        "Selecione as manutenções que pretende eliminar!", 
        "error");
        return false;
        }
    }
</script>
  </head>


<body>
<div class="container col-sm-11">
  <?php include "../../../assets/breadcrumbers/bc_listagem.php" ?>
  <h3>Lista de Manutenções Agendadas</h3>
  <p>Lista das manutenções que se encontram agendadas para reparação.</p>
  <div class="card my-5">
    <div class="card-header">
      <div class="row">
        <a class="btn btn-primary mx-1 my-2" href="incidentes.php"><i class="fa fa-plus-square"></i> Nova Manutenção</a>
        <a class="btn btn-danger mx-1 my-2" href="javascript:{}" onclick="checkDelete()"><i class="fa fa-trash"></i> Eliminar Manutenção</a>
        <a class="btn btn-success mx-1 my-2" href="javascript:{}" onclick="checkDelete()"><i class="fa fa-check"></i> Manutenção concluída</a>
      </div>
    </div>
    <div class="card-body">
      <form method="POST" id="form1" action="eliminar_manutencoes.php">
        <table id="data" class="table table-condensed table-hover table-striped bootgrid-table display" cellspacing="0" style="table-layout: fixed; width: 100%;">
          <thead>
            <tr>
              <th><input type="checkbox" id="checkAll"/></th>
              <th>Data</th>
              <th>COD</th>
              <th>Local</th>
              <th>Descrição</th>  
              <th>Fornecedor</th>
              <th>Estado</th>
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
                    WHERE incidente_manutencao.estado='agendada'
                    ORDER BY manutencao.data_planeada, manutencao.data_conclusao ASC";//manutenções agendadadas
            $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
            while($rows = mysqli_fetch_assoc($resultset)) {
            ?>
              <tr>
                  <td class="col-sm-1"><input type="checkbox" name="id_manutencao[]" value="<?php echo $rows['id_manutencao']; ?>" multiple></td>
                  <td><?php echo utf8_encode($rows["data_planeada"]); ?></td>
                  <td><?php echo utf8_encode($rows["cod_condominio"]); ?></td>
                  <td><?php echo utf8_encode($rows["local"]); ?></td>
                  <td><?php echo utf8_encode($rows["observacoes"]); ?></td>
                  <td><?php echo utf8_encode($rows["fornecedor"]); ?></td>
                  <td><?php echo utf8_encode($rows["estado"]); ?></td>
                  <td class="d-flex justify-content-center">
                      <form method="POST" id="form2" action="alterar_manutencao.php">
                          <input type="hidden" name="id_incidente" value="<?php echo "$id_incidente"?>">
                          <button form="form2" name="id_manutencao" class="btn btn-info" type="submit" value="<?php echo utf8_encode($rows["id_manutencao"]); ?>"> Editar</button>
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
        { "width": "10%", "targets": 3 },
        { "width": "25%", "targets": 4 },
        { "width": "15%", "targets": 5 },
        { "width": "10%", "targets": 6 },
        { "width": "10%", "targets": 7 }
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
