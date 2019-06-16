<?php
include "../../../../core/connect.php";
include "../../../../core/pw_handle.php";
mysqli_set_charset($conn, "utf8");

if(isset($_POST['nome'], $_POST['email'], $_POST['telemovel'], $_POST['data_nascimento'], $_POST['n_contribuinte'], $_POST['senha'], $_POST['id_grupo'])){
    $nome=$_POST['nome'];
    $email=$_POST['email'];
    $data_nascimento=$_POST['data_nascimento'];
    $telemovel=$_POST['telemovel'];
    $n_contribuinte=$_POST['n_contribuinte'];
    $senha=$_POST['senha'];
    $id_grupo=$_POST['id_grupo'];
    $senha=getHash($senha);
    //inserir utilizador
    $sql = "INSERT INTO utilizador (nome,data_criacao,data_nascimento,email,telemovel,senha,numero_contribuinte,ativo) VALUES ('$nome',now(),SUBDATE('$data_nascimento', INTERVAL 0 DAY),'$email','$telemovel','$senha','$n_contribuinte','1')";
    if (mysqli_query($conn, $sql)) {
        $last_id_utilizador = $conn->insert_id;
        echo "last_id_utilizador-> $last_id_utilizador;";
        echo "inserido utilizador";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    //inserir utilizador no grupo

    $sql = "INSERT INTO utilizador_grupo (id_utilizador,id_grupo) VALUES ('$last_id_utilizador','$id_grupo')";
    if (mysqli_query($conn, $sql)) {
        echo "inserido utilizador no grupo";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_query($conn,$sql);
    setcookie("utilizador_adicionado", "1", time()+(3), "/"); // o "/" disponibiliza a cookie para toda a plataforma
    header( "Location: gestao_utilizadores.php" );    
}else{header( "Location: gestao_utilizadores.php" );}
?>