<body id="%body_id%" class="<?php if (!LOGGED_IN) { echo 'anonymous'; } ?> "> 
<div id="overlay"></div> 
<div id="header-container"> 
	<div id="header" class="clearfix"> 
		<h1><a href="%www%"></a></h1> 
       <div id="subnavi"> 
			<div id="subnavi-user"> 
			<?php if (LOGGED_IN) { ?>
				<ul> 
					<li id="myfriends"><a href="#"><span>My Friends</span></a><span class="r"></span></li> 
					<li id="mygroups"><a href="#"><span>My Groups</span></a><span class="r"></span></li> 
					<li id="myrooms"><a href="#"><span>My Rooms</span></a><span class="r"></span></li> 
				</ul> 
			<?php } else { ?>
			<div class="clearfix">&nbsp;</div> 
                <p> 
				        <a href="%www%/client" id="enter-hotel-open-medium-link" target="client" onclick="HabboClient.openOrFocus(this); return false;">Enter uberHotel</a> 
                </p> 
			<?php } ?>
			</div> 
			<?php if (LOGGED_IN) { ?>
            <div id="subnavi-search"> 
                <div id="subnavi-search-upper"> 
                <ul id="subnavi-search-links"> 
                    <li><a href="%www%/help" target="habbohelp" onclick="openOrFocusHelp(this); return false">Help</a></li> 
					<li><a href="%www%/account/logout" class="userlink" id="signout">Sign Out</a></li> 
				</ul> 
                </div> 
            </div> 
            <div id="to-hotel"> 
					    <a href="%www%/client" class="new-button green-button" target="uberClientWnd" onclick="HabboClient.openOrFocus(this); return false;"><b>Enter uberHotel</b><i></i></a> 
						
			<?php if ($users->HasFuse(USER_ID, 'fuse_housekeeping_login')) { ?>
								    <a href="%www%/manage/" class="new-button red-button" style="margin-right: 5px;"><b>Housekeeping</b><i></i></a> 
			<?php } ?>
			</div>            
        </div> 
        <script type="text/javascript"> 
		L10N.put("purchase.group.title", "Create a group");
		document.observe("dom:loaded", function() {
            $("signout").observe("click", function() {
                HabboClient.close();
            });
        });
        </script>
		<?php } else { ?>
		           <div id="subnavi-login"> 
                <form action="%www%/account/submit" method="post" id="login-form"> 
            		<input type="hidden" name="page" value="%www%<?php echo $_SERVER['PHP_SELF']; ?>" /> 
                    <ul> 
                        <li> 
                            <label for="login-username" class="login-text"><b>Username</b></label> 
                            <input tabindex="1" type="text" class="login-field" name="credentials.username" id="login-username" /> 
		                    <a href="#" id="login-submit-new-button" class="new-button" style="float: left; display:none"><b>Sign in</b><i></i></a> 
                            <input type="submit" id="login-submit-button" value="Sign in" class="submit"/> 
                        </li> 
                        <li> 
                            <label for="login-password" class="login-text"><b>Password</b></label> 
                            <input tabindex="2" type="password" class="login-field" name="credentials.password" id="login-password" /> 
                            <input tabindex="3" type="checkbox" name="_login_remember_me" value="true" id="login-remember-me" /> 
                            <label for="login-remember-me" class="left">Remember me</label> 
                        </li> 
                    </ul> 
                </form> 
                <div id="subnavi-login-help" class="clearfix"> 
                    <ul> 
                        <li class="register"><a href="%www%/account/password/forgot" id="forgot-password"><span>Forgot password/username?</span></a></li> 
                    	<li><a href="%www%/register"><span>Register for free</span></a></li> 
                    </ul> 
                </div> 
<div id="remember-me-notification" class="bottom-bubble" style="display:none;"> 
	<div class="bottom-bubble-t"><div></div></div> 
	<div class="bottom-bubble-c"> 
					By selecting 'remember me' you will stay signed in on this computer until you click 'Sign Out'. If this is a public computer please do not use this feature.
	</div> 
	<div class="bottom-bubble-b"><div></div></div> 
</div> 
            </div> 
        </div> 
		<script type="text/javascript"> 
			LoginFormUI.init();
			RememberMeUI.init("right");
		</script> 
		<?php } ?>
		
<ul id="navi"> 
<?php

$data = dbquery("SELECT id,caption,class,url,visibility FROM site_navi WHERE parent_id = '0' ORDER BY order_id ASC");

while ($link = mysql_fetch_assoc($data))
{
	$allowDisplay = true;
	
	switch ($link['visibility'])
	{
		default:
		case 0:
		
			$allowDisplay = false;
			break;
		
		case 1:
		
			break;
			
		case 2:
		
			if (!LOGGED_IN)
			{
				$allowDisplay = false;	
			}
			
			break;
			
		case 3:
		
			if (LOGGED_IN)
			{
				$allowDisplay = false;
			}
			
			break;
	}

	if (!$allowDisplay)
	{
		continue;
	}

	$class = clean($link['class']);
	$showLink = true;
	
	if (defined('TAB_ID') && TAB_ID == $link['id'])
	{
		$class .= ' selected';
		$showLink = false;
	}

	echo '	<li ' . (($class == "tab-register-now") ? 'id="tab-register-now"' : '') . ' class="' . $class . '">';
	 
	if ($showLink)
	{
		echo '<a href="' . clean($link['url']) . '">';
	}
	else
	{
		echo '<strong>';
	}
	
	echo clean($link['caption']);
	
	if ($showLink)
	{
		echo '</a>';
	}
	else
	{
		echo '</strong>';
	}
	
	echo '	<span></span> 
	</li>' . LB;
}

?>
</ul> 
 
        <div id="habbos-online"><div class="rounded"><span>%hotel_status%</span></div></div> 
		
	</div> 
</div> 

 
<div id="content-container"> 
 
<?php if (LOGGED_IN || defined('TAB_ID')) { ?>
<div id="navi2-container" class="pngbg"> 
    <div id="navi2" class="pngbg clearfix"> 
	<ul> 
	<?php
	
	$i = 0;
	$lookupParent = '1';
	
	if (defined('TAB_ID'))
	{
		$lookupParent = TAB_ID;
	}
	
	$getSub = dbquery("SELECT id,caption,url,visibility FROM site_navi WHERE parent_id = '" . $lookupParent . "' ORDER BY order_id ASC");
	
	while ($subLink = mysql_fetch_assoc($getSub))
	{
		$allowDisplay = true;

		switch ($subLink['visibility'])
		{
			default:
			case 0:
			
				$allowDisplay = false;
				break;
			
			case 1:
			
				break;
				
			case 2:
			
				if (!LOGGED_IN)
				{
					$allowDisplay = false;	
				}
				
				break;
				
			case 3:
			
				if (LOGGED_IN)
				{
					$allowDisplay = false;
				}
				
				break;
		}
		
		$i++;
		
		if (!$allowDisplay)
		{
			continue;
		}
		
		$class = '';
		$showLink = true;
		
		if (defined('PAGE_ID') && PAGE_ID == $subLink['id']) 
		{
			$class .= ' selected';
			$showLink = false;
		}
		
		if ($i == mysql_num_rows($getSub))
		{
			$class .= ' last';
		}
	
		echo '<li class="' . $class . '">';
		if ($showLink) echo '<a href="' . clean($subLink['url']) . '">';
		echo clean($subLink['caption']);
		if ($showLink) echo '</a>';
		echo '</li>';
	}
			
	?>
	</ul> 
    </div> 
</div> 
<?php } ?>

<div id="container">
<div id="content" style="position: relative" class="clearfix">
