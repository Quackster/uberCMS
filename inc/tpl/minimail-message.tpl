	<ul class="message-headers">
            <li class="header-report"><a href="#" class="report" title="Report as offensive"></a></li>
		<li><b>Subject:</b> %subject%</li>
		<li><b>From:</b> %from%</li>
		<?php if (!$sent) { ?><li><b>To:</b> %to%</li><?php } ?>
	</ul>
    <div class="body-text">%body-text%</div>
    <div class="reply-controls">
        <div>
            <div class="new-buttons clearfix">
                <?php if (!$trashed) { ?><!--<a href="#" class="related-messages" id="rel-%message_id%" title="Show full conversation"></a>--><?php } ?>
				<?php if ($trashed) { ?><a href="#" class="new-button undelete"><b>Undelete</b><i></i></a><?php } ?>
            	<a href="#" class="new-button red-button delete"><b>Delete</b><i></i></a>
                <?php if (!$trashed && !$sent) { ?><a href="#" class="new-button reply"><b>Reply</b><i></i></a><?php } ?>
            </div>
        </div>
        <div style="display: none">
	        <textarea rows="5" cols="10" class="message-text"></textarea><br />
	        <div class="new-buttons clearfix">
    	        <a href="#" class="new-button cancel-reply"><b>Cancel</b><i></i></a>
    	        <a href="#" class="new-button preview"><b>Preview</b><i></i></a>
                <a href="#" class="new-button send-reply"><b>Send</b><i></i></a>
	        </div>
        </div>
    </div>
