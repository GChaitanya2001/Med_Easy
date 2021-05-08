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
		<title>MED-EASY</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0;">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sans-serif">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="css/stylecss.css">
		<script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
		<script>

			function bills()
			{
				$.ajax({type:'POST', url: 'bills.php', data:$('#medownerbills').serialize(), success: function(response)
				{
					$('#billsdisp').html(response);
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
	            <a href="transaction.php" style="color:navy;background:white;">Bills</a>
	            <a href="profitloss.php" style="background:navy;">ProfitLoss</a>
	            <a href="logout.php?logout=true" style="background:navy">Log Out</a>
	        </nav>
	    </center>
	    <div class="loginbox" style = "width:400px; height:300px; top: 250px; background-color:white; color:navy; box-shadow:5px 5px 5px 5px grey;">
		<form id="medownerbills" onsubmit="return bills();">
			<?php
				$getTxnId = mysqli_query($dbconn,'SELECT id FROM transaction;');
			?>
			<center>
		<label for="bills">Show Bill For Transaction ID</label>
		<br><br><br>
		    </center>
			<select name="txn_id">
				<option value = '' selected disabled hidden style="color:grey">--SELECT--</option>
				<?php
					while ($row = mysqli_fetch_array($getTxnId))
					{
				?>
				<option value="<?php echo $row['id']; ?>"><?php echo $row['id']; ?></option>
				<?php
					}
				?>
			</select>
			<br ><br >
			<center>
			<input type="submit" name="submit" value="Submit" class="submit" id="txnsub"/>
		    </center>
			<br /><br />
		</form>
	  </div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	  <div id="billsdisp" class="outputsqlq"></div>
	  <br><br><br><br><br>
	 </div>
	</body>
</html>