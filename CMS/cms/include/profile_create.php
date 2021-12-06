<?php
include 'functions.php';
//escape strings
$username = mysqli_real_escape_string(connect(),$_POST['username']);
$firstName = mysqli_real_escape_string(connect(),$_POST['firstName']);
$lastName = mysqli_real_escape_string(connect(),$_POST['lastName']);
$phone = mysqli_real_escape_string(connect(),$_POST['phone']);
$mail = mysqli_real_escape_string(connect(),$_POST['mail']);
$pw1 = mysqli_real_escape_string(connect(),$_POST['pw1']);
$pw2 = mysqli_real_escape_string(connect(),$_POST['pw2']);

//look up the username in DB. if it exists - create an error
$q="SELECT `ID` FROM `".$GLOBALS['prefix']."users` WHERE `username`='$username' LIMIT 1";
$res=mysqli_query(connect(), $q);
if (mysqli_num_rows($res)==1)
{
	header('Location: ../index.php?page=create_user&status=3');
}
//check if passwords match
if(strcmp($pw1,$pw2)!=0)
{
	header('Location: ../index.php?page=create_user&status=2');
}
else if(isset($mail) && strlen($mail)>5)
{
	$random = MD5(date("Y-m-d-h-m-s"));	//generate a random number for an activation code
	
	$q="INSERT INTO `".$GLOBALS['prefix']."users` (`username`, `firstName`, `lastName`, `phone`, `mail`, `password`, `activation`) VALUES
	('$username', '$firstName', '$lastName', '$phone','$mail', MD5('$pw1'), '$random')";

	$r = mysqli_query(connect(), $q);
	
	//send a mail to the user mail adress for activation
	$subject = "Activate your account";
	$message = '
	<html>
	<head>
	<title>Activate your account</title>
	</head>
	<body>
	<p>You\'re almost done!</p>
	You just have to click on this activation link and then you can log in:
	<a href="http://www.fablabdanmark.dk/include/profile_activate.php?mail='.$mail.'&activate='.$random.'">
	http://www.fablabdanmark.dk/include/profile_activate.php?mail='.$mail.'&activate='.$random.'</a>
	</body>
	</html>
	';
	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	// More headers
	$headers .= 'From: <info@fablabdanmark.dk>';

	mail($mail,$subject,$message,$headers);
	
	//redirect to the front page
	header('Location: ../index.php?page=create_user&status=1');
}
?>