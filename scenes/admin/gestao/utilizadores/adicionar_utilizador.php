<?php
include "../../../../core/connect.php";
mysqli_set_charset($conn, "utf8");

if(isset($_POST['nome'], $_POST['email'], $_POST['telemovel'], $_POST['morada'])){
    $nome=$_POST['nome'];
    $entrada=$_POST['email'];
    $morada=$_POST['morada'];
    $telemovel=$_POST['telemovel'];
    $sql="INSERT INTO fornecedor (email, nome, morada, telemovel) VALUES ('$email','$nome','$morada','$telemovel')";
    mysqli_query($conn,$sql);
    setcookie("fornecedor_adicionado", "1", time()+(3), "/"); // o "/" disponibiliza a cookie para toda a plataforma
    header( "Location: gestao_fornecedores.php" );    
}else{header( "Location: gestao_fornecedores.php" );}
?>