<?php
	session_start();
	if(!isset($_SESSION['receptionist']))
	{
		header("Location: index.html");
		exit();
	}
	include 'config.php';
	if(!($dbconn =mysqli_connect($dbhost, $dbuser, $dbpass))) exit('Error connecting to database.');
	mysqli_select_db($dbconn,$db);
?>
<html>
	<head>
        <title>MED-EASY</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0;">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sans-serif">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="css/stylecss.css">
    </head>

	<body style = "background-image: url('images/bg.jpg');">
        <header style="font-weight:bold;">
            MED-EASY
        </header><br><br><br><br>
         <center>
	        <nav style="height:60px; background:navy;">
	        	<a href="update_password.php" style="color:navy;background:white;">Change Password</a>
	            <a href="recep_purchase.php" style="background:navy;">Purchase</a>
	            <a href="recep_sell.php" style="background:navy;">Sell</a>
	            <a href="make_request.php" style="background:navy;">Make Request</a>
	            <a href="logout.php?logout=true" style="background:navy">Log Out</a>
	        </nav>
	    </center><br><br>

	    <div class="loginbox" style = "width:800px; height: 400px; top: 300px; background-color:white;color:navy;box-shadow:5px 5px 5px 5px grey; border-radius: 0">

	    <form id="update" method="POST" action="update_password_action.php">
	    	<center>
			<label for="purchase" style="font-size:25px;">Change Password</label>
		    </center><br>	 
		    <p>Enter New Password: </p>
	    	<input type="text" id="new" name="new" required="" autocomplete=off>
	    	<br>
	    	<p>Confirm New Password: </p>
	    	<input type="text" id="new1" name="new1" required="" autocomplete=off>
	    	<center><br>
			<input type="submit" name="submit" value="UPDATE" class="submit" style="width:40%;">
			</center>
		</form>
	</div>
</body>
</html>
