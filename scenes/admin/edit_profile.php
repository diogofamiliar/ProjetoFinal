<?php
//session_start();
include __DIR__.'/../../headers/admin_header.php';
//if(isset($_SESSION['nome_grupo'])=='inquilino' && isset($_SESSION['id_utilizador'])){
    include "../../core/connect.php";
    $id_utilizador=$_SESSION['id_utilizador'];
    $sql="SELECT nome, data_nascimento, email, telemovel, senha FROM utilizador WHERE id_utilizador='$id_utilizador'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_array($result);
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
    <!-- datepicker CSS-->
    <link href="../../css/datepicker.min.css" rel="stylesheet" type="text/css">

    <title>elVecino</title>
  </head>

<body>
  
	<div class="container py-3">
        <div class="row">
            <div class="mx-auto col-sm-7">
                <!-- form user info -->
                <div class="card">
                    <div class="card-header">
                        <h1 class="mb-0" id="h1-centered">Perfil</h1>
                    </div>
                    <div class="card-body">
                        <form class="form" role="form" autocomplete="off" method="post" action="../../core/alter_user.php">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Nome</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" value="<?php echo $row['nome']; ?>" name="nome" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                <div class="col-lg-9">
                                    <input type="email" class="form-control" name="email" id="" aria-describedby="emailHelpId" value="<?php echo $row['email']; ?>" required>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Telemóvel</label>
                                <div class="col-lg-9">
                                    <input type="text" name="telemovel" class="form-control" placeholder="Introduza um numero de 9 digitos" pattern="[0-9]{9}" value="<?php echo $row['telemovel']; ?>" required> <!-- required e numeros de 0-9 e de 9 digitos -->
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Data nascimento</label>
                                <div class="col-lg-9">
                                    <input type="text" class="datepicker-here form-control" data-language='pt'data-position="top left" name="data_nascimento" value="<?php echo $row['data_nascimento']; ?>" Required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Insira a password</label>
                                <div class="col-lg-9">
                                    <input type="password" class="form-control" id="password" placeholder="Password" name="senha" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onchange='check_pass();' value="<?php echo $row['senha']; ?>" Required>
                                    <small id="passHelp" class="form-text text-muted">A password deve conter um mínimo de 8 caracteres, incluíndo pelo menos: um algarismo, uma letra maiúscula e uma letra minúscula.</small>
                                </div>                                    
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Reintroduza a password</label>
                                <div class="col-lg-9">
                                    <input type="password" class="form-control" id="confirm_password" placeholder="Password" name="conv" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onchange='check_pass();' value="<?php echo $row['senha']; ?>" Required>
                                    <span id='message'></span>
                                </div>                                    
                            </div> 
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                <div class="col-lg-9">
                                    <input type="reset" class="btn btn-secondary" value="Cancel">
                                    <input type="submit" class="btn btn-primary" value="Save Changes">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Optional JavaScript -->
    <script src="../../js/datepicker.min.js"></script>
    <script src="../../js/i18n/datepicker.pt.js"></script>
    <!-- Compara as duas pw's introduzidas -->
    <script src="../../js/compare_pw.js"></script>
</body>