<?php
   session_start();

   if( isset($_POST['submit']))
	{
		include 'config.php';

		if(!($dbconn = mysqli_connect($dbhost, $dbuser, $dbpass))) exit('Error connecting to database.');
		mysqli_select_db($dbconn,$db);

		$name = $_POST['name'];
		$address = $_POST['address'];
		$salary = $_POST['salary'];
		$timings = $_POST['timings'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];

		$sqlq = "SELECT * FROM person WHERE name='".$name."'";
		$sqlq = mysqli_query($dbconn,$sqlq);
		$rows = mysqli_num_rows($sqlq);
		if($rows == 0)
		{
			$check_1 = "INSERT INTO users(username, password, role) VALUES('".$name."','".$name."', 'receptionist')";
			$query_1 = mysqli_query($dbconn,$check_1);

			$check_2 = "INSERT INTO person(name, address) VALUES('".$name."', '".$address."')";
	        $query_2 = mysqli_query($dbconn,$check_2);

	        $check = "SELECT * FROM person WHERE name='".$name."'";
		    $query = mysqli_query($dbconn,$check);
			$query = mysqli_fetch_array($query);
			$pid = $query['pid'];

	        $check_3 = "INSERT INTO employee(pid, salary, duty_timings) VALUES('".$pid."', '".$salary."', '".$timings."')";
	        $query_3 = mysqli_query($dbconn, $check_3);

	        $check_4 = "INSERT INTO person_email(pid, email) VALUES('".$pid."', '".$email."')";
	        $query_4 = mysqli_query($dbconn, $check_4);

	        $check_5 = "INSERT INTO person_tel_no(pid, tel_no) VALUES('".$pid."', '".$phone."')";
	        $query_5 = mysqli_query($dbconn, $check_5);
	        header("Location: add_recep.php?msg=success");
	    }
	    else
	    {
           header("Location: add_recep.php?msg=fail");
	    }
   }


?>