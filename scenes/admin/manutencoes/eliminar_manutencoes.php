<?php
include "../../../core/connect.php";
mysqli_set_charset($conn, "utf8");

if (isset($_POST['id_manutencao'])) {
    $id_manutencao=$_POST['id_manutencao'];
    echo $id_manutencao;
    foreach($id_manutencao as $valor) {
        $sql="DELETE FROM incidente_manutencao WHERE id_manutencao='$valor'";
        mysqli_query($conn,$sql);
        $sql="DELETE FROM manutencao WHERE id_manutencao='$valor'";
        mysqli_query($conn,$sql);
    }
    setcookie("manutencao_eliminada", "1", time()+(3), "/"); // o "/" disponibiliza a cookie para toda a plataforma
    header('Location: listagem.php');
} else {header('Location: listagem.php');}
?>