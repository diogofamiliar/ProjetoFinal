<?php
include "../../../../core/connect.php";
mysqli_set_charset($conn, "utf8");
if (isset($_POST['id_contacto_util'], $_POST['tipo_contacto'], $_POST['contacto'], $_POST['id_condominio'])) {
    $id_contacto_util=$_POST['id_contacto_util'];
    $tipo_contacto=$_POST['tipo_contacto'];
    $contacto=$_POST['contacto'];
    $id_condominio=$_POST['id_condominio'];
   
    $sql="UPDATE contacto_util SET tipo_de_contacto='$tipo_contacto', data_modificacao=now(), contacto='$contacto' WHERE id_contacto_util='$id_contacto_util'";
    mysqli_query($conn, $sql);
    $sql="UPDATE condominio_contacto SET id_condominio='$id_condominio' WHERE id_contacto_util='$id_contacto_util'"; 
    mysqli_query($conn, $sql);
    
    setcookie("contacto_alterado", "1", time()+(3), "/"); // o "/" disponibiliza a cookie para toda a plataforma
    header( "Location: gestao_contactos.php" );
    
} else {header( "Location: registar_contacto.php" );}
?>