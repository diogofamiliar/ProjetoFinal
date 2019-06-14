<?php
include "../../core/connect.php";
/*
if(isset($_SESSION['nome_grupo'])=='admin' && isset($_SESSION['id_utilizador'])){ */
    if(isset($_POST['id_manutencao'])){
        $id_manutencao=$_POST['id_manutencao'];
        foreach($id_manutencao as $valor){
            echo $valor;
            $sql="UPDATE manutencao SET data_conclusao=now() WHERE id_manutencao='$valor'";
            $result=mysqli_query($conn,$sql);

        }
    setcookie("tarefa_concluida", "1", time()+(3), "/"); // o "/" disponibiliza a cookie para toda a plataforma
    header( "Location: tarefas.php" );
    }

/*}else header('Location: ../../../mensagens.php');    */
?>