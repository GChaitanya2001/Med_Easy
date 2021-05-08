<?php
   session_start();

   if(isset($_POST['submit']))
	{
		include 'config.php';
		if(!($dbconn = mysqli_connect($dbhost, $dbuser, $dbpass))) exit('Error connecting to database.');
		mysqli_select_db($dbconn,$db);

		$new = $_POST['new'];
		$new1 = $_POST['new1'];
		if($new == $new1)
		{
			$q = "UPDATE users SET password='".$new."' WHERE username='".$_SESSION['receptionist']."'";
			$q = mysqli_query($dbconn, $q);
			header("Location: index.html");
		}
		else
		{
			header("Location: update_password.php?msg=error");
		}
	}
?>