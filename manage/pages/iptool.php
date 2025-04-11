<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_moderation'))
{
	exit;
}

$ip = '';

if (isset($_POST['ip'])) { $ip = filter($_POST['ip']); }

require_once "top.php";			

echo '<h1>IP Lookup / Clone Checker</h1>
<br /><p>This tool can be used for looking up a user\'s IP, particulary useful when you need to ban a person or computer rather than just accounts.</p>';

echo '<br />
<form method="post">
Username:<br />
<input type="text" name="user"><Br />
<input type="submit" value="Lookup">
</form>';

echo '<br />
<form method="post">
IP Address:<br />
<input type="text" name="ip"><Br />
<input type="submit" value="Lookup">
</form>';

if (isset($_POST['user']))
{
	$user = filter($_POST['user']);
	$get = dbquery("SELECT ip_last FROM users WHERE username = '" . $user . "' LIMIT 1");
	
	if (mysql_num_rows($get) > 0)
	{
		$ip = mysql_result($get, 0);
	}
	
	echo '<h2>' . $user . '\'s IP is<br /><b style="font-size: 150%;">' . $ip . '</b></h2>';
}

if (isset($ip) && strlen($ip) > 0)
{
	echo '<h2 style="font-size: 140%;">Users on this IP: ' . $ip . '</h2>';
	$get = dbquery("SELECT * FROM users WHERE ip_last = '" . $ip . "' LIMIT 50");
	
	while ($user = mysql_fetch_assoc($get))
	{
		echo '<h2 style="width: 50%;"><B>' . clean($user['username']) . '</B> <Small>(ID: ' . $user['id'] . ')</small><br /><span style="font-weight: normal;">Last online: ' . $user['last_online'] . '<br />E-mail: ' . $user['mail'] . '<br />This user is <b>' . (($user['online'] == "1") ? 'online!' : 'offline') . '</b></span></h2>';
	}
}

require_once "bottom.php";

?>