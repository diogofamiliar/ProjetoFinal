<?php
session_start();
if(isset($_SESSION['id_grupo'])=='7' || isset($_SESSION['id_utilizador'])){
    $id_utilizador=$_SESSION['id_utilizador'];
    include __DIR__.'/../../core/connect.php';
    $query ="SELECT data_ocorrencia, local_ocorrencia, descricao FROM ocorrencia WHERE id_utilizador='$id_utilizador' ORDER BY data_ocorrencia DESC";  
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
  <div class="container">
        <div class="table-responsive">  
            <table id="dados_manutencoes" class="table table-striped table-bordered">  
            <thead>  
                <tr>  
                    <div class="col-sm-4"><th data-column-id="data_ocorrencia">Data</th></div>
                    <div class="col-sm-4"><th data-column-id="local_ocorrencia">Local</th></div>
                    <div class="col-sm-4"></div><th data-column-id="descricao">Descrição</th></div>
                </tr>  
            </thead>  
            <tbody>  
                <?php  
                    while($row = mysqli_fetch_array($result))  
                    {   $date=$row["data_ocorrencia"];
                        $new_date_format = date('Y-m-d H:i:s', $date);
                        echo '  
                               <tr>  
                                    <td>'.$new_date_format.'</td>  
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