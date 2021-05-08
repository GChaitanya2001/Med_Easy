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
	        	<a href="update_password.php" style="background:navy;">Change Password</a>
	            <a href="recep_purchase.php" style="background:navy;">Purchase</a>
	            <a href="recep_sell.php" style="color:navy;background:white;">Sell</a>
	            <a href="make_request.php" style="background:navy;">Make Request</a>
	            <a href="logout.php?logout=true" style="background:navy">Log Out</a>
	        </nav>
	    </center><br><br>


        <div class="loginbox" style = "width:800px; height: 1300px; top: 450px; bottom: 200px;  background-color:white; color:navy; box-shadow:5px 5px 5px 5px grey;border-radius: 0">
	    <form id="sellmeds"  method="POST" action="sellmeds.php">
	    	<center>
			<label for="question" style="font-size:25px;">Medicine Sale</label>
		    </center>
			<label for="medno" class="desc">Select number of different medicines being sold:</label>
			<select name="medno">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
			</select>
			<br />

			<script	type="text/javascript">
				function getQty(str,idx)
				{
					var xmlhttp;
					if (window.XMLHttpRequest)
					{
						xmlhttp=new XMLHttpRequest();
					}
					else
					{
						xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					}
					xmlhttp.onreadystatechange=function()
					{
						if (xmlhttp.readyState==4 && xmlhttp.status==200)
						{
							var select = document.getElementById("noof"+idx);
							select.options.length=0;
							var retqty = xmlhttp.responseText;
							var i=0;
							for(i=1;i<=retqty;i++)
							{
								var option = document.createElement("option");
								option.text = i;
								option.value = i;
								var select = document.getElementById("noof"+idx);
								select.appendChild(option);
							}
						}
					}
					xmlhttp.open("GET","getMedsDetails.php?q="+str,true);
					xmlhttp.send();
				}
			</script>

			<?php
				$getMeds =mysqli_query($dbconn,'SELECT * FROM medicine');
			?>

			<label for="m1" class="desc">Select Medicine 1:</label>
			<select name="m1" onmouseup="getQty(this.options[this.selectedIndex].value,1);" onchange="getQty(this.options[this.selectedIndex].value,1);">
				<option value = '' selected disabled hidden style="color:grey">--SELECT--</option>
				<?php
					while ($row =mysqli_fetch_array($getMeds))
					{
				?>
				<option value="<?php echo $row['name'].','.$row['buy_timestamp'].','.$row['expiry_date'].','.$row['chem_amount'].','.$row['cp'].','.$row['sp']; ?>"><?php echo $row['name'].','.$row['chem_amount'].','.$row['expiry_date'].','.$row['sp']; ?></option>
				<?php
					}
				?>
			</select>
			<select id="noof1" name="noof1"></select>
			<br />

			<?php
				$getMeds =mysqli_query($dbconn,'SELECT * FROM medicine');
			?>

			<label for="m2" class="desc">Select Medicine 2:</label>
			<select name="m2" onmouseup="getQty(this.options[this.selectedIndex].value,2);" onchange="getQty(this.options[this.selectedIndex].value,2);">
				<option value = '' selected disabled hidden style="color:grey">--SELECT--</option>
				<?php
					while ($row =mysqli_fetch_array($getMeds))
					{
				?>
				<option value="<?php echo $row['name'].','.$row['buy_timestamp'].','.$row['expiry_date'].','.$row['chem_amount'].','.$row['cp'].','.$row['sp']; ?>"><?php echo $row['name'].','.$row['chem_amount'].','.$row['expiry_date'].','.$row['sp']; ?></option>
				<?php
					}
				?>
			</select>
			<select id="noof2" name="noof2"></select>
			<br />

			<?php
				$getMeds =mysqli_query($dbconn,'SELECT * FROM medicine');
			?>

			<label for="m3" class="desc">Select Medicine 3:</label>
			<select name="m3" onmouseup="getQty(this.options[this.selectedIndex].value,3);" onchange="getQty(this.options[this.selectedIndex].value,3);">
				<option value = '' selected disabled hidden style="color:grey">--SELECT--</option>
				<?php
					while ($row =mysqli_fetch_array($getMeds))
					{
				?>
				<option value="<?php echo $row['name'].','.$row['buy_timestamp'].','.$row['expiry_date'].','.$row['chem_amount'].','.$row['cp'].','.$row['sp']; ?>"><?php echo $row['name'].','.$row['chem_amount'].','.$row['expiry_date'].','.$row['sp']; ?></option>
				<?php
					}
				?>
			</select>
			<select id="noof3" name="noof3"></select>
			<br />

			<?php
				$getMeds =mysqli_query($dbconn,'SELECT * FROM medicine');
			?>

			<label for="m4" class="desc">Select Medicine 4:</label>
			<select name="m4" onmouseup="getQty(this.options[this.selectedIndex].value,4);" onchange="getQty(this.options[this.selectedIndex].value,4);">
				<option value = '' selected disabled hidden style="color:grey">--SELECT--</option>
				<?php
					while ($row =mysqli_fetch_array($getMeds))
					{
				?>
				<option value="<?php echo $row['name'].','.$row['buy_timestamp'].','.$row['expiry_date'].','.$row['chem_amount'].','.$row['cp'].','.$row['sp']; ?>"><?php echo $row['name'].','.$row['chem_amount'].','.$row['expiry_date'].','.$row['sp']; ?></option>
				<?php
					}
				?>
			</select>
			<select id="noof4" name="noof4"></select>
			<br />

			<?php
				$getMeds =mysqli_query($dbconn,'SELECT * FROM medicine');
			?>

			<label for="m5" class="desc">Select Medicine 5:</label>
			<select name="m5" onmouseup="getQty(this.options[this.selectedIndex].value,5);" onchange="getQty(this.options[this.selectedIndex].value,5);">
				<option value = '' selected disabled hidden style="color:grey">--SELECT--</option>
				<?php
					while ($row =mysqli_fetch_array($getMeds))
					{
				?>
				<option value="<?php echo $row['name'].','.$row['buy_timestamp'].','.$row['expiry_date'].','.$row['chem_amount'].','.$row['cp'].','.$row['sp']; ?>"><?php echo $row['name'].','.$row['chem_amount'].','.$row['expiry_date'].','.$row['sp']; ?></option>
				<?php
					}
				?>
			</select>
			<select id="noof5" name="noof5"></select>
			<br />

			<label for="cex" class="desc">Existing Customer:</label>
			<select name="cex">
				<option value="N">No</option>
				<option value="Y">Yes</option>
			</select>
			<br />

			<label for="cname" class="desc">Customer Name:</label>
			<input type="text" name="cname" required/>

			<label for="caddr" class="desc">Customer Address:</label>
			<input type="text" name="caddr" required/>
			<br />

			<label for="cem" class="desc">Customer Email:</label>
			<input type="email" name="cem" required/>

			<label for="ctel" class="desc">Customer Phone No(only numbers):</label>
			<input type="text" name="ctel" pattern="[0-9]+" required/>
			<br />

			<label for="snotes">Notes:</label>
			<input type="text" name="snotes" />
			<br />
			<!-- check that none of the options are same -->
            <center>
			<input type="submit" name="submit" value="Submit" class="submit" id="sellsub" style="width:50%;"/> 
			</center> 
		</form>
           </div>
			</body>
		</html>