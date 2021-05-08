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
			function ajaxForQuery(id)
			{
				console.log(id);
				$.ajax({
					type:'POST', 
					url: 'ownersqlq.php', 
					data:{name:id},
					 success: function(response){
					$('#medowner').find('#'+id).html(response);
					},
			       error:function(){
			        console.log("error");
			       }
				});

				return false;
			}
			ajaxForQuery("medicines");
			ajaxForQuery("medicines_compounds");
			ajaxForQuery("medicines_pharma");
			ajaxForQuery("employees");
			ajaxForQuery("transactions");

		</script>
		<title>MED-EASY</title>
	</head>

	<body style = "background-image: url('images/bg.jpg');">
        <header style="font-weight:bold;">
            MED-EASY
        </header><br><br><br><br>
		<center>
			<nav style="height:60px; background:navy;">
	            <a href="status.php" style="color:navy;background:white;">Table Status</a>
	            <a href="add_recep.php" style="background:navy;">Add Receptionist</a>
	            <a href="transaction.php" style="background:navy;">Bills</a>
	            <a href="profitloss.php" style="background:navy;">ProfitLoss</a>
	            <a href="logout.php?logout=true" style="background:navy">Log Out</a>
	        </nav>
	    </center>
		<form id="medowner">
			<br><br>
            <center>
			<label for="tables" style="color:navy;font-size:25px;">Current Status of Tables</label>
		    </center>
			<br /><br />
			<center>
			<div id="medicines"></div>
		    </center>
			<br /><br />
			<center>
			<div id="medicines_compounds"></div>
		    </center>
			<br /><br />
			<center>
			<div id="medicines_pharma"></div>
		    </center>
			<br /><br />
			<center>
			<div id="employees"></div>
	     	</center>
			<br /><br />
			<center>
			<div id="transactions"></div>
		    </center>
			<br /><br />
		</form>
		
	</body>

</html>
