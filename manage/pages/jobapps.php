<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_sitemanagement'))
{
	exit;
}

require_once "top.php";

?>			

<h1>Job Applications</h1>

<p>
	<i>None submitted yet.</i>
</p>



<?php

require_once "bottom.php";

?>