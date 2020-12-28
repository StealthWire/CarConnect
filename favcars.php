<?php
require_once 'login/config.php';
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        echo "please log in first";
    exit;
}

$userid=$_SESSION["id"];

$sql='SELECT itemid FROM `favcars` WHERE userid='.$userid;
$result=mysqli_query($link,$sql);
$carids=Array();
while($row=mysqli_fetch_assoc($result)){
    $carids[]=$row['itemid'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FavCars</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 500px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2><span class="glyphicon glyphicon-star"></span> My Favourite cars</h2>
        <p>Your saved cars appear here. Click the button below to add. </p>
          <a href="autoexpress/index.php" class="btn btn-warning" target="_blank">+Add Cars</a> <br><br>
        <p>List of saved cars:</p>
        <?php
            foreach ($carids as $item) {
                    $sql='SELECT yearMade FROM `vehicle` WHERE vehicleId='.$item;
                    $year=mysqli_query($link,$sql);
                    $year=mysqli_fetch_assoc($year);
                    $sql='SELECT make FROM `vehicle` WHERE vehicleId='.$item;
                    $make=mysqli_query($link,$sql);
                    $make=mysqli_fetch_assoc($make);
                    $sql='SELECT model FROM `vehicle` WHERE vehicleId='.$item;
                    $model=mysqli_query($link,$sql);
                    $model=mysqli_fetch_assoc($model);
                    echo '<a href="/ProjCar/autoexpress/details.php?carId='.$item.'" target="_blank">';
                    echo $year['yearMade'].' '.$make['make'].' '.$model['model'];
                    echo '</a><br>';

            }

        ?>
            <br><br>
            <div class="form-group">
               <a href="del.php" class="btn btn-primary" onclick="function()"> Clear All</a>
            </div>

    </div>
</body>

 <script type="text/javascript">
    function(){
        if (top.location!= self.location) {
   top.location = self.location.href;
}
    }
    </script>
</html>
