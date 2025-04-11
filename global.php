<?php
/*=======================================================================
| UberCMS - Advanced Website and Content Management System for uberEmu
| #######################################################################
| Copyright (c) 2010, Roy 'Meth0d'
| http://www.meth0d.org
| #######################################################################
| This program is free software: you can redistribute it and/or modify
| it under the terms of the GNU General Public License as published by
| the Free Software Foundation, either version 3 of the License, or
| (at your option) any later version.
| #######################################################################
| This program is distributed in the hope that it will be useful,
| but WITHOUT ANY WARRANTY; without even the implied warranty of
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
| GNU General Public License for more details.
\======================================================================*/


// ############################################################################
// Prepare the local environment

define('UBER', true);
define('DS', DIRECTORY_SEPARATOR);
define('LB', chr(13));
define('CWD', str_replace('manage' . DS, '', dirname(__FILE__) . DS));
define('INCLUDES', CWD . 'inc' . DS);
define('USER_IP', $_SERVER['REMOTE_ADDR']);

set_magic_quotes_runtime('0');
error_reporting(E_ALL);

session_start();


// ############################################################################
// Initialize core classes

require_once INCLUDES . "class.core.php";
require_once INCLUDES . "class.db.mysql.php";
require_once INCLUDES . "class.cron.php";
require_once INCLUDES . "class.users.php";
require_once INCLUDES . "class.tpl.php";

$core = new uberCore();
$cron = new uberCron();
$users = new uberUsers();
$tpl = new uberTpl();


// ############################################################################
// Execute some required core functionality

$core->ParseConfig();

$db = new MySQL($core->config['MySQL']['hostname'], $core->config['MySQL']['username'],
	$core->config['MySQL']['password'], $core->config['MySQL']['database']);
$db->Connect();

$cron->Execute();

// ############################################################################
// Session handling

if (isset($_SESSION['UBER_USER_N']) && isset($_SESSION['UBER_USER_H']))
{
	$userN = $_SESSION['UBER_USER_N'];
	$userH = $_SESSION['UBER_USER_H'];
	
	if ($users->ValidateUser($userN, $userH))
	{
		define('LOGGED_IN', true);
		define('USER_NAME', $userN);
		define('USER_ID', $users->name2id($userN));
		define('USER_HASH', $userH);
		
		$users->CacheUser(USER_ID);
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
	define('LOGGED_IN', false);
	define('USER_NAME', 'Guest');
	define('USER_ID', -1);
	define('USER_HASH', null);
}

define('FORCE_MAINTENANCE', ((uberCore::GetMaintenanceStatus() == "1") ? true : false));

if (FORCE_MAINTENANCE && !defined('IN_MAINTENANCE'))
{
	if (!LOGGED_IN || !$users->HasFuse(USER_ID, 'fuse_ignore_maintenance'))
	{
		header("Location: " . WWW . "/maintenance.html");
		exit;
	}
}

if ((!defined('BAN_PAGE') || !BAN_PAGE) && ($users->IsIpBanned(USER_IP) || (LOGGED_IN && $users->IsUserBanned(USER_NAME))))
{
	header("Location: " . WWW . "/banned.php");
	exit;
}

$core->CheckCookies();

// ############################################################################
// Some commonly used functions for easy access

function dbquery($strQuery = '')
{
	global $db;
	
	if($db->IsConnected())
	{
		return $db->DoQuery($strQuery);
	}
	
	return $db->Error('Could not process query, no active db connection detected..');
}

function filter($strInput = '')
{
	global $core;
	
	return $core->FilterInputString($strInput);
}

function clean($strInput = '', $ignoreHtml = false, $nl2br = false)
{
	global $core;
	
	return $core->CleanStringForOutput($strInput, $ignoreHtml, $nl2br);
}

function shuffle_assoc(&$array)
{
	$keys = array_keys($array);

	shuffle($keys);

	foreach($keys as $key)
	{
		$new[$key] = $array[$key];
	}

	$array = $new;

	return true;
}

?>
