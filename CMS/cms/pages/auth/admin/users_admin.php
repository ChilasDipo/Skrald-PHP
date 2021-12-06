<?php
if (check_login($_SESSION['ID'],$_SESSION['user'])) {

	$q="SELECT * FROM `".$GLOBALS['prefix']."users` ORDER BY `firstName` ASC, `active` DESC";
	$r=mysqli_query(connect(), $q);
	echo '<a href="index.php?page=auth/admin/admin">Tilbage til adminstration</a>';
	echo '<h2>Alle brugere:</h2>';
	
	if(isset($_GET['update']) && mysqli_real_escape_string(connect(),$_GET['update'])==1)
		echo 'Privileges has been updated!';
	else if(isset($_GET['update']) && mysqli_real_escape_string(connect(),$_GET['update'])==2)
		echo 'User has been deactivated!';
	else if(isset($_GET['update']) && mysqli_real_escape_string(connect(),$_GET['update'])==3)
		echo 'User has been activated!';
	
	echo '<table width="100%" border="0"><tr><td><b>Fornavn</b></td><td><b>Efternavn</b></td><td><b>Mail</b></td><td><b>Privilegier</b></td></tr>';
	echo '<tr><td colspan="8"><hr /></td></tr>';
	while ($row = mysqli_fetch_assoc($r))
	{
		if($row['active']==0)
		{
			echo '<tr bgcolor="#666666">';
		}
		else if($row['active']==2)
		{
			echo '<tr bgcolor="#BBBBBB">';
		}
		else
		{
			echo '<tr>';
		}
		echo '<td>'.$row['firstName'].'</td>';
		echo '<td>'.$row['lastName'].'</td>';
		echo '<td>'.$row['mail'].'</td>';
		echo '<td><form action="include/admin_privilege_update.php" method="POST" style="display: inline;">';
		echo '<input type="hidden" name="ID" value="'.$row['ID'].'">';
		echo '<input type="text" name="privileges" size="4" value="'.$row['privileges'].'">';
		echo '<input type="submit" value="Opdater" size="4" style="display: inline;"></form>';
		
		//if user is deactivated show an activate button here
		if($row['active']==0 || $row['active']==2)
		{
			echo '<form action="include/admin_user_activate.php" method="POST" style="display: inline;">';
			echo '<input type="hidden" name="ID" value="'.$row['ID'].'">';
			echo '<input type="submit" value="Aktiver" size="4" style="display: inline;"></form>';
		}
		else	//else - show a deactivation button
		{
			echo '<form action="include/admin_user_deactivate.php" method="POST">';
			echo '<input type="hidden" name="ID" value="'.$row['ID'].'">';
			echo '<input type="submit" value="Deaktiver" size="4" style="display: inline;"></form>';
		}
		
		echo '</td></tr>';
		echo '<tr><td colspan="8"><hr /></td></tr>';
	}
	echo '</table>';
	
	echo '
	privileges:<br />
	1: user, 2: Super-user, 128: site admin<br /><br />
	Privileges are non-inclusive meaning that to be user AND  super-user the privilege level should be \'3\' since 1 + 2 is.. you know.. 3..<br />
	';
	echo '<hr />';
} 
else
{echo 'Du har ikke adgang til denne side. ';}
?>