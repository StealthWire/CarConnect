<?php
// Initialize the session
session_start();

// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $namee=$_POST["fname"];
    $numberr=$_POST["number"];
    $addresss=$_POST["address"];
    $sql = 'UPDATE users
    SET fullname = "'.$namee.'" ,
        contact = "'.$numberr.'",
        address = "'.$addresss.'"
    WHERE id = "'.$_SESSION["id"].'"';
    $result = mysqli_query($link,$sql);

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2><span class="glyphicon glyphicon-user"></span> My saved details</h2>
        <p>Please fill out this form.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>Full Name</label><input type="text" name="fname" class="form-control" value="<?php echo $new_password; ?>">
                <span class="help-block"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Contact Number</label>
                <input type="text" name="number" class="form-control">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Address</label>
                <input type="text" name="address" class="form-control">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit" onclick="clicked();">
                <a class="btn btn-link" href="welcome.php">Cancel</a>
            </div>
        </form>
    </div>


 <script type="text/javascript">
    function clicked() {
        alert("Details updated successfully.")
    }
</script>
</body>
</html>
