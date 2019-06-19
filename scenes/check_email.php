<?php
include "../core/connect.php";
if(isset($_POST["post_email"])){
 $email = mysqli_real_escape_string($conn, $_POST["post_email"]);
 $query = "SELECT * FROM utilizador WHERE email = '".$email."'";
 $result = mysqli_query($conn, $query);
 echo mysqli_num_rows($result);
}
?>