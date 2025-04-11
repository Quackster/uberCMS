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

class uberUsers
{
	/**************************************************************************************************/
	
	private $userCache = Array();

	/**************************************************************************************************/

	private $blockedNames = Array('roy', 'meth0d', 'method', 'graph1x', 'graphix', 'admin', 'administrator',
		'mod', 'moderator', 'guest', 'undefined');
	private $blockedNameParts = Array('moderate', 'staff', 'manage', 'system', 'admin', 'uber');
	
	/**************************************************************************************************/
	
	public function IsValidEmail($email = '')
	{
		return preg_match("/^[a-z0-9_\.-]+@([a-z0-9]+([\-]+[a-z0-9]+)*\.)+[a-z]{2,7}$/i", $email);
	}
	
	public function IsValidName($nm = '')
	{
		if (preg_match('/^[a-z0-9]+$/i', $nm) && strlen($nm) >= 1 && strlen($nm) <= 32)
		{
			return true;
		}
		
		return false;
	}
	
	public function IsNameTaken($nm = '')
	{
		return ((mysql_num_rows(dbquery("SELECT null FROM users WHERE username = '" . $nm . "' LIMIT 1")) > 0) ? true : false);
	}
	
	public function IdExists($id = 0)
	{
		return ((mysql_num_rows(dbquery("SELECT null FROM users WHERE id = '" . $id . "' LIMIT 1")) > 0) ? true : false);
	}
	
	public function IsNameBlocked($nm = '')
	{	
		foreach ($this->blockedNames as $bl)
		{
			if (strtolower($nm) == strtolower($bl))
			{
				return true;
			}
		}
		
		foreach ($this->blockedNameParts as $bl)
		{
			if (strpos(strtolower($nm), strtolower($bl)) !== false)
			{
				return true;
			}
		}
		
		return false;
	}	
	
	/**************************************************************************************************/
	
	function Add($username = '', $passwordHash = '', $email = 'default@localhost', $rank = 1, $figure = '', $sex = 'M')
	{
		dbquery("INSERT INTO users (username,password,mail,auth_ticket,rank,look,gender,motto,credits,activity_points,last_online,account_created) VALUES ('" . $username . "','" . $passwordHash . "','" . $email . "','','" . $rank . "','" . $figure . "','" . $sex . "','','500','1000','','" . date('d-M-Y') . "')");		
		$id = intval(mysql_result(dbquery("SELECT id FROM users WHERE username = '" . $username . "' ORDER BY id DESC LIMIT 1"), 0));
		dbquery("INSERT INTO user_info (user_id,bans,cautions,reg_timestamp,login_timestamp,cfhs,cfhs_abusive) VALUES ('" . $id . "','0','0','" . time(). "','" . time() . "','0','0')");
		return $id;
	}
	
	function Delete($id)
	{
		dbquery("DELETE FROM messenger_friendships WHERE user_one_id = '" . $id . "' OR user_two_id = '" . $id . "'");
		dbquery("DELETE FROM messenger_requests WHERE to_id = '" . $id . "' OR from_id = '" . $id . "'");
		dbquery("DELETE FROM users WHERE id = '" . $id . "' LIMIT 1");
		dbquery("DELETE FROM user_subscriptions WHERE user_id = '" . $id . "'");
		dbquery("DELETE FROM user_info WHERE user_id = '" . $id . "' LIMIT 1");
		dbquery("DELETE FROM user_items WHERE user_id = '" . $id . "'");
	}
	
	/**************************************************************************************************/
	
	function ValidateUser($username, $password)
	{
		return mysql_num_rows(dbquery("SELECT null FROM users WHERE username = '" . $username . "' AND password = '" . $password. "' LIMIT 1"));
	}
	
	/**************************************************************************************************/
	
	function Name2id($username = '')
	{
		return @intval(mysql_result(dbquery("SELECT id FROM users WHERE username = '" . $username . "' LIMIT 1"), 0));
	}
	
	function Id2name($id = -1)
	{
		if (isset($this->userCache[$id]['username']))
		{
			return $this->userCache[$id]['username'];
		}	
	
		$name = mysql_result(dbquery("SELECT username FROM users WHERE id = '" . $id . "' LIMIT 1"), 0);
		$this->userCache[$id]['username'] = $name;
		return $name;
	}	
	
	/**************************************************************************************************/
	
	function CacheUser($id)
	{
		$data = mysql_fetch_assoc(dbquery("SELECT * FROM users WHERE id = '" . $id . "' LIMIT 1"));
		
		foreach ($data as $key => $value)
		{
			$this->userCache[$id][$key] = $value;
		}
	}
	
	function GetUserVar($id, $var, $allowCache = true)
	{
		if ($allowCache && isset($this->userCache[$id][$var]))
		{
			return $this->userCache[$id][$var];
		}	
	
		$val = @mysql_result(dbquery("SELECT " . $var . " FROM users WHERE id = '" . $id . "' LIMIT 1"), 0);
		$this->userCache[$id][$var] = $val;
		return $val;
	}
	
	// do not remove - still used in hk
	function formatUsername($id, $link = true, $styles = true)
	{
		$datas = dbquery("SELECT id,rank,username FROM users WHERE id = '" . $id . "' LIMIT 1");
		
		if (mysql_num_rows($datas) == 0)
		{
			return '<s>Unknown User</s>';
		}
		
		$data = mysql_fetch_assoc($datas);
		
		$prefix = '';
		$name = $data['username'];
		$suffix = '';
		
		if ($link)
		{
			$prefix .= '<a href="/user/' . clean($data['username']) . '">';
			$suffix .= '</a>';
		}
		
		if ($styles)
		{
			$rank = $this->getRank($id);
			
			$rankData = dbquery("SELECT prefix,suffix FROM ranks WHERE id = '" . $rank . "' LIMIT 1");
			
			if (mysql_num_rows($rankData) == 1)
			{
				$rankData = mysql_fetch_assoc($rankData);
				
				$prefix .= $rankData['prefix'];
				$suffix .= $rankData['suffix'];
			}
		}
		
		return clean($prefix . $name . $suffix, true);
	}
	// do not remove - still used in hk
	
