<?php
include 'functions.php';
session_start();
if (check_login($_SESSION['ID'],$_SESSION['user'])) {
	//escape strings
	$ID = mysqli_real_escape_string(connect(),$_POST['ID']);
	
	$q="UPDATE `".$GLOBALS['prefix']."users` SET 
	`active` = '0' 
	WHERE `id`='$ID' ";
	
	$r = mysqli_query(connect(), $q);
	header('Location: ../index.php?page=auth/admin/users_admin&update=2');
	
} 
else
{echo 'Du har ikke adgang til denne side. ';}
?>