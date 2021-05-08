<?php
	session_start();
	if(!isset($_SESSION['med_admin']))
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
        <script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
        <script>
			function showRequests(id)
			{
				console.log(id);
				$.ajax({type:'POST', url: 'show_requests.php', data:{name:id}, success: function(response)
				   {
					$('#see').find('#'+id).html(response);
				   },
			       error:function(){
			        console.log("error");
			       }});
				return false;
			}
			showRequests("requests");
        </script>
        <title>MED-EASY</title>
    </head>
    <body style = "background-image: url('images/bg.jpg');">
    	<header style="font-weight:bold;">
                MED-EASY  
        </header><br><br><br><br>
        <center>
			<nav style="height:60px; background:navy;">
	            <a href="see_requests.php" style="color:navy;background:white;">See Requests</a>
	            <a href="med_admin_screen.php" style="background:navy;">Execute Query</a>
	            <a href="logout.php?logout=true" style="background:navy">Log Out</a>
	        </nav>
	    </center>
    	<form id="see">
    		<br><br>
    		<center>
			<label for="requests" style="color:navy;font-size:25px;">Current Active Requests</label>
		    </center>
		    <br /><br />
		    <center>
			<div id="requests"></div>
		    </center>
			<br><br>
		</form>
    </body>
</html>