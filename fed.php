<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2><span class="glyphicon glyphicon-bookmark"></span> Feedback</h2>

        <form name="contactform" method="post" action="send_form_email.php" >
										<div class="form-group">
											<label>Full Name</label>
												<input type="text" id="name" name="name" class="form-control" />
                                        </div>

                                        <div class="form-group">
                                           <label>Email</label>
                                            <input type="email" id="email" name="email"  class="form-control"/>
                                        </div>


										<div class="form-group">
											<label>Suggestions / Requests</label>
												<textarea name="message" id="message" placeholder="Message" rows="7"  class="form-control"></textarea>

										</div>
										 <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
    </div>

</body>
</html>
