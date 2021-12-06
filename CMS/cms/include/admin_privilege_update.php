<?php
include 'functions.php';
session_start();
if (check_login($_SESSION['ID'],$_SESSION['user'])) {
	//escape strings
	$ID = mysqli_real_escape_string(connect(),$_POST['ID']);
	$privileges = mysqli_real_escape_string(connect(),$_POST['privileges']);
	
	$q="UPDATE `".$GLOBALS['prefix']."users` SET 
	`privileges` = '$privileges' 
	WHERE `id`='$ID' ";
	
	$r = mysqli_query(connect(), $q);
	header('Location: ../index.php?page=auth/admin/users_admin&update=1');
	
} 
else
{echo 'Du har ikke adgang til denne side. ';}
?>