<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_sitemanagement'))
{
	exit;
}

if (isset($_POST['edit']))
{
	$id = intval($_POST['edit']);
	$image = filter($_POST['image']);
	$title = filter($_POST['title']);
	$descr = filter($_POST['descr']);
	$enabled = filter($_POST['enabled']);
	$order = filter($_POST['order']);
	$url = filter($_POST['url']);
	
	if (!is_numeric($order) || intval($order) <= 0)
	{
		$order = 0;
	}
	
	dbquery("UPDATE site_hotcampaigns SET image_url = '" . $image . "', caption = '" . $title . "', descr = '" . $descr . "', enabled = '" . $enabled . "', order_id = '" . $order . "', url = '" . $url . "' WHERE id = '" . $id . "' LIMIT 1");
	fMessage('ok', 'Updated campaign.');
}

if (isset($_POST['add-new']))
{
	$image = filter($_POST['image']);
	$title = filter($_POST['title']);
	$descr = filter($_POST['descr']);
	$enabled = filter($_POST['enabled']);
	$order = filter($_POST['order']);
	$url = filter($_POST['url']);
	
	if (!is_numeric($order) || intval($order) <= 0)
	{
		$order = 0;
	}
	
	dbquery("INSERT INTO site_hotcampaigns (id,order_id,enabled,image_url,caption,descr,url) VALUES (NULL,'" . $order . "','" . $enabled . "','" . $image . "','" . $title . "','" . $descr . "','" . $url . "')");
	fMessage('ok', 'Added campaign.');
}

if (isset($_GET['doDel']) && is_numeric($_GET['doDel']))
{
	dbquery("DELETE FROM site_hotcampaigns WHERE id = '" . $_GET['doDel'] . "' LIMIT 1");
	fMessage('ok', 'Deleted.');
	header("Location: index.php?_cmd=campaigns");
	exit;
}

require_once "top.php";

?>			

<h1>Hot Campaigns (Homepage)</h1>

<br />

<p>
	You can use this tool to manage the hot campaigns section of the homepage (me page). Can be used for competitions,
	events, and other important communication.
</p>

<h2>Manage items</h2>

<br />

<table width="100%" border="1">
<thead>
<tr>
	<td>ID</td>
	<td>Image</td>
	<td>Title</td>
	<td>Link</td>
	<td>Description</td>
	<td>Enabled?</td>
	<td>Order</td>
	<td>Options</td>
</tr>
</thead>
<tbody>
<?php

$getItems = dbquery("SELECT * FROM site_hotcampaigns ORDER BY order_id ASC");

while ($item = mysql_fetch_assoc($getItems))
{
	echo '<tr>
	<form method="post">
	<input type="hidden" name="edit" value="' . $item['id'] . '">
	<td>' . $item['id'] . '</td>
	<td><img src="' . clean($item['image_url']) . '"><br /><input type="text" name="image" value="' . clean($item['image_url']) . '"></td>
	<td><input type="text" name="title" value="' . clean($item['caption']) . '"></td>
	<td><input type="text" name="url" value="' . clean($item['url']) . '"></td>
	<td><textarea cols="30" rows="3" name="descr">' . clean($item['descr']) . '</textarea></td>
	<td><select name="enabled"><option value="1">Enabled</option><option value="0" ' . (($item['enabled'] == "0") ? 'selected' : '') . '>Disabled</option></select></td>
	<td><center><input type="text" size="3" name="order" value="' . $item['order_id'] . '"></center></td>
	<td><input type="submit" value="Save">&nbsp;<input type="button" onclick="document.location = \'index.php?_cmd=campaigns&doDel=' . $item['id'] . '\';" value="Delete"></td>	
	</form>
	</tr>';
}

?>
<tr>

<form method="post">
<input type="hidden" name="add-new" value="1">

	<td>New item</td>
	<td><input type="text" name="image"></td>
	<td><input type="text" name="title"></td>
	<td><input type="text" name="url"></td>
	<td><textarea cols="30" rows="3" name="descr"></textarea></td>
	<td><select name="enabled"><option value="1">Enabled</option><option value="0">Disabled</option></select></td>
	<td><center><input type="text" size="3" name="order" value="1"></center></td>
	<td><input type="submit" value="Add"></td>
</form>
</tr>
</tbody>
</table>

<?php

require_once "bottom.php";

?>