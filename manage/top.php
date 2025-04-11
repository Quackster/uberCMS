<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN)
{
	exit;
}

?>
<html>
<head>
<title>uberHotel / housekeeping</title>
<style type="text/css">
* {
	margin: 0;
	padding: 0;
}

body {
	font-family: sans-serif;
	font-size: 12px;
}

table {
	font-size: 12px;
}

table thead {
	font-weight: bold;
}

#menu {
	padding: 5px;
}

a {
	color: #35415C;
	text-decoration: none;
	font-weight: normal;
}

a:hover {
	text-decoration: underline;
}

#menu li {
	margin: 0px;
}

#menu li:hover {
	background: #f6f7fe;
}

#menu li a {
	display: block;
	width: 100%;
}

h1, h2 {
	background: #EFF0F9;
	text-align: left;
}

h1 {
	margin-top: 0px;
	font-size: 140%;
	padding: 3px;
	color: #000;
}

h2 {
	margin: 0;
	font-size: 100%;
	margin-top: 1em;
	padding: 3px;
}

#main {
	padding: 5px;
}

.plus {
	float: right;
	font-size: 8px;
	font-weight: normal;
	padding: 1px 4px 2px 4px;
	margin: 0px 0px;
	background: #f6f7fe;
	color: #000;
	border: 1px solid #b4b8d0;
	cursor: pointer;
}

.plus:hover {
	background: #f6f7fe;
	border: 1px solid #c97;
}

ul.listmnu {
	list-style: none;
}

.listmnu {
	padding: 5px;
	text-align: left;
}

#top-flashmessage-ok {
	background-color: #E0F8E0;
	color: #088A08;
}

#top-flashmessage-error {
	background-color: #F8E0E0;
	color: #8A0808;
}

#top-flashmessage-ok,#top-flashmessage-error {
	font-family: arial, san-serif;
	border: 1px solid #2E2E2E;
	font-size: 14px;
	font-weight: bold;
	text-align: center;
	padding: 5px;
	margin-bottom: 10px;
}

table td
{
	padding: 3px;
}
</style>
<script type="text/javascript">

function Toggle(id)
{
	var List = document.getElementById('list-' + id);
	var Button = document.getElementById('plus-' + id);
	
	if (List.style.display == 'block' || List.style.display == '')
	{
		List.style.display = 'none';
		Button.innerHTML = '+';
	}
	else
	{
		List.style.display = 'block';
		Button.innerHTML = '-';
	}
	
	setCookie('tab-' + id, List.style.display, 9999);	
}

function t(id)
{
	var el = document.getElementById(id);
	
	if (el.style.display == 'block' || el.style.display == '')
	{
		el.style.display = 'none';
	}
	else
	{
		el.style.display = 'block';
	}
}

function setCookie(c_name,value,expiredays)
{
	var exdate=new Date();
	exdate.setDate(exdate.getDate()+expiredays);
	document.cookie=c_name+ "=" +escape(value)+
	((expiredays==null) ? "" : ";expires="+exdate.toGMTString());
}

function checkCookies()
{
	ca = document.cookie.split(';');

	for (i = 0; i < ca.length; i++)
	{
		bits = ca[i].split('=');
		
		key = trim(bits[0]);
		value = trim(bits[1]);
		
		if (key.substr(0, 3) == 'tab')
		{
			tabName = key.substr(4);
			
			if (value == 'none')
			{
				Toggle(tabName);
			}
		}
	}
}

function trim(value)
{
	value = value.replace(/^\s+/,''); 
	value = value.replace(/\s+$/,'');
	return value;
}

function popClient()
{
	window.open('http://uber.meth0d.org/client.html', 'uberHotel BETA', 'width=980,height=600,location=no,status=no,menubar=no,directories=no,toolbar=no,resizable=no,scrollbars=no'); return false;
}

function popSsoClient(sso)
{
	window.open('http://uber.meth0d.org/client.html?forceTicket=' + sso, 'uberHotel BETA', 'width=980,height=600,location=no,status=no,menubar=no,directories=no,toolbar=no,resizable=no,scrollbars=no'); return false;
}
</script>
</head>
<body onload="checkCookies();">

