<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_admin'))
{
	exit;
}

if (isset($_GET['new']))
{
	dbquery("INSERT INTO moderation_presets (type,enabled,message) VALUES ('message','0','Newly generated preset - please update')");
	
	fMessage('ok', 'New preset generated.');
	
	header("Location: index.php?_cmd=presets");
	exit;
}

if (isset($_GET['delete']) && is_numeric($_GET['delete']))
{
	dbquery("DELETE FROM moderation_presets WHERE id = '" . intval($_GET['delete']) . "' LIMIT 1");
	
	if (mysql_affected_rows() >= 1)
	{
		fMessage('ok', 'Deleted preset successfully.');
	}
	
	header("Location: index.php?_cmd=presets");
	exit;	
}

if (isset($_POST['preset-save']) && is_numeric($_POST['preset-save']))
{
	$id = intval($_POST['preset-save']);
	$type = filter($_POST['type']);
	$enabled = filter($_POST['enabled']);
	$message = filter($_POST['message']);
	
	dbquery("UPDATE moderation_presets SET type = '" . $type . "', enabled = '" . $enabled . "', message = '" . $message . "' WHERE id = '" . $id . "' LIMIT 1");
	
	if (mysql_affected_rows() >= 1)
	{
		fMessage('ok', 'Updated preset.');
	}
}

require_once "top.php";

?>			

<h1>Mod tool presets</h1>

<h2>Room tool presets</h2>
<br />

<table width="100%" border="1" >
<thead>
	<td>ID</td>
	<td>Type</td>
	<td>Enabled</td>
	<td>Message</td>
	<td>Options</td>
</thead>
<tbody>
<?php

$get = dbquery("SELECT * FROM moderation_presets ORDER BY id DESC");

while ($p = mysql_fetch_assoc($get))
{
	echo '<tr>';
	echo '<form method="post">';
	echo '<input type="hidden" name="preset-save" value="' . $p['id'] . '">';
	echo '<td>#' . $p['id'] . '</td>';
	echo '<td><select name="type"><option value="message">User message (friendly)</option><option value="roommessage"';
	
	if ($p['type'] == "roommessage")
	{
		echo ' selected';
	}
	
	echo '>Room message</option></select></td>';
	echo '<td><select name="enabled"><option value="1">Enabled</option><option value="0"';
	
	if ($p['enabled'] == "0")
	{
		echo ' selected';
	}
	
	echo '>Disabled</option></select></td>';
	echo '<td><textarea name="message" cols="50" rows="5">' . clean($p['message']) . '</textarea></p></td>';
	echo '<td><input type="submit" value="Save">&nbsp;<input type="button" onclick="document.location = \'index.php?_cmd=presets&delete=' . $p['id'] . '\';" value="Delete"></td>';
	echo '</form>';
	echo '</tr>';
}

?>
</tbody>
</table>

<br />
<br />

<center>

	<a href="index.php?_cmd=presets&new">
		<b>Add new preset</b>
	</a>
	
	<br /><br />
	
	<i style="color: darkred;">
		NOTE: Changes will not be seen in the hotel until the server restarts.
	</i>
</center>



<?php

require_once "bottom.php";

?>