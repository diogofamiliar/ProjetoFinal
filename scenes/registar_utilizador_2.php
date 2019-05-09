<?php
include "../core/connect.php";
include "../core/pw_handle.php";

    if (isset ($_POST['nome'], $_POST['email'], $_POST['pw'], $_POST['id_zona'], $_POST['data_nascimento'], $_POST['telefone1'], $_POST['telefone2'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $id_zona = $_POST['id_zona'];
        $data_nascimento = $_POST['data_nascimento'];
        $pw =  $_POST['pw'];
        $telefone1 = $_POST['telefone1'];
        $telefone2 = $_POST['telefone2'];
    }else header( "Location: registar_utilizador.php" );
    //adicionar tipo_utilizador

//transforma a pw introduzida numa pw criptografada
$pw=getHash($pw);
//inserir utilizador
$sql = "INSERT INTO utilizador (id_zona,nome,data_alteracao,data_nascimento,email1,telefone1,telefone2,senha) VALUES ('$id_zona','$nome',now(),'$data_nascimento','$email','$telefone1','$telefone2','$pw')";
if (mysqli_query($conn, $sql)) {
    $last_id_utilizador = $conn->insert_id;
    echo "last_id_utilizador-> $last_id_utilizador;";
    echo "inserido utilizador";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

//inserir utilizador no grupo

$sql = "INSERT INTO utilizador_grupo (id_utilizador,id_grupo) VALUES ('$last_id_utilizador','7')";
if (mysqli_query($conn, $sql)) {
    echo "inserido utilizador no grupo";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>

