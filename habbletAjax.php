<?php
/*=======================================================================
| UberCMS - Advanced Website and Content Management System for uberEmu
| #######################################################################
| Copyright (c) 2010, Roy 'Meth0d'
| http://www.meth0d.org
| #######################################################################
| This program is free software: you can redistribute it and/or modify
| it under the terms of the GNU General Public License as published by
| the Free Software Foundation, either version 3 of the License, or
| (at your option) any later version.
| #######################################################################
| This program is distributed in the hope that it will be useful,
| but WITHOUT ANY WARRANTY; without even the implied warranty of
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
| GNU General Public License for more details.
\======================================================================*/

require_once "global.php";

$cmd = '';

if (isset($_GET['cmd']))
{
	$cmd = $_GET['cmd'];
}

switch (strtolower($cmd))
{
	case 'new_redeemvoucher':
	
		if (!LOGGED_IN)
		{
			exit;
		}
	
		echo '<div class="redeem-redeeming"><div><input type="text" name="voucherCode" value="" class="redeemcode" size="8" /></div><div class="redeem-redeeming-button"><a href="#" class="new-button green-button redeem-submit"><b><span></span>Redeem</b><i></i></a></div></div>';

		$findVoucher = dbquery("SELECT value FROM credit_vouchers WHERE code = '" . filter($_POST['voucherCode']) . "' LIMIT 1");
		
		if (mysql_num_rows($findVoucher) >= 1)
		{
			$value = intval(mysql_result($findVoucher, 0));
		
			echo '<div class="redeem-result"><div class="rounded rounded-green">You have successfully redeemed <b>' . $value . '</b> credits.</div></div>';		
		
			dbquery("UPDATE users SET credits = credits + " . $value . " WHERE id = '" . USER_ID . "' LIMIT 1");
			dbquery("DELETE FROM credit_vouchers WHERE code = '" . filter($_POST['voucherCode']) . "' LIMIT 1");		
			$core->Mus('updateCredits', USER_ID);
		}
		else
		{
			echo '<div class="redeem-result"><div class="rounded rounded-red">Your redeem code could not be found.</div></div>';
		}
	
		break;

	case 'updatemotto':
	
		if (!LOGGED_IN)
		{
			exit;
		}
		
		if (isset($_POST['motto']))
		{
			$motto = filter(trim(uberCore::FilterSpecialChars(substr($_POST['motto'], 0, 40))));
			
			dbquery("UPDATE users SET motto = '" . $motto . "' WHERE id = '" . USER_ID . "' LIMIT 1");		
			$core->Mus('updatemotto', USER_ID);
			
			die(clean($motto));
		}
		
		break;
}
	
?>