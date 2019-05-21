<?php
include "connect.php";
session_start();

if (isset ($_POST['nome'], $_POST['email'], $_POST['pw'], $_POST['data_nascimento'], $_POST['telefone1'], $_POST['telefone2'])) {
    $id_utilizador=$_SESSION['id_utilizador'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $data_nascimento = $_POST['data_nascimento'];
    $pw =  $_POST['pw'];
    $telefone1 = $_POST['telefone1'];
    $telefone2 = $_POST['telefone2'];

    $sql = "SELECT senha FROM utilizador WHERE id_utilizador='$id_utilizador'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_array($result);
    $hash=$row['senha'];
    $compare=strcmp($pw,$hash); //compara o campo password do formulário com a hash guardada na bd
    echo "comparacao=".$compare;

    if ($compare==1) { //se a password for diferente
        //obter a nova hash
        $hash=password_hash($pw, PASSWORD_DEFAULT);
        $sql = "UPDATE utilizador SET nome='$nome', data_alteracao=now(), data_nascimento='$data_nascimento', email1='$email', telefone1='$telefone1', telefone2='$telefone2', senha='$hash' WHERE id_utilizador='$id_utilizador'";
        $result=mysqli_query($conn,$sql);
        header( "Location: ../scenes/cliente/cliente.php" );

    } else { //se a password for a mesma atualiza os outros campos menos a pass
        $sql = "UPDATE utilizador SET nome='$nome', data_alteracao=now(), data_nascimento='$data_nascimento', email1='$email', telefone1='$telefone1', telefone2='$telefone2' WHERE id_utilizador='$id_utilizador'";
        $result=mysqli_query($conn,$sql);

        
        setcookie("alter_user", "1", time()+(10), "/"); // o "/" disponibiliza a cookie para toda a plataforma
        header( "Location: ../scenes/cliente/cliente.php" );
            
    }

}else header( "Location: registar_utilizador.php" );

?>



