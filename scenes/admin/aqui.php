<?php
include "../../core/connect.php";

    if (isset ($_POST['id_incidente'])) {
        $id_incidente=$_POST['id_incidente'];
        
    }else echo "nada";

    foreach ($id_incidente as $valor) {
        echo"<form action =''>";
        echo "<input type='hidden' name='id' value= '". $valor ."'/>";
        echo "<input name='submit' type='submit'  value='edit'>". "<hr>";
        echo "</form>";
    }

?>

