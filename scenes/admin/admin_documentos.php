<?php
session_start();
if(isset($_SESSION['nome_grupo'])=='admin' || isset($_SESSION['nome_grupo'])=='master' && isset($_SESSION['id_utilizador'])){
}else header('Location: /ProjetoFinal/index.php');
?>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
<link rel="icon" href="https://i.imgur.com/SzFkxr6.png">
<?php
  include __DIR__.'/../../headers/admin_header.php';
    $id_utilizador=$_SESSION['id_utilizador'];  
    include __DIR__.'/../../core/connect.php';
    $query ="SELECT condominio.nome as nome_condominio, zona.nome AS nome_zona, utilizador_documento.data_criacao, documento.nome AS nome_documento, documento.descricao, documento.tipo_de_documento, documento.tamanho_ficheiro, documento.id_documento, utilizador.nome AS nome_autor FROM documento LEFT JOIN utilizador_documento ON documento.id_documento=utilizador_documento.id_documento LEFT JOIN zona ON zona.id_zona=documento.id_zona LEFT JOIN utilizador ON utilizador.id_utilizador=utilizador_documento.id_utilizador LEFT JOIN condominio ON condominio.id_condominio=zona.id_condominio";  
    $result = mysqli_query($conn, $query);

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

    <!-- datatables CSS -->
    <link rel="stylesheet" type="text/css" href="../../css/jquery.dataTables.min.css">

    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <link rel="shortcut icon" type="image/x-icon" href="https://i.imgur.com/SzFkxr6.png" />
    <title>elVecino | Documentos</title>
  </head>

  <body>

  
  <h1 id="h1-centered">Documentos</h1>
    <div class="container">
    <table id="data" class="table table-condensed table-hover table-striped bootgrid-table display" cellspacing="0" style="table-layout: fixed; width: 100%;">
      <thead>
        <tr>
          <th>ID</th>
          <th>Data</th>
          <th>Tipo de Documento</th>
          <th>Zona</th>
          <th>Nome</th>
          <th>Descrição</th>  
          <th>Autor</th>
          <th>Tamanho</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php
      if ($result->num_rows > 0) {
        while($rows = mysqli_fetch_assoc($result)) {
        ?>
      <tr>
          <td><?php echo utf8_encode($rows["id_documento"]); ?></td>
          <td><?php echo $rows["data_criacao"]; ?></td>
          <td><?php echo utf8_encode($rows["tipo_de_documento"]); ?></td>
          <td><?php echo utf8_encode($rows["nome_zona"]); ?> - <?php echo utf8_encode($rows["nome_condominio"]); ?></td>
          <td><a href="../pdfreader.php?id=<?php echo utf8_encode($rows["nome_documento"]);?>"><?php echo utf8_encode($rows["nome_documento"]); ?></td>
          <td><?php echo utf8_encode($rows["descricao"]); ?></td>
          <td><?php echo utf8_encode($rows["nome_autor"]); ?></td>
          <td><?php echo utf8_encode($rows["tamanho_ficheiro"]); ?></td>
          <td><a href="funcoes_doc.php?id=<?php echo $rows["id_documento"];?>&tipo_documento=<?php echo $rows["tipo_de_documento"];?>&zona=<?php echo $rows["nome_zona"];?>&descricao=<?php echo $rows["descricao"];?>&tipo=editar" class='far fa-edit' style='font-size:24px'></a><a href="funcoes_doc.php?id=<?php echo $rows["id_documento"];?>&tipo=apagar" class='far fa-trash-alt' style='font-size:24px'></a></td>
      </tr>
      <?php
      }
    }else{
      ?>
            <tr>
                <td></td> 
                <td></td> 
                <td></td>
                <td></td>
                <td>Não existem documentos!</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
                
            <?php
    }
      ?>
      </tbody>
    </table>
    <form action="adicionar_documento.php" method="Post">
    <button type="submit" class="btn btn-primary btn-lg">Adicionar Documento</button>
    </form>
  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <script> 
      $(document).ready( function () {
        
        $('#data').DataTable({
          "columnDefs": [
            { "width": "10px", "targets": 0 },
            { "width": "80px", "targets": 1 },
            { "width": "150px", "targets": 2 },
            { "width": "100px", "targets": 3 },
            { "width": "100px", "targets": 4 },
            { "width": "100px", "targets": 5 },
            { "width": "50px", "targets": 6 },
            { "width": "50px", "targets": 7 },
            { "width": "50px", "targets": 8 }
          ],
          select: true,
          "scrollX": true
        });
      });
    </script>
</body>
</html> 
