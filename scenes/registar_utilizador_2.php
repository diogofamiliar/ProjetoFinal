<?php
include "../core/connect.php";
include "../core/pw_handle.php";

$telemovel = $_POST['telemovel'];
    if (isset ($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['id_zona'], $_POST['data_nascimento'], $_POST['telemovel'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $id_zona = $_POST['id_zona'];
        $data_nascimento = $_POST['data_nascimento'];
        $senha =  $_POST['senha'];
        $telemovel = $_POST['telemovel'];
    }//else header( "Location: registar_utilizador.php" );
    //adicionar tipo_utilizador

//transforma a pw introduzida numa pw criptografada
$senha=getHash($senha);
//inserir utilizador

$sql = "INSERT INTO utilizador (id_zona,nome,data_criacao,data_nascimento,email,telemovel,senha) VALUES ('$id_zona','$nome',now(),SUBDATE('$data_nascimento', INTERVAL 0 DAY),'$email','$telemovel','$senha')";
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
//header('Location: /ProjetoFinal/scenes/cliente/cliente.php');

?>

