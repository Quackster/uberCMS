<?php

require_once "../inc/class.rooms.php";

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_moderation'))
{
	exit;
}

$searchResults = null;

if (isset($_GET['timeSearch']))
{
	$_POST['searchQuery'] = $_GET['timeSearch'];
	$_POST['searchType'] = '4';
}

if (isset($_POST['searchQuery']))
{
	$query = filter($_POST['searchQuery']);
	$type = $_POST['searchType'];
	
	$q = "SELECT * FROM chatlogs WHERE ";
	
	switch ($type)
	{
		default:
		case '1':
		
			$q .= "user_name = '" . $query . "'";
			break;
			
		case '2':
		
			$q .= "message LIKE '%" . $query . "%'";
			break;
			
		case '3':
		
			$q .= "room_id = '" . $query . "'";
			break;
			
		case '4':
		
			$cutMin = intval($query) - 300;
			$cutMax = intval($query) + 300;
			
			$q .= "timestamp >= " . $cutMin . " AND timestamp <= " . $cutMax;
	}
	
	$searchResults = dbquery($q);
}

require_once "top.php";

?>			

<h1>Chatlogs</h1>

<br />

<p>
	This tool may be used to look up and review room chatlogs. Special chat such as IM and minimail is not being monitored here. Seperate tools
	may be available for them.
</p>

<br />

<p>
	<b>IMPORTANT:</b> Chatlogs are only kept for a limited period of time.<br />
	Chatlogs older than 2 weeks will be permanently deleted. If you would
	like to keep them for a longer period, please save them locally.
</p>

<?php

if (isset($searchResults))
{
	echo '<h2>Search results - You searched for "<span style="font-size: 125%;">' . clean($_POST['searchQuery']) . '</span>"</h2>';
	echo '<br /><p><a href="index.php?_cmd=chatlogs&doReset">Clear search</a></p><br />
	
	<table width="100%">
	<thead>
	<tr>
		<td>Date</td>
		<td>Time</td>
		<td>User</td>
		<td>Room</td>
		<td>Message</td>
		<td>Timestamp</td>
	</tr>
	<tbody>';
	
	while ($result = mysql_fetch_assoc($searchResults))
	{
		if (strlen($result['hour']) < 2)
		{
			$result['hour'] = '0' . $result['hour'];
		}
		
		if (strlen($result['minute']) < 2)
		{
			$result['minute'] = '0' . $result['minute'];
		}		
	
		echo '<tr>
		<td>' . $result['full_date'] . '</td>
		<td>' . $result['hour'] . ':' . $result['minute'] . '</td>
		<td><a href="#">' . clean($result['user_name']) . '</a> (' . $result['user_id'] . ')</td>
		<td><a href="#">' . clean(RoomManager::GetRoomVar($result['room_id'], 'caption')) . '</a> (' . $result['room_id'] . ')</td>
		<td>' . clean($result['message']) . '</td>
		<td>' . clean($result['timestamp']) . ' (<a href="index.php?_cmd=chatlogs&timeSearch=' . intval($result['timestamp']) . '">Search</a>)</td>
		</tr>';
	}
	
	echo '</tbody>
	</thead>
	</table>';
}
else
{
	echo '<h2>Search chatlogs</h2>
	
	<br />
	
	<form method="post">
	
	Search type:&nbsp;
	<select name="searchType">
	<option value="1">By username</option>
	<option value="2">By message content</option>
	<option value="3">By room (by ID only!)</option>
	<option value="4">By timestamp (600 second range)</option>
	</select>
	
	<br /><br />
	
	Search query:&nbsp;
	<input type="text" name="searchQuery">
	
	<br /><br />
	
	<input type="submit" value="Search">
	
	</form>
	
	
	<h2>Recent activity</h2>
	<table width="100%">
	<thead>
	<tr>
		<td>Date</td>
		<td>Time</td>
		<td>User</td>
		<td>Room</td>
		<td>Message</td>
		<td>Timestamp</td>
	</tr>
	<tbody>';
	
	$getRecent = dbquery("SELECT * FROM chatlogs ORDER BY id DESC LIMIT 30");
	
	while ($recent = mysql_fetch_assoc($getRecent))
	{
		if (strlen($recent['hour']) < 2)
		{
			$recent['hour'] = '0' . $recent['hour'];
		}
		
		if (strlen($recent['minute']) < 2)
		{
			$recent['minute'] = '0' . $recent['minute'];
		}		
	
		echo '<tr>
		<td>' . $recent['full_date'] . '</td>
		<td>' . $recent['hour'] . ':' . $recent['minute'] . '</td>
		<td><a href="#">' . clean($recent['user_name']) . '</a> (' . $recent['user_id'] . ')</td>
		<td><a href="#">' . clean(RoomManager::GetRoomVar($recent['room_id'], 'caption')) . '</a> (' . $recent['room_id'] . ')</td>
		<td>' . clean($recent['message']) . '</td>
		<td>' . clean($recent['timestamp']) . ' (<a href="index.php?_cmd=chatlogs&timeSearch=' . intval($recent['timestamp']) . '">Search</a>)</td>
		</tr>';
	}
	
	echo '</tbody>
	</thead>
	</table>';
}


require_once "bottom.php";

?>