<?php
    session_start();
	if( isset($_POST['submit']) )
	{
		include 'config.php';

		if(!($dbconn = mysqli_connect($dbhost, $dbuser, $dbpass))) exit('Error connecting to database.');
		mysqli_select_db($dbconn,$db);
		
		$medname = $_POST['name'];
		$expdate = $_POST['expirydate'];
		$chemamt = $_POST['chemamt'];
		$qty = $_POST['qty'];
		$cp = $_POST['cp'];
		$sp = $_POST['sp'];
		$c1 = $_POST['c1'];
		$c2 = $_POST['c2'];
		$c3 = $_POST['c3'];
		$ph = $_POST['ph'];
		$notes = $_POST['notes'];
		$exists = $_POST['ex'];
		$sname = $_POST['sname'];
		$saddr = $_POST['saddr'];
		$sem = $_POST['sem'];
		$stel = $_POST['stel'];

		echo "UPDATING RECORDS.............<br /><br />";

		echo "Medicine Name -	".$medname."<br />";
		echo "Expiry Date -	".$expdate."<br />";
		echo "Chemical Amount -	".$chemamt."<br />";
		echo "Quantity -	".$qty."<br />";
		echo "Cost Price -	".$cp."<br />";
		echo "Selling Price -	".$sp."<br />";
		echo "Major Compound -	".$c1."<br />";
		echo "Minor Compound1 -	".$c2."<br />";
		echo "Minor Compound2 -	".$c3."<br />";
		echo "Pharma Co. -	".$ph."<br />";
		echo "Notes -		".$notes."<br />";
		echo "Existing Supp -	".$exists."<br />";
		//echo "Supp ID -		"."<br />";//calculate later
		echo "Supp Name -	".$sname."<br />";
		echo "Supp Addr -	".$saddr."<br />";
		echo "Supp Email -	".$sem."<br />";
		echo "Supp Tel -	".$stel."<br /><br />";

		if($exists == "N" || $exists == "Y")//merged cases because anyways the user can't be trusted to provide correct value
		{
			$date = new DateTime();
			$ts = $date->getTimestamp();
			//insert into medicine
			$insert = "INSERT INTO medicine (name,buy_timestamp,expiry_date,chem_amount,qty,cp,sp) VALUES ('".$medname."','".date('Y-m-d H:i:s',$ts)."','".$expdate."','".$chemamt."','".$qty."','".$cp."','".$sp."')";
			$query = mysqli_query($dbconn,$insert);
			//insert into name_pharma
			$insert = "INSERT INTO name_pharma (name,pharmaco) VALUES ('".$medname."','".$ph."')";
			$query = mysqli_query($dbconn,$insert);
			//insert into name_compound
			$insert = "INSERT INTO name_compound (name,compound) VALUES ('".$medname."','".$c1."')";
			$query = mysqli_query($dbconn,$insert);
			if($c2 !== '')
			{
				$insert = "INSERT INTO name_compound (name,compound) VALUES ('".$medname."','".$c2."')";
				$query = mysqli_query($dbconn,$insert);
			}
			if($c3 !== '')
			{
				$insert = "INSERT INTO name_compound (name,compound) VALUES ('".$medname."','".$c3."')";
				$query = mysqli_query($dbconn,$insert);
			}
			//insert into person if not exists
			$check = "SELECT * FROM person WHERE name='".$sname."' AND address='".$saddr."'";
			$query = mysqli_query($dbconn,$check);
			$tempid = -1;
			$foundid= -1;
			if(mysqli_num_rows($query)==0)
			{
				$insert = "INSERT INTO person (name,address) VALUES ('".$sname."','".$saddr."')";
				$query = mysqli_query($dbconn,$insert);
				$tempid = mysqli_insert_id($dbconn);
				//insert into person_email
				if($sem !== '')
				{
					$insert = "INSERT INTO person_email (pid,email) VALUES ('".$tempid."','".$sem."')";
					$query = mysqli_query($dbconn,$insert);
				}
				//insert into person_tel_no
				if($stel !== '')
				{
					$insert = "INSERT INTO person_tel_no (pid,tel_no) VALUES ('".$tempid."','".$stel."')";
					$query = mysqli_query($dbconn,$insert);
				}
				//insert into supplier_pharmaco
				$insert = "INSERT INTO supplier_pharmaco (pid,pharmaco) VALUES ('".$tempid."','".$ph."')";
				$query = mysqli_query($dbconn,$insert);
			}
			else
			{
				$query = mysqli_fetch_array($query);
				$foundid = $query['pid'];
				//insert into supplier_pharmaco
				$insert = "INSERT INTO supplier_pharmaco (pid,pharmaco) VALUES ('".$foundid."','".$ph."')";
				$query = mysqli_query($dbconn,$insert);
			}
			//insert into transaction
			$insert = "INSERT INTO transaction (txn_timestamp,buy_sell,notes) VALUES ('".date('Y-m-d H:i:s',$ts)."','B','".$notes."')";
			$query = mysqli_query($dbconn,$insert);
			$txnid = mysqli_insert_id($dbconn);
			//insert into txn_on
			$insert = "INSERT INTO txn_on (name,buy_timestamp,expiry_date,chem_amount,cp,id,qty_buy_sell) VALUES ('".$medname."','".date('Y-m-d H:i:s',$ts)."','".$expdate."','".$chemamt."','".$cp."','".$txnid."','".$qty."')";
			$query = mysqli_query($dbconn,$insert);
			//insert into txn_person
			$pidp = -1;
			if($foundid != -1) $pidp = $foundid;
			else $pidp = $tempid;
			$check = "SELECT * FROM person WHERE name='".$_SESSION['receptionist']."'";
			$query = mysqli_query($dbconn,$check);
			$query = mysqli_fetch_array($query);
			$pidrecp = $query['pid'];
			$insert = "INSERT INTO txn_person (id,pid_person,pid_employee) VALUES ('".$txnid."','".$pidp."','".$pidrecp."')";
			$query = mysqli_query($dbconn,$insert);

			echo "<br /><br />Debug:".mysqli_error($dbconn);
		}
		echo "***************RECORDS UPDATED SUCCESSFULLY**************<br /><br />";
		echo "Returning back in 10 seconds..............";
		header("refresh:10;url=recep_purchase.php");
	}
	else
	{
		header("Location: index.html");
	}
?>
