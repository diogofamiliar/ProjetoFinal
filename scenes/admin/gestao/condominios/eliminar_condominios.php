<?php
include "../../../../core/connect.php";
mysqli_set_charset($conn, "utf8");

if (isset($_POST['cod_condominio'])) {
    $id_condominio=$_POST['cod_condominio'];
    foreach($cod_condominio as $valor) {
        $sql="DELETE FROM condominio WHERE id_condominio='$valor'";
        mysqli_query($conn,$sql);
    }
    setcookie("condominio_eliminado", "1", time()+(3), "/"); // o "/" disponibiliza a cookie para toda a plataforma
    header('Location: gestao_condominios.php');
} else {header('Location: gestao_condominios.php');}
?>