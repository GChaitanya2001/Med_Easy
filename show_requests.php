<?php
	session_start();
	if(!isset($_SESSION['med_admin']))
	{
		header("Location: index.html");
		exit();
	}
	include 'config.php';
	if(!($dbconn =mysqli_connect($dbhost, $dbuser, $dbpass))) exit('Error connecting to database.');
	mysqli_select_db($dbconn,$db);

    $status = 0;
	$sqlq = "SELECT req_id, recep_id, req FROM request WHERE status ='".$status."'";
	$sqlq = mysqli_query($dbconn,$sqlq);
	if(!$sqlq)
	{
		echo "Query Failed.<br />";
		exit;
	}
	echo '<link rel="stylesheet" href="css/table.css">';
	$num_rows = mysqli_num_rows($sqlq);
    if($num_rows>0)
    {
		echo "<table border=1 ><tr>";
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
    }
?>