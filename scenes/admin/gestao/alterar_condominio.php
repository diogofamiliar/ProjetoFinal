<?php
if (isset($_POST['condominio'])) {
    $id_condominio=$_POST['condominio'];
    echo $id_condominio;
} else {header( "Location: registar_utilizador.php" );}
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

    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>

    <title>elVecino | Alterar Utilizador</title>
  
    <script language="JavaScript" type="text/javascript">
      function checkDelete() {

        var confirmed = confirm("Pretende eliminar as mensagens?");
          if(confirmed){
            document.getElementById('form1').submit();
            return true;
      }else{
        swal("Aviso!", 
        "Selecione as notificações que pretende eliminar!", 
        "error");
      return false;}
      }
    </script>


</head>

<body>

	<?php
        include '../../../headers/admin_header.php';
        include '../../../core/connect.php';
	?>
  
    <h1 id="h1-centered">Alterar condomínio:</h1>
    <div class="container">
        <?php
                $sql="SELECT id_condominio, cod_condominio, nome, morada FROM condominio";
                $result=mysqli_query($conn,$sql);
                $row=mysqli_fetch_array($result);
                $cod_condominio=$row['cod_condominio'];
        ?>
            <div class="card" style="margin-top: 20px;" id="myDIV">
                <div class="card-header">
                    <div>
                        <div>
                            <h5><?php echo utf8_encode($row['cod_condominio']);?> - <?php echo utf8_encode($row['nome']);?></h5>
                        </div>
                    </div>    
                </div>
                <div class="card-body">
                    <form method="POST" id="form1" action="alterar_condominio_1.php">
                        <input type="hidden" name="id_condominio" value="<?php echo "$id_condominio"?>">
                        <div class="form-group row">
                            <div class="row col-sm-3">
                                <label for="inputCodCondominio" class="col-sm-5 col-form-label">Código:</label>
                                <input type="text" name="cod_condominio" class="form-control col-sm-7" id="inputCodCondominio" value="<?php echo utf8_encode($row['cod_condominio']);?>" placeholder="<?php echo utf8_encode($row['cod_condominio']);?>"  required>
                                
                            </div>
                            <div class="row col-sm-9">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Nome:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nome" class="form-control" id="inputTelemovel" value="<?php echo utf8_encode($row['nome']);?>" placeholder="<?php echo utf8_encode($row['nome']);?>"  required>
                                </div>
                            </div>
                        </div>              
                        <div class="form-group">
                                <div class="form-row">
                                    <label class="col-sm-4 col-form-label">Morada:</label>
                                    <input class="form-control" name="morada" type="text" placeholder="<?php echo utf8_encode($row['morada']);?>" value="<?php echo utf8_encode($row['morada']);?>" required>
                                </div>    
                            <div class="form-group col-md-7"">
                                <div class="form-row" id="fornecedorselector" style="display:none;">
                                    <label class="col-sm-3 col-form-label">Fornecedor:</label>
                                    <div class="col-sm-9">
                                        <select name="id_fornecedor" class="form-control" id="fornecedor" required>
                                            <option selected=""></option>
                                            <?php
                                            $query_1="SELECT id_fornecedor, nome FROM fornecedor";
                                            $result = mysqli_query($conn, $query_1);
                                            while($row_result=mysqli_fetch_assoc($result)){ ?>
                                        <option value="<?php echo $row_result['id_fornecedor']; ?>"><?php echo utf8_encode($row_result['nome']); ?></option> <?php
                                            }
                                                ?>
                                        </select>
                                    </div>
                                </div>    
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-primary btn-lg" href="javascript:{}" onclick="checkDelete()"><i class="fa fa-floppy-o"></i> Alterar</a>
                        </div>
                    </form>
                </div>
            </div>
    </div>

    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>