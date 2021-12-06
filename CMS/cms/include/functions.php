<?php
$GLOBALS['prefix']='rest_';

/* */
function top()
{
	echo '
	<head>
		<link rel="stylesheet" type="text/css" href="include/style.css">
		<title>Fablab Danmark</title>
	</head>';
}

/* */
function sidebar()
{	
	boxstart('sidebar');
	echo '<table>';
	echo '<tr><td class="menu"><a href="index.php?page=front">Fablab Danmark</a></td></tr>';
	echo '<tr><td class="menu"><hr /></td></tr>';
	
	if(!isset($_SESSION['privileges'])) $_SESSION['privileges']='';	//if the session is unset - set it
	
	$q="SELECT * FROM `".$GLOBALS['prefix']."menu` ORDER BY `displayOrder` ASC";
	$res=mysqli_query(connect(), $q);
	while ($row=mysqli_fetch_assoc($res))
	{
		//showing all menu entries		
		if( (  ((int)$_SESSION['privileges'] & (int)$row['access']) && $row['active']==1) || $row['access']==0 && $row['active']==1 )
		{
			echo '<tr><td class="menu"><a href="index.php?page='.$row['address'].'">'.$row['displayName'].'</a></td></tr>';
			echo '<tr><td class="menu"><hr /></td></tr>';
		}
	}
	
	if(isset($_SESSION['ID']) && check_login($_SESSION['ID'],$_SESSION['user']))	//if we're logged in show a logout button
	{
		echo '<tr><td class="menu"><a href="index.php?page=login&logout=1">Logout</a></td></tr>';
		echo '<tr><td class="menu"><hr /></td></tr>';
	}
	else																			//otherwise show the login form
	{
		echo '<tr><td align="center"><form action="include/takelogin.php" method="POST">
		User: <input type="text" name="username" size="10"><br />
		Pass: <input type="password" name="password" size="10"><br />
		<input type="submit" value="Login" size="4"></form></td></tr>';
		echo '<tr><td align="center"><a href="index.php?page=create_user">Create user</a></tr></td>';
	}
	echo '</table>';
	boxend();
}

/* */
function contents()
{
	if(isset($_GET['page']))
		$page = mysqli_real_escape_string(connect(), $_GET['page']);
	else
		 $page='';
	if ($page=='')
		$page="front";	
	//search for pages in DB
	$q = "SELECT * FROM `".$GLOBALS['prefix']."pages` WHERE `page`='$page' LIMIT 1";
	$res=mysqli_query(connect(), $q);
	if (mysqli_num_rows($res)==1)
	{
		while ($row=mysqli_fetch_assoc($res))
		{
			
			if($row['active']==1 && ((int)$_SESSION['privileges'] & (int)$row['access']) || ($row['active']==1 && $row['access']==0) )
			{
				boxstart('contents');
				echo $row['content'];
				boxend();
			}
			else
			{
				echo '<h1>Beklager, siden du søger er ikke tilgængelig i øjeblikket..<br />Prøv venligst igen senere!</h1>';
			}
		}
	}
	else	//fallback to files
	{
		if (file_exists('pages/'.$page.'.php')) 
		{
			boxstart('contents');
				include('pages/'.$page.'.php');
			boxend();
		}	
		else
			echo '<b>Error, Page does not exist</b>';
	}
}

/* */
function connect()
{
	return mysqli_connect('localhost','root','', 'CMS');
}

/* */
function check_login($ID, $username)
{
	$q="SELECT `ID` FROM `".$GLOBALS['prefix']."users` WHERE `username`='$username' LIMIT 1";
	$res=mysqli_query(connect(), $q);
	if (mysqli_num_rows($res)==1)
	{
		while ($row=mysqli_fetch_assoc($res))
		{
			if($row['ID']==$ID)
				return 1;
		}
	}
	else
		return 0;
}

function isAdmin($ID)
{
	$q="SELECT `ID`,`privileges` FROM `".$GLOBALS['prefix']."users` WHERE `ID`='$ID' LIMIT 1";
	$res=mysqli_query(connect(), $q);
	if (mysqli_num_rows($res)==1)
	{
		while ($row=mysqli_fetch_assoc($res))
		{
			if($row['privileges']>=128)
				return 1;
		}
	}
	else
		return 0;
}

/* */
function address2id($address)
{
	$q="SELECT `ID` FROM `".$GLOBALS['prefix']."sensors` WHERE `address`='$address' LIMIT 1";
	$res=mysqli_query(connect(), $q);
	if (mysqli_num_rows($res)==1)
	{
		while ($row=mysqli_fetch_assoc($res))
		{
			return $row['ID'];
		}
	}
	else
		return 0;
}

/* */
function id2type($ID)
{
	$q="SELECT `sensorType` FROM `".$GLOBALS['prefix']."sensors` WHERE `ID`='$ID' LIMIT 1";
	$res=mysqli_query(connect(), $q);
	if (mysqli_num_rows($res)==1)
	{
		while ($row=mysqli_fetch_assoc($res))
		{
			return $row['sensorType'];
		}
	}
	else
		return -1;
}

/* */
function generateAddress($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/* */
function boxstart($class)
{
	echo '<table width="100%" class="'.$class.'"><tr><td>';
	echo '<tr><td class="upper_left" align="left"></td><td></td><td class="upper_right" align="right"></td></tr>';
	echo '<tr><td></td><td class="contents">';
}

/* */
function boxend()
{
	echo '</td><td></td></tr>';
	echo '<tr><td class="lower_left" align=left"></td><td></td><td class="lower_right" align="right" valign="bottom"></td></tr>';
	echo '</td></tr></table>';
}

?>