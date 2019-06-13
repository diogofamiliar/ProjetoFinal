<?php
include '../../headers/cliente_header.php';
if(isset($_SESSION['nome_grupo'])=='inquilino' && isset($_SESSION['id_utilizador'])){
}else header('Location: ../../index.php');
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

        <title>elVecino</title> 
        <?php include "../../core/connect.php";?>

    </head>

    <body>
        <div class="container">
            <h2>Registo de Incidentes</h2>
            <form target="_self" action="inserir_ocorrencia.php" method="Post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="localizacao" class="font-weight-bold">Insira o local do incidente:</label>
                    <input type="text" class="form-control" id="localizacao" placeholder="Rés chão" name="local" Required>
                </div>
                <div class="form-group form-row">
                    <div class="form-group col-md-6">
                        <label for="id_categoria_incidente" class="font-weight-bold">Selecione o tipo de incidente:</label>
                        <select class="form-control" id="id_categoria_incidente" name="id_categoria_incidente" Required>
                            <option value=""></option>
                            <?php
                            $query="SELECT id_categoria_incidente,descricao FROM categoria_incidente";
                            $result = mysqli_query($conn, $query);
                            while($row_result=mysqli_fetch_assoc($result)){ ?>
                                <option value="<?php echo $row_result['id_categoria_incidente']; ?>"><?php echo $row_result['descricao']; ?></option> <?php
                            }
                                ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="descricao" class="font-weight-bold">Descrição:</label>
                    <textarea class="form-control" rows="3" id="descricao" name="descricao"></textarea>
                </div>
                <div class="form-group">
                    <label for="fotos" class="font-weight-bold">Introduza imagens:</label>
                    <input id="fotos" type="file" name="files[]" multiple>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        
        <!-- Optional JavaScript -->
        <script src="../../js/others_show_box.js"></script>
    </body>

</html>