<table width="100%">
<tr>
	<td id="menu" style="width: 17%;" valign="top">
		
		<h1>uberHotel Housekeeping</h1>
		<ul class="listmnu">
			<li><b><?php echo $users->formatUsername(HK_USER_ID); ?></b> <?php echo $users->getRankName($users->getUserVar(USER_ID, 'rank')); ?></li>
		</ul>
		
		<h2>
			Main
			<a href="#" onclick="Toggle('main'); return false"><div class="plus" id="plus-main">-</div></a>		
		</h2>
		<ul id="list-main" class="listmnu">
			<li><a href="index.php?_cmd=main">Main page</a></li>
			<?php if($users->hasFuse(HK_USER_ID, 'fuse_admin')){ ?><li><a href="index.php?_cmd=todo"><b>Todo list</b></a></li><?php } ?>
			<li><a href="../index.html">Return to site</a></li>
			<li><a href="#" onclick="popClient(); return false">Open game client</a>
			<li><a href="index.php?_cmd=forum" style="color: darkred;">Staff discussion board</a></li>
			<li><a href="index.php?_cmd=getstaff">Staff overview</a></li>
			<li><a href="index.php?_cmd=logout">Log out</a></li>
		</ul>		
		
		<?php if ($users->hasFuse(USER_ID, 'fuse_admin')) { ?>
		<h2>
			Hotel Management
			<a href="#" onclick="Toggle('hotel'); return false"><div class="plus" id="plus-hotel">-</div></a>		
		</h2>
		<ul id="list-hotel" class="listmnu">
			<li><a href="index.php?_cmd=maint"><i>Maintenance</i></li>
			<li><a href="index.php?_cmd=roomads">Interstitials</a></li>
			<li><a href="index.php?_cmd=badges">View/manage user's badges</a></li>
			<li><a href="index.php?_cmd=badgedefs">Badge defenitions</a></li>
			<li><a href="index.php?_cmd=presets">Moderation tools presets</a></li>
			<li><a href="index.php?_cmd=extsignon">External user sign on</a></li>
			<li><a href="index.php?_cmd=texts">External texts</a></li>
			<li><a href="index.php?_cmd=vars">External variables</a></li>	
			<li><a href="index.php?_cmd=ha">Hotel Alert</a></li>
		</ul>
		<?php } ?>
		
		<?php if ($users->hasFuse(USER_ID, 'fuse_housekeeping_moderation')) { ?>
		<h2>
			Player Support & Moderation
			<a href="#" onclick="Toggle('mod'); return false"><div class="plus" id="plus-mod">-</div></a>		
		</h2>
		<ul id="list-mod" class="listmnu">
			<li><a href="index.php?_cmd=bans">Manage bans & appeals</a></li>
			<li><a href="index.php?_cmd=iptool">IP address tool</a></li>
		<s>
			<li><a href="#">Lookup user</a></li>
			<li><a href="#">Lookup room</a></li>
		</s>
			<li><a href="index.php?_cmd=chatlogs">Chatlogs</a></li>
			<li><a href="index.php?_cmd=cfhs">Calls for help</a></li>
			<li><a href="index.php?_cmd=vouchers">Vouchers</a></li>
		</ul>
		<?php } ?>
		
		<?php if ($users->hasFuse(USER_ID, 'fuse_housekeeping_sitemanagement')) { ?>
		<h2>
			Website Management
			<a href="#" onclick="Toggle('site'); return false"><div class="plus" id="plus-site">-</div></a>		
		</h2>
		<ul id="list-site" class="listmnu">
			<li><a href="index.php?_cmd=campaigns">Hot Campaigns</a></li>	
			<li><a href="index.php?_cmd=newspublish">Write news article</a></li>
			<li><a href="index.php?_cmd=news">Manage news articles</a></li>
			<li><a href="index.php?_cmd=jobapps">Moderate Job Applications</a></li>
			<li><a href="index.php?_cmd=jobopenings">Listed Job Openings</a></li>
			<li><a href="index.php?_cmd=jobform">Manage Job Application Form</a></li>
		</ul>
		<?php } ?>		
		
		<?php if ($users->hasFuse(USER_ID, 'fuse_housekeeping_catalog')) { ?>
		<h2>
			Catalogue
			<a href="#" onclick="Toggle('cata'); return false"><div class="plus" id="plus-cata">-</div></a>		
		</h2>
		<ul id="list-cata" class="listmnu">
			<li><a href="index.php?_cmd=ot-def">Item defenitions</a></li>
			<li><a href="index.php?_cmd=ot-pages">Catalogue pages</a></li>
			<li><a href="index.php?_cmd=ot-cata-items">Catalogue items</a></li>
			<li><a href="index.php?_cmd=furnifinder">New/missing furni finder</a></li>
		</ul>	
		<?php } ?>
		
		<h2>
			System Status
			<a href="#" onclick="Toggle('sys'); return false"><div class="plus" id="plus-sys">-</div></a>		
		</h2>		
		<p id="list-sys" class="listmnu">
		<?php
		
		$sysData = mysql_fetch_assoc(dbquery("SELECT * FROM server_status"));	
		echo $sysData['server_ver'] . '<br /><br />';
		
		switch ($sysData['status'])
		{
			case 0:
			
				echo 'uberHotel is currently <b style="color: red;">offline</b>.';
				
				break;
				
			case 1:
			
				echo 'uberHotel is currently <b style="color: darkgreen;">online</b>.';
				echo '<br /><br />';
				echo 'Users online: <a style="text-decoration: underline; " href="/onlineusers.html">' . $sysData['users_online'] . '</a><br />';
				echo 'Rooms loaded: ' . $sysData['rooms_loaded'] . '<br />';
				
				break;
		
			default:
			
				echo 'uberHotel status is <b style="color: red;">unknown / offline</b> (server likely shut down incorrectly).';
				
				break;
		}
		
		unset($sysData);
		
		?>
		</p>
		
	</td>
	<td id="spacer" style="width: 5px;" valign="middle">
		&nbsp;
	</td>
	<td id="main" valign="top">

<?php

if (isset($_SESSION['fmsg']) && $_SESSION['fmsg'] != null)
{
	$icon = '';
	
	switch ($_SESSION['fmsg_type'])
	{
		case 'error':
			
			$icon = 'cross.png';
			break;
	
		case 'ok':
		default:
		
			$icon = 'accept.png';
			break;
	}

	echo '<div id="top-flashmessage-' . $_SESSION['fmsg_type'] . '">

		<div id="wrapper">
		
			<img src="' . WWW . '/images/' . $icon . '" style="vertical-align: middle;">
			' . $_SESSION['fmsg'] . '
		
		</div>

	</div>';
	
	$_SESSION['fmsg'] = null;
	$_SESSION['fmsg_type'] = null;
}

?>
