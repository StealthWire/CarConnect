<?php
require_once 'autoexpress/admin/server/CarDAO.php';
require_once 'autoexpress/admin/server/DiagramDAO.php';

$v = new CarDAO();
$d = new DiagramDAO();

if(isset($_GET['incar1']) && $v->isVehicleExist($_GET['incar1'])) {
    $carId = $_GET['incar1'];
    $carId2 = $_GET['incar2'];
    $currCar = $v->getCarById($carId); // current car [0]
    $numImg = $d->countAllPhotosByCarId($carId);
    $currCarImg = $d->getPhotosBy_CarId($carId);

    $com1='autoexpress/details-cmp.php?carId='.$carId;
    $com2='autoexpress/details-cmp.php?carId='.$carId2;
} else {
    header('Location: error.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible"
    content="ie-edge">
    <script defer src="https://use.fontawesome.com/releases/v5.5.0/js/all.js" integrity="sha384-GqVMZRt5Gn7tB9D9q7ONtcp4gtHIUEW/yG7h98J7IpE3kpi+srfFyyB/04OV6pG0" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
     <link href="https://fonts.googleapis.com/css?family=Raleway|Source+Sans+Pro" rel="stylesheet">
      <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="script.js"></script>
    <title>Cars Compare</title>
</head>
<body>
     <div class="wrapper">
        <!-- Navigation -->
       <nav class="main-nav" id="cssmenu">
            <ul>
                 <li><a href="index.html">Home</a></li>
                <li class="active"><a href="compare.php">Cars Compare</a></li>
                <li><a href="locate.html">Dealer Locator</a></li>
                <li><a href="login.php">Sign In</a></li>
                <li><a href="/ProjCar/autoexpress/admin/admin.php" target="_blank" >Admin Login</a></li>
                <li><a href="feedback.php">FeedBack</a></li>
            </ul>
        </nav>
         <div class="box" style="background: url(img/bg001.jpg); color:#FFFFFF;"> <h1> Comparing Cars : </h1></div>
        <section class="top-container-cmp2">
                  <iframe id="hi" src="<?php echo $com1 ?>" frameborder="0" height="4000px" width="49.8%" align="left" style="overflow: hidden;"></iframe>
                   <iframe src="<?php echo $com2 ?>" frameborder="0" height="4000px" width="49.8%" align="right" style="overflow:hidden;" ></iframe>
        </section>
    </div>

    </body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>
