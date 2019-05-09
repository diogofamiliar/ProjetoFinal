<?php

//session_start();
include 'connect.php';
$id_utilizador=$_SESSION['id_utilizador'];
//Entra a pw em string e sai a hash encryptada. algoritmo CRYPT_BLOWFISH \\ VARCHAR(255) recomended
$sql="SELECT id_grupo FROM utilizador_grupo WHERE id_utilizador='$id_utilizador'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_array($result);
    $_SESSION['id_group']=$row['id_grupo'];
    
    if ($row['id_grupo']=='7'){ // 7 -> pq é o id do grupo inquilino
        header ("location: ../scenes/cliente/incidentes.php");
    }
    else if ($row['user_group']=="user"){ 
                   // $_SESSION['role']=$row['role'];
                    //header ("location: user_page.php"); 
    }else if ($row['user_group']=="user")
    { 
                   // $_SESSION['role']=$row['role'];
                    //header ("location: user_page.php"); 
    }

?>