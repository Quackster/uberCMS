<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_admin'))
{
	exit;
}

if (isset($_POST['edit-no']))
{
	dbquery("UPDATE external_texts SET sval = '" . filter($_POST['nm']) . "' WHERE skey = 'badge_name_" . filter($_POST['edit-no']) . "' LIMIT 1");
	dbquery("UPDATE external_texts SET sval = '" . filter($_POST['dc']) . "' WHERE skey = 'badge_desc_" . filter($_POST['edit-no']) . "' LIMIT 1");
	
	fMessage('ok', 'Updated badge def.');
}

if (isset($_POST['newbadge']))
{
	dbquery("INSERT INTO external_texts (skey,sval) VALUES ('badge_name_" . filter($_POST['newbadge']) . "','" . filter($_POST['newname']) . "')");
	dbquery("INSERT INTO external_texts (skey,sval) VALUES ('badge_desc_" . filter($_POST['newbadge']) . "','" . filter($_POST['newdescr']) . "')");
}

if (isset($_GET['doDel']))
{
	dbquery("DELETE FROM external_texts WHERE skey = 'badge_name_" . filter($_GET['doDel']) . "' LIMIT 1");
	dbquery("DELETE FROM external_texts WHERE skey = 'badge_desc_" . filter($_GET['doDel']) . "' LIMIT 1");
	
	fMessage('ok', 'Badge defenition removed.');
	
	header("Location: index.php?_cmd=badgedefs");
	exit;
}

require_once "top.php";

echo '<h1>Badge defenitions</h1>';
echo '<p>This tool can be used to manage badge defenitions (the text that appears).</p><br />';

echo '<table border="1" width="100%">';
echo '<thead>';
echo '<tr>';
echo '<td>Badge</td>';
echo '<td>Name</td>';
echo '<td>Description</td>';
echo '<td>Controls</td>';
echo '</tr>';

$get = dbquery("SELECT * FROM external_texts WHERE skey LIKE '%badge_name_%'");

while ($text = mysql_fetch_assoc($get))
{
	$badgeName = substr($text['skey'], 11);
	$badgeTName = $text['sval'];
	$badgeTDescr = mysql_result(dbquery("SELECT sval FROM external_texts WHERE skey = 'badge_desc_" . $badgeName . "' LIMIT 1"), 0);

	echo '<tr><form method="post">';
	echo '<td><img src="http://images.habbohotel.co.uk/c_images/Badges/' . $badgeName . '.gif" style="vertical-align: middle;">&nbsp;&nbsp;' . $badgeName . '</td>';
	echo '<input type="hidden" name="edit-no" value="' . clean($badgeName) . '">';
	echo '<td><input type="text" style="width: 100%; padding: 10px; font-size: 115%;" name="nm" value="' . clean($badgeTName) . '"></td>';
	echo '<td><textarea style="width: 100%; height: 100%;" name="dc">' . clean($badgeTDescr) . '</textarea></td>';
	echo '<td><center><input type="submit" value="Update">&nbsp;<input type="button" value="Delete" onclick="window.location = \'index.php?_cmd=badgedefs&doDel=' . $badgeName . '\';"></center></td>';
	echo '</form></tr>';
}

echo '<tr><form method="post">';
echo '<td><input type="text" style="width: 100%; padding: 10px; font-size: 115%;" name="newbadge"></td>';
echo '<td><input type="text" style="width: 100%; padding: 10px; font-size: 115%;" name="newname"></td>';
echo '<td><textarea name="newdescr" style="width: 100%; height: 100%;"></textarea>';
echo '<td><center><input type="submit" value="Add">';
echo '</form></tr>';

echo '</thead>';
echo '</table>';

require_once "bottom.php";

?>