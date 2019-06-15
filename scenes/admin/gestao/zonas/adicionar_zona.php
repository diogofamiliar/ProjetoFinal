<?php
include "../../../../core/connect.php";
mysqli_set_charset($conn, "utf8");

if(isset($_POST['id_condominio'], $_POST['morada'], $_POST['nome'])){
    $id_condominio=$_POST['id_condominio'];
    $entrada=$_POST['nome']; echo $entrada;
    $morada=$_POST['morada']; echo $morada;
    $id_condominio = substr($id_condominio, 0, 2);
    $id_condominio=preg_replace('/[^0-9]/', '', $id_condominio); echo $id_condominio;
    $sql="INSERT INTO zona (id_condominio, nome, morada) VALUES ('$id_condominio','$entrada','$morada')";
    mysqli_query($conn,$sql);
    setcookie("zona_adicionada", "1", time()+(3), "/"); // o "/" disponibiliza a cookie para toda a plataforma
    header( "Location: gestao_zonas.php" );    
}else{header( "Location: gestao_zonas.php" );}
?>