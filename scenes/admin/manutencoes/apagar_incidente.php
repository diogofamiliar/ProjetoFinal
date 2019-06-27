<?php

include "../../../core/connect.php";

$id_incidente=$_POST['id_incidente'];
foreach($id_incidente as $valor){ //para cada valor id_formulario do formulário incidentes.php
    
    $sql="SELECT id_incidente, caminho FROM fotografia WHERE id_incidente='$valor'"; //o incidente tem fotografias associadas?
    $result=mysqli_query($conn,$sql);
    if (($result->num_rows)!=0) {//se este incidente tiver correspondência na tabela fotografia
        while($row = mysqli_fetch_assoc($result)){ //enquanto houver correspondencia para uma fotografia o programa apaga do sistema o ficheiro correspondente a este incidente
            $ficheiro=utf8_encode($row["caminho"]);
            $path='../../../uploads/fotografias/'.$ficheiro;
            if(unlink($path)) echo "Deleted file ";//apaga o ficheiro do reportório        
        }
        $sql="DELETE FROM fotografia WHERE id_incidente='$valor'";  //apagar as fotografias do incidente
        $result=mysqli_query($conn,$sql);
        $sql="DELETE FROM incidente WHERE id_incidente='$valor'"; //apagar o incidente
        $result=mysqli_query($conn,$sql);
    } else {//se nao tiver fotografia associada
        $sql="DELETE FROM incidente WHERE id_incidente='$valor'";
        $result=mysqli_query($conn,$sql);
    }
    echo $valor;
}
setcookie("incidente_apagado", "1", time()+(3), "/"); // o "/" disponibiliza a cookie para toda a plataforma
header( "Location: incidentes.php" );

?>