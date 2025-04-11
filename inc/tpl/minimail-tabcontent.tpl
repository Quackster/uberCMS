<?php

$folder = '';
$unreadMode = false;

if (isset($unreadOnly) && $unreadOnly == "true")
{	
	$unreadMode = true;
}

if (isset($label))
{
	$folder = $label;
}

if ($folder != 'inbox' && $folder != 'sent' && $folder != 'trash')
{
	$folder = 'inbox';
}

$isReadClause = '';

if ($unreadMode)
{
	$isReadClause = " AND is_read = '0'";
}

$getMessages = dbquery("SELECT * FROM site_minimail WHERE folder = '" . $folder . "' AND receiver_id = '" . USER_ID . "'" . $isReadClause . " ORDER BY id DESC");
$messageCount = mysql_num_rows($getMessages);

$navigator = '';

if ($messageCount > 0)
{
	$navigator = '<div class="progress"></div> ' . $messageCount . ' - ' . $messageCount . ' of ' . $messageCount . '</p>';
}

?>

<a href="#" class="new-button compose"><b>Compose</b><i></i></a> 

<div class="clearfix labels nostandard"> 
    <ul class="box-tabs"> 
        <li <?php if ($folder == 'inbox') { echo 'class="selected"'; } ?>><a href="#" label="inbox">Inbox</a><span class="tab-spacer"></span></li> 
        <li <?php if ($folder == 'sent') { echo 'class="selected"'; } ?>><a href="#" label="sent">Sent</a><span class="tab-spacer"></span></li> 
        <li <?php if ($folder == 'trash') { echo 'class="selected"'; } ?>><a href="#" label="trash">Trash</a><span class="tab-spacer"></span></li> 
    </ul> 
</div> 
 
 
<div id="message-list" class="label-inbox"> 
<div class="new-buttons clearfix"> 
	<div class="labels inbox-refresh"><a href="#" class="new-button green-button" label="<?php echo $folder; ?>" style="float: left; margin: 0"><b>Refresh</b><i></i></a></div> 
</div> 
<div style="clear: both; height: 1px"></div> 

<?php if ($folder == 'trash' && $messageCount >= 1) { ?>
    <div class="trash-controls notice">
        Messages in this folder that are older than 30 days are deleted automatically. <a href="#" class="empty-trash">Empty trash</a>
    </div>
<?php } ?>
 
<div class="navigation"> 
<?php if ($folder == 'inbox') { ?><div class="unread-selector"><input type="checkbox" class="unread-only" <?php if ($unreadMode) { echo 'checked'; } ?>/> only unread</div><?php } ?>
<?php echo $navigator; ?>
</div> 
 
	<?php
	
	if (mysql_num_rows($getMessages) > 0)
	{
		while ($message = mysql_fetch_assoc($getMessages))
		{
			$getSender = dbquery("SELECT username,look FROM users WHERE id = '" . $message['sender_id'] . "' LIMIT 1");
			$senderData = Array();
			
			if (mysql_num_rows($getSender) > 0)
			{
				$senderData = mysql_fetch_assoc($getSender);
			}
			else
			{
				continue;
			}
		
			echo '	<div class="message-item ' . (($message['is_read'] == "0") ? 'unread' : 'read') . ' " id="msg-' . $message['id'] . '">
		<div class="message-preview" status="' . (($message['is_read'] == "0") ? 'unread' : 'read') . '">
			<span class="message-tstamp" isotime="' . $message['isodate'] . '" title="' . $message['date'] . '">
			    ' . $message['date'] . '
			</span>
			<img src="http://www.habbo.co.uk/habbo-imaging/avatarimage?figure=' . clean($senderData['look']) . '&direction=2&head_direction=2&size=s" /> 
			<span class="message-sender" title="' . clean($senderData['username']) . '">' . $senderData['username'] . '</span>
			
			<span class="message-subject" title="' . clean($message['subject']) . '">&ldquo;' . clean($message['subject']) . '&rdquo;</span>
		</div>
		<div class="message-body" style="display: none;">
		    <div class="contents"></div>
            <div class="message-body-bottom"></div>
		</div>		
	</div>';
		}
	}
	else
	{
		echo '	<p class="no-messages">';
	
		switch ($folder)
		{
			default:
			case 'inbox':
			
				if ($unreadMode)
				{
					echo 'No unread messages';
				}
				else
				{
					echo 'No messages';
				}
			   
			   break;
			   
			case 'sent':
			
				echo 'No sent messages';
				break;
			   
			case 'trash':
			
				echo 'No deleted messages';
				break;
		}
		
		echo '	</p> ';
	}
	
	if ($navigator != '')
	{
		echo '<div class="navigation">' . $navigator . '</div>';
	}
	
	?>
 
</div>