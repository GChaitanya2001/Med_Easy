<?php
	session_start();
	if(!isset($_SESSION['owner']))  
	{
		header("Location: index.html");
		exit();
	};

	if(!isset($_POST['txn_id']))  
	{
		// header("Location: transaction.php");
		exit();
	};

	$txnid = $_POST['txn_id'];

	include 'config.php';
	if(!($dbconn = mysqli_connect($dbhost, $dbuser, $dbpass))) exit('Error connecting to database.');
	mysqli_select_db($dbconn,$db);


	$sqlq = "SELECT * FROM (SELECT * FROM transaction WHERE id='".$txnid."') AS a NATURAL JOIN txn_on NATURAL JOIN medicine;";
	$sqlq = mysqli_query($dbconn,$sqlq);
	if(!$sqlq)
	{
		echo "Query Failed.<br />";
		exit;
	}
	echo '<link rel="stylesheet" href="css/stylecss.css">';
	echo '<link rel="stylesheet" href="css/table.css">';
	echo '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sans-serif">';
	echo '<div style = "width:100%; max-height:1200px; top:700px; background-color:None;">';
	$num_rows = mysqli_num_rows($sqlq);
	echo "<center>";
	echo "<p>Medicine Info</p><br>";
	echo "<div style='max-height:400px;overflow-y:auto;width:90%;box-shadow:5px 5px 5px 5px grey'>";
	echo "<table style='width:100%;'><tr>";
	for($i = 0; $i < mysqli_num_fields($sqlq); $i++)
	{
		$field_info = mysqli_fetch_field_direct($sqlq, $i);
		echo "<th>{$field_info->name}</th>";
	}
	echo "</tr>";
	while($row = mysqli_fetch_row($sqlq))
	{
		echo "<tr>";
		foreach($row as $_column)
		{
			echo "<td>{$_column}</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
	echo "</div>";
	echo "</center><br>";

	$sqlq = "SELECT * FROM (SELECT pid_person FROM txn_person WHERE id='".$txnid."') AS a JOIN person ON (a.pid_person=person.pid)";
	$sqlq = mysqli_query($dbconn,$sqlq);
	if(!$sqlq)
	{
		echo "Query Failed.<br />";
		exit;
	}
	$num_rows = mysqli_num_rows($sqlq);
	echo "<center>";
	echo "<p>Buyer/seller Info</p><br>";
	echo "<div style='max-height:400px;overflow-x:auto;width:80%;box-shadow:5px 5px 5px 5px grey'>";
	echo "<table border=1 style ='width:100%;'><tr>";
	for($i = 0; $i < mysqli_num_fields($sqlq); $i++)
	{
		$field_info = mysqli_fetch_field_direct($sqlq, $i);
		echo "<th>{$field_info->name}</th>";
	}
	echo "</tr>";
	while($row = mysqli_fetch_row($sqlq))
	{
		echo "<tr>";
		foreach($row as $_column)
		{
			echo "<td>{$_column}</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
	echo "</div>";
	echo "</center><br>";

	$txntype=-1;
	$sqlq = "SELECT * FROM transaction WHERE id='".$txnid."'";
	$sqlq = mysqli_query($dbconn,$sqlq);
	$sqlq = mysqli_fetch_array($sqlq);
	if($sqlq['buy_sell']=='B') $txntype=1;
	else if($sqlq['buy_sell']=='S') $txntype=0;

	if($txntype==0)	//	S
	{
		$sqlq = "SELECT SUM(qty_buy_sell*sp) AS 'Received from Customer' FROM (SELECT * FROM transaction WHERE id='".$txnid."') AS a NATURAL JOIN txn_on NATURAL JOIN medicine;";
		$sqlq = mysqli_query($dbconn,$sqlq);
		if(!$sqlq)
		{
			echo "Query Failed.<br />";
			exit;
		}
		$num_rows = mysqli_num_rows($sqlq);
		echo "<center>";
		echo "<p>Bill</p><br>";
		echo "<table border=1><tr>";
		for($i = 0; $i < mysqli_num_fields($sqlq); $i++)
		{
			$field_info = mysqli_fetch_field_direct($sqlq, $i);
			echo "<th>{$field_info->name}</th>";
		}
		echo "</tr>";
		while($row = mysqli_fetch_row($sqlq))
		{
			echo "<tr>";
			foreach($row as $_column)
			{
				echo "<td>{$_column}</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
		echo "</center><br>";
	}
	else if($txntype==1) //	B
	{
		$sqlq = "SELECT SUM(qty_buy_sell*cp) AS 'Paid to Supplier' FROM (SELECT * FROM transaction WHERE id='".$txnid."') AS a NATURAL JOIN txn_on NATURAL JOIN medicine;";
		$sqlq = mysqli_query($dbconn,$sqlq);
		if(!$sqlq)
		{
			echo "Query Failed.<br />";
			exit;
		}
		$num_rows = mysqli_num_rows($sqlq);
		echo "<center>";
		echo "<p>Bill</p><br>";
		echo "<table border=1><tr>";
		for($i = 0; $i < mysqli_num_fields($sqlq); $i++)
		{
			$field_info = mysqli_fetch_field_direct($sqlq, $i);
			echo "<th>{$field_info->name}</th>";
		}
		echo "</tr>";
		while($row = mysqli_fetch_row($sqlq))
		{
			echo "<tr>";
			foreach($row as $_column)
			{
				echo "<td>{$_column}</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
		echo "</center><br>";
		echo "</div>";
	}
?>
