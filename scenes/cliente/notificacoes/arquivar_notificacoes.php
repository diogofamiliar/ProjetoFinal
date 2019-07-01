<?php
session_start();
if(isset($_SESSION['nome_grupo'])=='inquilino' || isset($_SESSION['nome_grupo'])=='cliente' && isset($_SESSION['id_utilizador'])){
}else header('Location: /ProjetoFinal/index.php');
?>
<?php
include "../../../core/connect.php";
    if(isset($_POST['id_mensagem'])){
        $id_mensagem=$_POST['id_mensagem'];
        foreach($id_mensagem as $valor){
            echo $valor;
            $sql="UPDATE mensagem SET arquivada=2 WHERE id_mensagem='$valor'";
            $result=mysqli_query($conn,$sql);

        }
    setcookie("notificacoes_arquivadas", "1", time()+(3), "/"); // o "/" disponibiliza a cookie para toda a plataforma
    header( "Location: notificacoes.php" );
    }

?>