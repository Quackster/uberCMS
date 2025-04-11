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

require_once "global.php";

if (!LOGGED_IN)
{
	exit;
}

$cmd = '';

if (isset($_GET['cmd']))
{
	$cmd = $_GET['cmd'];
}

switch (strtolower($cmd))
{
	case "tag/remove":
	
		if (isset($_POST['tagId']) && isset($_POST['accountId']))
		{
			$tagId = intval($_POST['tagId']);
			dbquery("DELETE FROM user_tags WHERE user_id = '" . USER_ID . "' AND id = '" . $tagId . "' LIMIT 1");
			$core->Mus('updateTags', USER_ID);
		}
	
		break;
		
	case "tag/add":	
	
		if (isset($_POST['tagName']) && isset($_POST['accountId']))
		{
			$tagName = strtolower(filter(uberCore::FilterSpecialChars($_POST['tagName'])));
			
			if (!preg_match('#^[a-z0-9\s]+$#i', $tagName) || strlen($tagName) <= 0 || strlen($tagName) > 20)
			{
				die("invalidtag");
			}
			else if (count(uberUsers::GetUserTags(USER_ID)) >= 20)
			{
				die("limitreached");
			}
			else if (intval(mysql_result(dbquery("SELECT COUNT(*) FROM user_tags WHERE tag = '" . $tagName . "' AND user_id = '" . USER_ID . "'"), 0)) >= 1)
			{
				die("exists");
			}
			else
			{
				dbquery("INSERT INTO user_tags (tag,user_id) VALUES ('" . $tagName . "','" . USER_ID . "')");
				$core->Mus('updateTags', USER_ID);
			}
		}	
	
		break;
}
	
?>