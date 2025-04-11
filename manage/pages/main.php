<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN)
{
	exit;
}

require_once "top.php";

?>			

<h1>Welcome to uberHotel Housekeeping</h1>

<br />

<p>
	Housekeeping is a set of web-based tools that can assist in moderation, and even makes remote moderation possible
	without having to be logged into the hotel. This is a secure environment accessible to staff only, and your rank
	and rights define what tools you have access to.
</p>

<br />

<p>
	If you have any suggestions, questions, or feedback relating to houskeeping or moderation in general please use the
	discussion board.
</p>

<br />
<br />

<p>
	<a style="font-size: 120%;" href="http://roy.mine.nu/manage/index.php?_cmd=uberdown">
	
		<img src="images/uberdown.PNG" style="vertical-align: middle; margin-right: 10px;">
		
		<b style="color: darkred; font-size: 120%;">
			Uberdown - report downtime/freezes/critical problems to sysadmin
		</b>
	
	</a>
</p>

<br />

<p>
	<a style="font-size: 120%;" href="http://roy.mine.nu/manage/index.php?_cmd=forumthread&i=3">
	
		<img src="images/pdf.PNG" style="vertical-align: middle; margin-right: 10px;">
		
		<b>
			uberHotel Moderation Handbook
		</b>
	
	</a>
</p>

<br />

<p>
	<a style="font-size: 120%;" href="http://roy.mine.nu/manage/index.php?_cmd=forum">
	
		<img src="images/discussion.png" style="vertical-align: middle; margin-right: 10px;">
		
		<b>
			Staff discussion board
		</b>
		
	</a>
</p>

<br /><br />

<div style="width: 50%; border: 1px dotted; padding: 2px; margin: 0;">

	<h2 style="margin: 0;">
		Contact Details
	</h2>

	<div style="padding: 5px;">
	
		<p>
			In case of emergency or other serious issues that cannot wait
			or cannot be publicly discussed on the staff discussion board,
			please use the contact information below.
		</p>
		
		<br />
		
		<h3><a href="mailto:oscar@meth0d.org"><strong>oscar@meth0d.org</strong> - Community/Hotel Manager</a></h3>
		
		<p>
			With issues or questions regarding the community, content, staff, etc contact Oscar.
		</p>
		
		<br />
		
		<h3><a href="mailto:oscar@meth0d.org"><strong>roy@meth0d.org</strong> - Technical, Development and Server Administration</a></h3>
		
		<p>
			If you have questions and/or issues regarding the server, Uber's development, downtime, etcetera please contact Roy. Not for bug reports unless confidential.
		</p>		
		
	</div>

</div>

<?php

require_once "bottom.php";

?>