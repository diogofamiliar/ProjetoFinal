<?php
/* Verifica a que grupo de utilizadores (id_grupo) pertence o utilizador (id_utilizador) */
$sql="SELECT id_grupo FROM utilizador_grupo WHERE id_utilizador='$id_utilizador'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_array($result);
    $id_grupo=$row['id_grupo'];
    echo $id_grupo;
$sql="SELECT nome FROM grupo WHERE id_grupo='$id_grupo'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_array($result);
    $nome_grupo=$row['nome'];
    echo $nome_grupo;
    $_SESSION['nome_grupo']=$row['nome'];
    echo $_SESSION["camefrom"];
//Este if vai tratar de reencaminhar os utilizadores PRIMEIRO consoante o id_grupo a que pertencem
    if ($row['nome']=='inquilino'){ // 7 -> pq é o id do grupo inquilino
        if($_SESSION["camefrom"]=="scenes"){ //este if irá reencaminhar os utilizadores para a sua àrea de utilizador consoante o sítio de onde fizeram login
            session_start();
            ob_start();
            unset($_SESSION["camefrom"]);
            header('location: cliente/cliente.php', true);      
        }else{
            session_start();
            ob_start();
            unset($_SESSION["camefrom"]);
            header('location: scenes/cliente/cliente.php', true);   
           }
    }
    else if ($row['nome']=="tecnico"){ 
                   
    }else if ($row['nome']=="admin"){ 
        if($_SESSION["camefrom"]=="scenes"){ //este if irá reencaminhar os utilizadores para a sua àrea de utilizador consoante o sítio de onde fizeram login
            session_start();
            ob_start();
            header('location: admin/admin.php', true);      
        }else{
            session_start();
            ob_start();
            unset($_SESSION["camefrom"]);
            header('location: scenes/admin/admin.php', true);   
           }

    }else if ($row['nome']=="master"){ 
        if($_SESSION["camefrom"]=="scenes"){ //este if irá reencaminhar os utilizadores para a sua àrea de utilizador consoante o sítio de onde fizeram login
            session_start();
            ob_start();
            unset($_SESSION["camefrom"]);
            header('location: admin/admin.php', true);      
        }else{
            session_start();
            ob_start();
            unset($_SESSION["camefrom"]);
            header('location: scenes/admin/admin.php', true);   
           }

    }

?>