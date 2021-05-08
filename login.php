<?php
	session_start();
	if( isset($_POST['submit']) && isset($_POST['username']) && isset($_POST['password']) )
	{
		include 'config.php';
		
		$username = stripslashes($_POST['username']);
		$password = stripslashes($_POST['password']);
		$utype = stripslashes($_POST['utype']);
		print "<h2>" . $username . "</h2>";
		print "<h2>" . $password . "</h2>";
		
		if(!($dbconn = mysqli_connect($dbhost, $dbuser, $dbpass, $db))) exit('Error connecting to database.');

		$getCreds = mysqli_query($dbconn,"SELECT role FROM ".$dbtable." WHERE username='".$username."' AND password='".$password."'");
		$gotCreds = mysqli_fetch_array($getCreds);
		// echo $gotCreds['role'];
		print "<h2>" .  $gotCreds['role'] . "</h2>";

		if(strcmp($gotCreds['role'],'med_admin')==0 && strcmp($utype, 'med_admin')==0){
			$_SESSION['med_admin']=$username;
			header("Location: see_requests.php");
		}
		else if($gotCreds['role']=='receptionist' && strcmp($utype, 'receptionist')==0){
			$_SESSION['receptionist']=$username;
			header("Location: recep_purchase.php");
		}
		else if($gotCreds['role']=='owner' && strcmp($utype, 'owner') == 0){
			$_SESSION['owner']=$username;
			header("Location: status.php");
		}
		else
		{
			header("Location: index.html?msg=error");
		}
	}
	else
	{
		header("Location: index.html?msg=error");
	}
?>