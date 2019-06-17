<?php
include "../../../../core/connect.php";
mysqli_set_charset($conn, "utf8");

if (isset($_POST['id_fornecedor'])) {
    $id_fornecedor=$_POST['id_fornecedor'];
    foreach($id_fornecedor as $valor) {
        $sql="DELETE FROM fornecedor_utilizador WHERE id_fornecedor='$valor'";
        mysqli_query($conn,$sql);
        $sql2="UPDATE manutencao SET id_fornecedor=NULL WHERE id_fornecedor='$valor'";
        mysqli_query($conn,$sql2);
        $sql1="DELETE FROM fornecedor WHERE id_fornecedor='$valor'";
        mysqli_query($conn,$sql1);
    }
    setcookie("fornecedor_eliminado", "1", time()+(3), "/"); // o "/" disponibiliza a cookie para toda a plataforma
    header('Location: gestao_fornecedores.php');
} else {header('Location: gestao_fornecedores.php');}
?>