<?php
include "../../../../core/connect.php";
mysqli_set_charset($conn, "utf8");
if (isset($_POST['utilizador'], $_POST['id_grupo'], $_POST['email'], $_POST['telemovel'])) {
    $email=$_POST['email'];
    $id_grupo=$_POST['id_grupo'];
    $telemovel=$_POST['telemovel'];
    $utilizador=$_POST['utilizador'];
    $ativo=$_POST['ativo'];
   
    $fornecedor=$_POST['id_fornecedor'];
    $sql="UPDATE utilizador SET email='$email', telemovel='$telemovel', ativo='$ativo' WHERE id_utilizador='$utilizador'"; //dá update ao email
    mysqli_query($conn, $sql);
    $sql="UPDATE utilizador_grupo SET id_grupo='$id_grupo', data_adicao=now() WHERE id_utilizador='$utilizador'"; //da update no grupo do utilizador
    mysqli_query($conn, $sql);
    $sql="INSERT INTO fornecedor_utilizador (id_fornecedor, id_utilizador) VALUES ('$fornecedor','$utilizador')"; //faz a ligaçao entre o user e o fornecedor
    mysqli_query($conn, $sql);
    $sql2="INSERT INTO utilizador_grupo (id_utilizador, id_grupo, data_adicao) VALUES ('$utilizador', '$id_grupo', now())";
    mysqli_query($conn, $sql2);
    
  
    setcookie("utilizador_alterado", "1", time()+(3), "/"); // o "/" disponibiliza a cookie para toda a plataforma
    header( "Location: gestao_utilizadores.php" );
    
} else {header( "Location: registar_utilizador.php" );}
?>