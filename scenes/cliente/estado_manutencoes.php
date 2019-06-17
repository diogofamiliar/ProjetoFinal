<?php
session_start();
include __DIR__.'/../../headers/cliente_header.php'; 
if(($_SESSION['nome_grupo'])=='cliente' || ($_SESSION['nome_grupo'])=='inquilino' && isset($_SESSION['id_utilizador'])){
    $id_utilizador=$_SESSION['id_utilizador'];
    include __DIR__.'/../../core/connect.php';
    $query ="SELECT incidente.data_incidente, incidente.local, incidente.descricao, incidente_manutencao.estado FROM incidente INNER JOIN incidente_manutencao ON incidente.id_incidente = incidente_manutencao.id_incidente WHERE incidente.id_utilizador='$id_utilizador' ORDER BY incidente.data_incidente DESC;";  
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
     
    <link rel="shortcut icon" type="image/x-icon" href="https://i.imgur.com/SzFkxr6.png" />
    <title>elVecino</title>
  </head>

<body>

	<?php ?>
    <div class="container">
        <div class="table-responsive">  
            <table id="dados_manutencoes" class="table table-striped table-bordered">  
            <thead>  
                <tr>  
                    <div class="col-sm-3"><th data-column-id="data_incidente">Data</th></div>
                    <div class="col-sm-3"><th data-column-id="local">Local</th></div>
                    <div class="col-sm-3"></div><th data-column-id="descricao">Descrição</th></div>
                    <div class="col-sm-3"></div><th data-column-id="estado">Estado</th></div>
                </tr>  
            </thead>  
            <tbody>  
                <?php
                    
                        while($row = mysqli_fetch_array($result)){
                            echo '  
                                <tr>  
                                        <td>'.$row["data_incidente"].'</td>  
                                        <td>'.$row["local"].'</td>  
                                        <td>'.$row["descricao"].'</td>  
                                        <td>'.utf8_encode($row["estado"]).'</td>  
                                </tr>  
                            ';  
                        }
                    
                ?>  
            </tbody>  
            </table>  
        </div>  
    </div>  
</body>  
</html>  
 <script>  
 $("#dados_manutencoes").bootgrid();  
 </script>  