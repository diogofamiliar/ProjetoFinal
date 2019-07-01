<?php
session_start();
if(($_SESSION['nome_grupo'])=='cliente' || ($_SESSION['nome_grupo'])=='inquilino' && isset($_SESSION['id_utilizador'])){
}else header('Location: /ProjetoFinal/index.php');
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
    <!-- datatables CSS -->
    <link rel="stylesheet" type="text/css" href="../../../css/jquery.dataTables.min.css">
    <!-- Sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="https://i.imgur.com/SzFkxr6.png" />
    <title>Avisos</title>
    
    <script language="JavaScript" type="text/javascript">
      function checkArquivar() {
        var x = $('[name="id_mensagem[]"]:checked').length;
      if(x>0){ 
        var confirmed = confirm("Pretende arquivar as mensagens?");
          if(confirmed){
            document.getElementById('form1').submit();
            return true;
          }
      }else{
        swal("Aviso!", 
        "Selecione as notificações que pretende arquivar!", 
        "error");
      return false;}
      }
    </script>

</head>

<body>

	<?php
  include '../../../headers/cliente_header.php';
  include '../../../core/connect.php';
  $id_utilizador=$_SESSION['id_utilizador'];
	?>
  
  
	<div class="container">
    <?php include "../../../assets/breadcrumbers/bc_cliente_notificacoes.php" ?>
    <h1 id="h1-centered">Notificações e avisos</h1>
    <p>Lista de mensagens e avisos que recebeu.</p>
    <div class="card">
      <div class="card-header">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#cx_entrada">Cx entrada</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#arquivado">Arquivado</a>
          </li>
        </ul>
      </div>
      <div>
        <div class="tab-content">
          <div id="cx_entrada" class="container tab-pane active">
            <a class="btn btn-primary mx-2 my-2" href="javascript:{}" onclick="checkArquivar()"><i class="fa fa-trash"></i> Arquivar</a>  
            <div class="card-body">
              <form method="POST" id="form1" action="arquivar_notificacoes.php">
                <div class="table-responsive">
                  <table id="data" class="table table-hover">
                    <thead>
                      <tr>
                        <th><input type="checkbox" id="checkAll"/></th>
                        <th>Assunto</th>
                        <th>Mensagem</th>
                        <th>Data</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $sql = "SELECT mensagem.id_mensagem as id_mensagem, mensagem.assunto as assunto, mensagem.texto as mensagem, mensagem.data_criacao as data_criacao, destinatario.lida as lida 
                              FROM mensagem INNER JOIN destinatario 
                              WHERE mensagem.id_mensagem=destinatario.id_mensagem AND destinatario.id_utilizador='$id_utilizador' AND mensagem.arquivada IS NULL ORDER BY mensagem.data_criacao DESC";
                      $resultset = $conn->query($sql);
                      if ($resultset->num_rows > 0) {
                      while($rows = mysqli_fetch_assoc($resultset)) {
                      ?>
                    <tr class="<?php if ($rows['lida'] == "1"){ echo 'table-active';}else{ echo '';} ?>">
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
                </div>
              </form>
            </div>
          </div>
          <div id="arquivado" class="container tab-pane fade">
            <div class="card-body">
              <form method="POST" id="form1" action="arquivar_notificacoes.php">
                <div class="table-responsive-sm">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Assunto</th>
                        <th class="col-sm-6">Mensagem</th>
                        <th>Data</th>
                        <th class="col-sm-auto"></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $sql = "SELECT mensagem.id_mensagem as id_mensagem, mensagem.assunto as assunto, mensagem.texto as mensagem, mensagem.data_criacao as data_criacao, destinatario.lida as lida 
                      FROM mensagem INNER JOIN destinatario 
                      WHERE mensagem.id_mensagem=destinatario.id_mensagem AND destinatario.id_utilizador='$id_utilizador' AND mensagem.arquivada IS NOT NULL ORDER BY mensagem.data_criacao DESC";
                      $resultset = $conn->query($sql);
                      if ($resultset->num_rows > 0) {
                      while($rows = mysqli_fetch_assoc($resultset)) {
                      ?>
                    <tr class="<?php if ($rows['lida'] == "1"){ echo 'table-active';}else{ echo '';} ?>">
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
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../../../js/jquery-3.4.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- checkbox check all -->
    <script>
      $("#checkAll").change(function () {
      $("input:checkbox").prop('checked', $(this).prop("checked"));
      });
    </script>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready( function () {
    
    $('#data').DataTable({
      "columnDefs": [
        { "width": "5%", "targets": 0 },
        { "width": "10%", "targets": 1 },
        { "width": "50%", "targets": 2 },
        { "width": "20%", "targets": 3 },
        { "width": "10%", "targets": 4 }
      ],
      select: true,
      "scrollX": true
    });
  
    
  });
</script>
<?php
  if(isset($_COOKIE["notificacoes_arquivadas"])){
?>
      <script>
      swal({
            title: "Sucesso!",
            text: "As mensagens foram arquivadas com sucesso!",
            icon: "success",
            button: "Continuar",
      });
      </script>
<?php
  }
?>

</body>
</html>
