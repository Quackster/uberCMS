<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_admin'))
{
	exit;
}

$popClient = '';

if (isset($_POST['username']))
{
	$username = filter($_POST['username']);
	$get = dbquery("SELECT id FROM users WHERE username = '" . $username . "' LIMIT 1");
	
	if (mysql_num_rows($get) == 1)
	{
		$id = intval(mysql_result($get, 0));
		$ticket = $core->GenerateTicket();
		
		dbquery("UPDATE users SET auth_ticket = '" . $ticket . "' WHERE id = '" . $id . "' LIMIT 1");
		$core->Mus('signOut', $id);
		$popClient = $ticket;
		
		fMessage('ok', 'Creating temporary SSO ticket.');
	}
	else
	{
		fMessage('error', 'Could not locate that user.');
	}
}

require_once "top.php";			

echo '<h1>External user sign on</h1>';

if ($popClient != '')
{
	echo "<input type=\"button\" onclick=\"popSsoClient('" . $popClient . "'); window.location = 'index.php?_cmd=extsignon'\" value=\"Ticket created - click here to log in as " . $username . "\" style=\"margin: 20px; font-size: 150%;\">";
	echo '<input type="button" value="Done" onclick="window.location = \'index.php?_cmd=extsignon\';">';
}
else
{
	echo '<br /><p>This tool allows hotel managament to sign in to the hotel with another account. This may be useful for high level moderation, debugging, and/or supporting users.</p><br />';
	echo '<form method="post">
	Username: <input type="text" name="username" value=""><input type="submit" value="Sign in">
	</form>';
}

require_once "bottom.php";

?>