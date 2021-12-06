<?php
include 'functions.php';

//escape strings
$mail = mysqli_real_escape_string(connect(),$_GET['mail']);
$activate = mysqli_real_escape_string(connect(),$_GET['activate']);

//look up the user based on the mail and check the activation code.
//if they match, activate the user
$q="UPDATE `".$GLOBALS['prefix']."users` SET `active` = '1' WHERE `mail` = '$mail' AND `activation` = '$activate'";

$r = mysqli_query(connect(), $q);

header('Location: ../index.php?page=front');

?>