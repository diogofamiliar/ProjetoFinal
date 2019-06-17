<?php
if (isset($_POST['id_zona'])) {
    $id_zona=$_POST['id_zona'];
} else {header( "Location: gestao_zonas.php" );}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../../../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../../../css/custom.css">

    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="https://i.imgur.com/SzFkxr6.png" />
    <title>Alterar zona</title>
</head>

<body>

	<?php
        include '../../../../headers/admin_header.php';
        include '../../../../core/connect.php';
	?>
  
    <h1 id="h1-centered">Alterar zona:</h1>
    <div class="container">
        <?php
                $sql="SELECT zona.id_zona as id_zona, condominio.id_condominio as id_condominio, condominio.cod_condominio as cod_condominio, zona.nome as entrada, zona.morada as morada FROM zona INNER JOIN condominio ON zona.id_condominio=condominio.id_condominio WHERE zona.id_zona='$id_zona'";
                $result=mysqli_query($conn,$sql);
                $row=mysqli_fetch_array($result);
        ?>
            <div class="card" style="margin-top: 20px;" id="myDIV">
                <div class="card-header">
                    <div>
                        <div>
                            <h5><?php echo utf8_encode($row['morada']);?> - <?php echo utf8_encode($row['entrada']);?></h5>
                        </div>
                    </div>    
                </div>
                <div class="card-body">
                    <form method="POST" action="alterar_zona_1.php">
                        <input type="hidden" name="id_zona" value="<?php echo utf8_encode($row['id_zona']);?>">
                        <div class="form-group row">
                            <div class="row col-8">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Morada:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="morada" class="form-control" id="inputTelemovel" value="<?php echo utf8_encode($row['morada']);?>" placeholder="<?php echo utf8_encode($row['nome']);?>"  required>
                                </div>
                            </div>                            
                            <div class="row col-sm-4">
                                <label for="inputCodCondominio" class="col-sm-4 col-form-label">Entrada:</label>
                                <input type="text" name="entrada" class="form-control col-sm-8" id="inputCodCondominio" value="<?php echo utf8_encode($row['entrada']);?>" placeholder="<?php echo utf8_encode($row['cod_condominio']);?>"  required>
                                
                            </div>
                        </div>
                        <div class="form-group" id="codCondominioSelector">
                                    <label class="col-sm-2 col-form-label">Condominio:</label>
                                    <div class="col-11">
                                        <input type="text" name="id_condominio" id="id_condominio" class="form-control" value="<?php echo utf8_encode($row['id_condominio']);?>-<?php echo utf8_encode($row['cod_condominio']);?>-<?php echo utf8_encode($row['entrada']);?>" placeholder="Selecione uma das opções"/ Required>  
                                        <div id="lista_condominios"></div>
                                    </div>
                        </div>   
                        <div class="form-group d-flex justify-content-center">
                        <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="../../../../js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){  
    $('#id_condominio').keyup(function(){
            var query = $(this).val();  
            if(query != '')  
            {  
                $.ajax({  
                    url:"../../../../core/fetch_results/fetch_condominio_1.php",
                    method:"POST",  
                    data:{query:query},  
                    success:function(data)  
                    {  
                        $('#lista_condominios').fadeIn();  
                        $('#lista_condominios').html(data);  
                    }  
                });  
            }  
    });  
    $(document).on('click', 'li', function(){  
            $('#id_condominio').val($(this).text());  
            $('#lista_condominios').fadeOut();  
    });  

    });
</script>


</body>
</html>