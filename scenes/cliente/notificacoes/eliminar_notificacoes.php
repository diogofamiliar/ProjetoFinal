<?php
include "../../../core/connect.php";
/*
if(isset($_SESSION['nome_grupo'])=='admin' && isset($_SESSION['id_utilizador'])){ */
    if(isset($_POST['id_mensagem'])){
        $id_mensagem=$_POST['id_mensagem'];
        foreach($id_mensagem as $valor){
            echo $valor;
            $sql="DELETE FROM destinatario WHERE id_mensagem='$valor'";
            $result=mysqli_query($conn,$sql);

        }
    setcookie("notificacoes_eliminadas", "1", time()+(3), "/"); // o "/" disponibiliza a cookie para toda a plataforma
    header( "Location: notificacoes.php" );
    }

/*}else header('Location: ../../../mensagens.php');    */
?>