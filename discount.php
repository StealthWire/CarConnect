<?php session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
          body{ font: 14px sans-serif; }
        .wrapper{ width: 500px; padding: 20px; }
#container {
 background-color: #113f67;
 height: 100px;
 width: 400px;
 margin: 50px 150px;
 border: 3px dashed #FF851B;

 /*shadow*/
 -webkit-box-shadow: 10px 10px 10px #000;
 -moz-box-shadow: 10px 10px 10px #000;
 box-shadow: 10px 10px 10px #000;

 /*rounded corners*/
 -webkit-border-radius: 20px;
 -moz-border-radius: 20px;
 border-radius: 20px;
}

    </style>
</head>
<body>
    <div class="wrapper">
        <h2><span class="glyphicon glyphicon-qrcode"></span> Discount Code</h2>
        <p>Use the unique code below to avail discounted price at dealers. This code is unique for you and will be checked for authenticity.</p><br>

    <div id="container">
    	<h2 style="font-size: 80px;
 line-height: 40px;
 font-family: Helvetica, sans-serif;
 font-weight: bold;
 text-align: center;
 text-transform: uppercase;
 color: #FFFFFF;"><span class="glyphicon glyphicon-qrcode" style="font-size: 60px;
 line-height: 40px
 font-weight: bold;
 text-align: center;
 text-transform: uppercase;
 color: #000000;"></span> <?php echo substr(md5($_SESSION["username"]),0,5);?></h2>
    </div>
    </div>



</body>
</html>
