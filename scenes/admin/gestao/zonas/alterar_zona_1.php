<?php
include "../../../../core/connect.php";
mysqli_set_charset($conn, "utf8");
if(isset($_POST['id_zona'], $_POST['id_condominio'], $_POST['entrada'], $_POST['morada'])){
    $id_zona=$_POST['id_zona'];
    $id_condominio=$_POST['id_condominio'];
    $entrada=$_POST['entrada'];
    $morada=$_POST['morada']; echo $morada;
    $id_condominio = substr($id_condominio, 0, 2);
    $id_condominio=preg_replace('/[^0-9]/', '', $id_condominio);
    $sql="UPDATE zona SET morada='$morada', nome='$entrada', id_condominio='$id_condominio' WHERE id_zona='$id_zona'"; //dá update ao email
    mysqli_query($conn, $sql);
    setcookie("zona_alterada", "1", time()+(3), "/"); // o "/" disponibiliza a cookie para toda a plataforma
    header( "Location: gestao_zonas.php" );
}else{header( "Location: gestao_zonas.php" );}
?>