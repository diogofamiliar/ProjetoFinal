<?php
if (isset ($_POST['nome'], $_POST['email'], $_POST['pw'], $_POST['id_zona'], $_POST['data_nascimento'], $_POST['telefone1'], $_POST['telefone2'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $id_zona = $_POST['id_zona'];
    $data_nascimento = $_POST['data_nascimento'];
    $pw =  $_POST['pw'];
    $telefone1 = $_POST['telefone1'];
    $telefone2 = $_POST['telefone2'];
}else header( "Location: registar_utilizador.php" );

?>