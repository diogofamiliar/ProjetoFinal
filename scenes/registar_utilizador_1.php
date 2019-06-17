
<?php   session_start();
        ob_start();     
        echo $_SESSION["camefrom"];
        include "../core/connect.php";

    if (isset ($_POST['nome_completo'], $_POST['email'], $_POST['id_condominio'], $_POST['senha'])) {
        $nome = $_POST['nome_completo'];
        $email = $_POST['email'];
        $nome_condominio = $_POST['id_condominio'];
        $senha = $_POST['senha'];
        $id_condominio = substr($nome_condominio, 0, 1);
        echo $id_condominio;
    }else header( "Location: registar_utilizador.php" );
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

        <link rel="shortcut icon" type="image/x-icon" href="https://i.imgur.com/SzFkxr6.png" />
        <title>elVecino</title> 

    </head>

    <body>
        
        <?php include '../headers/header.php';?>
        <div class="container">
            <h1>Já está quase!!!</h1>
            <p>Por favor conclua o preenchimento deste formulário de forma a criar uma conta.</p>
            <form method="post" action="registar_utilizador_2.php">
                <div class="form-group">
                        <label for="morada" class="font-weight-bold">A sua morada:</label>
                        <input type="text" name="nome_condominio" id="nome_condominio" class="form-control" placeholder="<?php echo $nome_condominio;?>" disabled/>  
                        <div id="lista_condominios"></div> 
                </div>
                <div class="form-group">
                        <label for="morada" class="font-weight-bold">Escolha o nº da sua porta:</label>
                        <select class="form-control" id="n_zona" name="id_zona" Required>
                            <option value=""></option>
                            <?php
                            $query="SELECT id_zona, nome FROM zona WHERE id_condominio = '$id_condominio'";
                            $result = mysqli_query($conn, $query);
                            while($row_result=mysqli_fetch_assoc($result)){ ?>
                                <option value="<?php echo $row_result['id_zona']; ?>"><?php echo utf8_encode($row_result['nome']);?></option> <?php
                            }
                                ?>
                        </select>
                </div>
                <div class="form-group">
                        <label for="data_nascimento" class="font-weight-bold">Data de nascimento:</label>
                        <input type="text" class="datepicker-here form-control" data-language='pt'data-position="top left" name="data_nascimento" Required>
                </div>
                <div class="form-group form-row">
                    <div class="form-group col-md-3">
                        <label for="telefone" class="font-weight-bold">Telemóvel:</label>
                        <input type="tel" name="telemovel" class="form-control" placeholder="Introduza um numero 9 digitos" required pattern="[0-9]{9}"> <!-- required numeros de 0-9 e de 9 digitos -->
                    </div>
                </div>
                <input type="hidden" name="nome" value="<?php echo $nome; ?>"> <!-- nome da pag anterior -->
                <input type="hidden" name="email" value="<?php echo $email; ?>"/> <!-- email da pag anterior -->
                <input type="hidden" name="senha" value="<?php echo $senha; ?>"/> <!-- pass da pag anterior -->
                
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
       
