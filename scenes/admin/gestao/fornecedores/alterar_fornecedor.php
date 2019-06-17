<?php
<<<<<<< HEAD
session_start();
if(isset($_SESSION['nome_grupo'])=='admin' || isset($_SESSION['nome_grupo'])=='master' && isset($_SESSION['id_utilizador'])){
}else header('Location: /ProjetoFinal/index.php');
?>
<?php
if (isset($_POST['cod_fornecedor'])) {
    $cod_fornecedor=$_POST['cod_fornecedor'];
=======
if (isset($_POST['id_fornecedor'])) {
    $id_fornecedor=$_POST['id_fornecedor'];
>>>>>>> 5e276c70be62776675830feafba416430c0e182c
} else {header( "Location: gestao_fornecedor.php" );}
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
    <title>Alterar fornecedor</title>
</head>

<body>

	<?php
        include '../../../../headers/admin_header.php';
        include '../../../../core/connect.php';
	?>
  
    <h1 id="h1-centered">Alterar fornecedor:</h1>
    <div class="container col-12">
        <?php
                $sql="SELECT id_fornecedor, telemovel, email, nome, morada FROM fornecedor WHERE id_fornecedor='$id_fornecedor'";
                $result=mysqli_query($conn,$sql);
                $row=mysqli_fetch_array($result);
        ?>
            <div class="card" style="margin-top: 20px;" id="myDIV">
                <div class="card-header">
                    <div>
                        <div>
                            <h5><?php echo utf8_encode($row['nome']);?></h5>
                        </div>
                    </div>    
                </div>
                <div class="card-body">
                    <form method="POST" action="alterar_fornecedor_1.php">
                        <input type="hidden" name="id_fornecedor" value="<?php echo utf8_encode($row['id_fornecedor']);?>">
                        <div class="form-group">
                            <div class="">
                                <label for="inputEmail" class="">Nome:</label>
                                <div class="">
                                    <input type="text" name="nome" class="form-control" id="inputTelemovel" value="<?php echo utf8_encode($row['nome']);?>" placeholder="<?php echo utf8_encode($row['nome']);?>"  required>
                                </div>
                            </div>                            
                            <div class="form-group">
                                <label for="inputTel" class="col-sm-4 col-form-label">Telemóvel:</label>
                                <input type="tel" name="telemovel" class="form-control col-sm-6" id="inputCodCondominio" value="<?php echo utf8_encode($row['telemovel']);?>" placeholder="<?php echo utf8_encode($row['cod_condominio']);?>"  required pattern="[0-9]{9}">
                                
                            </div>
                        </div>
                        <div class="form-group" id="codCondominioSelector">
                            <div>
                                <label>Morada:</label>
                                <div>
                                    <input type="text" name="morada" class="form-control" id="inputTelemovel" value="<?php echo utf8_encode($row['morada']);?>" placeholder="<?php echo utf8_encode($row['morada']);?>"  required>
                                </div>
                            </div>
                            <div>
                                <label class="form-label">Email:</label>
                                <div>
                                    <input type="text" name="email" class="form-control" id="inputEmail" value="<?php echo utf8_encode($row['email']);?>" placeholder="<?php echo utf8_encode($row['email']);?>"  required>
                                </div>
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

</body>
</html>