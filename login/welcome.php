<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
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
    <link rel="stylesheet" href="/ProjCar/style.css">
     <link href="https://fonts.googleapis.com/css?family=Raleway|Source+Sans+Pro" rel="stylesheet">
      <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="/ProjCar/script.js"></script>
    <title>Sign In</title>
</head>
<body>
    <div class="wrapper">
        <!-- Navigation -->
        <nav class="main-nav" id="cssmenu">
            <ul>
                <li><a href="/ProjCar/index.html">Home</a></li>
                <li><a href="/ProjCar/compare.php">Cars Compare</a></li>
                <li><a href="/ProjCar/locate.html">Dealer Locator</a></li>
                <li><a href="/ProjCar/login.php" style="background-color: #303F9F; color: #FFFFFF">My account</a></li>
                <li><a href="/ProjCar/autoexpress/admin/admin.php" target="_blank">Admin Login</a></li>
                <li><a href="/ProjCar/feedback.php">FeedBack</a></li>
            </ul>
        </nav>

        <div class="box" style="background: url(/ProjCar/img/bg002.jpg);">
              <h1 style="color:#FFFFFF;">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome.</h1>
          </div>

            <section class="top-container-cmp2">
                     <div class="vertical-menu" id="myDIV">
                              <a href="/ProjCar/login/userinfo.php" target="frame" class="a" id="detail">Personal Details</a>
                              <a href="/ProjCar/favcars.php" id="fav" target="frame" class="a">My favourite cars</a>
                              <a href="/ProjCar/discount.php" id="dsc-code" target="frame" class="a">Discount Code</a>
                              <a href="/ProjCar/callback.php" id="callback" target="frame" class="a">Request a callback</a>
                              <br><br>
                               <a href="reset-password.php" target="frame">Reset Password</a>
                             <a href="logout.php" class="logout">Sign Out</a>
                    </div>

                    <iframe name="frame" id="frame" style="display:inline-block;" height="400px" width="85%" align="right"></iframe>

         </section>


    </div>
    </body>

    <script type="text/javascript">

        if (self !== top)
            top.location.replace(self.location.href);

    </script>

    <script type="text/javascript">
            document.getElementById("detail").click();
    </script>

    <script>
                // Get the container element
        var btnContainer = document.getElementById("myDIV");

        // Get all buttons with class="btn" inside the container
        var btns = btnContainer.getElementsByClassName("a");

        for (var i = 0; i < btns.length; i++) {
          btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active");

            // If there's no active class
            if (current.length > 0) {
              current[0].className = current[0].className.replace(" active", "");
            }

            // Add the active class to the current/clicked button
            this.className += " active";
          });
        }
    </script>

</html>
