<?php
	session_start();
	if(!isset($_SESSION['med_admin']))
	{
		header("Location: index.html");
		exit();
	}
    
    function isInsert(string $stmt): bool {
    $_TRIM_MASK_WITH_PAREN = "( \t\n\r\0\x0B";
    return 'INSERT' === strtoupper(substr(ltrim($stmt, $_TRIM_MASK_WITH_PAREN), 0, 6));
    }

    function isDelete(string $stmt): bool {
    $_TRIM_MASK_WITH_PAREN = "( \t\n\r\0\x0B";
    return 'DELETE' === strtoupper(substr(ltrim($stmt, $_TRIM_MASK_WITH_PAREN), 0, 6));
    }

    function isUpdate(string $stmt): bool {
    $_TRIM_MASK_WITH_PAREN = "( \t\n\r\0\x0B";
    return 'UPDATE' === strtoupper(substr(ltrim($stmt, $_TRIM_MASK_WITH_PAREN), 0, 6));
    }

	function isSelect(string $stmt): bool {
    $_TRIM_MASK_WITH_PAREN = "( \t\n\r\0\x0B";
    return 'SELECT' === strtoupper(substr(ltrim($stmt, $_TRIM_MASK_WITH_PAREN), 0, 6));
    }

    echo '<link rel="stylesheet" href="css/table.css">';
	echo '<link rel="stylesheet" href="css/stylecss.css">';
	echo '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sans-serif">';

	if(isset($_POST['sqlq']))
	{
		$query = $_POST['sqlq'];

		if(isSelect($query) || isUpdate($query) || isDelete($query) || isInsert($query))
	    {
			include 'config.php';
			if(!($dbconn = mysqli_connect($dbhost, $dbuser, $dbpass))) exit('Error connecting to database.');
			mysqli_select_db($dbconn,$db);
			$sqlq = mysqli_query($dbconn,$query);
			if(!$sqlq)
			{
				echo "Query Failed.<br />";
				exit;
			}
			else
			{
				echo "<script>alert('successfully executed')</script>";
			}
			if(isSelect($query))
			{
				$num_rows = mysqli_num_rows($sqlq);
				if ($num_rows > 0)
				{
					echo "<p>Fetched ".$num_rows." rows. Output:<br /><br />";
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
				}
			}
		}
		else
		{
			echo "<script>alert('Access Denied!!! Only SELECT, DELETE, UPDATE, INSERT queries are allowed')</script>";
		}
	}
?>
