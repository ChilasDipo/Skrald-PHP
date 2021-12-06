<?php
if (check_login($_SESSION['ID'],$_SESSION['user'])) {
	?>

	<h2>Adminstration:</h2>
	Hvad vil du:<br /><br /><br />
	<table width="100%">
		<tr>
			<td><a href="index.php?page=auth/admin/users_admin">Bruger-administration</a></td>
		</tr>
	</table>
		
	<?php
} 
else
{echo 'Du har ikke adgang til denne side. ';}
?>