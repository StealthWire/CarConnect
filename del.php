<?php
require_once 'login/config.php';
session_start();
$userid=$_SESSION["id"];

$sql='DELETE FROM `favcars` WHERE userid='.$userid;

mysqli_query($link,$sql);
 header("location: /ProjCar/login.php");
?>
