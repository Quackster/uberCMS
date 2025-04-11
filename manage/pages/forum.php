<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN)
{
	exit;
}

if (isset($_POST['msg']))
{
	$subject = $_POST['subj'];
	$body = $_POST['msg'];
	
	if (strlen($subject) < 1)
	{
		$subject = 'No subject';
	}
	
	if (strlen($body) < 20)
	{
		die("Message is too short. Please type something worthwhile.");
	}
	
	dbquery("INSERT INTO moderation_forum_threads (subject,message,poster,date,timestamp) VALUES ('" . filter($subject) . "','" . filter($body) . "','" . HK_USER_NAME . "','" . date('j F Y h:i A') . "','" . time() . "')");
	
	fMessage('ok', 'Thread created');
	
	header("Location: index.php?_cmd=forum");
	exit;
}

require_once "top.php";

?>			

<h1>Discussion Board</h1>

<p>
	Use the staff discussion board to give us feedback, report private bugs, or discuss other staff
	or moderation related topics. Please keep spam to a minimum and only post relevant topics.
	Threads
	that have had no posts for over a week will be removed automatically. If you would like a thread
	removed sooner for whatever reason, please ask an administrator.
</p>

<?php

$getTopics = dbquery("SELECT * FROM moderation_forum_threads ORDER BY timestamp DESC");

if (mysql_num_rows($getTopics) >= 1)
{
	while ($topic = mysql_fetch_assoc($getTopics))
	{
		echo '<h2 style="font-weight: normal;"><a href="index.php?_cmd=forumthread&i=' . $topic['id'] . '">';
		echo '<b style="font-size: 130%;">';
		
		if ($topic['locked'] >= 1)
		{
			echo '<img src="images/locked.gif" alt="Locked" title="Thread locked" style="vertical-align: middle;">&nbsp;';
		}		
		
		if ($topic['timestamp'] >= 99999999999)
		{
			echo '<img src="images/sticky.gif" alt="Sticky" title="Sticky topic" style="vertical-align: middle;">&nbsp;';
		}
		
		echo clean($topic['subject']) . '</b>&nbsp;';
		
		$rCount = mysql_result(dbquery("SELECT COUNT(*) FROM moderation_forum_replies WHERE thread_id = '" . $topic['id'] . "'"), 0);
		
		if ($topic['locked'] == "0" || $rCount > 0)
		{
			echo '(' . $rCount . ' replies)';
		}
		
		echo '<br />';
		
		/*echo '<p><small>' . substr($topic['message'], 0, 120);
		
		if (strlen($topic['message']) > 120)
		{
			echo '...';
		}
		
		echo '</small></p><br />';*/
		
		echo 'Posted on ' . $topic['date'] . ' by <b>' . $topic['poster'] . '</b>';
		echo '</a></h2>';
	}
}
else
{
	echo '<br /><center><b><i>No topics have been posted yet.</b></i></center><br />';
}

?>

<h2 id="cn-link">
	<a href="#" onclick="t('cn-link'); t('cn-form'); return false">Create new thread</a>
</h2>

<h2 id="cn-form" style="display: none;">
<form method="post">

Subject:<br />
<input type="text" name="subj" size="35" maxlength="120"><br />
<br />
Message:<br />
<textarea name="msg" cols="50" rows="5"></textarea><br />
<br />
<input type="submit" value="Submit">
<input type="button" value="Cancel" onclick="t('cn-link'); t('cn-form');">
</form>
</h2>

<?php

require_once "bottom.php";

?>