<?php
include "../../../../core/connect.php";
mysqli_set_charset($conn, "utf8");

if (isset($_POST['id_zona'])) {
    $id_condominio=$_POST['id_zona'];
    foreach($id_condominio as $valor) {
        $sql="DELETE FROM zona WHERE id_zona='$valor'";
        mysqli_query($conn,$sql);
    }
    setcookie("zona_eliminada", "1", time()+(3), "/"); // o "/" disponibiliza a cookie para toda a plataforma
    header('Location: gestao_zonas.php');
} else {header('Location: gestao_condominios.php');}
?>