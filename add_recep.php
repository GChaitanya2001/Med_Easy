<?php
	session_start();
	if(!isset($_SESSION['owner']))
	{
		header("Location: index.html");
	}
	include 'config.php';
	if(!($dbconn = mysqli_connect($dbhost, $dbuser, $dbpass))) exit('Error connecting to database.');
	mysqli_select_db($dbconn,$db);
	//parse_str($url_components['query'], $params);
?>
<html>
	<head>
		<title>MED-EASY</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0;">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sans-serif">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="css/stylecss.css">
		<script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
		<title>Medical Store Management</title>
		<script>
		<?php
		  if (isset($_GET['msg']))
		  {
			   if($_GET['msg'] =='success')
			   {
			   	    
		?>
		            alert("Successfully ADDED");
		            
		<?php
			   }
			   else if($_GET['msg'] =='fail')
			   {
		?>
		            alert("Username already exists!!! Try Another username");
		<?php
			   }
		  }
		?>
	   </script>
    </head>
    <body style = "background-image: url('images/bg.jpg');">
		<header style="font-weight:bold;">
            MED-EASY
        </header><br><br><br><br>
		<center>
			<nav style="height:60px; background:navy;">
	            <a href="status.php" style="background:navy;">Table Status</a>
	            <a href="add_recep.php" style="color:navy;background:white;">Add Receptionist</a>
	            <a href="transaction.php" style="background:navy;">Bills</a>
	            <a href="profitloss.php" style="background:navy;">ProfitLoss</a>
	            <a href="logout.php?logout=true" style="background:navy">Log Out</a>
	        </nav>
	    </center>
	    <div class="loginbox" style = "width:440px; height:740px; top: 320px; background-color:white; color:navy; box-shadow:5px 5px 5px 5px grey;">
	    	<center><h1 style="font-weight:bold;font-size:32px;">Add Receptionist</h1></center>
	    	<form id="add_recep"  method="POST" action="add_recep_action.php">
	    		<p>Receptionist name</p>
                <input type="text" id = "name" name="name" placeholder="Enter Receptionist Name" required="" autocomplete="off">
                <p>Address</p>
                <input type="text" id="address" name="address" placeholder="Enter Address" required="" autocomplete="off">
                <p>Salary</p>
                <input type="number" id="salary" name="salary" placeholder="Enter Salary in Rupees" required="" autocomplete="off">
                <p>Duty Timings</p>
                <input type="text" id="timings" name="timings" placeholder="Enter Duty Timings" required="" autocomplete="off">
                <p>E-Mail Address</p>
                <input type="email" id="email" name="email" placeholder="Enter Email Id" required="" autocomplete="off">
                <p>Phone Number</p>
                <input type="text" id="phone" name="phone" placeholder="Enter Phone Number" pattern="[0-9]+" required="" autocomplete="off">
                <center>
                <input type="submit" name = "submit" value="ADD">
                </center>     
	    	</form>
	    </div><br><br><br><br><br><br>
    </body>
 </html>