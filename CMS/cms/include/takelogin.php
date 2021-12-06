<?php
include 'functions.php';

$user = mysqli_real_escape_string(connect(), $_POST['username']);
$pass = mysqli_real_escape_string(connect(), $_POST['password']); 

$pass=md5($pass);

$q = "SELECT * FROM `".$GLOBALS['prefix']."users` WHERE `username`='$user' AND `password`='$pass' AND `active`='1' LIMIT 1";

$res = mysqli_query(connect(),$q);

if (mysqli_num_rows($res)!=0)
{
	while($row=mysqli_fetch_assoc($res))
	{
		session_start();
		$_SESSION['user'] = $row['username'];
		$_SESSION['ID'] = $row['ID'];
		$_SESSION['privileges'] = $row['privileges'];
	}
	header('Location: ../index.php?page=auth/front');
}
else
{
	header('Location: ../index.php?page=front&e=1');
}

?>