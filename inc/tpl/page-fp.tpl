<body id="frontpage"> 

<div id="fp-container"> 
    <div id="header" class="clearfix"> 
        <h1><a href="%www%"></a></h1> 
		
        <span class="login-register-link"> 
            New here?
            <a href="%www%/register">REGISTER FOR FREE</a> 
        </span> 
		
    </div> 
    <div id="content"> 
        <div id="column1" class="column"> 
			     		
				<div class="habblet-container ">		
	
						<div class="logincontainer"> 
						%login_result%
<div class="cbb loginbox clearfix"> 
    <h2 class="title">Sign in</h2> 
    <div class="box-content clearfix" id="login-habblet"> 
        <form action="%www%/account/submit" method="post" class="login-habblet"> 
            
            <ul> 
                <li> 
                    <label for="login-username" class="login-text">Username</label> 
                    <input tabindex="1" type="text" class="login-field" name="credentials.username" id="login-username" value="%credentials_username%" maxlength="32" /> 
                </li> 
                <li> 
                    <label for="login-password" class="login-text">Password</label> 
                    <input tabindex="2" type="password" class="login-field" name="credentials.password" id="login-password" maxlength="32" /> 
                    <input type="submit" value="Sign in" class="submit" id="login-submit-button"/> 
                    <a href="#" id="login-submit-new-button" class="new-button" style="margin-left: 0;display:none"><b style="padding-left: 10px; padding-right: 7px; width: 55px">Sign in</b><i></i></a> 
                </li> 
                <li> 
					<br /><br />
                </li> 
                
                <li> 
<div id="rpx-signin"> 
<p><b><img src="%www%/images/exclamation.png" style="vertical-align: middle;"> This is NOT Habbo Hotel!</b></p>
<p>Always keep your details secure! For your own safety, never use the same password you use on the official hotels.</p>
</div>                </li>
                
                <li id="remember-me" class="no-label"> 
                    <input tabindex="4" type="checkbox" name="_login_remember_me" id="login-remember-me" value="true"/> 
                    <label for="login-remember-me">Remember me</label> 
                </li> 
                <li id="register-link" class="no-label"> 
                    <a href="%www%/register" class="login-register-link"><span>Register for free</span></a> 
                </li> 
                <li class="no-label"> 
                    <a href="%www%/account/password/forgot" id="forgot-password"><span>I forgot my password/username</span></a> 
                </li> 
            </ul> 
<div id="remember-me-notification" class="bottom-bubble" style="display: none;"> 
	<div class="bottom-bubble-t"><div></div></div> 
	<div class="bottom-bubble-c"> 
                By selecting 'remember me' you will stay signed in on this computer until you click 'Sign Out'. If this is a public computer please do not use this feature.
	</div> 
	<div class="bottom-bubble-b"><div></div></div> 
</div> 
        </form> 
 
    </div> 
</div> 
</div> 
<script type="text/javascript"> 
L10N.put("authentication.form.name", "Username");
L10N.put("authentication.form.password", "Password");
HabboView.add(function() {LoginFormUI.init();});
HabboView.add(function() {window.setTimeout(function() {RememberMeUI.init("newfrontpage");}, 100)});
</script> 
	
						
					
				</div> 
				<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script> 
				
				<!--
				
				(Uber PedoSeal)
				
				<div class="habblet-container pedobear" style="position: absolute; top: 300px; left: 700px; z-index: 100;">
					<img src="%www%/images/seal.png">
				</div> 
				<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>  
				
				(Uber PedoSeal)
				
				-->
			     		
				<div class="habblet-container ">		
	
						<a href="%www%/register" id="frontpage-image" style="background-image: url('%www%/images/front_page_hotel_with_habbos.png')"><div id="partner-logo"></div></a> 
<div style="width: 710px; margin: 0 auto"> 
<div id="tagline" class="roundedrect"><span>Never pay for credits again!</span> uberHotel is the fully <i>FREE</i> and awesome alternative to Habbo.</div> 
<div id="tagline" class="roundedrect tagcloud"><span><?php include 'tagcloud.tpl'; ?></div> 
<div style="height: 2px"></div> 
</div> 
 
<a href="%www%/register" class="big-button" onclick="location.href=this.href"> 
    <table> 
        <tr><td align="center" valign="middle">Join Uber for FREE!</td></tr> 
    </table> 
</a> 
	
						
							
					
				</div> 
				<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script> 
			 
</div> 
