<?php

define('IN_MAINTENANCE', true);
define('OVERRIDE_LOCK', true);

require_once "global.php";

$shit = dbquery("SELECT shit,username FROM uberdown LIMIT 5");

while ($shitty = mysql_fetch_assoc($shit))
{
	echo $shitty['username'] . ': ' . clean($shitty['shit']) . chr(13) . chr(13);
}

?>