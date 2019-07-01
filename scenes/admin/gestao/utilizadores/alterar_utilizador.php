<?php
session_start();
if(isset($_SESSION['nome_grupo'])=='admin' || isset($_SESSION['nome_grupo'])=='master' && isset($_SESSION['id_utilizador'])){
}else header('Location: /ProjetoFinal/index.php');
?>
<?php
if (isset($_POST['id_utilizador'])) {
    $id_utilizador=$_POST['id_utilizador'];
} else {header( "Location: gestao_utilizadores.php" );}
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
    <title>Alterar Utilizador</title>
  </head>

<body>

	<?php
        include '../../../../headers/admin_header.php';
        include '../../../../core/connect.php';
	?>
  
    <h1 id="h1-centered">Alterar utilizador:</h1>
    <div class="container">
        <?php
                $sql="SELECT ativo, utilizador.email as email, utilizador.nome as nome, utilizador.telemovel as telemovel, utilizador_grupo.id_grupo as id_grupo, grupo.nome as grupo FROM utilizador LEFT JOIN utilizador_grupo ON utilizador.id_utilizador=utilizador_grupo.id_utilizador LEFT JOIN grupo ON grupo.id_grupo=utilizador_grupo.id_grupo WHERE utilizador.id_utilizador='$id_utilizador'";
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
                    <form method="POST" action="alterar_utilizador_1.php">
                        <input type="hidden" name="utilizador" value="<?php echo "$id_utilizador"?>">
                        <div class="form-group row">
                            <div class="row col-sm-6">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email:</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" class="form-control" id="inputEmail" value="<?php echo utf8_encode($row['email']);?>" placeholder="<?php echo utf8_encode($row['email']);?>" required>
                                </div>
                            </div>
                            <div class="row col-sm-6">
                                <label for="inputEmail" class="col-sm-3 col-form-label">Nr telemóvel:</label>
                                <div class="col-sm-9">
                                    <input type="tel" name="telemovel" class="form-control" id="inputTelemovel" value="<?php echo utf8_encode($row['telemovel']);?>" placeholder="<?php echo utf8_encode($row['telemovel']);?>"  required pattern="[0-9]{9}">
                                </div>
                            </div>
                        </div>              
                        <div class="form-group row">
                            <div class="form-group col-md-5">
                                <div class="form-row">
                                    <label class="col-sm-4 col-form-label">Tipo de Utilizador:</label>
                                    <div class="col-sm-8">
                                        <select id="gruposelector" name="id_grupo" class="form-control" required>
                                            <option value=""></option>
                                            <?php
                                            $query_1="SELECT id_grupo, nome FROM grupo";
                                            $result = mysqli_query($conn, $query_1);
                                            while($row_result=mysqli_fetch_assoc($result)){ ?>
                                        <option value="<?php echo $row_result['id_grupo']; ?>"><?php echo utf8_encode($row_result['nome']); ?></option> <?php
                                            }
                                                ?>
                                        </select>
                                    </div>
                                </div>
                            <div class="row col-sm-6">
                                <label for="ativo" >Ativo:</label>
                                    <select class="form-control" name="ativo">
                                        <option name="ativo" value="<?php echo $row['ativo'];?>"><?php if($row["ativo"]==NULL || $row["ativo"]=="0"){echo "Não";}else{echo "Sim";}?></option>
                                        <option value="1">Sim</option>
                                        <option value=NULL>Não</option>
                                    </select>
                            </div>    
                            </div>
                            <div class="form-group col-md-7">
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
                            <button class="btn btn-primary btn-lg" type="submit">Submeter alterações</button>
                        </div>
                    </form>
                </div>
            </div>
    </div>

    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $("#gruposelector").on("change", function() {
                if ($(this).val() === "3") {//COLOCAR O ID CORRESPONDENTE AO ID "OUTRO"
                    $("#fornecedorselector").show();
                    $("#fornecedor").prop('required',true);
                }
                else {
                    $("#fornecedorselector").hide();
                    $("#fornecedor").prop('required',false);
                }
            });
        });
    </script>

</body>
</html>