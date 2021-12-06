<?php
	$status = mysqli_real_escape_string(connect(),$_GET['status']);
	
	if ($status==1)
	{
		echo '<h2>Account created - Please check your email for activation link</h2>';
	}
	else
	{
		if($status==2)
		{
			echo '<h2>Error - Password don\'t match</h2>';
		}
		if($status==3)
		{
			echo '<h2>Error - Username already taken</h2>';
		}
		echo '<h2>Enter your profile information here:</h2><br/>';
		
		echo '<form action="include/profile_create.php" method="POST">';
		
		echo '<table align="center">';
		echo '<tr><td>Username&nbsp;&nbsp;</td><td><input type="text" name="username"></td></tr>';
		echo '<tr><td>First name&nbsp;&nbsp;</td><td><input type="text" name="firstName"></td></tr>';
		echo '<tr><td>Last name&nbsp;&nbsp;</td><td><input type="text" name="lastName"></td></tr>';
		echo '<tr><td>Phone&nbsp;&nbsp;</td><td><input type="text" name="phone"></td></tr>';
		echo '<tr><td>email&nbsp;&nbsp;</td><td><input type="text" name="mail"></td></tr>';
		echo '<tr><td colspan="2"><hr /></td></tr>';
		echo '<tr><td>password&nbsp;&nbsp;</td><td><input type="password" name="pw1"></td></tr>';
		echo '<tr><td>password, again&nbsp;&nbsp;</td><td><input type="password" name="pw2"></td></tr>';
		echo '<tr><td colspan="2"><input type="submit" value="Create user!" size="4"></form></td></tr>';
		echo '</table>';
	}
	

?>