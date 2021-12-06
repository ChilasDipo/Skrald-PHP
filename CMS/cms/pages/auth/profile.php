<?php
if (check_login($_SESSION['ID'],$_SESSION['user'])) {

	$q="SELECT * FROM `".$GLOBALS['prefix']."users` WHERE `ID`='".$_SESSION['ID']."' LIMIT 1";
	
	$r=mysqli_query(connect(), $q);
	
	echo '<h2>Rediger dine oplysninger :</h2><br/>';
	if(isset($_GET['update']) && mysqli_real_escape_string(connect(),$_GET['update'])==1)
		echo 'Oplysninger opdateret!';
	
	while ($row = mysqli_fetch_assoc($r))
	{
		echo '<form action="include/profile_update.php" method="POST">';
		echo '<input type="hidden" name="ID" value="'.$row['ID'].'" 	><br />';
		echo '<table align="center">';
		echo '<tr><td>Brugernavn&nbsp;&nbsp;</td><td><input type="text" name="username" value="'.$row['username'].'" disabled>
		<input type="hidden" name="username" value="'.$row['username'].'"></td></tr>';
		echo '<tr><td>Fornavn&nbsp;&nbsp;</td><td><input type="text" name="firstName" value="'.$row['firstName'].'"></td></tr>';
		echo '<tr><td>Efternavn&nbsp;&nbsp;</td><td><input type="text" name="lastName" value="'.$row['lastName'].'"></td></tr>';
		echo '<tr><td>Email&nbsp;&nbsp;</td><td><input type="text" name="mail" value="'.$row['mail'].'"></td></tr>';
		echo '<tr><td><input type="submit" value="Update" size="4"></form></td></tr>';
		echo '</table>';		
	}
	echo '<hr />';	
} 
else
{echo 'Du har ikke adgang til denne side. ';}
?>