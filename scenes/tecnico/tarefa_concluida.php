<?php
session_start();
if(($_SESSION['nome_grupo'])=='tecnico' && isset($_SESSION['id_utilizador'], $_POST['id_manutencao'])){
}else header('Location: /ProjetoFinal/index.php');
?>
<?php
include "../../core/connect.php";
mysqli_set_charset($conn, "utf8");
    if(isset($_POST['id_manutencao'])){
        $id_manutencao=$_POST['id_manutencao'];
        $remetente=$_SESSION['id_utilizador'];
        foreach($id_manutencao as $valor){
            echo $valor;
            $sql="UPDATE manutencao SET data_conclusao=now() WHERE id_manutencao='$valor'";
            $result=mysqli_query($conn,$sql);
            $sql1="UPDATE incidente_manutencao SET estado='concluida' WHERE id_manutencao='$valor'";
            $results=mysqli_query($conn,$sql1);
            //ver quem é o utilizador que criou este incidente
            $sql="SELECT incidente.id_utilizador as destinatario, incidente.data_incidente as data_incidente ,incidente.local as local_incidente, incidente_manutencao.id_incidente as id_incidente, incidente_manutencao.id_manutencao
                    FROM incidente
                    INNER JOIN incidente_manutencao ON incidente_manutencao.id_incidente = incidente.id_incidente
                    WHERE incidente_manutencao.id_manutencao='$valor'";
            $result= mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
            $dados_mensagem = mysqli_fetch_assoc($result);
            $destinatario=$dados_mensagem["destinatario"];
            $data_incidente=$dados_mensagem["data_incidente"];
            $local_incidente=$dados_mensagem["local_incidente"];
            /* DADOS DA MENSAGEM A ENVIAR PARA O SEU CLIENTE*/
            $assunto="Reparação concluída";
            $mensagem="O pedido de reparação submitido no dia ".$data_incidente." acerca dos problemas encontrados no local ".$local_incidente." encontram-se agora concluídos. Obrigado pela sua preferência!";
            echo $mensagem;
            $sql="INSERT INTO mensagem (remetente,assunto,texto,data_criacao) VALUES ('$remetente','$assunto','$mensagem',now())";
            if ($conn->query($sql) === TRUE) {
                $id_mensagem = $conn->insert_id;
                $sql="INSERT INTO destinatario (id_utilizador,id_mensagem) VALUES ('$destinatario','$id_mensagem')";
                $conn->query($sql);
            }
        }
    setcookie("tarefa_concluida", "1", time()+(3), "/"); // o "/" disponibiliza a cookie para toda a plataforma
    header( "Location: tarefas.php" );
    }
?>