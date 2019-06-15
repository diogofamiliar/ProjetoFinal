<?php
include "connect.php";
session_start();

if (isset ($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['data_nascimento'], $_POST['telemovel'])) {
    $id_utilizador=$_SESSION['id_utilizador'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $data_nascimento = $_POST['data_nascimento'];
    $senha =  $_POST['senha'];
    $telemovel = $_POST['telemovel'];

    $sql = "SELECT senha FROM utilizador WHERE id_utilizador='$id_utilizador'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_array($result);
    $hash=$row['senha'];
    $compare=strcmp($senha,$hash); //compara o campo password do formulário com a hash guardada na bd
    echo "comparacao=".$compare;

    if ($compare==1) { //se a password for diferente
        //obter a nova hash
        $hash=password_hash($senha, PASSWORD_DEFAULT);
        $sql = "UPDATE utilizador SET nome='$nome', data_criacao=now(), data_nascimento='$data_nascimento', email='$email', telemovel='$telemovel', senha='$hash' WHERE id_utilizador='$id_utilizador'";
        $result=mysqli_query($conn,$sql);
        header( "Location: ../scenes/cliente/cliente.php" );

    } else { //se a password for a mesma atualiza os outros campos menos a pass
        $sql = "UPDATE utilizador SET nome='$nome', data_criacao=now(), data_nascimento='$data_nascimento', email='$email', telemovel='$telemovel' WHERE id_utilizador='$id_utilizador'";
        $result=mysqli_query($conn,$sql);

        
        setcookie("alter_user", "1", time()+(3), "/"); // o "/" disponibiliza a cookie para toda a plataforma
        header( "Location: ../scenes/cliente/cliente.php" );
            
    }

}else header( "Location: registar_utilizador.php" );

?>



