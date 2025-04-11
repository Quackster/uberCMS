<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_admin'))
{
	exit;
}

$maintMode = mysql_result(dbquery("SELECT maintenance FROM site_config LIMIT 1"), 0);

if (isset($_GET['switch']))
{
	$newState = "1";

	if ($maintMode == "1")
	{
		$newState = "0";
	}
	
	dbquery("UPDATE site_config SET maintenance = '" . $newState . "' LIMIT 1");
	$maintMode = $newState;
}

require_once "top.php";

?>			

<h1>Maintenance Mode</h1>

<br />

<p>
	 Maintenance mode can be used to disable the site and effectively prevent new logins to the server. Please note that any users still connected to the server or have a login session generated for them, will still be able to use the server until they are disconnected or it reboots.
</p>

<h2>
<?php

if ($maintMode == "1")
{
	echo '<span style="font-size: 120%; color: darkred;">Maintenance mode is currently ENABLED. Site is not accessible to regular users.</span><br /><input type="button" value="Restore site, disable maintenance" onclick="document.location = \'index.php?_cmd=maint&switch\';">';
}
else
{
	echo 'Maintenance mode is currently disabled.<br /><input type="button" value="Enable maintenance" onclick="document.location = \'index.php?_cmd=maint&switch\';" style="color: darkred; font-weight: bold;">';
}

?>
</h2>

<?php

require_once "bottom.php";

?>