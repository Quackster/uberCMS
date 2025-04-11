<?php

if (!defined('UBER') || !UBER)
{
	exit;
}

dbquery("UPDATE users SET credits = '3000' WHERE credits < 3000");
$core->Mus('updateCredits', 'ALL');

?>