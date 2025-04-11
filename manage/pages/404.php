<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN)
{
	exit;
}

require_once "top.php";

?>			

<div style="margin: 25px;">
<center>
	<b style="font-size: 18px;">Page not found</b>
	
	<p>
		This page has moved or does not exist.
	</p>
	
	<p>
		If you think you've found a bug, please report it on the <a href="index.php?_cmd=forum">discussion forum</a>.
	</p>
	
</center>
</div>

<?php

require_once "bottom.php";

?>