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
//Este if vai tratar de reencaminhar os utilizadores PRIMEIRO consoante o id_grupo a que pertencem
    if ($nome_grupo=='inquilino'){ // 7 -> pq é o id do grupo inquilino
        header('location: /ProjetoFinal/scenes/cliente/cliente.php', true);
    }
    else if ($row['nome']=="tecnico"){
        header('location: /ProjetoFinal/scenes/tecnico/tecnico.php', true);
                   
    }else if ($row['nome']=="cliente"){
        header('location: /ProjetoFinal/scenes/cliente/cliente.php', true);
                   
    }else if ($row['nome']=="admin"){ 
        header('location: /ProjetoFinal/scenes/admin/admin.php', true);

    }else if ($row['nome']=="master"){ 
        header('location: /ProjetoFinal/scenes/admin/admin.php', true);

    }

?>