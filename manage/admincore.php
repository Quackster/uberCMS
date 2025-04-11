<?php
/*=======================================================================
| UberWeb - Lightweight site system for Uber
| #######################################################################
| Copyright (c) 2009, Roy 'Meth0d'
| http://www.meth0d.org
| #######################################################################
| This program is free software: you can redistribute it and/or modify
| it under the terms of the GNU General Public License as published by
| the Free Software Foundation, either version 3 of the License, or
| (at your option) any later version.
| #######################################################################
| This program is distributed in the hope that it will be useful,
| but WITHOUT ANY WARRANTY; without even the implied warranty of
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
| GNU General Public License for more details.
\======================================================================*/

define('IN_HK', true);
define('HK_WWW', WWW . '/manage');

function fMessage($type, $message)
{
	if (isset($_SESSION['fmsg']))
	{
		return;
	}
	
	$_SESSION['fmsg_type'] = $type;
	$_SESSION['fmsg'] = $message;
}

if (isset($_SESSION['UBER_HK_USER_N']) && isset($_SESSION['UBER_HK_USER_H']))
{
	$userN = $_SESSION['UBER_HK_USER_N'];
	$userH = $_SESSION['UBER_HK_USER_H'];
	
	if ($users->validateUser($userN, $userH))
	{
		define('HK_LOGGED_IN', true);
		define('HK_USER_NAME', $userN);
		define('HK_USER_ID', $users->name2id($userN));
		define('HK_USER_HASH', $userH);
	}
	else
	{
		@session_destroy();
		header('Location: ./index.html');
		exit;
	}	
}
else
{
	define('HK_LOGGED_IN', false);
	define('HK_USER_NAME', 'Guest');
	define('HK_USER_ID', -1);
	define('HK_USER_HASH', null);
}

?>