<div class="habblet-container ">		
<div class="cbb clearfix red "> 

<h2 class="title">What's going on?</h2> 

<div id="hotcampaigns-habblet-list-container"> 

<ul id="hotcampaigns-habblet-list"> 
<?php

$getItems = dbquery("SELECT * FROM site_hotcampaigns WHERE enabled = '1' ORDER BY order_id ASC");
$evenOdd = 'odd';

while ($item = mysql_fetch_assoc($getItems))
{
	if ($evenOdd == 'odd')
	{
		$evenOdd = 'even';
	}
	else
	{
		$evenOdd = 'odd';
	}
	
	echo '<li class="' . $evenOdd . '"> 
            <div class="hotcampaign-container"> 
                <a href="' . clean($item['url']) . '">
				<img src="' . clean($item['image_url']) . '" align="left" alt="' . clean($item['caption']) . '" /></a> 
                <h3>' . clean($item['caption']) . '</h3> 
                <p>' . clean($item['descr']) . '</p> 
                <p class="link"><a href="' . clean($item['url']) . '">Go there &raquo;</a></p> 
            </div> 
        </li> ';
}

?>
</ul>

</div>
</div>
</div>
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>