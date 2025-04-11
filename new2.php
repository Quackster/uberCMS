<?php

exit;

require_once "global.php";

if (!LOGGED_IN || !$users->HasFuse(USER_ID, 'fuse_admin'))
{
	exit;
}

$hugeItemList = dbquery("SELECT id FROM room_items");

while ($roomItem = mysql_fetch_assoc($hugeItemList))
{
	$get = dbquery("SELECT user_id,id FROM user_items WHERE id = '" . $roomItem['id'] . "'");
	
	while ($item = mysql_fetch_assoc($get))
	{
		echo 'Duplicate item: ' . $item['id'] . ' - deleting..<br />';
		dbquery("DELETE FROM user_items WHERE id = '" . $item['id'] . "' LIMIT 1");
	}
}

echo 'All done. All duplicates have been removed.<br />';

?>