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

    <title>Técnico - Tarefas</title>
    
    <script language="JavaScript" type="text/javascript">
      function checkDelete() {
        var x = $('[name="id_manutencao[]"]:checked').length;
      if(x>0){ 
        var confirmed = confirm("Pretende dar como concluídas as reparações selecionadas?");
          if(confirmed){
            document.getElementById('form1').submit();
            return true;
          }
      }else{
        swal("Erro!", 
        "Selecione as reparações já efetuadas.", 
        "error");
      return false;}
      }
    </script>

</head>

<body>

	<?php
  include '../../headers/tecnico_header.php';
  include '../../core/connect.php';
  //include '../../../core/notificacao.php'; //verifica o nr_notificacoes por ler
  //$id_utilizador=$_SESSION['id_utilizador'];
	?>
  
  <h1 id="h1-centered">Lista de tarefas:</h1>
	<div class="container col-11">
    <div class="card">
      <div class="card-header d-flex justify-content-start">
        <a class="btn btn-success" href="javascript:{}" onclick="checkDelete()"><i class="fa fa-trash"></i> Concluído</a>
      </div>
      <div class="card-body">
        <form method="POST" id="form1" action="tarefa_concluída.php"> 
          <table class="table table-hover">
            <thead>
              <tr>
                <th class="col-sm-1"><input type="checkbox" id="checkAll"/></th>
                <th class="col-sm-1">Data</th>
                <th class="col-sm-3">Local</th>
                <th class="col-sm-1">Manutenção</th>
                <th class="col-sm-3">Descrição do cliente</th>
                <th class="col-sm-3">Observações</th>
              </tr>
            </thead>
            <tbody>
            <?php
              $sql =    "SELECT manutencao.id_manutencao as id_manutencao, tipo_manutencao.descricao as tipo_manutencao, incidente.id_zona, zona.morada as morada, zona.nome as entrada, manutencao.id_tipo_manutencao, manutencao.data_planeada as data_planeada, manutencao.observacoes as observacoes, incidente.descricao as descricao
                        FROM manutencao
                        INNER JOIN incidente_manutencao
                        ON manutencao.id_manutencao=incidente_manutencao.id_manutencao
                        INNER JOIN incidente
                        ON incidente.id_incidente=incidente_manutencao.id_incidente
                        INNER JOIN zona
                        ON zona.id_zona=incidente.id_zona
                        INNER JOIN tipo_manutencao
                        ON tipo_manutencao.id_tipo_manutencao=manutencao.id_tipo_manutencao
                        WHERE manutencao.data_conclusao IS NULL
                        ORDER BY data_planeada ASC";
              $resultset = $conn->query($sql);
              if ($resultset->num_rows > 0) {
              while($rows = mysqli_fetch_assoc($resultset)) {
              ?>
            <tr> 
                <td class="col-sm-1"><input type="checkbox" name="id_manutencao[]" value="<?php echo $rows['id_manutencao']; ?>" multiple></td>
                <td><?php echo utf8_encode($rows["data_planeada"]); ?></td>
                <td><?php echo utf8_encode($rows["entrada"]);?><br><?php echo utf8_encode($rows["morada"]);?></td>
                <td><?php echo utf8_encode($rows["tipo_manutencao"]); ?></td>
                <td><?php echo utf8_encode($rows["observacoes"]);?></td>
                <td><?php echo utf8_encode($rows["descricao"]);?></td>               
            </tr>
            <?php
              }}else{
            ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Não existem reparações!</td>
                <td></td>
                <td></td>
                <td></td>
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

    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- checkbox check all -->
    <script>
      $("#checkAll").change(function () {
      $("input:checkbox").prop('checked', $(this).prop("checked"));
      });
    </script>
    
<?php
  if(isset($_COOKIE["tarefa_concluida"])){
?>
      <script>
      swal({
            title: "Sucesso!",
            text: "Tarefas concluídas com sucesso!",
            icon: "success",
            button: "Continuar",
      });
      </script>
<?php
  }
?>

</body>
</html>
