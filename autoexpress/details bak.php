<!-- Backup file path name changed for python script -->
<?php
require_once 'admin/server/CarDAO.php';
require_once 'admin/server/DiagramDAO.php';

$v = new CarDAO();
$d = new DiagramDAO();

if(isset($_GET['carId']) && $v->isVehicleExist($_GET['carId'])) {
    $carId = $_GET['carId'];
    $currCar = $v->getCarById($carId); // current car [0]
    $numImg = $d->countAllPhotosByCarId($carId);
    $currCarImg = $d->getPhotosBy_CarId($carId);
} else {
    header('Location: index.php');
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Cars Compare</title>

    <link rel="apple-touch-icon" sizes="180x180" href="image/favicon_package_v0.16/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="image/favicon_package_v0.16/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="image/favicon_package_v0.16/favicon-16x16.png">
    <link rel="manifest" href="image/favicon_package_v0.16/site.webmanifest">
    <link rel="mask-icon" href="image/favicon_package_v0.16/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/print-preview.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <script type="text/javascript" src="jscharts.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div id="loading" class="loading">
  <img id="loading-image" src="/ProjCar/autoexpress/image/loader.gif" alt="Loading..." />
</div>
<div class="container_custom">
    <?php include 'template/header.php'; ?>
</div>
<div id="details-container">
    <div id="content_section">
        <div id="vehicle_title"><h3><?php echo $currCar[0]->getHeadingTitle(); ?></h3></div>
        <div style="clear: both" ></div>
        <div class="center_section" style="width: 100%; margin: auto;">
            <?php if($numImg > 0) { ?>
            <!-- Carousel slideshow code-->
               <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php $h = null; ?>
                    <?php for($i = 0; $i < $numImg; $i++) { ?>
                        <?php if($i == 0) { ?>
                            <?php $h .= '<li data-target="#carousel-example-generic" data-slide-to="'.$i.'" class="active"></li>'; ?>
                        <?php } else { ?>
                            <?php $h .= '<li data-target="#carousel-example-generic" data-slide-to="'.$i.'"></li>'; ?>
                        <?php } ?>
                    <?php } ?>
                    <?php echo $h; ?>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <?php $ht = null; ?>
                    <?php for($j = 0; $j < $numImg; $j++) { ?>
                        <?php if($j == 0) { ?>
                            <?php
                            $ht .= '<div class="item active">
                                        <img src="'.$currCarImg[$j]->getDiagram().'">
                                    </div>';
                            ?>
                        <?php } else { ?>
                            <?php
                            $ht .= '<div class="item">
                                        <img src="'.$currCarImg[$j]->getDiagram().'">
                                    </div>';
                            ?>
                        <?php } ?>
                    <?php } ?>
                    <?php echo $ht; ?>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="fa fa-arrow-left fa-arrow-position" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="fa fa-arrow-right fa-arrow-position" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <?php } else { ?>
            <div class="car-images" >
                <img src="https://placeholdit.co//i/272x150?text=Photo Unavailable&bg=111111">
            </div>
            <?php } ?>
            <br>
           
        </div>
        <?php 
            $str1=$currCar[0]->getMake();
            $str2=$currCar[0]->getModel();
            $str3=$currCar[0]->getYearMade();
            $str4=$str1.$str2.$str3.".html";
        ?>
        <button onclick="window.location='<?php echo $str4?>'" target="_blank" >VIEW Car in 360</button>
        <div class="center_section">
            <div id="vehicle_info">
                <div id="vehicle_info_left">
                    <style>p{font-size: 1.2rem;}</style>
                    <p>Price</p>
                    <p>Make</p>
                    <p>Model</p>
                    <p>Year</p>
                    <p>Mileage</p>
                    <p>Transmission</p>
                    <p>Drivetrain</p>
                    <p>Exterior Colour</p>
                    <p>Interior Colour</p>
                    <p>Category</p>
                    <p>Cylinders</p>
                    <p>Fuel type</p>
                    <p>Doors</p>
                    <p>Engine Capacity</p>
                    <p>Safety Rating</p>
                </div>
                <div id="vehicle_info_right">
                    <p class="price">Rs. <?php echo $currCar[0]->getPrice(); ?></p>
                    <p><?php echo $currCar[0]->getMake(); ?></p>
                    <p><?php echo $currCar[0]->getModel(); ?></p>
                    <p><?php echo $currCar[0]->getYearMade(); ?></p>
                    <p class="mileage"><?php echo $currCar[0]->getMileage(); ?> km/l</p>
                    <p><?php echo $currCar[0]->getTransmission(); ?></p>
                    <p><?php echo $currCar[0]->getDrivetrain(); ?></p>
                    <p><?php echo $currCar[0]->getExterior(); ?></p>
                    <p><?php echo $currCar[0]->getInterior(); ?></p>
                    <p><?php echo $currCar[0]->getCategory(); ?></p>
                    <p><?php echo $currCar[0]->getCylinder(); ?></p>
                    <p><?php echo $currCar[0]->getFuel(); ?></p>
                    <p><?php echo $currCar[0]->getDoors(); ?></p>
                    <p><?php echo $currCar[0]->getEngineCapacity(); ?> L</p>
                    <p><?php echo $currCar[0]->getSafety(); ?> </p>
                    <p style="display:none;" id='python_script'><?php //TODO : change this path according to the main.py file
                        echo shell_exec('/Users/*user_name*/anaconda3/bin/python.app /Applications/XAMPP/xamppfiles/htdocs/ProjCar/mainPro.py 10"'.$currCar[0]->getHeadingTitle().'"'); ?> </p>
                   </div>
                   <br>
                   
                   <!--  chart Code begins -->
                    <div id="piechart" style="background-color:#fff;"></div><br>
                <!-- Tweet display code begins -->
                        <button id="disp_tweets"> View Tweets!</button>
                        <iframe id="tweetdisp" src="http://localhost:5000" height="2000px" width="100%" style="display:none"></iframe><br>
                <div style="clear: both" ></div>
            </div>
        </div>
        <div style="clear: both" ></div>
    </div>
     <?php include 'template/footer.php'; ?>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- JS for Chart -->
<script type="text/javascript">
    var str=document.getElementById("python_script").innerHTML;

    var strArr=str.split(',');
    var intArr=[];
    for (var i = 0; i<8; i++) {
        intArr.push(parseFloat(strArr[i]));
    }
    //ye wala array
var myData = new Array(['Positive', intArr[1]], ['Weakly +ve', intArr[2]], ['Strongly +ve', intArr[3]], ['Negative', intArr[4]], ['Weakly -ve', intArr[5]], ['Strongly -ve', intArr[6]],['Neutral', intArr[7]]);

var myChart = new JSChart('piechart', 'bar');
myChart.setDataArray(myData);
myChart.colorize(['#3E90C9','#FCBB04','#FF7F50','#D42525','#32CD32','#FFAA00','#000000']);
myChart.setSize(1000, 400);
myChart.setIntervalEndY(80);
myChart.setTitle('Sentimental Analysis using tweets');
myChart.setTitleFontSize(20);
myChart.setGridOpacity(1);
myChart.setBarSpacingRatio(20);
myChart.setBarValuesColor('#7B7D77');
myChart.setBarBorderWidth(1);
myChart.setBarOpacity(1);
myChart.setAxisWidth(1);
myChart.setAxisNameX('', );
myChart.setAxisNameY('', );
myChart.draw();
// Draw the chart and set the chart values
</script>

<script language="javascript" type="text/javascript">
    window.onload = function(){ document.getElementById("loading").style.display = "none" }
</script>

<!-- Java script for displaying tweets -->
<script type="text/javascript">
    disp_tweets.onclick = function() {
        document.getElementById('tweetdisp').style.display = 'block';
    tweetdisp.contentWindow.postMessage(<?php echo "'".substr($currCar[0]->getHeadingTitle(),5)."'"; ?>, '*');
    return false;
    };
</script>
</body>
</html>
