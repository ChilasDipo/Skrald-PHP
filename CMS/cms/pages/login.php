<h1>Welcome, please login or create a user</h1>
<form action="include/takelogin.php" method="POST">
Username: <input type="text" name="username">
Password: <input type="password" name="password">
<input type="submit" value="Login" size="4"></form>

<?php
if(isset($_GET['e']))
{
	echo 'Error during login - please try again';
}
?>
<br /><br /><a href="index.php?page=create_user">Create new user</a>


<?php
if(isset($_GET['logout']))
{
	if (mysqli_real_escape_string(connect(), $_GET['logout']==1))
	{
		unset($_SESSION['username']);
		unset($_SESSION['privileges']);
		session_destroy();
		echo '<meta http-equiv="REFRESH" content="0;url=index.php?page=front">';
	}	
}
?>