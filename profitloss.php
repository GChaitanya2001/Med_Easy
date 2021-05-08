<?php
	session_start();
	if(!isset($_SESSION['owner']))
	{
		header("Location: index.html");
	}
	include 'config.php';
	if(!($dbconn = mysqli_connect($dbhost, $dbuser, $dbpass))) exit('Error connecting to database.');
	mysqli_select_db($dbconn,$db);
?>
<html>
		<head>
		<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0;">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sans-serif">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<![if !IE]>
		<link href='css/stylecss.css' rel='stylesheet' type='text/css'>
		<![endif]>
		<script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
		<script>
			function profitlosscalc()
			{
				$.ajax({type:'POST', url: 'profitloss_calc.php', data:$('#profitloss').serialize(), success: function(response)
				{
					$('#profitloss').find('#pldisp').html(response);
				}
				});
				return false;
			}
		</script>
		<title>MED-EASY</title>
	</head>
	<body style = "background-image: url('images/bg.jpg');">
		<header style="font-weight:bold;">
            MED-EASY
        </header><br><br><br><br>

		<center>
			<nav style="height:60px; background:navy;">
	            <a href="status.php" style="background:navy;">Table Status</a>
	            <a href="add_recep.php" style="background:navy;">Add Receptionist</a>
	            <a href="transaction.php" style="background:navy;">Bills</a>
	            <a href="profitloss.php" style="color:navy;background:white;">ProfitLoss</a>
	            <a href="logout.php?logout=true" style="background:navy">Log Out</a>
	        </nav>
	    </center>
	   <div class="loginbox" style = "width:400px; height:400px; top: 300px; background-color:white; color:navy; box-shadow:5px 5px 5px 5px grey;">
		<form id="profitloss" style="height:;"  onsubmit="return profitlosscalc();">
			<center>
			<label for="pl" style="color:navy;font-size:25px;">Profit/Loss</label>
		    </center><br>
			<label for="month1_year1">Starting Date, Month and Year:</label>
			<input type="date" name="startdate" id="month1_year1"><br>
			<label for="month2_year2">Ending Date, Month and Year:</label>
			<input type="date" name="enddate" id="month2_year2" value="<?php echo date('Y-m-d') ?>"><br>
			<center>
			<input type="submit" name="submit" value="Submit" class="submit" id="plsub"/>
		    </center>
			<br /><br /><br>
			<center>
			<div id="pldisp"></div>
		   </center>
		</form>
	   </div>
	</body>
</html>