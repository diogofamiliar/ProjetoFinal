<?php
include "../../../../core/connect.php";
include "../../../../core/pw_handle.php";
mysqli_set_charset($conn, "utf8");

if(isset($_POST['tipo_contacto'], $_POST['contacto'], $_POST['id_condominio'])){
    $tipo_contacto=$_POST['tipo_contacto'];
    $contacto=$_POST['contacto'];
    $id_condominio=$_POST['id_condominio'];
    
    //inserir utilizador
    $sql = "INSERT INTO contacto_util (tipo_de_contacto,contacto,data_modificacao) VALUES ('$tipo_contacto','$contacto',now())";
    if (mysqli_query($conn, $sql)) {
        $last_id_contacto_util = $conn->insert_id;
        echo "last_id_contacto_util-> $last_id_contacto_util;";
        echo "inserido contacto";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    //inserir contacto relacionado com condominio

    $sql = "INSERT INTO condominio_contacto (id_contacto_util, id_condominio) VALUES ('$last_id_contacto_util','$id_condominio')";
    if (mysqli_query($conn, $sql)) {
        echo "inserido contacto no condominio";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_query($conn,$sql);
    setcookie("contacto_adicionado", "1", time()+(3), "/"); // o "/" disponibiliza a cookie para toda a plataforma
    header( "Location: gestao_contactos.php" );    
}else{header( "Location: gestao_contactos.php" );}
?>