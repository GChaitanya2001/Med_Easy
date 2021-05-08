<?php 
 
if(isset($_GET['logout']))
{
	session_destroy();
	header('location:index.html?logout=true');
	exit;
}
?>