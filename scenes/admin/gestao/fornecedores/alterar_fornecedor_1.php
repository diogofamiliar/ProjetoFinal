<?php
include "../../../../core/connect.php";
mysqli_set_charset($conn, "utf8");
if(isset($_POST['cod_fornecedor'], $_POST['nome'], $_POST['email'], $_POST['morada'], $_POST['telemovel'])){
    $cod_fornecedor=$_POST['cod_fornecedor'];
    $nome=$_POST['nome'];
    $email=$_POST['email'];
    $morada=$_POST['morada'];
    $telemovel=$_POST['telemovel'];
    $sql="UPDATE fornecedor SET morada='$morada', nome='$nome', email='$email', telemovel='$telemovel' WHERE cod_fornecedor='$cod_fornecedor'"; //dá update ao email
    mysqli_query($conn, $sql);
    setcookie("fornecedor_alterado", "1", time()+(3), "/"); // o "/" disponibiliza a cookie para toda a plataforma
    header( "Location: gestao_fornecedores.php" );
}else{header( "Location: gestao_fornecedores.php" );}
?>