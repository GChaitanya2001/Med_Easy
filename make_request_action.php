<?php
   session_start();

   if(isset($_POST['submit']))
	{
		include 'config.php';
		if(!($dbconn = mysqli_connect($dbhost, $dbuser, $dbpass))) exit('Error connecting to database.');
		mysqli_select_db($dbconn,$db);

		$request = $_POST['request'];
		$sqlq = "SELECT * FROM person NATURAL JOIN employee WHERE name='".$_SESSION['receptionist']."'";
		$sqlq = mysqli_query($dbconn, $sqlq);
		$list = mysqli_fetch_array($sqlq);
		$pid = $list['pid'];

		$query = "INSERT INTO request(recep_id, req, status) VALUES('".$pid."', '".$request."', 0)";
		$query = mysqli_query($dbconn, $query);
		if(!$query)
		{
		   header("Location: make_request.php?msg=error");
	    }
	    else
	    {
	    	header("Location: make_request.php?msg=done");
	    }
	}
?>