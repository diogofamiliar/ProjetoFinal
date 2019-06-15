<?php
include '../../../core/connect.php';
if (isset($_POST['utilizador'], $_POST['id_grupo'], $_POST['email'], $_POST['telemovel'])) {
    $email=$_POST['email'];
    $id_grupo=$_POST['id_grupo'];
    $telemovel=$_POST['telemovel'];
    $utilizador=$_POST['utilizador'];
    if (isset($_POST['id_fornecedor'])) { //se tiver atribuido um fornecedor a um utilizador
        $fornecedor=$_POST['id_fornecedor'];
        $sql="UPDATE utilizador SET email='$email', telemovel='$telemovel' WHERE id_utilizador='$utilizador'"; //dá update ao email
        mysqli_query($conn, $sql);
        $sql="UPDATE utilizador_grupo SET id_grupo='$id_grupo', data_adicao=now() WHERE id_utilizador='$utilizador'"; //da update no grupo do utilizador
        mysqli_query($conn, $sql);
        $sql="INSERT INTO fornecedor_utilizador (id_fornecedor, id_utilizador) VALUES ('$fornecedor','$utilizador')"; //faz a ligaçao entre o user e o fornecedor
        mysqli_query($conn, $sql);
    } else {
        $sql="UPDATE utilizador SET email='$email', telemovel='$telemovel' WHERE id_utilizador='$utilizador'";
        mysqli_query($conn, $sql);
        $sql="UPDATE utilizador_grupo SET id_grupo='$id_grupo', data_adicao=now() WHERE id_utilizador='$utilizador'";
        mysqli_query($conn, $sql);
    }

    setcookie("user_editado", "1", time()+(3), "/"); // o "/" disponibiliza a cookie para toda a plataforma
    header( "Location: gestao_utilizadores.php" );
    
} else {header( "Location: registar_utilizador.php" );}
?>