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

<h1>Staff listing</h1>

<p>
	This is an overview of the uberHotel staff team with their contact details as defined in their account settings.
</p>

<br />

<table width="100%" border="1">
<thead>
	<td>User</td>
	<td>Rank</td>
	<td>Contact</td>
</thead>
<?php

$get = dbquery("SELECT id,rank,mail FROM users WHERE rank >= 3 ORDER BY rank DESC");

while ($user = mysql_fetch_assoc($get))
{
	echo '<tr>';
	echo '<td>' . $users->formatUsername($user['id']) . '</td>';
	echo '<td>' . $users->getRankName($user['rank']) . '</td>';
	echo '<td><a href="mailto:' . $user['mail'] . '">' . $user['mail'] . '</a></td>';
	echo '</tr>';
}

?>
</table>

<?php

require_once "bottom.php";

?>