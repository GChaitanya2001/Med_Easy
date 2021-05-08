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
        <script>
        	<?php
		     if (isset($_GET['msg']))
		     {
				   if($_GET['msg'] =='done')
				   {	   	    
			?>
			            alert("Successfully UPDATED");            
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
		</script>
    </head>

	<body style = "background-image: url('images/bg.jpg');">
        <header style="font-weight:bold;">
            MED-EASY
        </header><br><br><br><br>
         <center>
	        <nav style="height:60px; background:navy;">
	        	<a href="update_password.php" style="background:navy;">Change Password</a>
	            <a href="recep_purchase.php" style="color:navy;background:white;">Purchase</a>
	            <a href="recep_sell.php" style="background:navy;">Sell</a>
	            <a href="make_request.php" style="background:navy;">Make Request</a>
	            <a href="logout.php?logout=true" style="background:navy">Log Out</a>
	        </nav>
	    </center><br><br>

        <div class="loginbox" style = "width:800px; height: 1550px; top: 500px; bottom: 200px; background-color:white;color:navy;box-shadow:5px 5px 5px 5px grey; border-radius: 0">
		<form id="medbuy" method="POST" action="buymeds.php">
		    <center>
			<label for="purchase" style="font-size:25px;">Medicine Purchase</label>
		    </center>
			<label for="name">Name:</label>
			<input type="text" name="name" required/>

			<label for="expirydate" class="desc">Expiry Date(YYYY-MM-DD):</label>
			<input type="text" name="expirydate" pattern="[0-9][0-9][0-9][0-9][-][0-9][0-9][-][0-9][0-9]" required/>
			<br />

			<label for="chemamt">Chemical Amount:</label>
			<input type="text" name="chemamt" required/>

			<label for="qty" class="desc">Quantity:</label>
			<input type="text" name="qty" pattern="[0-9]+" required/>
			<br />

			<label for="cp">Cost Price:</label>
			<input type="text" name="cp" pattern="[0-9]+" required/>

			<label for="sp" class="desc">Selling Price:</label>
			<input type="text" name="sp" pattern="[0-9]+" required/>
			<br />

			<label for="c1">Compound 1:</label>
			<input type="text" name="c1" required/>

			<label for="c2" class="desc">Compound 2:</label>
			<input type="text" name="c2" />
			<br />

			<label for="c3">Compound 3:</label>
			<input type="text" name="c3" />

			<label for="ph" class="desc">Pharma Co.:</label>
			<input type="text" name="ph" required/>
			<br />

			<label for="notes">Notes:</label>
			<input type="text" name="notes" />

			<label for="ex" class="desc">Existing Supplier:</label>
			<select name="ex">
				<option value="N">No</option>
				<option value="Y">Yes</option>
			</select>
			<br />

			<label for="sname" class="desc">Supplier Name:</label>
			<input type="text" name="sname" required/>

			<label for="saddr" class="desc">Supplier Address:</label>
			<input type="text" name="saddr" required/>
			<br />

			<label for="sem" class="desc">Supplier Email:</label>
			<input type="email" name="sem" required/>

			<label for="stel" class="desc">Supplier Phone No(only numbers):</label>
			<input type="text" name="stel" pattern="[0-9]+" required/>
			<br />
            <center>
			<input type="submit" name="submit" value="Submit" class="submit" id="buysub"/>
			</center>
		</form>
  
        </div>
			</body>
		</html>
