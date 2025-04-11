<div class="habblet-container ">		
						<div class="cbb clearfix red "> 
	
							<h2 class="title">%site_name% Club Test Wardrobe
							</h2> 
						<div id="habboclub-tryout" class="box-content"> 
 
    <div class="rounded rounded-lightbrown clearfix"> 
       <p class="habboclub-logo heading">Try on the club clothes for free here, but you'll need to join %site_name% Club to wear them in the hotel.<br /><br />If you just want to change your look, please go back to your <a href="%www%/profile">Account Settings.</a></p> 
    </div> 
 
    <div id="flashcontent"> 
        You need to have a Flash player installed on your computer before being able to edit your Habbo character. You can download the player from here: <a target="_blank" href="http://www.adobe.com/go/getflashplayer">http://www.adobe.com/go/getflashplayer</a> 
    </div>    
</div> 
 
<script type="text/javascript" language="JavaScript"> 
    var swfobj = new SWFObject("http://www.habbo.co.uk/%flash_build%/HabboRegistration.swf", "habboreg", "435", "400", "8");
    swfobj.addParam("base", "http://www.habbo.co.uk/%flash_build%/");
    swfobj.addParam("wmode", "opaque");
    swfobj.addParam("AllowScriptAccess", "always");
    swfobj.addVariable("figuredata_url", "http://hotel-uk.habbo.com/gamedata/figuredata");
    swfobj.addVariable("draworder_url", "http://hotel-uk.habbo.com/gamedata/figurepartconfig/draworder");
    swfobj.addVariable("localization_url", "http://www.habbo.co.uk/figure/figure_editor_xml");
    swfobj.addVariable("habbos_url", "http://www.habbo.co.uk/habblet/xml/promo_habbos");
    swfobj.addVariable("figure", "%look%");
    swfobj.addVariable("gender", "%gender%");
    swfobj.addVariable("showClubSelections", "1");
    if (deconcept.SWFObjectUtil.getPlayerVersion()["major"] >= 8) {
	    $("flashcontent").setStyle({ textAlign: "center", "marginTop" : "10px" });
	    swfobj.write("flashcontent");	    
    }
</script> 
	
						
							
					</div> 
				</div> 
				<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script> 