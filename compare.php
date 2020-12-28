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
     <link href="https://fonts.googleapis.com/css?family=Raleway|Source+Sans+Pro|Bitter:400,700" rel="stylesheet">
      <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="script.js"></script>
    <title>Compare Car</title>
</head>
<style>
   h2 {
 font-size: 25px;
 line-height: 40px;
 font-family: Bitter, sans-serif;
 font-weight: bold;
 text-align: center;
 color: #006BA6;
 text-shadow: 2px 8px 6px rgba(0,0,0,0.2), 0px -5px 35px rgba(255,255,255,0.3);
    }

#container {
 /*stitching*/
 outline: 1px dashed #34495E;
 outline-offset: -5px;

 background-color: #ffffff;
 height: 40px;
 width: 400px;
 margin: 20px auto;

 /*shadow*/
 -webkit-box-shadow: 2px 2px 2px #000;
 -moz-box-shadow: 2px 2px 2px #000;
 box-shadow: 2px 2px 2px #000;
}
    </style>
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

        <div class="box" style="background: url(/ProjCar/img/bg002.jpg);" id="cmp-bar">
         <p style="color: #FFFFFF;">To compare two cars use the <span style="color: orange">(+ Add to compare)</span> button. Add two cars and then click the button below. </p>
            <form type="get" action="/ProjCar/comparing.php"  style="color:#FFFFFF" >
                    <input type="hidden" name="incar1" id="incar1">
                    <input type="hidden" name="incar2" id="incar2">

                     <div id="container">
                        <h2 id="car1"></h2>
                    </div>

                     <div id="container">
                       <h2 id="car2"></h2>
                     </div>

                <button type="submit" class="btn-cmp">Compare</button>
            </form>


          </div>

   <section class="top-container-alt">
            <header class="showcase-cmp" style="margin-top: 0;">
               <iframe width="100%" height="1050px" src="autoexpress/index.php" frameborder="0"    ></iframe>
            </header>

        </section>

    </div>
    </body>
    <!-- Scripts -->
    <script type="text/javascript">
    function choose(str, idd) {
        if(document.getElementById('car1').innerHTML)
        {
            document.getElementById('car2').innerHTML=str;
            document.getElementById('incar2').value=idd;
        }
        else {
            document.getElementById('car1').innerHTML=str;
            document.getElementById('incar1').value=idd;
        }
    }

</script>
</html>
