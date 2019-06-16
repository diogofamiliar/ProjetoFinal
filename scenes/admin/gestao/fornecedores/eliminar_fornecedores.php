<?php
include "../../../../core/connect.php";
mysqli_set_charset($conn, "utf8");

if (isset($_POST['cod_fornecedor'])) {
    $cod_fornecedor=$_POST['cod_fornecedor'];
    foreach($cod_fornecedor as $valor) {
        $sql="DELETE FROM fornecedor WHERE cod_fornecedor='$valor'";
        mysqli_query($conn,$sql);
    }
    setcookie("fornecedor_eliminado", "1", time()+(3), "/"); // o "/" disponibiliza a cookie para toda a plataforma
    header('Location: gestao_fornecedores.php');
} else {header('Location: gestao_fornecedores.php');}
?>