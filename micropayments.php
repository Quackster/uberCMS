<?php

define('IN_MAINTENANCE', true);
define('OVERRIDE_LOCK', true);

require_once "global.php";

// Define basics
$requestUserId = 0;
$requestUserName = 'Not submitted';
$requestOrderId = 0;
$remoteIp = $_SERVER['REMOTE_ADDR'];

// Fill in some data from req if we got it
if (isset($_GET['betaalcode'])) { $requestOrderId = filter($_GET['betaalcode']); }
if (isset($_GET['parameter'][1])) { $requestUserId = filter($_GET['parameter'][1]); }
if (isset($_GET['parameter'][2])) { $requestUserName = filter($_GET['parameter'][2]); }

// Collect full request string for debugging/authenticy purposes
$dataString = '-------------------------------------------' . LB;
$dataString .= '[ GET DATA ] ' . LB;
$dataString .= '-------------------------------------------' . LB;
foreach ($_GET as $key => $value) { $dataString .= $key . ' = ' . $value . LB; }
$dataString .= LB . '-------------------------------------------' . LB;
$dataString .= '[ POST DATA ] ' . LB;
$dataString .= '-------------------------------------------' . LB;
foreach ($_POST as $key => $value) { $dataString .= $key . ' = ' . $value . LB; }
$dataString .= LB . '-------------------------------------------' . LB;
$dataString .= '[ SERVER DATA ] ' . LB;
$dataString .= '-------------------------------------------' . LB;
foreach ($_SERVER as $key => $value) { $dataString .= $key . ' = ' . $value . LB; }
$dataString .= LB . '-------------------------------------------' . LB;

// Log this request
dbquery("INSERT INTO micropayments (date,remote_ip,user_id,user_name,order_id,request_data,status) VALUES ('" . date(DATE_RFC822) . "','" . $remoteIp . "','" . $requestUserId . "','" . $requestUserName . "','" . $requestOrderId . "','" . filter($dataString) . "','0')");

// See if this request is valid
if ($remoteIp != "82.94.203.80" && $remoteIp != "82.94.203.81" && $remoteIp != "82.94.203.82" && $remoteIp != "::1" &&
$remoteIp != "82.94.203.83" && $remoteIp != "82.94.203.84" && $remoteIp != "82.94.203.85" && $remoteIp != "82.94.203.86")
{	
	die("NOTOK/x0010");
}

if ($requestUserId <= 0 || $requestOrderId <= 0 || $requestUserName == 'Not submitted')
{
	die("NOTOK/x0020");
}

$value = 0;

switch (intval($requestOrderId))
{
	case '779905': // Test Payment, 5 cents
	
		$value = 1;
		break;
		
	case '779785':
	
		$value = 10;
		break;

	case '779765':
	
		$value = 25;
		break;

	case '779805':
	
		$value = 50;
		break;

	case '779815':
	
		$value = 100;
		break;		
}

if ($value < 1)
{
	die("NOTOK/x0030");
}

die($dataString);

?>