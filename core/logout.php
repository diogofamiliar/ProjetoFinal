<?php
session_start();
session_destroy();
header('Location: ../scenes/index.php');
?>