<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_moderation'))
{
	exit;
}

if (isset($_POST['v-code']))
{
	$vCode = filter($_POST['v-code']);
	$vValue = filter($_POST['v-value']);
	
	if (strlen($vCode) <= 0)
	{
		fMessage('error', 'Please enter a voucher code.');
	}
	else if (!is_numeric($vValue) || intval($vValue) <= 0 || intval($vValue) > 5000)
	{
		fMessage('error', 'Invalid credit value. Must be numeric and a value between 1 - 5000.');
	}
	else
	{
		dbquery("INSERT INTO credit_vouchers (code,value) VALUES ('" . $vCode . "','" . intval($vValue) . "')");
		fMessage('ok', 'Voucher is now live and redeemable.');
	}
}

require_once "top.php";

?>			

<h1>Credit vouchers</h1>

<br />

<p>
	Credit vouchers can be exchanged for credits on the website and in the ingame catalogue.
</p>

<br />

<p style="font-size: 125%; color: darkred;">
	<b>NOTE:</b> Staff are *NOT* to abuse this system. Vouchers may be used as a method of refunds,
	rewards, or prizes, but not to be handed out without VALID reason. Amounts must be kept reasonable.
	<u>Abuse of this system WILL be punished.</u>
</p>

<br />

<div style="float: left; width: 49%;">

	<h2>Redeemable vouchers</h2>
	
	<br />

	<table width="100%" border="1">
	<thead>
		<td>Voucher code</td>
		<td>Value</td>
	</thead>
	<?php

	$get = dbquery("SELECT code,value FROM credit_vouchers ORDER BY code ASC");

	while ($user = mysql_fetch_assoc($get))
	{
		echo '<tr>';
		echo '<td>' . $user['code'] . '</td>';
		echo '<td>' . $user['value'] . ' credits</td>';
		echo '</tr>';
	}

	?>
	</table>

</div>

<div style="float: right; width: 49%;">

	<h2>Add new voucher</h2>
	
	<br />
	
	<form method="post">
	
		Code:<br />
		<input type="text" name="v-code"><br />
		<br />
		Credit value:<br />
		<input type="text" name="v-value"><br />
		<br />
		<input type="submit" value="Add">
	</form>

</div>

<div style="clear: both;"></div>

<?php

require_once "bottom.php";

?>