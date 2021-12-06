<?php
include 'functions.php';
session_start();
if (check_login($_SESSION['ID'],$_SESSION['user'])) {
	//escape strings
	$sensorID = $_SESSION['ID'];

	$q="DELETE FROM `".$GLOBALS['prefix']."sensors` WHERE `ID`='".$sensorID."'";	
	$r = mysqli_query(connect(), $q);
	header('Location: ../index.php?page=auth/sensors');
} 
else
{echo 'Du har ikke adgang til denne side. ';}
?>