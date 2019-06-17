<?php
include "../../../core/connect.php";
$id_incidente=$_POST['id_incidente'];
foreach($id_incidente as $valor){
    echo $valor;
    $sql="DELETE FROM incidente WHERE id_incidente='$valor'";
    $result=mysqli_query($conn,$sql);
}
header( "Location: selecao_ocorrencias.php" );


?>