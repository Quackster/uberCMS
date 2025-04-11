<?php

$getUser = dbquery("SELECT * FROM users WHERE id = '" . $user_id . "' LIMIT 1");

if (mysql_num_rows($getUser) < 0)
{
	exit;
}

$userData = mysql_fetch_assoc($getUser);


$status = 'offline';
if ($userData['online'] == "1") { $status = 'online'; }

?>
<div class="movable widget ProfileWidget" id="widget-%id%" style=" left: %pos-x%px; top: %pos-y%px; z-index: %pos-z%;"> 
<div class="%skin%"> 
	<div class="widget-corner" id="widget-%id%-handle"> 
		<div class="widget-headline"><h3><span class="header-left">&nbsp;</span><span class="header-middle">MY HABBO</span><span class="header-right">&nbsp;</span></h3> 
		</div>	
	</div> 
	<div class="widget-body"> 
		<div class="widget-content"> 
	<div class="profile-info"> 
		<div class="name" style="float: left"> 
		<span class="name-text"><?php echo clean($userData['username']); ?></span> 
		</div> 
 
		<br class="clear" /> 
 
			<img alt="<?php echo $status; ?>" src="%static_url%/web-gallery/images/myhabbo/profile/habbo_<?php echo $status; ?>.gif" /> 
		<div class="birthday text"> 
			Created on:
		</div> 
		<div class="birthday date"> 
			<?php echo clean($userData['account_created']); ?>
		</div> 
		<div> 
        	
            
        </div> 
	</div> 
	<div class="profile-figure"> 
			<img alt="<?php echo clean($userData['username']); ?>" src="http://www.habbo.co.uk/habbo-imaging/avatarimage?figure=<?php echo clean($userData['look']); ?>&direction=4" /> 
	</div> 
		
	<br clear="all" style="display: block; height: 1px"/> 
    <div id="profile-tags-panel"> 
    <div id="profile-tag-list"> 

 
    </div> 
    </div> 
    <script type="text/javascript"> 
		document.observe("dom:loaded", function() {
			new ProfileWidget('22033873', null, {
				headerText: "Are you sure?",
				messageText: "Are you sure you want to ask <strong\>Meth0d15</strong\> to be your friend?",
				loginText: "You must sign in before sending a friend request.",
				buttonText: "OK",
				cancelButtonText: "Cancel"
			});
		});
	</script> 
		<div class="clear"></div> 
		</div> 
	</div> 
</div> 
</div> 