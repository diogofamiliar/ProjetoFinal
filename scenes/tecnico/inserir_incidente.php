<?php 
session_start();

include '../../core/connect.php';
mysqli_set_charset($conn, "utf8");
$id_utilizador=$_SESSION['id_utilizador'];
/*
ficheiro que pega no formulario do registo_incidente.php e insere os dados do form na tabela "ocorrencia da bd"
*/
if (isset ($_POST['local'], $_POST['id_categoria_incidente'], $_POST['id_zona'], $_POST['descricao'])) {
    $local = $_POST['local'];
    $id_categoria_incidente = $_POST['id_categoria_incidente'];
    $id_zona= $_POST['id_zona'];
    $id_zona=substr($id_zona, 0, 2);
    echo $id_zona;
    echo "--";
    $id_zona=preg_replace('/[^0-9]/', '', $id_zona);
    echo $id_zona;
    echo "--";
    $descricao= $_POST['descricao'];
    $sql = "INSERT INTO incidente (id_utilizador,id_zona,local,id_categoria_incidente,descricao,data_incidente) VALUES ('$id_utilizador','$id_zona','$local','$id_categoria_incidente','$descricao',now())";
    if (mysqli_query($conn, $sql)) {
        $last_id_incidente = $conn->insert_id;
        //echo "last_id_incidente-> $last_id_incidente;";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}elseif(isset ($_POST['local'], $_POST['id_categoria_incidente'], $_POST['id_zona'])){
    $local = $_POST['local'];
    $id_zona= $_POST['id_zona'];
    $id_zona=substr($id_zona, 0, 2);
    echo $id_zona;
    echo "--";
    $id_zona=preg_replace('/[^0-9]/', '', $id_zona);
    echo $id_zona;
    echo "--";
    $id_categoria_incidente = $_POST['id_categoria_incidente'];
    $sql = "INSERT INTO incidente (id_utilizador,id_zona,local,id_categoria_incidente,data_incidente) VALUES ('$id_utilizador','$id_zona','$local','$id_categoria_incidente',now())";
    if (mysqli_query($conn, $sql)) {
        $last_id_incidente = $conn->insert_id;
        //echo "last_id_incidente-> $last_id_incidente;";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
//upload das fotos
    include '../../upload.php';


mysqli_close($conn);
setcookie("registo_efetuado", "1", time()+(3), "/"); // o "/" disponibiliza a cookie para toda a plataforma
header( "Location: tecnico.php" );
?>