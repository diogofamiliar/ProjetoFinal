<?php
include "../../core/connect.php";
if(isset($_POST['equipa'])){
    $equipa=$_POST['equipa'];
    $sql="INSERT INTO teste (equipa)VALUES ('$equipa')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
    
?>
