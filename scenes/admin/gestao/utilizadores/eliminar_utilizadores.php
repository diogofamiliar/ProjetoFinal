<?php
include "../../../../core/connect.php";
mysqli_set_charset($conn, "utf8");

if (isset($_POST['id_utilizador'])) {
    $id_utilizador=$_POST['id_utilizador'];
    foreach($id_utilizador as $valor) {
        $sql="UPDATE utilizador SET ativo='0' WHERE id_utilizador='$valor'";
        mysqli_query($conn,$sql);
    }
    setcookie("utilizador_eliminado", "1", time()+(3), "/"); // o "/" disponibiliza a cookie para toda a plataforma
    header('Location: gestao_utilizadores.php');
} else {header('Location: gestao_utilizadores.php');}
?>