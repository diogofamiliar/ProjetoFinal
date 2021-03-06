<?php 
    session_start();
    ob_start();
        $_SESSION["camefrom"]="scenes";

        include __DIR__.'/../headers/header_scenes.php'; 
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
        <?php include "../core/connect.php";?>

    </head>

    <body>
        

        <div class="container">
            <h1>Registo de novo utilizador</h1>
            <p>Por favor preencha este formulário de forma a criar uma conta.</p>
            <form action="registar_utilizador_1.php" method="Post" enctype="multipart/form-data"> <!--  VERIFICAR ISTO-->
                <div class="form-group">
                    <label for="localizacao" class="font-weight-bold">Nome completo:</label>
                    <input type="text" class="form-control" id="nome" placeholder="Insira o seu nome completo" name="nome_completo" Required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="font-weight-bold">Endereço email:</label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Insira o seu email" Required>
                    <span id="availability"></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" class="font-weight-bold">Palavra-passe:</label>
                    <input type="password" class="form-control" id="password" placeholder="Inserir palavra-passe" name="senha" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onchange='check_pass();' Required>
                    <small id="passHelp" class="form-text text-muted">A palavra-passe deve conter um mínimo de 8 caracteres, incluíndo pelo menos: um algarismo, uma letra maiúscula e uma letra minúscula.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" class="font-weight-bold">Confirme a palavra-passe:</label>
                    <input type="password" class="form-control" id="confirm_password" placeholder="Confirmar palavra-passe" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onchange='check_pass();' Required>
                    <span id='message'></span>
                </div>
                <div class="form-group">
                        <label for="morada" class="font-weight-bold">Insira a sua morada:</label>
                        <input type="text" name="id_condominio" id="id_condominio" class="form-control" placeholder="Selecione uma das opções"/ Required>  
                        <div id="lista_condominios"></div> 
                </div>
                <button type="submit" name="submit" id="register" class="btn btn-primary">Continuar</button>
            </form>
        </div>
        
        
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="../js/jquery-3.4.1.js"></script>  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <!-- LIVE SEARCH BAR JavaScript -->
        <script type="text/javascript" src="../js/search_box.js" charset="utf-8"></script>
        <!-- Compara as duas pw's introduzidas -->
        <script src="../js/compare_pw.js"></script>

<script>  
 $(document).ready(function(){  
   $('#email').blur(function(){

     var email = $(this).val();

     $.ajax({
      url:'check_email.php',
      method:"POST",
      data:{post_email:email},
      success:function(data)
      {
       if(data != '0')
       {
        $('#availability').html('<span class="text-danger">Endereço de email já utilizado</span>');
        $('#register').attr("disabled", true);
       }
       else
       {
        $('#availability').html('<span class="text-success">Endereço de email disponível</span>');
        $('#register').attr("disabled", false);
       }
      }
     })

  });
 });  
</script>
<script>
function check_pass() {
    if (document.getElementById('password').value == document.getElementById('confirm_password').value) {
            document.getElementById('register').disabled = false;
            document.getElementById('message').innerHTML = '';
        } else {
            document.getElementById('register').disabled = true;
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'As passwords introduzidas não são iguais';
        }
    }
    </script>
       
