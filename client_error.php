<?php

require_once "global.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
<head> 
<meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
<title>Uber / private beta</title> 
<style type="text/css">
body
{
	background-color: #fff;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: rgb(65, 65, 66);	
	margin: auto;
	padding-top: 50px;
}

#container
{
	margin: 10px;
	padding: 10px;
	vertical-align: middle;
}

a, a:visited, a:hover, a:active
{
	color: blue;
	text-decoration: none;
	border-bottom: 1px dotted;
}

a:hover
{
	border-bottom: 1px solid;
}

h1
{
	font-size: 300%;
}
</style>
</head>
<body>

<div id="container">
<table width="100%" height="100%">
<tr>
	<td valign="middle" style="text-align: center;">
		<img src="<?php echo WWW; ?>/images/sadface.png">
	</td>
	<td valign="middle" style="float: right; padding: 25px;">
		
		<?php if (LOGGED_IN) { ?>
		<h1>Game client error</h1>
		
		<h2>
			The game client encountered an critical problem and needed to close.<br />
			Try to reload the client. If you think you've found a bug, please report it.
		</h2>
		
		<br />
		
		<h3>
			<a href="<?php echo WWW; ?>/client">Reload client</a>
		</h3>
		
		<h3>
			<a href="https://uber.uservoice.com/forums/40871-general">Report an bug/submit feedback</a>
		</h3>		
		<?php } else { ?>
		<h1>Logged out</h1>
		
		<h2>
			You have been logged out of the hotel. Thanks for visiting!
		</h2>
		
		<br />
		
		<h3>
			<a href="<?php echo WWW; ?>/client">Log in again?</a>
		</h3>		
		<?php } ?>
		
		<h3>
			<a href="#" onclick="window.close();">Close window</a>
		</h3>		
		
	</td>
</tr>
</div>
	
</body> 
</html>