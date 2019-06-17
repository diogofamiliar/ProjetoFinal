<?php /*
session_start();
if(isset($_SESSION['nome_grupo'])=='admin' && isset($_SESSION['id_utilizador'])){
}else header('Location: ../../index.php');*/
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

    <title>elVecino | Manutenções</title>
  </head>

<body>

	<?php
  include __DIR__.'/../../../headers/admin_header.php';
  include __DIR__.'/../../../core/connect.php';
	?>
  
<h1 id="h1-centered">Manutenções</h1>
<div class="container">
  <div class="row justify-content-center"> <!--justify-content-center alinha os conteudos ao meio sem os "escalar"  -->
    <div class="col-sm-4 my-2">
      <div class="card h-100">
        <a class="card-img-top mx-auto my-2" href="registo_incidente.php">
            <img class="object-fit-cover" src="../../../assets/admin/manutencoes/broken-door.png" alt="Card image cap">
        </a>
        <div class="card-body d-flex flex-column">
          <h4 class="card-title">Inserir Incidente</h4>
          <p class="card-text">Insira estragos ocorridos nos condomínios de forma a poder criar uma manutenção posteriormente.</p>
          <a href="registo_incidente.php" class="mt-auto btn btn-primary">Inserir</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4 my-2">
      <div class="card h-100">
        <a class="card-img-top mx-auto my-2" href="selecao_ocorrencias.php">
            <img class="object-fit-cover" src="../../../assets/admin/manutencoes/agendar.png" alt="Card image cap">
        </a>
        <div class="card-body d-flex flex-column">
          <h4 class="card-title">Inserir Manutenção</h4>
          <p class="card-text">Inicie o processo de manutenção ao agendar reparações.</p>
          <a href="selecao_ocorrencias.php" class="mt-auto btn btn-primary">Inserir</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4 my-2">
      <div class="card h-100">
        <a class="card-img-top mx-auto my-2" href="listagem.php">
            <img class="object-fit-cover" src="../../../assets/admin/manutencoes/repair.png" alt="Card image cap">
        </a>
        <div class="card-body d-flex flex-column">
            <h4 class="card-title">Lista de manutenções</h4>
            <p class="card-text"> Pode editar ou eliminar manutenções já inseridas no sistema.</p>
            <a href="listagem.php" class="mt-auto btn btn-primary">Entrar</a>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container">
<h1 id="h1-centered">Plano manutenções</h1>
<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Data planeada</th>
      <th>Data conclusão</th>
      <th>COD</th>
      <th>Entrada</th>
      <th>Manutenção</th>
      <th>Fornecedor</th>
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
            WHERE manutencao.data_planeada >= now() OR manutencao.data_planeada = CURDATE()
            ORDER BY manutencao.data_planeada, manutencao.data_conclusao ASC";
            $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
            while($rows = mysqli_fetch_assoc($resultset)) {
            ?>
          <tr class="<?php if (($rows['data_conclusao'] == "") and ($rows['data_planeada'] == $rows['hoje'])){ echo 'table-danger';}elseif(($rows['data_conclusao'] == null)){ echo '';}elseif(isset($rows['data_conclusao'])){ echo 'table-success';} ?>">
              <td><?php echo utf8_encode($rows["data_planeada"]); ?></td>
              <td><?php echo utf8_encode($rows["data_conclusao"]); ?></td>
              <td><?php echo utf8_encode($rows["tipo_reparacao"]); ?></td>
              <td><?php echo utf8_encode($rows["cod_condominio"]); ?></td>
              <td><?php echo utf8_encode($rows["zona"]); ?></td>
              <td><?php echo utf8_encode($rows["fornecedor"]); ?></td>
          </tr>
          <?php
          }
          ?>
  </tbody>
</table>
</div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>