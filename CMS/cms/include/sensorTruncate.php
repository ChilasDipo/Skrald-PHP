<?php
include 'functions.php';
session_start();
if (check_login($_SESSION['ID'],$_SESSION['user'])) {
	//escape strings
	$sensorID = mysqli_real_escape_string(connect(),$_GET['sensorID']);

	$q="DELETE FROM `".$GLOBALS['prefix']."data` WHERE `owner`='".$sensorID."'";
	$r = mysqli_query(connect(), $q);
	header('Location: ../index.php?page=auth/sensorDetail&sensorID='.$sensorID);
} 
else
{echo 'Du har ikke adgang til denne side. ';}
?>