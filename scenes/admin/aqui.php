<?php
include "../../core/connect.php";

    if (isset ($_POST['id_ocorrencia'])) {
        $id_ocorrencia=$_POST['id_ocorrencia'];
        
    }else echo "nada";

    foreach ($id_ocorrencia as $valor) {
        echo"<form action =''>";
        echo "<input type='hidden' name='id' value= '". $valor ."'/>";
        echo "<input name='submit' type='submit'  value='edit'>". "<hr>";
        echo "</form>";
    }

?>

