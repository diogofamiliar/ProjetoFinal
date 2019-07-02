<?php
session_start();
if(($_SESSION['nome_grupo'])=='tecnico' && isset($_SESSION['id_utilizador'])){
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
    <!-- Sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="https://i.imgur.com/SzFkxr6.png" />
    <title>ElVecino - Área Técnica</title>

  
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

<body style="padding-top: 27px;">

	<?php
  include '../../headers/tecnico_header.php';
  include '../../core/connect.php';
	?>
<div class="w-100" id="top_div">
  <div class="w-100">
        <h5 class="mt-5" id="h5_admin">
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
        <div class="card-transparent" id="teste1" style="border-color: #0199e6;">
          <div class="card-header text-white" style="background-color: #0199e6;"><h3>Áreas de controlo</h3></div>
          <div class="card-body text-dark">
            <div class="container">
              <div class="row">
                <div class="col-sm">
                  <a href="tarefas.php" class="btn btn-lg btn-change btn-block" role="button"><i class="fa fa-list"></i> Plano de manutenções</a>
                </div>
              </div>
              <div class="row">
                <div class="col-sm">
                  <a href="registo_incidente.php" class="btn btn-lg btn-change btn-block" role="button"><i class="fa fa-plus-square"></i> Inserir Incidente</a>
                </div>
              </div>
              <div class="row">
                <div class="col-sm">
                  <a href="contactos_tecnico.php" class="btn btn-lg btn-change btn-block" role="button"><i class="fa fa-phone-square"></i> Contactos úteis</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col my-3">
        <div class="card" id="teste2" style="border-color: #0199e6;">
          <div class="card-header text-white" style="background-color: #0199e6;"><h3>Painel Técnico</h3></div>
          <div class="card-body text-dark">
            <div class="border-bottom">
              <?php
                $sql = "select count(incidente.id_incidente) as n_agendadas FROM incidente
                  LEFT JOIN incidente_manutencao
                  ON incidente_manutencao.id_incidente=incidente.id_incidente
                  WHERE incidente_manutencao.id_incidente IS NULL";//número de reparações que não estão agendadas
                $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
                $row = mysqli_fetch_assoc($resultset);
              ?>
              <p><b><?php echo $row['n_agendadas'];?></b> manutenções por agendar.</p>
            </div>  
            <div class="border-bottom border-top">
              <?php
                $sql = "SELECT count(incidente.id_incidente) as r_efetuadas, manutencao.data_conclusao, manutencao.id_manutencao as id_manutencao, manutencao.data_planeada as data_planeada, incidente.id_incidente as id_incidente, incidente_manutencao.estado as estado  FROM manutencao
                  INNER JOIN incidente_manutencao ON manutencao.id_manutencao=incidente_manutencao.id_manutencao
                  INNER JOIN incidente ON incidente.id_incidente=incidente_manutencao.id_incidente
                  WHERE manutencao.data_planeada = curdate() AND manutencao.data_conclusao IS NOT NULL
                  ORDER BY manutencao.data_planeada, manutencao.data_conclusao ASC"; //número de reparações efetuadas
                $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
                $row1 = mysqli_fetch_assoc($resultset);
              ?>
              <p><b><?php echo $row1['r_efetuadas'];?></b> reparações concluídas hoje.</p>
            </div>
            <div class="border-bottom border-top">
              <?php
                $sql = "SELECT count(incidente.id_incidente) r_atraso, manutencao.data_conclusao, manutencao.id_manutencao as id_manutencao, manutencao.data_planeada as data_planeada, incidente.id_incidente as id_incidente, incidente_manutencao.estado as estado  FROM manutencao
                  INNER JOIN incidente_manutencao ON manutencao.id_manutencao=incidente_manutencao.id_manutencao
                  INNER JOIN incidente ON incidente.id_incidente=incidente_manutencao.id_incidente
                  WHERE manutencao.data_planeada < curdate() AND manutencao.data_conclusao IS NULL
                  ORDER BY manutencao.data_planeada, manutencao.data_conclusao ASC";//reparações em atraso
                $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
                $row = mysqli_fetch_assoc($resultset);
              ?>
              <p><b><?php echo $row['r_atraso'];?></b> reparações encontram-se em atraso.</p>
            </div>
            <div>
              <?php
                $sql = "SELECT count(incidente.id_incidente) as r_agendadas, manutencao.data_conclusao, manutencao.id_manutencao as id_manutencao, manutencao.data_planeada as data_planeada, incidente.id_incidente as id_incidente, incidente_manutencao.estado as estado  FROM manutencao
                  INNER JOIN incidente_manutencao ON manutencao.id_manutencao=incidente_manutencao.id_manutencao
                  INNER JOIN incidente ON incidente.id_incidente=incidente_manutencao.id_incidente
                  WHERE manutencao.data_planeada = curdate()
                  ORDER BY manutencao.data_planeada, manutencao.data_conclusao ASC";//reparações agendadas para hoje
                $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
                $row = mysqli_fetch_assoc($resultset);
                $r_agendadas=$row['r_agendadas'];$r_efetuadas=$row1['r_efetuadas']; //reparações agendadas e reparações efetuadas
                if ($r_agendadas==0) {
                  $percentagem="Sem manutenções para hoje";
                }else {
                  $percentagem=($r_efetuadas/$r_agendadas)*100;
                }
              ?>
              <p>% de reparações efetuadas hoje:</p>
              <div class="progress">
                  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="<?php echo $percentagem;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percentagem;?>%"><?php echo $percentagem; if ($percentagem!=0) {  echo "%";}?></div> <!--SE A PERCENTAGEM FOR DIFERENTE DE ZERO IMPRIME "%" -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container mb-5">

<?php
  include '../../headers/tecnico_header.php';
  include '../../core/connect.php';
  //include '../../../core/notificacao.php'; //verifica o nr_notificacoes por ler
  $id_utilizador=$_SESSION['id_utilizador'];
  //Vê a que fornecedor pertence o utilizador
  $sql="SELECT id_fornecedor, id_utilizador FROM fornecedor_utilizador WHERE id_utilizador='$id_utilizador'";
  $result=mysqli_query($conn,$sql);
  $row=mysqli_fetch_array($result);
  $id_fornecedor=$row['id_fornecedor'];
	?>
  
	<div class="container w-100">
  
  <h1 id="h1-centered">Lista de tarefas</h1>
  <p>Lista de todas as tarefas que tem para fazer. Clicando na fotografia tem acesso à mesma com maior detalhe.<br>Para concluir uma tarefa ou mais tarefas basta selecionar a(s) desejada(s) e clicar no botão "Concluído".</p>
    <div class="card">
      <form method="POST" id="form1" action="tarefa_concluida.php"> 
        <div class="card-header d-flex justify-content-start">
          <a class="btn btn-success" href="javascript:{}" onclick="checkDelete()"><i class="fa fa-check"></i> Concluído</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col"><input type="checkbox" id="checkAll"/></th>
                  <th scope="col">Data</th>
                  <th scope="col">Local</th>
                  <th scope="col">Manutenção</th>
                  <th scope="col">Prioridade</th>
                  <th scope="col">Descrição do cliente</th>
                  <th scope="col">Observações</th>
                  <th scope="col">Fotografia</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $sql =    "SELECT  prioridade, incidente.id_incidente, manutencao.id_manutencao as id_manutencao, tipo_manutencao.descricao as tipo_manutencao, incidente.id_zona, zona.morada as morada, zona.nome as entrada, manutencao.id_tipo_manutencao, manutencao.data_planeada as data_planeada, manutencao.observacoes as observacoes, incidente.descricao as descricao
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
                          AND manutencao.id_fornecedor='$id_fornecedor'
                          ORDER BY data_planeada ASC";

                $resultset = $conn->query($sql);
                if ($resultset->num_rows > 0) {
                while($rows = mysqli_fetch_assoc($resultset)) {
                ?>
              <tr> 
              <?php $id_incidente=$rows['id_incidente']; ?>
                  <td scope="row"><input type="checkbox" name="id_manutencao[]" value="<?php echo $rows['id_manutencao']; ?>" multiple></td>
                  <td scope="row"><?php echo utf8_encode($rows["data_planeada"]); ?></td>
                  <td scope="row"><?php echo utf8_encode($rows["entrada"]);?><br><?php echo utf8_encode($rows["morada"]);?></td>
                  <td scope="row"><?php echo utf8_encode($rows["tipo_manutencao"]); ?></td>
                  <td scope="row"><?php echo utf8_encode($rows["prioridade"]);?></td>
                  <td scope="row"><?php echo utf8_encode($rows["descricao"]);?></td>
                  <td scope="row"><?php echo utf8_encode($rows["observacoes"]);?></td>
                  <td scope="row">
  <?php
            $sql1="SELECT caminho FROM fotografia WHERE id_incidente=$id_incidente";
            $resultset1 = mysqli_query($conn, $sql1) or die("database error:". mysqli_error($conn));
  ?>
          
  <?php
            while($row = mysqli_fetch_assoc($resultset1)) {
  ?>
            <a href="\ProjetoFinal\uploads\fotografias\<?php echo utf8_encode($row['caminho']);?>"><img  name="fotos" style="width: 70px; height: 70px;" title="foto" src="\ProjetoFinal\uploads\fotografias\<?php echo utf8_encode($row['caminho']);?>">
      <?php } ?>
      </td>
                              
              </tr>
              <?php
                }}else{
              ?>
              <tr class="d-flex">
                  <td class="col-1"></td>
                  <td class="col-1"></td>
                  <td class="col-2"></td>
                  <td class="col-2">Não existem reparações!</td>
                  <td class="col-2"></td>
                  <td class="col-2"></td>
                  <td class="col-2"></td>
              </tr>
                  
              <?php
              }
              ?>
              </tbody>
            </table>
          </div>
        </div>
      </form>
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
</div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

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
</html>
