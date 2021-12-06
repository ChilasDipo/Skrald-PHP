<?php
include 'functions.php';
session_start();
if (check_login($_SESSION['ID'],$_SESSION['user'])) {
	//escape strings
	$ownerID = $_SESSION['ID'];
	$name = mysqli_real_escape_string(connect(),$_POST['name']);
	$sensorType = mysqli_real_escape_string(connect(),$_POST['sensortype']);
	
	$address = generateAddress(32);
	
	$q="INSERT INTO `".$GLOBALS['prefix']."sensors` (`ownerID`, `name`, `address`, `sensorType`) VALUES ('$ownerID', '$name', '$address', '$sensorType')";	
	$r = mysqli_query(connect(), $q);
	header('Location: ../index.php?page=auth/sensors');
} 
else
{echo 'Du har ikke adgang til denne side. ';}
?>