<?php
if (check_login($_SESSION['ID'],$_SESSION['user'])) {
	echo '<h1>Fablab Danmark</h1>';
	echo 'Velkommen!';
} 
else
{echo 'Du har ikke adgang til denne side. ';}
?>