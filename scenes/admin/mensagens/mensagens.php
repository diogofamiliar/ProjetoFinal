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
    <title>elVecino | Mensagens</title>

    <script language="JavaScript" type="text/javascript">
      function checkDelete() {
        var x = $('[name="id_mensagem[]"]:checked').length;
      if(x>0){ 
        var confirmed = confirm("Pretende eliminar as mensagens?");
          if(confirmed){
            document.getElementById('form1').submit();
            return true;
          }
      }else{
        swal("Aviso!", 
        "Selecione as notificações que pretende eliminar!", 
        "error");
      return false;}
      }
    </script>

  </head>

<body>

  <div>


  </div>
<div class="container">
  <?php include "../../../assets/breadcrumbers/bc_mensagens.php" ?>
  <h1 id="h1-centered">Notificações</h1>
  <p>Listagem de todas as mensagens enviadas e detalhes das mesmas.</p>
  <div class="card col-sm-12">
    <div class="card-header">
      <a class="btn btn-primary" href="criar_mensagem.php"><i class="fa fa-envelope-o"></i> Criar notificação</a>
      <a class="btn btn-danger" href="javascript:{}" onclick="checkDelete()"><i class="fa fa-trash"></i> Eliminar</a>
    </div>
    <div class="card-body">
      <form method="POST" id="form1" action="eliminar_mensagens.php"> 
        <table id="data" class="table table-condensed table-hover table-striped bootgrid-table display" cellspacing="0" style="table-layout: fixed; width: 100%;">
          <thead>
            <tr>
              <th><input type="checkbox" id="checkAll"/></th>
              <th>Destinatário</th>
              <th>Assunto</th>
              <th>Mensagem</th>  
              <th>Data Envio</th>
              <th>Autor</th>
              <th>Lida</th>
              <th>Data Leitura</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT mensagem.remetente as id_remetente,destinatario.data_leitura, utilizador.nome as nome_destinatario, 
            mensagem.id_mensagem as id_mensagem, mensagem.assunto as assunto, 
            mensagem.texto as texto, mensagem.data_criacao as data_criacao, 
            destinatario.id_utilizador as destinatario, destinatario.lida as lida 
            from mensagem inner join destinatario ON mensagem.id_mensagem=destinatario.id_mensagem 
            INNER JOIN utilizador ON utilizador.id_utilizador=destinatario.id_utilizador 
            order by data_criacao DESC";
            $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
            while($rows = mysqli_fetch_assoc($resultset)) {
              $id_remetente=$rows["id_remetente"];
              $sql1="SELECT utilizador.nome as autor FROM utilizador WHERE id_utilizador=".$id_remetente;
              $resultset1 = mysqli_query($conn, $sql1) or die("database error:". mysqli_error($conn));
              while($row = mysqli_fetch_assoc($resultset1)) {
            ?>
          <tr>
              <td><input type="checkbox" name="id_mensagem[]" value="<?php echo $rows['id_mensagem']; ?>" multiple></td>
              <td><?php echo utf8_encode($rows["nome_destinatario"]); ?></td>
              <td><?php echo utf8_encode($rows["assunto"]); ?></td>
              <td><?php echo utf8_encode($rows["texto"]); ?></td>
              <td><?php echo utf8_encode($rows["data_criacao"]); ?></td>
              <td><?php echo utf8_encode($row["autor"]); ?></td>
              <td><?php if($rows["lida"]==1){ echo "Sim";}elseif($rows["lida"]==NULL){echo "Não";}; ?></td>
              <td><?php echo utf8_encode($rows["data_leitura"]); ?></td>
          </tr>
          <?php
              }
          }
          ?>
          </tbody>
        </table>
      </form>
    </div>  
  </div>
</div>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../../../js/jquery-3.4.1.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- Optional JavaScript -->
 
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready( function () {
    
    $('#data').DataTable({
      "columnDefs": [
        { "width": "5%", "targets": 0 },  //check
        { "width": "10%", "targets": 1 }, //destinatario
        { "width": "10%", "targets": 2 }, //assunto
        { "width": "35%", "targets": 3 }, //mensagem
        { "width": "15%", "targets": 4 }, //data
        { "width": "5%", "targets": 5 },  //autor
        { "width": "5%", "targets": 6 },  //lida
        { "width": "15%", "targets": 7 }  //data leitura
      ],
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
  if(isset($_COOKIE["mensagem_eliminada"])){
?>
    <script>
      swal({
          title: "Sucesso!",
          text: "As mensagens foram eliminadas com sucesso!",
          icon: "success",
          button: "Continuar",
      });
    </script>
<?php
  }
?>
<?php
  if(isset($_COOKIE["mensagem_enviada"])){
?>
    <script>
      swal({
          title: "Enviado!",
          text: "Mensagem enviada com sucesso!",
          icon: "success",
          button: "Continuar",
      });
    </script>
<?php
  }
?>
</body>
</html>