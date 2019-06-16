<?php
include "../../../../core/connect.php";
mysqli_set_charset($conn, "utf8");


if (isset($_POST['cod_condominio'], $_POST['nome'], $_POST['morada'])) {
    $cod_condominio=$_POST['cod_condominio'];
    $nome=$_POST['nome'];
    $morada=$_POST['morada'];
    $sql="INSERT INTO condominio (cod_condominio, nome, morada) VALUES ('$cod_condominio','$nome','$morada')";
    mysqli_query($conn,$sql);
} else {header('Location: gestao_condominios.php');}
setcookie("condominio_adicionado", "1", time()+(3), "/"); // o "/" disponibiliza a cookie para toda a plataforma
header('Location: gestao_condominios.php');
?>