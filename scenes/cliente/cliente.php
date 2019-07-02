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
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/custom.css">
    <link rel="shortcut icon" type="image/x-icon" href="https://i.imgur.com/SzFkxr6.png" />
    <link rel="shortcut icon" type="image/x-icon" href="https://i.imgur.com/SzFkxr6.png" />
    <title>Àrea do cliente</title>

  </head>

<body style="padding-top: 27px;">

	<?php
  include __DIR__.'/../../headers/cliente_header.php';
  include '../../core/connect.php';
	?>
  
  <div class="w-100">

<div class="w-100" id="top_div_cliente">
  <div class="w-100">
    <h5 class="mt-5" id="h5_cliente">
        <?php
        $id_utilizador=$_SESSION['id_utilizador'];
        $sql = "SELECT nome FROM utilizador WHERE id_utilizador='$id_utilizador'";
        $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
        $row = mysqli_fetch_assoc($resultset);
        ?>
        <b>Bem-vindo(a) <?php echo $row['nome'];?></b>
    </h5>
  </div>
  <div class="container my-5">
    <div class="row">
      <div class="col my-3">
        <div class="card-transparent" id="area_controlo_cliente" style="border-color: #0199e6;">
          <div class="card-header text-white" style="background-color: #0199e6;"><h3>Áreas de controlo</h3></div>
          <div class="card-body text-dark">
            <div class="container">
            <div class="row">
              <div class="col-sm">
                <a href="registo_incidente.php" class="btn btn-lg btn-change btn-block" role="button"><i class="fa fa-plus-square"></i> Registar incidente</a>
              </div>
              <div class="col-sm">
                <a href="estado_manutencoes.php" class="btn btn-lg btn-change btn-block" role="button"><i class="fa fa-calendar"></i> Estado manutenções</a>
              </div>
            </div>
            <div class="row">
              <div class="col-sm">
                <a href="notificacoes/notificacoes.php" class="btn btn-lg btn-change btn-block" role="button"><i class="fa fa-envelope"></i> Notificações</a>
              </div>
              <div class="col-sm">
                <a href="contactos.php" class="btn btn-lg btn-change btn-block" role="button"><i class="fa fa-phone"></i> Contactos</a>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col my-3">
        <div class="card" id="notificacoes_cliente" style="border-color: #0199e6;">
          <div class="card-header text-white" style="background-color: #0199e6;"><h3> Notificações</h3></div>
          <div class="card-body text-dark">
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
                WHERE mensagem.id_mensagem=destinatario.id_mensagem AND destinatario.id_utilizador='$id_utilizador' ORDER BY destinatario.lida ASC, mensagem.data_criacao DESC LIMIT 5";
                $resultset = $conn->query($sql);
                if ($resultset->num_rows > 0) {
                while($rows = mysqli_fetch_assoc($resultset)) {
                ?>
              <tr class="<?php if ($rows['lida'] == "1"){ echo 'table-active';}else{ echo '';} ?>">
                  <td><?php echo utf8_encode($rows["assunto"]); ?></td>
                  <td><?php echo utf8_encode($rows["mensagem"]); ?></td>
                  <td><?php echo utf8_encode($rows["data_criacao"]); ?></td>
                  <td><form method="POST" id="form2" action="notificacoes/mensagem_detalhe.php">
                        <button form="form2" name="mensagem" class="btn btn-info" type="submit" value="<?php echo utf8_encode($rows["id_mensagem"]); ?>"><i class="fa fa-plus" aria-hidden="true"></i></button>
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
            <div class="d-flex justify-content-center">
              <a href="notificacoes/notificacoes.php">Ver mais</a>
            </div>
          </div>
        </div>
      </div>
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

<?php
  if(isset($_COOKIE["alter_user"])){
?>
    <script>
      swal({
          title: "Sucesso!",
          text: "O seu perfil foi atualizado com sucesso.",
          icon: "success",
          button: "Continuar",
      });
    </script>
<?php
  }    
?>
<?php
  if(isset($_COOKIE["registo_efetuado"])){
?>
      <script>
      swal({
            title: "Sucesso!",
            text: "Pedido de manutenção inserido com sucesso!",
            icon: "success",
            button: "Continuar",
      });
      </script>
<?php
  }
?>

</body>

