<?php
include "../../../../core/connect.php";
mysqli_set_charset($conn, "utf8");

if (isset($_POST['id_contacto_util'])) {
    $id_contacto_util=$_POST['id_contacto_util'];
    foreach($id_contacto_util as $valor) {
        $sql="DELETE FROM condominio_contacto WHERE id_contacto_util='$valor'";
        mysqli_query($conn,$sql);
        $sql1="DELETE FROM contacto_util WHERE id_contacto_util='$valor'";
        mysqli_query($conn,$sql1);
    }
    setcookie("contacto_eliminado", "1", time()+(3), "/"); // o "/" disponibiliza a cookie para toda a plataforma
    header('Location: gestao_contactos.php');
} else {header('Location: gestao_contactos.php');}
?>