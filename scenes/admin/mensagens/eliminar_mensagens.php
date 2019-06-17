<?php
session_start();
if(isset($_SESSION['nome_grupo'])=='admin' || isset($_SESSION['nome_grupo'])=='master' && isset($_SESSION['id_utilizador'])){
}else header('Location: /ProjetoFinal/index.php');
?>
<?php
include "../../../core/connect.php";
if(isset($_POST['id_mensagem'])){
    $id_mensagem=$_POST['id_mensagem'];
    foreach($id_mensagem as $valor){
        $sql="DELETE FROM destinatario WHERE id_mensagem='$valor'";
            $result=mysqli_query($conn,$sql);
        $sql="DELETE FROM mensagem WHERE id_mensagem='$valor'";
            $result=mysqli_query($conn,$sql);
    }
setcookie("mensagem_eliminada", "1", time()+(3), "/"); // o "/" disponibiliza a cookie para toda a plataforma
header( "Location: mensagens.php" );
}
?>