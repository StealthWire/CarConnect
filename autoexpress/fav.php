<?php

require_once 'config.php';
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    	echo '<span style="color:red;float:center;font-family:sans-serif;font-size:3em;">Error:</span>';
        echo '<span style="color:black;float:center;font-family:sans-serif;font-size:3em;">Please SIGN IN first.</span>';
    exit;
}


    $userid=$_SESSION["id"];
    $car=$_GET["carid"];
    $sql ="INSERT INTO favcars (userid, itemid) VALUES (".$userid.",".$car.")";
    $result = mysqli_query($link,$sql);
 	 header("location: /ProjCar/autoexpress/favcar-index.php");
?>
