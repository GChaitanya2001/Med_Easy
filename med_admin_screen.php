<?php
	session_start();
	if(!isset($_SESSION['med_admin']))
	{
		header("Location: index.html");
		exit();
	}
	include 'config.php';
	if(!($dbconn = mysqli_connect($dbhost, $dbuser, $dbpass))) exit('Error connecting to database.');
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
        <script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
		<script>
			function executeQuery()
			{
				$.ajax({type:'POST', url: 'runsqlq.php', data:$('#medadmin').serialize(), success: function(response)
				{
					$('#outputsqlq').html(response);
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
	            <a href="see_requests.php" style="background:navy;">See Requests</a>
	            <a href="med_admin_screen.php" style="color:navy;background:white;">Execute Query</a>
	            <a href="logout.php?logout=true" style="background:navy">Log Out</a>
	        </nav>
	    </center>
        <div class="loginbox" style = "width:1000px; height: 480px; top: 300px; background-color:white;color:navy;box-shadow:5px 5px 5px 5px grey; border-radius:0px">
        			<p>Please update the status of the request in request table also(after executing a request based query)</p>
		<form id="medadmin" onsubmit="return executeQuery();">
			<center>
			<label for="sqlq" style="font-size:25px;">Run SQL Query (In MySQL Syntax)</label>
		    </center>
			<br><br>
			<!-- cols="115" rows="5" style="border-bottom:1px solid #000;resize:none;" required="" autocomplete="off" -->
			<textarea id="sqlq" name="sqlq" required="" placeholder="Enter the SQL Query"></textarea>
			<br><br>
			<center>
			<input type="submit" name="submit" value="Submit" class="submit" id="runsqlq" style="width:50%;">
		    </center>
		</form>
		</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	  <center>
	  <div id="outputsqlq"></div>
	  </center>
	</body>
</html>