	/**************************************************************************************************/

	function getRank($id)
	{
		if (isset($this->userCache[$id]['rank']))
		{
			return $this->userCache[$id]['rank'];
		}
	
		$rankId = @intval(mysql_result(dbquery("SELECT rank FROM users WHERE id = '" . intval($id) . "' LIMIT 1"), 0));
		$this->userCache[$id]['rank'] = $rankId;
		return $rankId;
	}
	
	function getRankVar($rankId, $var)
	{
		return mysql_result(dbquery("SELECT " . $var . " FROM ranks WHERE id = '" . intval($rankId) . "' LIMIT 1"), 0);
	}
	
	function getRankName($rankId)
	{
		return $this->getRankVar($rankId, 'name');
	}
	
	function hasFuse($id, $fuse)
	{		
		if (mysql_num_rows(dbquery("SELECT null FROM fuserights WHERE rank <= '" . $this->getRank($id) . "' AND fuse = '" . $fuse . "' LIMIT 1")) == 1)
		{
			return true;
		}
		
		return false;
	}
	
	/**************************************************************************************************/

	function GetFriendCount($id, $onlineOnly = false)
	{
		$i = 0;
		$q = dbquery("SELECT user_two FROM friendships WHERE user_one = '" . $id . "'");
		
		while ($friend = mysql_fetch_assoc($q))
		{
			if (!$onlineOnly)
			{
				$i++;
			}
			else
			{
				$isOnline = mysql_result(dbquery("SELECT online FROM users WHERE id = '" . $friend['user_two'] . "' LIMIT 1"), 0);
					
				if ($isOnline == "1")
				{
					$i++;
				}
			}
		}
		
		return $i;
	}
	
	/**************************************************************************************************/

	function CheckSSO($id)
	{
		global $core;
		
		if (strlen($this->getUserVar($id, 'auth_ticket')) <= 3)
		{
			dbquery("UPDATE users SET auth_ticket = '" . $core->generateTicket($this->getUserVar($id, 'username')) . "' WHERE id = '" . $id . "' LIMIT 1");
		}
	}
	
	/**************************************************************************************************/
	
	function getCredits($id)
	{
		return $this->getUserVar($id, 'credits');
	}
	
	function setCredits($id, $newAmount)
	{
		global $core;
	
		dbquery("UPDATE users SET credits = '" . $newAmount. "' WHERE id = '" . $id . "' LIMIT 1");
		$core->Mus('updateCredits:' . $id);
	}
	
	function giveCredits($id, $amount)
	{
		global $core;
	
		return $this->setCredits($id, ($this->getCredits($id) + $amount));
		$core->Mus('updateCredits:' . $id);
	}
	
	function takeCredits($id, $amount)
	{
		global $core;
	
		return $this->setCredits($id, ($this->getCredits($id) - $amount));
		$core->Mus('updateCredits:' . $id);
	}	
	
	function renderHabboImage($id, $size = 'b', $dir = 2, $head_dir = 3, $action = 'wlk', $gesture = 'sml')
	{
		$look = $this->getUserVar($id, 'look');
		
		return 'http://www.habbo.co.uk/habbo-imaging/avatarimage?figure=' . $look . '&size=' . $size . '&action=' . $action . ',&gesture=' . $gesture . '&direction=' . $dir . '&head_direction=' . $head_dir;
	}
	
	function getClubDays($id)
	{
		$sql = dbquery("SELECT timestamp_activated, timestamp_expire FROM user_subscriptions WHERE subscription_id = 'habbo_club' AND user_id = '" . $id . "' LIMIT 1");
		
		if (mysql_num_rows($sql) == 0)
		{
			return 0;
		}
		
		$data = mysql_fetch_assoc($sql);
		$diff = $data['timestamp_expire'] - time();
		
		if ($diff <= 0)
		{
			return 0;
		}
		
		return ceil($diff / 86400);
	}
	
	function hasClub($id)
	{
		return ($this->getClubDays($id) > 0) ? true : false;
	}
	
	/**************************************************************************************************/
	
	public static function IsUserBanned($name)
	{
		if (uberUsers::GetBan('user', $name, true) != null)
		{
			return true;
		}
		
		return false;
	}
	
	public static function IsIpBanned($ip)
	{
		if (uberUsers::GetBan('ip', $ip, true) != null)
		{
			return true;
		}
		
		return false;
	}
	
	public static function GetBan($type, $value, $mustNotBeExpired = false)
	{
		$q = "SELECT * FROM bans WHERE bantype = '" . $type . "' AND value = '" . $value . "' ";
		
		if ($mustNotBeExpired)
		{
			$q .= "AND expire > " . time() . " ";
		}
		
		$q .= "LIMIT 1";
	
		$get = dbquery($q);
		
		if (mysql_num_rows($get) > 0)
		{
			return mysql_fetch_assoc($get);
		}
	
		return null;
	}	
	
	/**************************************************************************************************/
	
	public static function GetUserTags($userId)
	{
		$tagsArray = Array();
		$data = dbquery("SELECT id,tag FROM user_tags WHERE user_id = '" . $userId . "'");
		
		while ($tag = mysql_fetch_assoc($data))
		{
			$tagsArray[$tag['id']] = $tag['tag'];
		}
		
		return $tagsArray;
	}
}

?>