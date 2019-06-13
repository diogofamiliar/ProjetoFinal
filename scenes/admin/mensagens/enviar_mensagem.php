<?php
include "../../../core/connect.php";
mysqli_set_charset($conn, "utf8");
session_start();
ob_start();
$remetente=$_SESSION['id_utilizador'];
echo $remetente;
if(isset($_POST['submit'], $_POST['tipo_destinatario'], $_POST['assunto'], $_POST['mensagem'])){
    $tipo_destinatario=$_POST['tipo_destinatario'];
    $assunto=$_POST['assunto'];
    $mensagem=$_POST['mensagem'];

    if($tipo_destinatario=="id_utilizador"){ //se for enviar para um utilizador apenas
        $destinatario=$_POST['input_utilizador'];
        $destinatario=substr($destinatario, 0, 1);
        $sql="INSERT INTO mensagem (remetente,assunto,texto,data_criacao) VALUES ('$remetente','$assunto','$mensagem',now())";
        if ($conn->query($sql) === TRUE) {
            $id_mensagem = $conn->insert_id;
            echo "id_mensagem=".$id_mensagem;
            $sql="INSERT INTO destinatario (id_utilizador,id_mensagem) VALUES ('$destinatario','$id_mensagem')";
            $conn->query($sql);
        }
    }elseif ($tipo_destinatario=="id_grupo") { // se for enviar para um grupo
        $destinatario=$_POST['input_grupo'];
        $destinatario=substr($destinatario, 0, 1);
        $sql="INSERT INTO mensagem (remetente,assunto,texto,data_criacao) VALUES ('$remetente','$assunto','$mensagem',now())";
        if ($conn->query($sql) === TRUE) {
            $id_mensagem = $conn->insert_id;
            echo "id_mensagem=".$id_mensagem;
            $query = "SELECT id_utilizador FROM utilizador_grupo WHERE id_grupo ='$destinatario'"; //seleciona todos os ids utilizadores daquele grupo
            $result = mysqli_query($conn,$query);
            while ($row = mysqli_fetch_array($result)) { //insere na tabela mensagem
                $destinatario=$row['id_utilizador'];
                $sql="INSERT INTO destinatario (id_utilizador,id_mensagem) VALUES ('$destinatario','$id_mensagem')";
                $conn->query($sql);
            }
        }
    }elseif ($tipo_destinatario=="id_condominio") {
        $destinatario=$_POST['input_condominio'];
        $destinatario=substr($destinatario, 0, 3);
        $destinatario=preg_replace('/[^0-9]/', '', $destinatario);
        $sql="INSERT INTO mensagem (remetente,assunto,texto,data_criacao) VALUES ('$remetente','$assunto','$mensagem',now())";
        if ($conn->query($sql) === TRUE) {
            $id_mensagem = $conn->insert_id;
            echo "id_mensagem=".$id_mensagem;
            $query = "SELECT id_utilizador FROM utilizador WHERE id_zona ='$destinatario'"; //seleciona todos os ids utilizadores daquele grupo
            $result = mysqli_query($conn,$query);
            while ($row = mysqli_fetch_array($result)) { //insere na tabela mensagem
                $destinatario=$row['id_utilizador'];
                $sql="INSERT INTO destinatario (id_utilizador,id_mensagem) VALUES ('$destinatario','$id_mensagem')";
                $conn->query($sql);
            }
        }
    }
}
setcookie("mensagem_enviada", "1", time()+(3), "/"); // o "/" disponibiliza a cookie para toda a plataforma
header('Location: mensagens.php');
?>