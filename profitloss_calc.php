<?php
	session_start();
	if(!isset($_SESSION['owner']))
	{
		header("Location: index.html");
		exit();
	};
	if(isset($_POST['startdate']))
	{
	  $date = date('Y-m-d', strtotime($_POST['startdate']));
	}
	if(isset($_POST['enddate']))
	{
	  $date1 = date('Y-m-d', strtotime($_POST['enddate']));
	}
    list($y1,$m1,$d1)=explode('-',$date);
    list($y2,$m2,$d2)=explode('-',$date1);

    echo '<link rel="stylesheet" href="css/table.css">';
	echo '<link rel="stylesheet" href="css/stylecss.css">';
	echo '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sans-serif">';
	if(checkdate($m1,$d1,$y1) && checkdate($m2,$d2,$y2))
	{
		include 'config.php';
		if(!($dbconn = mysqli_connect($dbhost, $dbuser, $dbpass))) exit('Error connecting to database.');
		mysqli_select_db($dbconn,$db);

		$sqlq = "SELECT id,qty_buy_sell*sp AS SP FROM transaction AS a NATURAL JOIN txn_on NATURAL JOIN medicine WHERE txn_timestamp>='".$y1."-".sprintf("%02d",$m1)."-".sprintf("%02d",$d1)." 00:00:00' AND txn_timestamp<='".$y2."-".sprintf("%02d",$m2)."-".sprintf("%02d",$d2)." 23:59:59' AND buy_sell='S';";
		$sqlq = mysqli_query($dbconn,$sqlq);
		if(!$sqlq)
		{
			echo "Query Failed.<br />";
			exit;
		}
		$num_rows = mysqli_num_rows($sqlq);
		echo "<p>Sale Transactions:<br /><br />";
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
		echo "</table><br>";

		$sqlq = "SELECT id,qty_buy_sell*cp AS CP FROM transaction AS a NATURAL JOIN txn_on NATURAL JOIN medicine WHERE txn_timestamp>='".$y1."-".sprintf("%02d",$m1)."-".sprintf("%02d",$d1)." 00:00:00' AND txn_timestamp<='".$y2."-".sprintf("%02d",$m2)."-".sprintf("%02d",$d2)." 23:59:59' AND buy_sell='B';";
		$sqlq = mysqli_query($dbconn,$sqlq);
		if(!$sqlq)
		{
			echo "Query Failed.<br />";
			exit;
		}
		$num_rows = mysqli_num_rows($sqlq);
		echo "<p>Purchase Transactions:<br /><br />";
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
		echo "</table><br>";

		$sqlq = "SELECT SUM(qty_buy_sell*cp) AS CP FROM transaction AS a NATURAL JOIN txn_on NATURAL JOIN medicine WHERE txn_timestamp>='".$y1."-".sprintf("%02d",$m1)."-".sprintf("%02d",$d1)." 00:00:00' AND txn_timestamp<='".$y2."-".sprintf("%02d",$m2)."-".sprintf("%02d",$d2)." 23:59:59' AND buy_sell='B';";
		$sqlq = mysqli_query($dbconn,$sqlq);
		if(!$sqlq)
		{
			echo "Query Failed.<br />";
			exit;
		}
		echo "<p>Total expenses: Rs. ";
		$cp = mysqli_fetch_array($sqlq);
		echo $cp['CP'];
		echo "<br>";

		$sqlq = "SELECT SUM(qty_buy_sell*sp) AS SP FROM transaction AS a NATURAL JOIN txn_on NATURAL JOIN medicine WHERE txn_timestamp>='".$y1."-".sprintf("%02d",$m1)."-".sprintf("%02d",$d1)." 00:00:00' AND txn_timestamp<='".$y2."-".sprintf("%02d",$m2)."-".sprintf("%02d",$d2)." 23:59:59' AND buy_sell='S';";
		$sqlq = mysqli_query($dbconn,$sqlq);
		if(!$sqlq)
		{
			echo "Query Failed.<br />";
			exit;
		}
		echo "<p>Total income: Rs. ";
		$sp = mysqli_fetch_array($sqlq);
		echo $sp['SP'];

		echo "<p>Total profits: Rs. ";
		echo $sp['SP']-$cp['CP'];
	}
	else echo "Dates are Invalid";
?>
