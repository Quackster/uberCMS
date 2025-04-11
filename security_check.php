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

if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}

if (isset($_SESSION['set_cookies']) && $_SESSION['set_cookies'] === true)
{
	setcookie('rememberme', 'true', time() + 2592000, '/');
	setcookie('rememberme_token', USER_HASH, time() + 2592000, '/');
	setcookie('rememberme_name', USER_NAME, time() + 2592000, '/');

	unset($_SESSION['set_cookies']);
}

$redirMode = WWW . '/me';

if (isset($_SESSION['page-redirect']))
{
	$redirMode = $_SESSION['page-redirect'];
	unset($_SESSION['page-redirect']);
}

?>
<html>
<head>
  <title>Redirecting...</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <style type="text/css">body { background-color: #e3e3db; text-align: center; font: 11px Verdana, Arial, Helvetica, sans-serif; } a { color: #fc6204; }</style>
</head>
<body>

<script type="text/javascript">window.location.replace('<?php echo $redirMode; ?>');</script><noscript><meta http-equiv="Refresh" content="0;URL=<?php echo $redirMode; ?>"></noscript>

<p class="btn">If you are not automatically redirected, please <a href="<?php echo $redirMode; ?>" id="manual_redirect_link">click here</a></p>

</body>
</html>