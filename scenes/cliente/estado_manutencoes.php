<?php
include __DIR__.'/../../core/connect.php';
$query ="SELECT data_ocorrencia, local_ocorrencia, descricao FROM ocorrencia ORDER BY data_ocorrencia DESC";  
$result = mysqli_query($conn, $query);
/*
session_start();
if(isset($_SESSION['id_grupo'])=='7' || isset($_SESSION['id_utilizador'])){
  echo "grupo 7 c/ utilizador definido";
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>                      
    <script src="../../js/jquery.bootgrid.min.js"></script>            
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.css" />  
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/custom.css">

    <title>elVecino</title>
  </head>

<body>

	<?php
	    include __DIR__.'/../../headers/cliente_header.php';
	?>
  <div class="container">
        <div class="table-responsive">  
            <table id="dados_manutencoes" class="table table-striped table-bordered">  
            <thead>  
                <tr>  
                    <th data-column-id="data_ocorrencia">data ocorrencia</th>  
                    <th data-column-id="local_ocorrencia">local da ocorrencia</th>  
                    <th data-column-id="descricao">descricao</th>  
                </tr>  
            </thead>  
            <tbody>  
                <?php  
                    while($row = mysqli_fetch_array($result))  
                    {  
                        echo '  
                               <tr>  
                                    <td>'.$row["data_ocorrencia"].'</td>  
                                    <td>'.$row["local_ocorrencia"].'</td>  
                                    <td>'.$row["descricao"].'</td>  
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