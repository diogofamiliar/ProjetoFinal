<?php
include "../../../core/connect.php";
$id_incidente=$_POST['id_incidente'];
echo "chegui";
foreach($id_incidente as $valor){
    echo $valor;
    $sql="DELETE FROM incidente WHERE id_incidente='$valor'";
    $result=mysqli_query($conn,$sql);
}
setcookie("incidente_apagado", "1", time()+(3), "/"); // o "/" disponibiliza a cookie para toda a plataforma
header( "Location: incidentes.php" );


?>