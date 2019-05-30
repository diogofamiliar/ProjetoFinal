<?php
//session_start();
//if(isset($_SESSION['nome_grupo'])=='admin' && isset($_SESSION['id_utilizador'])){
//}else header('Location: ../../index.php');
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

        <title>elVecino | Adicionar Documento</title> 
        <?php include "../../core/connect.php";?>

    </head>

    <body>
        <?php include '../../headers/admin_header.php';?>
        <div class="container">
            <h2>Adicionar Documento</h2>
            <form target="_self" action="#" method="Post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="tipo_documento" class="font-weight-bold">Tipo de documento:</label>
                    <br>
                    <select class="form-control" name="tipo_documento">
                        <option value="ata_reuniao">Ata de Reunião</option>
                        <option value="fatura">Fatura</option>
                        <option value="seguro">Seguro</option>
                        <option value="inspecoes">Inspeções</option>
                        <option value="manutencoes">Manutenções</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                        <label for="id_zona" class="font-weight-bold">Selecione a zona:</label>
                        <select class="form-control" id="id_zona" name="id_zona" Required>
                            <option value=""></option>
                            <?php
                            $query="SELECT id_zona,nome FROM zona";
                            $result = mysqli_query($conn, $query);
                            while($row_result=mysqli_fetch_assoc($result)){ ?>
                                <option value="<?php echo utf8_encode($row_result['id_zona']); ?>"><?php echo utf8_encode($row_result['nome']); ?></option> <?php
                            }
                                ?>
                        </select>
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