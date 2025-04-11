				<div class="habblet-container ">		
	
						<div id="new-personal-info" style="background-image:url(%www%/images/htlview_gb.png)"> 
 
 
 
    <div class="enter-hotel-btn"> 
        <div class="open enter-btn"> 
                <a href="%www%/client" target="uberClientWnd" onclick="HabboClient.openOrFocus(this); return false;">Enter uberHotel<i></i></a> 
            <b></b> 
        </div> 
    </div> 
    
 
	<div id="habbo-plate"> 
		<a href="%www%/profile"> 
				<img alt="%habboName%" src="http://www.habbo.co.uk/habbo-imaging/avatarimage?figure=%look%" /> 
		</a> 
	</div> 
 
	<div id="habbo-info"> 
		<div id="motto-container" class="clearfix">			
			<strong>%habboName%:</strong> 
			<div>
			<?php
			
			if (strlen($motto) == 0)
			{
				$motto = "What's on your mind today?";
			}
			
			echo '<span title="' . $motto . '">' . $motto . '</span>';
			echo '<p style="display: none"><input type="text" maxlength="40" name="motto" value="' . $motto . '"/></p>';
				
			?>
			
				
			</div> 
		</div> 
		<div id="motto-links" style="display: none"><a href="#" id="motto-cancel">Cancel</a></div> 
	</div> 
	
	<ul id="link-bar" class="clearfix"> 
		<li class="change-looks"><a href="%www%/profile">Change looks &raquo;</a></li>		
		<li class="credits"> 
			<a href="%www%/credits">%creditsBalance%</a> Credits
		</li>		
		<li class="club"> 
            <span id="clubdaysleft" style="display:none"> 
                <a href="%www%/credits/uberclub">0</a> 
                Club days left
            </span> 
            <span id="joinclub"> 
                %clubStatus%
            </span> 
		</li> 
		    <li class="activitypoints"> 
			    <a href="%www%/credits/pixels">%pixelsBalance%</a> Pixels
		    </li> 
	</ul> 
	
	<div id="habbo-feed"> 
		<ul id="feed-items">  
			<li class="small" id="feed-beta" style="background-image: url('%www%/images/betarat.gif') !important; padding-left: 65px;">
				
				Thank you for being a part of the uberHotel BETA. Please head over to our <a href="http://uber.uservoice.com/forums/45577-general">uservoice forum</a> to submit any feedback, ideas, and bug reports.
				
			</li>
	        <li class="small" id="feed-lastlogin"> 
                Last signed in:
                %lastSignedIn%
	        </li> 
		</ul> 
	</div> 
	<p class="last"></p> 
</div> 
 
<script type="text/javascript"> 
	HabboView.add(function() {
		L10N.put("personal_info.motto_editor.spamming", "Don\'t spam me, bro!");
		PersonalInfo.init("");
	});
</script> 
	
						
							
					
				</div> 
				<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>