<?php include '../headers/header.php';?>
        <?php
            if (isset ($_POST['nome_completo'], $_POST['email'], $_POST['id_condominio'], $_POST['hide'])) {
                $nome = $_POST['nome_completo'];
                $email = $_POST['email'];
                $id_condominio = $_POST['id_condominio'];
                $hide = $_POST['hide'];

                echo $id_condominio;
                echo $hide;
            }else header( "Location: registar_utilizador_1.php" );
        ?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/custom.css">
        <!-- datepicker CSS-->
        <link href="../css/datepicker.min.css" rel="stylesheet" type="text/css">
        <!-- autocomplete morada -->

       
        <title>elVecino</title> 
        <?php include "../core/connect.php";?>

    </head>

    <body>
        
        
        <div class="container">
            <h1>Já está quase!!</h1>
            <p>Por favor conclua o preenchimento deste formulário de forma a criar uma conta.</p>
            <form target="_self" action="registar_utilizador.php" method="Post" enctype="multipart/form-data"> <!--  VERIFICAR ISTO-->
                <div class="form-group">
                        <label for="data_nascimento" class="font-weight-bold">Data de nascimento:</label>
                        <input type="text" class="datepicker-here form-control" data-language='pt'data-position="bottom left" name="data_nascimento" name="data_nascimento" Required>
                </div>
                <div class="form-group">
                        <label for="morada" class="font-weight-bold">A sua morada:</label>
                        <input type="text" name="id_condominio" id="id_condominio" class="form-control" placeholder="<?php echo $id_condominio;?>" disabled/>  
                        <div id="lista_condominios"></div> 
                </div>
                <div class="form-group">
                        <label for="morada" class="font-weight-bold">Escolha o nº da sua porta:</label>
                        <select class="form-control" id="n_zona" name="tipo_incidente" Required>
                            <option value=""></option>
                            <?php
                            $query="SELECT id_zona, nome FROM zona WHERE id_condominio = '$hide'";
                            $result = mysqli_query($conn, $query);
                            while($row_result=mysqli_fetch_assoc($result)){ ?>
                                <option value="<?php echo $row_result['id_zona']; ?>"><?php echo $row_result['nome']; ?></option> <?php
                            }
                                ?>
                        </select>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Finalizar</button>
            </div>
            </form>
        </div>
        
        
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="../js/jquery-3.4.1.js"></script>  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <!-- Optional JavaScript -->
        <script src="../js/datepicker.min.js"></script>
        <script src="../js/i18n/datepicker.pt.js"></script>
        <script src="../js/i18n/datepicker.pt.js"></script>

</html>
       
