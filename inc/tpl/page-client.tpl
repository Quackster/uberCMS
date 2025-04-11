<body id="client" class="flashclient"> 
 
<script type="text/javascript"> 
var habboDefaultClientPopupUrl = "%www%/client";
</script> 

<noscript> 
    <meta http-equiv="refresh" content="0;url=%www%/client/nojs" /> 
</noscript>

<script type="text/javascript"> 
    FlashExternalInterface.loginLogEnabled = true;
    
    FlashExternalInterface.logLoginStep("web.view.start");
    
    if (top == self) {
        FlashHabboClient.cacheCheck();
    }
    var flashvars = {
            "client.allow.cross.domain" : "1", 
            "client.notify.cross.domain" : "0", 
            "connection.info.host" : "127.0.0.1", 
            "connection.info.port" : "30001", 
            "site.url" : "%www%", 
            "url.prefix" : "%www%", 
            "client.reload.url" : "%www%/account/reauthenticate?page=/flash_client", 
            "client.fatal.error.url" : "%www%/flash_client_error", 
            "client.connection.failed.url" : "%www%/client_connection_failed", 
            "external.hash" : "", 
            "external.variables.txt" : "%external_variables%", 
            "external.texts.txt" : "%external_flash_texts%", 
            "use.sso.ticket" : "1",
<?php

if ($forwardType > 0)
{
	echo '            "forward.type" : "' . $forwardType . '",' . LB;
	echo '            "forward.id" : "' . $forwardId . '",' . LB;
}

?>
            "sso.ticket" : "%sso_ticket%", 
            "processlog.enabled" : "0", 
            "account_id" : "0", 
            "client.starting" : "Welcome to the uberHotel BETA!", 
            "flash.client.url" : "%flash_client_url%", 
            "user.hash" : "", 
            "facebook.user" : "0", 
            "has.identity" : "0", 
            "flash.client.origin" : "popup" 
    };
    var params = {
        "base" : "%flash_base%",
        "allowScriptAccess" : "always",
        "menu" : "false"                
    };
    
    if (!(HabbletLoader.needsFlashKbWorkaround())) {
    	params["wmode"] = "opaque";
    }
    
    var clientUrl = "%flash_base%Habbo10.swf";
    try {
        if (swfobject.getFlashPlayerVersion().major <= 9) { 
            clientUrl = "%flash_base%Habbo.swf"; 
        }
    } catch(e) {}
    swfobject.embedSWF(clientUrl, "flash-container", "100%", "100%", "9.0.115", "%static_url%/web-gallery/flash/expressInstall.swf", flashvars, params);
</script> 
 
<div id="overlay"></div> 
<div id="client-ui" > 
    <div id="flash-wrapper"> 
    <div id="flash-container"> 
        <div id="content" style="width: 400px; margin: 20px auto 0 auto; display: none"> 
<div class="cbb clearfix"> 
    <h2 class="title">Please install Adobe Flash Player.</h2> 
    <div class="box-content"> 
            <p>You can install and download Adobe Flash Player here: <a href="http://get.adobe.com/flashplayer/">Install flash player</a>. More instructions for installation can be found here: <a href="http://www.adobe.com/products/flashplayer/productinfo/instructions/">More information</a></p> 
            <p><a href="http://www.adobe.com/go/getflashplayer"><img src="%static_url%/web-gallery/v2/images/client/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p> 
    </div> 
</div> 
        </div> 
        <script type="text/javascript"> 
            $('content').show();
        </script> 
        <noscript> 
            <div style="width: 400px; margin: 20px auto 0 auto; text-align: center"> 
                <p>If you are not automatically redirected, please <a href="/client/nojs">click here</a></p> 
            </div> 
        </noscript> 
    </div> 
    </div> 
	<div id="content" class="client-content"></div>            
</div> 
    <div style="display: none"> 
<div id="habboCountUpdateTarget"> 
%hotel_status%
</div> 
	<script language="JavaScript" type="text/javascript"> 
		setTimeout(function() {
			HabboCounter.init(600);
		}, 20000);
	</script> 
    </div> 
    <script type="text/javascript"> 
        RightClick.init("flash-wrapper", "flash-container");
    </script> 
 
</body> 
</html>