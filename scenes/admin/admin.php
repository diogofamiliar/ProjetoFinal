<?php
session_start();
if(($_SESSION['nome_grupo'])=='admin' || ($_SESSION['nome_grupo'])=='master' && isset($_SESSION['id_utilizador'])){
}else header('Location: /ProjetoFinal/index.php');
?>
<?php
include __DIR__.'/../../headers/admin_header.php';
include '../../core/connect.php';
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
    <link rel="shortcut icon" type="image/x-icon" href="https://i.imgur.com/SzFkxr6.png" />
    <title>Área administrativa</title>
  </head>

<body style="padding-top: 27px;">
<div class="w-100">

  <div class="w-100" id="top_div">
    <div class="w-100">
          <h5 class="mt-5" id="h5_admin">
              <?php
              $id_utilizador=$_SESSION['id_utilizador'];
              $sql = "SELECT nome FROM utilizador WHERE id_utilizador='$id_utilizador'";
              $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
              $row = mysqli_fetch_assoc($resultset);
              ?>
              <b>Bem-vindo <?php echo $row['nome'];?></b>
          </h5>
        </div>
    <div class="container my-5">

      <div class="row">
        <div class="col my-3">
          <div class="card-transparent" id="teste1" style="border-color: #0199e6;">
            <div class="card-header text-white" style="background-color: #0199e6;"><h3>Áreas de controlo</h3></div>
            <div class="card-body text-dark">
              <div class="row">
                <div class="col-sm">
                  <a href="manutencoes/manutencoes.php" class="btn btn-lg btn-change btn-block" role="button"><i class="fa fa-cog"></i> Manutenções</a>
                </div>
                <div class="col-sm">
                  <a href="admin_documentos.php" class="btn btn-lg btn-change btn-block" role="button"><i class="fa fa-archive"></i> Arquivo</a>
                </div>
              </div>
              <div class="row">
                <div class="col-sm">
                  <a href="relatorios.php" class="btn btn-lg btn-change btn-block" role="button"><i class="fa fa-area-chart"></i> Relatórios</a>
                </div>
                <div class="col-sm">
                  <a href="gestao/gestao.php" class="btn btn-lg btn-change btn-block" role="button"><i class="fa fa-building-o"></i> Gestão Condomínios</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col my-3">
          <div class="card" id="teste2" style="border-color: #0199e6;">
            <div class="card-header text-white" style="background-color: #0199e6;"><h3>Painel Administrativo</h3></div>
            <div class="card-body text-dark">
              <div class="border-bottom">
                <p><b>NUMERO</b> manutenções por agendar.</p>
              </div>  
              <div class="border-bottom border-top">
                <p><b>NUMERO</b> reparações concluídas.</p>
              </div>
              <div class="border-bottom border-top">
                <p><b>NUMERO</b> reparações encontram-se em atraso.</p>
              </div>
              <div>
                <p>% reparações efetuadas hoje:</p>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%">VALOR%</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <h1>Plano de manutenções</h1>
    <p>O painel que se encontra em baixo apresenta as reparações agendadas para o dia de hoje, amanhã e ontem.</p>
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th scope="col">Data planeada</th>
            <th scope="col">Data conclusão</th>
            <th scope="col">COD</th>
            <th scope="col">Entrada</th>
            <th scope="col">Manutenção</th>
            <th scope="col">Fornecedor</th>
          </tr>
        </thead>
        <tbody>
                  <?php
                  $sql = "SELECT curdate() as hoje ,manutencao.data_conclusao, manutencao.id_manutencao as id_manutencao, manutencao.data_planeada as data_planeada, incidente.id_incidente as id_incidente, incidente.local as local, manutencao.observacoes as observacoes, incidente_manutencao.estado as estado, zona.id_zona, tipo_manutencao.descricao as tipo_reparacao, condominio.cod_condominio as cod_condominio, zona.nome as zona, manutencao.id_fornecedor as id_fornecedor, fornecedor.nome as fornecedor  FROM manutencao
                  INNER JOIN incidente_manutencao ON manutencao.id_manutencao=incidente_manutencao.id_manutencao
                  INNER JOIN incidente ON incidente.id_incidente=incidente_manutencao.id_incidente
                  INNER JOIN zona ON zona.id_zona=incidente.id_zona
                  INNER JOIN condominio ON condominio.id_condominio=zona.id_condominio
                  INNER JOIN fornecedor ON fornecedor.id_fornecedor=manutencao.id_fornecedor
                  INNER JOIN tipo_manutencao ON tipo_manutencao.id_tipo_manutencao=manutencao.id_tipo_manutencao
            WHERE manutencao.data_planeada >= now() OR manutencao.data_planeada between date_sub(now(),INTERVAL 3 DAY) and now()
                  ORDER BY manutencao.data_planeada, manutencao.data_conclusao ASC";
                  $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
                  while($rows = mysqli_fetch_assoc($resultset)) {
                  ?>
                <tr class="<?php if (($rows['data_conclusao'] == "") and ($rows['data_planeada'] <= $rows['hoje'])){ echo 'table-danger';}elseif(($rows['data_conclusao'] == null)){ echo '';}elseif(isset($rows['data_conclusao'])){ echo 'table-success';} ?>">
                    <td scope="row"><?php echo utf8_encode($rows["data_planeada"]); ?></td>
                    <td scope="row"><?php echo utf8_encode($rows["data_conclusao"]); ?></td>
                    <td scope="row"><?php echo utf8_encode($rows["cod_condominio"]); ?></td>
                    <td scope="row"><?php echo utf8_encode($rows["zona"]); ?></td>
                    <td scope="row"><?php echo utf8_encode($rows["tipo_reparacao"]); ?></td>
                    <td scope="row"><?php echo utf8_encode($rows["fornecedor"]); ?></td>
                </tr>
                <?php
                }
                ?>
        </tbody>
      </table>
    </div>
  </div>
    <!-- acrescentar legendas nas tabelas p.e.-->
</div>

    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<?php //verificar isto
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
<?php
  if(isset($_COOKIE["alter_user"])){
?>
    <script>
    swal({
          title: "Sucesso!",
          text: "User alterado com sucesso!",
          icon: "success",
          button: "Continuar",
    });
    </script>
<?php
  }
?>
</body>

</html>