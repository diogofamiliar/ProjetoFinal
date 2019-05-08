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
        
        <?php include '../headers/header.php';?>
        <div class="container">
            <h1>Registo de novo utilizador</h1>
            <p>Por favor preencha este formulário de forma a criar uma conta.</p>
            <form target="_self" action="registar_utilizador.php" method="Post" enctype="multipart/form-data"> <!--  VERIFICAR ISTO-->
                <div class="form-group">
                    <label for="localizacao" class="font-weight-bold">Insira o nome completo:</label>
                    <input type="text" class="form-control" id="nome" placeholder="Tiago Oliveira Cardoso" name="nome_completo" Required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="font-weight-bold">Endereço email:</label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="...@email.com.pt" Required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" class="font-weight-bold">Password:</label>
                    <input type="password" class="form-control" id="password1" placeholder="Password" name="pw1" Required>
                    <small id="passHelp" class="form-text text-muted">A sua password deve conter um mínimo de 8 caracteres, incluíndo pelo menos: um algarismo e uma letra maiúscula.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" class="font-weight-bold">Repita a sua password:</label>
                    <input type="password" class="form-control" id="password2" placeholder="Password" name="pw1" Required>
                </div>
                <div class="form-group">
                        <label for="morada" class="font-weight-bold">Insira a sua morada:</label>
                        <input type="text" name="id_condominio" id="id_condominio" class="form-control" placeholder="Selecione uma das opções"/ Required>  
                        <div id="lista_condominios"></div> 
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Continuar</button>
            </div>
            </form>
        </div>
        
        
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="../js/jquery-3.4.1.js"></script>  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <!-- LIVE SEARCH BAR JavaScript -->
        <script src="../js/search_box.js"></script>

</html>
       
