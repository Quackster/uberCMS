<div class="habblet-container ">		
						<div class="cbb clearfix green "> 
<div class="box-tabs-container clearfix"> 
    <h2>Tags</h2> 
    <ul class="box-tabs"> 
        <li id="tab-1-6-1"><a href="#">%site_name%s like...</a><span class="tab-spacer"></span></li> 
        <li id="tab-1-6-2" class="selected"><a href="#">My Tags</a><span class="tab-spacer"></span></li> 
    </ul> 
</div> 
    <div id="tab-1-6-1-content"  style="display: none"> 
    		<div class="progressbar"><img src="%site_name%/web-gallery/images/progress_bubbles.gif" alt="" width="29" height="6" /></div> 
    		<a href="/habblet/proxy?hid=h22" class="tab-ajax"></a> 
    </div> 
    <div id="tab-1-6-2-content" > 
    
	<?php
	
	$tags = uberUsers::GetUserTags(USER_ID);
	$tagCount = count($tags);
	
	if ($tagCount == 0)
	{
		echo '<div id="my-tag-info" class="habblet-content-info">You have no tags. Answer the question below or just add a tag of your choice. Tags make it easier to find other users who share your interests.</div>';
	}
	else if ($tagCount < 20)
	{
		echo '<div id="my-tag-info" class="habblet-content-info">You haven\'t used up all your tags yet - add some more!</div>';
	}
		 
	?>
	
<div class="box-content"> 
<?php

include "comp-taglist.tpl";

?>
</div> 
 
</div> 
</div> 

<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>