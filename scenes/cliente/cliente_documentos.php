<?php
session_start();
	include __DIR__.'/../../headers/cliente_header.php';

if($_SESSION['nome_grupo']=='cliente' && $_SESSION['id_utilizador']){
  $id_utilizador=$_SESSION['id_utilizador'];  
    include __DIR__.'/../../core/connect.php';
   
    $id_utilizador=$_SESSION['id_utilizador'];
    //seleciona a zona a que esta associado o utilizador
    $zona= "SELECT id_zona FROM utilizador WHERE utilizador.id_utilizador=$id_utilizador";
    $resultado = mysqli_query($conn, $zona);
    $row = mysqli_fetch_assoc($resultado);
    // query que mostra os documentos que estao relacionados com a zona do utilizador
    $query ="SELECT zona.nome AS nome_zona, utilizador_documento.data_criacao, documento.nome AS nome_documento, documento.descricao, documento.tipo_de_documento, documento.tamanho_ficheiro, documento.id_documento, utilizador.nome AS nome_autor FROM documento LEFT JOIN utilizador_documento ON documento.id_documento=utilizador_documento.id_documento LEFT JOIN zona ON zona.id_zona=documento.id_zona LEFT JOIN utilizador ON utilizador.id_utilizador=utilizador_documento.id_utilizador WHERE documento.id_zona=$row[id_zona]";  
    $result = mysqli_query($conn, $query);
}else header('Location: /ProjetoFinal/scenes/cliente/cliente.php');
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

    <title>elVecino | Documentos</title>
  </head>

  <body>

	
  

  <div class="container">
    <?php include "../../assets/breadcrumbers/bc_cliente_documentos.php" ?>  
    <h1 id="h1-centered">Documentos</h1>  
    <p>Lista de todos os documentos relativos à sua zona e condomínio.</p>    
    <table id="data" class="table table-condensed table-hover table-striped bootgrid-table display" cellspacing="0" style="table-layout: fixed; width: 100%;">
      <thead>
        <tr>
         
          <th>Data</th>
          <th>Tipo de Documento</th>
          <th>Zona</th>
          <th>Nome</th>
          <th>Descrição</th>  
       
        </tr>
      </thead>
      <tbody>
        <?php
      if ($result->num_rows > 0) {
        while($rows = mysqli_fetch_assoc($result)) {
        ?>
      <tr>
        
          <td><?php echo utf8_encode($rows["data_criacao"]); ?></td>
          <td><?php echo utf8_encode($rows["tipo_de_documento"]); ?></td>
          <td><?php echo utf8_encode($rows["nome_zona"]); ?></td>
          <td><a href="../pdfreader.php?id=<?php echo utf8_encode($rows["nome_documento"]);?>"><?php echo utf8_encode($rows["nome_documento"]); ?></td>
          <td><?php echo utf8_encode($rows["descricao"]); ?></td>
         
      </tr>
      <?php
      }
    }else{
      ?>
            <tr>
                <td></td>
                <td></td>
                <td>Não existem documentos!</td>
                <td></td>
                <td></td>
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
    
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready( function () {
        
        $('#data').DataTable({
          "columnDefs": [
           
            { "width": "80px", "targets": 0 },
            { "width": "150px", "targets": 1 },
            { "width": "100px", "targets": 2 },
            { "width": "100px", "targets": 3 },
            { "width": "100px", "targets": 4 }
          
          ],
          select: true,
          "scrollX": true
        });
      });
    </script>
</body>
</html> 