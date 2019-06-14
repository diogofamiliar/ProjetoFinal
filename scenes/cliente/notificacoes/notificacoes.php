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

    <title>elVecino</title>
    
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

	<?php
  include '../../../headers/cliente_header.php';
  include '../../../core/connect.php';
  include '../../../core/notificacao.php'; //verifica o nr_notificacoes por ler
  $id_utilizador=$_SESSION['id_utilizador'];
	?>
  
  <h1 id="h1-centered">Notificações e avisos:</h1>
	<div class="container">
    <div class="card">
      <div class="card-header d-flex justify-content-end">
        <a class="btn btn-danger" href="javascript:{}" onclick="checkDelete()"><i class="fa fa-trash"></i> Eliminar</a>
      </div>
      <div class="card-body">
        <form method="POST" id="form1" action="eliminar_notificacoes.php"> 
          <table class="table table-hover">
            <thead>
              <tr>
                <th class="col-sm-1"><input type="checkbox" id="checkAll"/></th>
                <th class="col-sm-2">Assunto</th>
                <th class="col-sm-6">Mensagem</th>
                <th class="col-sm-2">Data</th>
                <th class="col-sm-1"></th>
              </tr>
            </thead>
            <tbody>
            <?php
              $sql = "SELECT mensagem.id_mensagem as id_mensagem, mensagem.assunto as assunto, mensagem.texto as mensagem, mensagem.data_criacao as data_criacao FROM mensagem INNER JOIN destinatario WHERE mensagem.id_mensagem=destinatario.id_mensagem AND destinatario.id_utilizador='$id_utilizador' ORDER BY mensagem.data_criacao DESC";
              $resultset = $conn->query($sql);
              if ($resultset->num_rows > 0) {
              while($rows = mysqli_fetch_assoc($resultset)) {
              ?>
            <tr>
                <td class="col-sm-1"><input type="checkbox" name="id_mensagem[]" value="<?php echo $rows['id_mensagem']; ?>" multiple></td>
                <td><?php echo utf8_encode($rows["assunto"]); ?></td>
                <td><?php echo utf8_encode($rows["mensagem"]); ?></td>
                <td><?php echo utf8_encode($rows["data_criacao"]); ?></td>
                <td><form method="POST" id="form2" action="mensagem_detalhe.php">
                      <button form="form2" name="mensagem" class="btn btn-info" type="submit" value="<?php echo utf8_encode($rows["id_mensagem"]); ?>">Detalhes</button>
                    </form>
                </td>
            </tr>
            <?php
              }}else{
            ?>
              <tr>
                  <td></td>
                  <td></td>
                  <td>Não existem notificações ou avisos!</td>
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
    <!-- sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- checkbox check all -->
    <script>
      $("#checkAll").change(function () {
      $("input:checkbox").prop('checked', $(this).prop("checked"));
      });
    </script>
    
<?php
  if(isset($_COOKIE["notificacoes_eliminadas"])){
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

</body>
</html>