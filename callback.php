<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 500px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2><span class="glyphicon glyphicon-earphone"></span> Request A Callback</h2><br><br>
        <p>Please fill in your number and we shall get back to you shortly.</p>
        <form action="callback_helper.php" method="GET">
                <label>Phone Number</label>
                <input type="text" name="num" id="num" class="form-control">
                <br>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
    </div>
</body>
</html>
