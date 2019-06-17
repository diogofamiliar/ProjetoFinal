<?php
if (isset($_POST['id_contacto_util'])) {
    $id_contacto_util=$_POST['id_contacto_util'];
} else {header( "Location: gestao_contactos.php" );}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="https://i.imgur.com/SzFkxr6.png" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../../../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../../../css/custom.css">

    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>

    <title>Alterar Contacto</title>
  </head>

<body>

	<?php
        include '../../../../headers/admin_header.php';
        include '../../../../core/connect.php';
	?>
  
    <h1 id="h1-centered">Alterar Contacto:</h1>
    <div class="container">
        <?php
                $sql="SELECT contacto_util.id_contacto_util, contacto, tipo_de_contacto, condominio.nome 
              FROM contacto_util INNER JOIN condominio_contacto 
              ON condominio_contacto.id_contacto_util=contacto_util.id_contacto_util 
              INNER JOIN condominio ON condominio.id_condominio=condominio_contacto.id_condominio
              WHERE contacto_util.id_contacto_util='$id_contacto_util'";
                $result=mysqli_query($conn,$sql);
                $row=mysqli_fetch_array($result);
        ?>
            <div class="card" style="margin-top: 20px;" id="myDIV">
                <div class="card-header">
                    <div>
                        <div>
                            <h5><?php echo utf8_encode($row['tipo_de_contacto']);?> - <?php echo utf8_encode($row['nome']);?></h5>
                        </div>
                    </div>    
                </div>
                <div class="card-body">
                    <form method="POST" action="alterar_contacto_1.php">
                        <input type="hidden" name="contacto" value="<?php echo "$id_contacto_util"?>">
                        <div class="form-group row">
                            <div class="row col-sm-6">
                                <label for="inputTipoContacto" class="col-sm-2 col-form-label">Tipo de Contacto:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="tipo_contacto" class="form-control" id="inputTipoContacto" value="<?php echo utf8_encode($row['tipo_de_contacto']);?>" placeholder="<?php echo utf8_encode($row['tipo_de_contacto']);?>" required>
                                </div>
                            </div>
                            <div class="row col-sm-6">
                                <label for="inputContacto" class="col-sm-3 col-form-label">Contacto:</label>
                                <div class="col-sm-9">
                                    <input type="tel" name="contacto" class="form-control" id="inputContacto" value="<?php echo utf8_encode($row['contacto']);?>" placeholder="<?php echo utf8_encode($row['contacto']);?>"  required pattern="[0-9]{9}">
                                </div>
                            </div>
                        </div>              
                        <div class="form-group row">
                            <div class="form-group col-md-5">
                                <div class="form-row">
                                    <label class="col-sm-4 col-form-label">Condominio:</label>
                                    <div class="col-sm-8">
                                        <select id="gruposelector" name="id_condominio" class="form-control" required>
                                            <option value=""></option>
                                            <?php
                                            $query_1="SELECT id_condominio, nome, cod_condominio FROM condominio";
                                            $result = mysqli_query($conn, $query_1);
                                            while($row_result=mysqli_fetch_assoc($result)){ ?>
                                        <option value="<?php echo $row_result['id_condominio']; ?>"><?php echo utf8_encode($row_result['cod_condominio']); ?> - <?php echo utf8_encode($row_result['nome']); ?></option> <?php
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
    

</body>
</html>