<?php

if (!defined('UBER') || !UBER)
{
	exit;
}

dbquery("UPDATE users SET daily_respect_points = '3'");

?>