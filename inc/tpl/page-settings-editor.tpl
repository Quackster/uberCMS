<div class="habblet-container" style="float:left; width: 560px;"> 
<div class="cbb clearfix settings"> 
 
<h2 class="title">Change your looks</h2> 
<div class="box-content"> 
            
<?php if ($updateResult == 1) { ?>
	<div class="rounded rounded-green">
		Account Settings updated<br />
	</div>
	<div>&nbsp;</div>
<?php } ?>
            	
<div id="settings-editor"> 
You need to have a Flash player installed on your computer before being able to edit your Uber character. You can download the player from here: <a target="_blank" href="http://www.adobe.com/go/getflashplayer">http://www.adobe.com/go/getflashplayer</a> 
</div> 
 
<div id="settings-wardrobe" style="display: none"> 
</div> 
 
<div id="settings-hc" style="display: none"> 
	<div class="rounded rounded-hcred clearfix"> 
<a href="/credits/habboclub" id="settings-hc-logo"></a> 
You have selected items marked with the Uber Club symbol <img src="http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/images/habboclub/hc_mini.png" />, but they are available only to Uber Club members. <a href="%www%/credits/uberclub">Join now!</a> or change your outfit.
	</div> 
</div> 
 
<div id="settings-oldfigure" style="display: none"> 
	<div class="rounded rounded-lightbrown clearfix"> 
Your avatar had clothes or colours that are not available anymore. Please update your look and then save the changes.
	</div> 
</div> 
 
<form method="post" action="%www%/profile" id="settings-form" style="display: none"> 
<input type="hidden" name="tab" value="1" /> 
<input type="hidden" name="__app_key" value="%app_key%" /> 
<input type="hidden" name="figureData" id="settings-figure" value="%figureData%" /> 
<input type="hidden" name="newGender" id="settings-gender" value="%gender%" /> 
<input type="hidden" name="editorState" id="settings-state" value="" /> 
<a href="#" id="settings-submit" class="new-button disabled-button"><b>Save changes</b><i></i></a> 
</form> 
 
<script type="text/javascript" language="JavaScript"> 
var swfobj = new SWFObject("http://www.habbo.co.uk/%flash_build%/HabboRegistration.swf", "habboreg", "435", "400", "8");
swfobj.addParam("base", "http://www.habbo.co.uk/%flash_build%/");
swfobj.addParam("wmode", "opaque");
swfobj.addParam("AllowScriptAccess", "always");
swfobj.addVariable("figuredata_url", "http://hotel-uk.habbo.com/gamedata/figuredata");
swfobj.addVariable("draworder_url", "http://hotel-uk.habbo.com/gamedata/figurepartconfig/draworder");
swfobj.addVariable("localization_url", "http://www.habbo.co.uk/figure/figure_editor_xml");
swfobj.addVariable("habbos_url", "http://www.habbo.co.uk/habblet/xml/promo_habbos");
swfobj.addVariable("figure", "%figureData%");
swfobj.addVariable("gender", "%gender%");
<?php

if ($users->HasClub(USER_ID))
{
	echo 'swfobj.addVariable("userHasClub", "1");' . LB;
	echo 'swfobj.addVariable("showClubSelections", "1");' . LB;	
}

?>
 
 
 
if (deconcept.SWFObjectUtil.getPlayerVersion()["major"] >= 8) {
	swfobj.write("settings-editor");
	$("settings-form").show();
	$("settings-wardrobe").show();
}
</script> 
 
</div> 
 
</div> 
</div> 
</div> 
 
</div> 
    </div> 