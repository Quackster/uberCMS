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

define('BAN_PAGE', true);

require_once "global.php";

$ban = null;

if (uberUsers::IsIpBanned(USER_IP))
{
	$ban = uberUsers::GetBan('ip', USER_IP, true);
}

if (LOGGED_IN && uberUsers::IsUserBanned(USER_NAME))
{
	$ban = uberUsers::GetBan('user', USER_NAME, true);
}

if ($ban == null)
{
	header("Location: " . WWW . "/");
	exit;
}

$tpl->Init();

$tpl->AddGeneric('head-init');
$tpl->AddIncludeSet('process-template');
$tpl->WriteIncludeFiles();
$tpl->AddGeneric('head-overrides-process');
$tpl->AddGeneric('head-bottom');
$tpl->AddGeneric('process-template-top');

$tpl->Write('<h2>You are banned! ' . (LOGGED_IN ? '<small style="font-weight: normal; font-size: 60%;">(<a href="%www%/logout.html">Log out</a>)</small>' : '') . '</h2>');
$tpl->Write('<img align="right" src="%www%/images/banned.php">');
$tpl->Write('<p>You have been banned from uberHotel for the following reason:</p>');
$tpl->Write('<p style="margin-top: 5px; margin-bottom: 5px; font-size: 110%;"><b>' . clean($ban['reason'], false, true) . '</b></p>');
$tpl->Write('<p>Your ban was filed on <b>' . $ban['added_date'] . '</b> and expires on <b>' . date('d F, Y', $ban['expire']) . '</b> which is <b>' . ceil(($ban['expire'] - time()) / 86400) . '</b> days from now.</p>');
$tpl->Write('<p>According to our server, your IP is <b>' . USER_IP . '</b>. ' . (($ban['bantype'] == 'user') ? 'The name associated with this ban is <b>' . clean($ban['value']) . '</b>.' : 'There is no name associated with this ban.') . '</p>');

if ($ban['appeal_state'] == "1" && ($ban['expire'] - time()) >= 259200)
{
	$tpl->Write('Because your ban is longer than 3 days in length, you may appeal the ban using the form below. Please explain why you believe you deserve to be unbanned. Rude, poorly written, or offensive appeals will be declined. Submission of an appeal does not guarentee nor does it imply that your ban will be lifted prior to its listed expiration date. E-mail address is optional, however if you do not provide one, we will be unable to contact you with questions and/or updates.');
}
else if ($ban['appeal_state'] == "1")
{
	$tpl->Write('Because your ban will expire within 3 days, you may not appeal this ban.');
}
else if ($ban['appeal_state'] == "0")
{
	$tpl->Write('<b style="color: darkred;">This ban is final and you are not permitted to submit an appeal against it.</b>');
}
else if ($ban['appeal_state'] == "2")
{
	$tpl->Write('<b style="color: darkred;">Your appeal has been reviewed and declined. You may not appeal this ban again.</b>');
}

if ($ban['appeal_state'] == "1" && ($ban['expire'] - time()) >= 259200)
{				
	$tpl->Write('<h2>Appeal ban</h2>
	<form method="post" id="appealform" style="width: 60%;">');
					
	if (isset($_POST['appeal-plea']))
	{			
		$mail = filter($_POST['appeal-email']);
		$plea = filter($_POST['appeal-plea']);
		
		if (strlen($plea) >= 1)
		{
			dbquery("UPDATE bans_appeals SET send_ip = '" . USER_IP . "', send_date = '" . date('d F, Y') . "', mail = '" . $mail . "', plea = '" . $plea . "' WHERE ban_id = '" . $ban['id'] . "' LIMIT 1");
		}
	}

	$query = dbquery("SELECT * FROM bans_appeals WHERE ban_id = '" . intval($ban['id']) . "' LIMIT 1");

	if (mysql_num_rows($query) <= 0)
	{
		dbquery("INSERT INTO bans_appeals (ban_id) VALUES ('" . intval($ban['id']) . "')");
	}			

	$adata = mysql_fetch_assoc($query);				

	if (strlen($adata['plea']))
	{
		$tpl->Write('<b style="color: darkred;">Thank you. Your appeal has been submitted and will be reviewed by a staff member soon. While waiting for reviewal you may make modifications if you please.</b>');
	}
					
	$tpl->Write('<p>
	<table width="100%">
	<tr>
		<td valign="middle">
			<b>E-Mail address</b>
		</td>
		<td valign="middle">
			<input name="appeal-email" type="text" size="43" value="' . clean($adata['mail']) . '">
		</td>
	</tr>
	<tr>
		<td valign="middle">
			<b>Plea</b>
		</td>
		<td valign="middle">
			<textarea name="appeal-plea" cols="43" rows="4">' . clean($adata['plea']) . '</textarea>
		</td>
	</tr>
	<tr>
		<td valign="middle">
			&nbsp;
		</td>
		<td valign="middle">
			<br />
			<a href="#" onclick="document.getElementById(\'appealform\').submit(); return false" class="pretty-button">
				Submit appeal
			</a>
		</td>
	</tr>
	</table>
	</p>');
}

$tpl->AddGeneric('process-template-bottom');
$tpl->AddGeneric('footer');

$tpl->SetParam('page_title', 'Home');

$tpl->Output();

?>