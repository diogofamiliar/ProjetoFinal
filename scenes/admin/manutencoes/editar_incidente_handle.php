<?php/*
session_start();
if(($_SESSION['nome_grupo'])=='admin' || ($_SESSION['nome_grupo'])=='master' && isset($_SESSION['id_utilizador'])){
}else header('Location: /ProjetoFinal/index.php');
*/?>

<?php
echo "entrei";
include "../../../core/connect.php";
mysqli_set_charset($conn, "utf8");

    if(isset($_POST['local'], $_POST['data_incidente'], $_POST['descricao'], $_POST['id_categoria_incidente'], $_POST['id_incidente'])){
        $id_categoria_incidente=$_POST['id_categoria_incidente'];
        $id_incidente=$_POST['id_incidente'];
        $data_incidente=$_POST['data_incidente'];
        $local=$_POST['local'];
        $descricao=$_POST['descricao'];
        $sql="UPDATE incidente SET local='$local', data_incidente='$data_incidente', descricao='$descricao', id_categoria_incidente='$id_categoria_incidente' WHERE id_incidente='$id_incidente'";
        if ($conn->query($sql) === TRUE) {
            echo "done";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }else { //caso nao tenha inserido descricao/observacao
        $id_categoria_incidente=$_POST['id_categoria_incidente'];
        $id_incidente=$_POST['id_incidente'];
        $data_incidente=$_POST['data_incidente'];
        $local=$_POST['local'];
        $descricao=$_POST['descricao'];
        $sql="UPDATE incidente SET local='$local', data_incidente='$data_incidente', id_categoria_incidente='$id_categoria_incidente' WHERE id_incidente='$id_incidente'";
        if ($conn->query($sql) === TRUE) {
            echo "done";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
?>
