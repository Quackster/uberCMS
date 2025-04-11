<div class="habblet-container ">		
<div class="cbb clearfix activehomes "> 

	<h2 class="title red">Spend your VIP Points - Hot Items</h2>
	
	<style type="text/css">
	.vip-odd { background-color: #9ED1E4; }
	.vip-even { background-color: #BBDAE4; }
	</style>
	
	<?php
	
	$oddEven = 'odd';
	
	for ($i = 0; $i < 5; $i++)
	{		
		$cost = 20000;
	
		if ($oddEven == 'odd')
		{
			$oddEven = 'even';
		}
		else
		{
			$oddEven = 'odd';
		}
	
		echo '	<table width="100%" class="vip-' . $oddEven . '">
	<tr>
		<td width="110" style="padding: 10px;" valign="middle">
		
			<div class="icon" height: 100px; width: 100px;">
				<img src="%www%/images/test.png">
			</div>
		
		</td>
		
		<td valign="top" style="text-align: left;">
			<h3>New personality</h3>
			<p>
				People hate you. So it\'s time for some change. Get a new personality, VIP style!
			</p>
			
			<div style="border-top: 1px dotted; padding-top: 8px; ">
			
				<div style="float: left; padding-top: 5px;">
					Only <b style="' . (($users->GetUserVar(USER_ID, 'vip_points') < $cost) ? 'color: red;' : '' ) . '">' . $cost . ' <img src="%www%/images/vipcoin.gif" style="vertical-align: middle;"></b>
				</div>
				
				<div style="float: right;">';
				
				if ($users->GetUserVar(USER_ID, 'vip_points') >= $cost)
				{
					echo '<a href="#" class="new-button gray-button" style="margin: 0;"><b>Buy</b><i></i></a> ';
				}
				else
				{
					echo '<a href="%www%/vip/getpoints" class="new-button red-button" style="margin: 0;"><b>Need more points</b><i></i></a>';
				}
				
				echo '</div>
			</div>
			
		</td>
	</tr>
	</table>';
	}
	
	?>

</div>
</div>
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>