<div class="habblet-container minimail" id="mail">		
						<div class="cbb clearfix blue "> 
	
							<h2 class="title">My Messages
							</h2> 
						<div id="minimail"> 
    <div class="minimail-contents"> 
	<?php include('minimail-tabcontent.tpl'); ?>
	</div> 
	<div id="message-compose-wait"></div> 
    <form style="display: none" id="message-compose"> 
        <div>To</div> 
        <div id="message-recipients-container" class="input-text" style="width: 426px; margin-bottom: 1em"> 
        	<input type="text" value="" id="message-recipients" /> 
        	<div class="autocomplete" id="message-recipients-auto"> 
        		<div class="default" style="display: none;">Type the name of your friend</div> 
        		<ul class="feed" style="display: none;"></ul> 
        	</div> 
        </div> 
        <div>Subject<br/> 
        <input type="text" style="margin: 5px 0" id="message-subject" class="message-text" maxlength="100" tabindex="2" /> 
        </div> 
        <div>Message<br/> 
        <textarea style="margin: 5px 0" rows="5" cols="10" id="message-body" class="message-text" tabindex="3"></textarea> 
        </div> 
        <div class="new-buttons clearfix"> 
            <a href="#" class="new-button preview"><b>Preview</b><i></i></a> 
            <a href="#" class="new-button send"><b>Send</b><i></i></a> 
        </div> 
    </form>	
</div> 
<script type="text/javascript"> 
	L10N.put("minimail.compose", "Compose").put("minimail.cancel", "Cancel")
		.put("bbcode.colors.red", "Red").put("bbcode.colors.orange", "Orange")
    	.put("bbcode.colors.yellow", "Yellow").put("bbcode.colors.green", "Green")
    	.put("bbcode.colors.cyan", "Cyan").put("bbcode.colors.blue", "Blue")
    	.put("bbcode.colors.gray", "Grey").put("bbcode.colors.black", "Black")
    	.put("minimail.empty_body.confirm", "Are you sure you want to send the message with an empty body?")
    	.put("bbcode.colors.label", "Colours").put("linktool.find.label", " ")
    	.put("linktool.scope.habbos", "Habbo").put("linktool.scope.rooms", "Room")
    	.put("linktool.scope.groups", "Group").put("minimail.report.title", "Report message to moderators");
 
    L10N.put("date.pretty.just_now", "just now");            
    L10N.put("date.pretty.one_minute_ago", "1 minute ago");            
    L10N.put("date.pretty.minutes_ago", "{0} minutes ago");            
    L10N.put("date.pretty.one_hour_ago", "1 hour ago");            
    L10N.put("date.pretty.hours_ago", "{0} hours ago");            
    L10N.put("date.pretty.yesterday", "yesterday");            
    L10N.put("date.pretty.days_ago", "{0} days ago");            
    L10N.put("date.pretty.one_week_ago", "1 week ago");            
    L10N.put("date.pretty.weeks_ago", "{0} weeks ago");            
	new MiniMail({ pageSize: 10, 
	   total: 0, 
	   friendCount: 3, 
	   maxRecipients: 50, 
	   messageMaxLength: 20, 
	   bodyMaxLength: 4096,
	   secondLevel: false});
</script> 
	
						
							
					</div> 
				</div> 
				<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script> 