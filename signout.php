<?php
Session_start();
Session_destroy();
header("location:index.php");
var_dump($_SESSION);
?>
