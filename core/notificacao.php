<?php
include 'connect.php';
    $id_utilizador=$_SESSION['id_utilizador'];
    $sql = "SELECT COUNT(*) AS lida FROM destinatario WHERE id_utilizador='$id_utilizador' AND destinatario.lida IS NULL;";
    $resultset = $conn->query($sql);
    if ($resultset->num_rows > 0) {
        while($rows = mysqli_fetch_assoc($resultset)) {
            $_SESSION['nr_notificacao']=$rows['lida'];
        }
    }else{  
            $valor=0;
            $_SESSION['nr_notificacao']=$valor;
        }
    
?>