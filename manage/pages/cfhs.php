<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_moderation'))
{
	exit;
}

function formatType($t)
{
	switch (intval($t))
	{
		case 101:
		
			return 'Sex';
			
		case 102:
		
			return 'Pers.info';
			
		case 103:
		
			return 'Scam';
			
		case 104:
		
			return 'Abusive';
	
		case 105:
		
			return 'Blocking';
			
		case 106:
		
			return 'Other';
	
		default:
		
			return $t;
	}
}

function formatSent($stamp)
{
	$stamp = time() - $stamp;

	$x = '';

	if ($stamp >= 604800)
	{
		$x = ceil($stamp / 604800) . 'wks';
	}
	else if ($stamp > 86400)
	{
		$x = ceil($stamp / 86400) . 'day';
	}
	else if ($stamp >= 3600)
	{
		$x = ceil($stamp / 3600) . 'hr';
	}
	else if ($stamp >= 120)
	{
		$x  = ceil($stamp / 60) . 'min';
	}
	else
	{
		$x = $stamp . ' s';
	}
	
	$x .= ' ago';
	return $x;
}

require_once "top.php";

?>			

<h1>Calls for Help</h1>

<p>
	This is an overview of the uberHotel staff team with their contact details as defined in their account settings.
</p>

<br />

<p>
	<b>This primarily serves as an archive/overview for calls for help. To moderate these tickets please use the ingame moderation tool. (any open issues will be sent to you upon login)</b>
</p>

<br />

<p>
	<small>* Calls for help are pruned every now and then, but usually kept for a longer period of time.</small>
</p>

<br />

<table width="100%" border="1">
<thead>
	<td>ID</td>
	<td>Type</td>
	<td>Status</td>
	<td>Sender</td>
	<td>Reported user</td>
	<td>Moderator</td>
	<td>Message</td>
	<td>Room</td>
	<td>Sent</td>
	<td>Chatlog</td>
</thead>
<?php

$get = dbquery("SELECT * FROM moderation_tickets ORDER BY id DESC");

while ($user = mysql_fetch_assoc($get))
{
	echo '<tr>';
	echo '<td>' . clean($user['id']) . '</td>';
	echo '<td>' . formatType($user['type']) . '</td>';
	echo '<td>' . clean($user['status']) . '</td>';
	echo '<td>' . $users->formatUsername($user['sender_id']) . '</td>';
	echo '<td>';
	
	if ($user['reported_id'] >= 1)
	{
		echo $users->formatUsername($user['reported_id']);
	}
	else
	{
		echo '-';
	}
	
	echo '</td>';
	echo '<td>';
	
	if ($user['moderator_id'] >= 1)
	{
		echo $users->formatUsername($user['moderator_id']);
	}
	else
	{
		echo '-';
	}
	
	echo '</td>';	
	echo '<td>' . clean($user['message']) . '</td>';
	echo '<td>' . clean($user['room_name']) . '</td>';
	echo '<td>' . formatSent($user['timestamp']) . '</td>';
	echo '<td><a href="index.php?_cmd=chatlogs&timeSearch=' . $user['timestamp'] . '">View</a></td>';
	echo '</tr>';
}

?>
</table>

<?php

require_once "bottom.php";

?>