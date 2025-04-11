<div class="habblet-container ">		
						<div class="cbb clearfix hcred "> 
	
							<h2 class="title">My Membership
							</h2> 
							
<?php if (LOGGED_IN) { ?>
						<script src="http://images.habbo.com/habboweb/%web_build%/web-gallery/static/js/habboclub.js" type="text/javascript"></script> 
<div id="hc-habblet"> 
    <div id="hc-membership-info" class="box-content"> 
<?php

$clubDays = $users->GetClubDays(USER_ID);

if ($clubDays <= 0)
{
	echo '<p>You are not a member of Uber Club.</p>';
}
else
{
	echo '<p>You are a member of Uber Club.</p>';
	echo '<p>You still have <b>' . $clubDays . '</b> days left in your club membership.</p>';
}

?>
    </div> 
    <div id="hc-buy-container" class="box-content">
		<div id="hc-buy-buttons" class="hc-buy-buttons rounded rounded-hcred">
		<?php if ($users->GetUserVar(USER_ID, 'credits') < 200) { ?>
        
            <form class="subscribe-form" method="post"> 
                <input type="hidden" id="settings-figure" name="figureData" value=""> 
                <input type="hidden" id="settings-gender" name="newGender" value=""> 
                <table width="97%" style="text-align: center;"> 
                  <p class="credits-notice">To join Uber Club you first need to buy some Uber Credits:</p> 
                  <p class="credits-notice">Uber Club membership starts from 20 credits</p>                  
                  <a class="new-button fill" href="%www%/credits"><b>Get Uber Credits</b><i></i></a> 
                </table> 
            </form> 
			
		<?php } else { ?>
		<p>If you would like to purchase or extend a club membership, please visit the 'Uber Club' page
		in the ingame catalogue.</p>
		<?php } ?>
		</div>
    </div> 
</div> 
<?php } else { ?>
<div id="hc-habblet" class='box-content'> 
Please sign in to see your Uber Club status
</div> 
<?php } ?>
	
						
					</div> 
				</div> 
				<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script> 