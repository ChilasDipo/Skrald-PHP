<?php
include 'functions.php';
session_start();
if (check_login($_SESSION['ID'],$_SESSION['user'])) {
	//escape strings
	$ID = mysqli_real_escape_string(connect(),$_POST['ID']);
	$username = mysqli_real_escape_string(connect(),$_POST['username']);
	$firstName = mysqli_real_escape_string(connect(),$_POST['firstName']);
	$lastName = mysqli_real_escape_string(connect(),$_POST['lastName']);
	$mail = mysqli_real_escape_string(connect(),$_POST['mail']);
	
	$q="UPDATE `".$GLOBALS['prefix']."users` SET 
	`username` = '$username', 
	`firstName` = '$firstName', 
	`lastName` = '$lastName',
	`mail` = '$mail'
	WHERE `id`='$ID' ";
	//die($q);
	$r = mysqli_query(connect(), $q);
	header('Location: ../index.php?page=auth/profile&update=1');
	
} 
else
{echo 'Du har ikke adgang til denne side. ';}
?>