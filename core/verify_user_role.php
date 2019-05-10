<?php
include 'connect.php';
$id_utilizador=$_SESSION['id_utilizador'];

/*
Verifica a que grupo de utilizadores (id_grupo) pertence o utilizador (id_utilizador)
*/
$sql="SELECT id_grupo FROM utilizador_grupo WHERE id_utilizador='$id_utilizador'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_array($result);
    $_SESSION['id_group']=$row['id_grupo'];
    
//Este if vai tratar de reencaminhar os utilizadores PRIMEIRO consoante o id_grupo a que pertencem

  if ($row['id_grupo']=='7'){ // 7 -> pq é o id do grupo inquilino
        if($_SESSION['camefrom']=='registar_utilizador.php'){ //este if irá reencaminhar os utilizadores para a sua àrea de utilizador consoante o sítio de onde fizeram login
            session_start();
            ob_start();
            echo "entrei";
            header('location: cliente/cliente.php', true);      
        }else{
            session_start();
            ob_start();
            header('location: scenes/cliente/cliente.php', true);   
        }
    }
    else if ($row['id_grupo']=="tecnico"){ 
                   
    }else if ($row['id_grupo']=="admin"){ 

    }else if ($row['id_grupo']=="master"){ 

    }

?>