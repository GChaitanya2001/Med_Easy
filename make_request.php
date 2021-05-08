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
        <script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
        <script>

        	<?php
		     if (isset($_GET['msg']))
		     {
				   if($_GET['msg'] =='done')
				   {	   	    
			?>
			            alert("REQUEST MADE");            
			<?php
				   }
				   else if($_GET['msg'] =='error')
				   {
			?>
			            alert("UNSUCCESSFUL!! TRY AGAIN");
			<?php
				   }
			  }
			?>
			function view_req()
			{
				$.ajax({
					type:'POST', 
					url: 'view_request.php', 
					success: function(response){
						$('#view_r').html(response);
					},
				});
				return false;
			}
			view_req();
		</script>
    </head>
    <body style = "background-image: url('images/bg.jpg');">
         <header style="font-weight:bold;">
            MED-EASY
         </header><br><br><br><br>
         <center>
	        <nav style="height:60px; background:navy;">
	        	<a href="update_password.php" style="background:navy;">Change Password</a>
	            <a href="recep_purchase.php" style="background:navy;">Purchase</a>
	            <a href="recep_sell.php" style="background:navy">Sell</a>
	            <a href="make_request.php" style="color:navy;background:white;">Make Request</a>
	            <a href="logout.php?logout=true" style="background:navy">Log Out</a>
	        </nav>
	     </center><br><br>
		<div class="loginbox" style = "width:1000px; height:400px; top: 300px; background-color:white; color:navy; box-shadow:5px 5px 5px 5px grey;border-radius:0px">
	    	<center><h1 style="font-weight:bold;font-size:32px;">Make request</h1></center>
	    	<form id="make" method="POST" action="make_request_action.php">
	    		<!-- cols="65" rows="5" style="border-bottom:1px solid #000;resize:none;" -->
			<textarea id="request" name="request" required="" placeholder="Enter the request"></textarea>
			<br><br>
            <center>
            <input type="submit" name = "submit" value="ADD" style="width:50%;">
            </center>
	    	</form>
	    </div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

	    <center>
	    	    <div id="view_r"></div><br><br><br><br><br><br>
	    </center>


    </body>
 </html>
