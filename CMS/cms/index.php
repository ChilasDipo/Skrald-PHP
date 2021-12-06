<?php
	include 'include/functions.php';
	session_start();
?>

<html>

<?php top(); ?>

<body>

<table class="site" align="center">
	<tr>
		<td class="banner" align="left" colspan="2"></td>
	</tr>
	<tr>
		<td><br /></td>
	</tr>
	<tr>
		<td valign="top"><?php sidebar(); ?></td>
		<td valign="top"><?php contents(); ?></td>
	</tr>
</table>
</body>
</html>