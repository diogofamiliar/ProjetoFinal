<?php
include "../../../core/connect.php";
mysqli_set_charset($conn, "utf8");

if (isset($_POST['id_condominio'], $_POST['cod_condominio'], $_POST['nome'], $_POST['morada'])) {
    $id_condominio=$_POST['id_condominio'];
    $cod_condominio=$_POST['cod_condominio'];
    $nome=$_POST['nome'];
    $morada=$_POST['morada'];
    $sql="UPDATE condominio SET cod_condominio='$cod_condominio', nome='$nome', morada='$morada' WHERE id_condominio='$id_condominio'";
    mysqli_query($conn,$sql);
} else {header('Location: gestao_condominios.php');}
setcookie("condominio_alterado", "1", time()+(3), "/"); // o "/" disponibiliza a cookie para toda a plataforma
header('Location: gestao_condominios.php');

?>
