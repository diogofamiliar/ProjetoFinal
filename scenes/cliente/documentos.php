<?php
session_start();
if(isset($_SESSION['id_grupo'])=='7' || isset($_SESSION['id_utilizador'])){
  $id_utilizador=$_SESSION['id_utilizador'];  
    include __DIR__.'/../../core/connect.php';
    $query ="SELECT zona.nome AS nome_zona, utilizador_documento.data_criacao, documento.nome AS nome_documento, documento.descricao, documento.tipo_de_documento, documento.tamanho_ficheiro, documento.id_documento, utilizador.nome AS nome_autor FROM documento LEFT JOIN utilizador_documento ON documento.id_documento=utilizador_documento.id_documento LEFT JOIN zona ON zona.id_zona=documento.id_zona LEFT JOIN utilizador ON utilizador.id_utilizador=utilizador_documento.id_utilizador";  
    $result = mysqli_query($conn, $query);
}else header('Location: ../../index.php');
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>                         
    <script src="../../js/jquery.bootgrid.min.js"></script>            
    <link rel="stylesheet" href="../../css/bootstrap_3_3_6.min.css" />  
    <link rel="stylesheet" href="../../css/jquery.bootgrid.min.css" />  

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/custom.css">

    <title>elVecino</title>
  </head>

  <body>

	<?php
	include __DIR__.'/../../headers/cliente_header.php';
	?>
  
  <h1 id="h1-centered"></h1>
	<div class="container" id="index_documentos">
    <h2 id="h1-centered">Documentos</h2>
  </div>
    <div class="container">
        <div class="table-responsive">  
            <table id="dados_documentos" class="table table-striped table-bordered">  
            <thead>  
                <tr>  
                    <div class="col-sm-3"><th data-column-id="id_documento">ID</th></div>
                    <div class="col-sm-3"><th data-column-id="data_criacao">Data</th></div>
                    <div class="col-sm-3"><th data-column-id="tipo_de_documento">Tipo de Documento</th></div>
                    <div class="col-sm-3"><th data-column-id="nome_zona">Zona</th></div>
                    <div class="col-sm-3"></div><th data-column-id="nome_documento">Nome</th></div>
                    <div class="col-sm-3"></div><th data-column-id="descricao">Descrição</th></div>
                    <div class="col-sm-3"></div><th data-column-id="nome_autor">Autor</th></div>
                    <div class="col-sm-3"></div><th data-column-id="tamanho_ficheiro">Tamanho</th></div>
                </tr>  
            </thead>  
            <tbody>  
                <?php
                    
                        while($row = mysqli_fetch_array($result)){
                            echo '  
                                <tr>  
                                        <td>'.$row["id_documento"].'</td>  
                                        <td>'.$row["data_criacao"].'</td>  
                                        <td>'.$row["tipo_de_documento"].'</td>  
                                        <td>'.utf8_encode($row["nome_zona"]).'</td>  
                                        <td>'.utf8_encode($row["nome_documento"]).'</td> 
                                        <td>'.utf8_encode($row["descricao"]).'</td> 
                                        <td>'.utf8_encode($row["nome_autor"]).'</td> 
                                        <td>'.utf8_encode($row["tamanho_ficheiro"]).'</td> 
                                </tr>  
                            ';  
                        }
                    
                ?>  
            </tbody>  
            </table>  
            <button type="submit" class="btn btn-primary btn-lg">Adicionar Documento</button>
        </div>  
    </div>  
    <?php
    
    
  ?>

</body>
</html>  
 <script>  
 $("#dados_documentos").bootgrid();  
 </script>  
