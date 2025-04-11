<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_admin'))
{
	exit;
}

$data = null;
$u = 0;

if (isset($_GET['u']) && is_numeric($_GET['u']))
{
	$u = intval($_GET['u']);
	$getData = dbquery("SELECT id,username FROM users WHERE id = '" . $u . "' LIMIT 1");
	
	if (mysql_num_rows($getData) > 0)
	{
		$data = mysql_fetch_assoc($getData);
	}
}
else if (isset($_POST['usrsearch']))
{
	$usrSearch = filter($_POST['usrsearch']);
	$getData = dbquery("SELECT id,username FROM users WHERE username = '" . $usrSearch . "' LIMIT 1");
	
	if (mysql_num_rows($getData) > 0)
	{
		$data = mysql_fetch_assoc($getData);
		
		header("Location: index.php?_cmd=badges&u=" . $data['id']);
		exit;
	}	
	else
	{
		fMessage('error', 'User not found!');
	}
}

require_once "top.php";			

echo '<h1>Manage user badges</h1>';

if ($data == null)
{
	echo '<p><i>No user set or invalid user supplied.</i> To edit an user\'s badges, search for one below..</p>';
	echo '<Br />';
	echo '<p><form method="post">';
	echo 'By UID: <input id="uidval" type="text" size="5" name="uid">&nbsp; <input type="button" value="Go" onclick="window.location = \'index.php?_cmd=badges&u=\' + document.getElementById(\'uidval\').value;"><br />';
	echo 'By username: <input type="text" name="usrsearch" value="">&nbsp; <input type="submit" value="Go">';
	echo '</form></p>';
}
else
{
	if (isset($_GET['take']))
	{
		dbquery("DELETE FROM user_badges WHERE user_id = '" . $data['id'] . "' AND badge_id = '" . filter($_GET['take']) . "'");
		
		if (mysql_affected_rows() >= 1)
		{
			echo '<b>Took badge ' . $_GET['take'] . ' from ' . $data['username'] . '.</b>';
		}
	}	
	
	if (isset($_POST['newbadge']))
	{
		dbquery("INSERT INTO user_badges (user_id,badge_id,badge_slot) VALUES ('" . $data['id'] . "','" . filter($_POST['newbadge']) . "','0')");
		echo '<b>Gave badge!</b>';
	}

	echo '<h2>Edting badges: ' . $data['username'] . ' (<a href="index.php?_cmd=badges">Back to user search</a>)</h2>';
	$getBadges = dbquery("SELECT badge_id,badge_slot FROM user_badges WHERE user_id = '" . $data['id'] . "'");
	
	echo '<Br /><table border="1">
	<thead>
	<tr>
		<td>Image</td>
		<td>Badge code</td>
		<td>Status</td>
		<td>Defenition</td>
		<td>Controls</td>
	</tr>
	</thead>';
	
	while ($b = mysql_fetch_assoc($getBadges))
	{
		echo '<tr>';
		echo '<td><img src="http://images.habbohotel.co.uk/c_images/Badges/' . $b['badge_id'] . '.gif"></td>';
		echo '<td><center>' . $b['badge_id'] . '</center></td>';
		echo '<td><center>';
		
		if ($b['badge_slot'] == 0)
		{
			echo 'Not equipped';
		}
		else
		{
			echo 'Equipped in slot ' . $b['badge_slot'];
		}
		
		echo '</center></td>';
		echo '<td><a href="index.php?_cmd=badgedefs">';
		
		$tryGet1 = dbquery("SELECT sval FROM external_texts WHERE skey = 'badge_name_" . $b['badge_id'] . "'");
		$tryGet2 = dbquery("SELECT sval FROM external_texts WHERE skey = 'badge_desc_" . $b['badge_id'] . "'");
		
		if (mysql_num_rows($tryGet1) > 0)
		{
			echo '<b>' . mysql_result($tryGet1, 0) . '</b><br />';
		}
		else
		{
			echo '<b><i>(No name def)</i></b><br />';
		}
		
		if (mysql_num_rows($tryGet2) > 0)
		{
			echo mysql_result($tryGet2, 0);
		}
		else
		{
			echo '<i>(No descr def)</i><br />';
		}		
		
		echo '</a></td>';
		echo '<td><center><input type="button" onclick="window.location = \'index.php?_cmd=badges&u=' . $u . '&take=' . $b['badge_id'] . '\';" value="Take"></center></td>';
		echo '</tr>';
	}
	
	echo '<tr><form method="post">
	<td><center>?</center></td>
	<td><input type="text" name="newbadge" value="" style="padding: 5px; font-size: 130%; text-align: center;"></td>
	<td><center>(New badge)</center></td>
	<td>&nbsp;</td>
	<td><center><input type="submit" value="Give" onclick=""></center></td>
	</form></tr>';
}

require_once "bottom.php";

?>