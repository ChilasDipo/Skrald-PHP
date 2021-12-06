<?php
if (check_login($_SESSION['ID'],$_SESSION['user'])) {
	echo '<h1>Your sensors</h1>';
	
	//get a list of users sensors
	$q="SELECT * FROM `".$GLOBALS['prefix']."sensors` WHERE `ownerID`='".$_SESSION['ID']."'";
	$r=mysqli_query(connect(), $q);
	
	function createSensor()
	{
		echo 'Create new sensor:';
		echo '<form action="include/sensorCreate.php" method="POST">';
		echo '<input type="hidden" ownerID="ID" value="'.$_SESSION['ID'].'" 	><br />';
		echo 'Name:&nbsp;&nbsp;<input type="text" name="name">';
		
		
		//get a list of sensortypes
		$q1="SELECT * FROM `".$GLOBALS['prefix']."sensortype` ORDER BY `ID` ASC";
		echo '&nbsp;&nbsp;Type: <select name="sensortype">';
		$r1=mysqli_query(connect(), $q1);
		while ($row1 = mysqli_fetch_assoc($r1))
		{
		    echo '<option value="'.$row1['ID'].'">'.$row1['name'].'</option>';
		}
		
		echo '</select>&nbsp;&nbsp;';
		echo '<input type="submit" value="Create" size="4"></form>';
	}
	
	if(mysqli_num_rows($r)==0)	//no rows returned
	{
		echo 'You don\'t have any sensors yet. Create one!';
		createSensor();
	}
	else	//user have sensors - show them
	{
		createSensor();
		echo '<table align="center" border="1">';
		echo '<tr><td width="150" align="center"><b>Navn</b></td><td width="450" align="center"><b>API key</b></td><td align="center"><b>Type</b></td><td align="center"><b>Details</b></td></tr>';
		while ($row = mysqli_fetch_assoc($r))
		{
			echo '<tr padding="10">';
			echo '<td align="center">'.$row['name'].'</td>';
			echo '<td align="center">'.$row['address'].'</td>';
			echo '<td align="center">'.$row['sensorType'].'</td>';
			echo '<td align="center"><a href="index.php?page=auth/sensorDetail&sensorID='.$row['ID'].'">Data</a></td>';
			echo '</tr>';
		}			
		echo '</table>';
	}
} 
else
{echo 'Du har ikke adgang til denne side. ';}
?>