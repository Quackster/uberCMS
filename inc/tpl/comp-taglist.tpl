	<div class="habblet" id="my-tags-list"> 
	
	<?php
	
	$tags = uberUsers::GetUserTags(USER_ID);
	$tagCount = count($tags);	
	
	if ($tagCount > 0)
	{
		echo '<ul class="tag-list make-clickable">' . LB;
		
		foreach ($tags as $id => $tag)
		{
			echo '                    <li><a href="%www%/tag/' . $tag . '" class="tag" style="font-size:10px">' . $tag . '</a> 
                        <div class="tag-id" style="display:none">' . $id . '</div><a class="tag-remove-link"
                        title="Remove tag"
                        href="#"></a></li>' . LB;
		}
		
		echo '</ul>' . LB;
	}
	
	if ($tagCount >= 20)
	{
		echo '<div class="add-tag-form">Tag limit reached. You need you remove one of your tags before adding another.</div>';
	}
	else
	{
		echo '<form method="post" action="/myhabbo/tag/add" onsubmit="TagHelper.addFormTagToMe();return false;" > 
    <div class="add-tag-form clearfix"> 
		<a  class="new-button" href="#" id="add-tag-button" onclick="TagHelper.addFormTagToMe();return false;"><b>Add tag</b><i></i></a> 
        <input type="text" id="add-tag-input" maxlength="20" style="float: right"/> 
        <em class="tag-question">';
		
		$possibleQuestions = Array();
		$possibleQuestions[] = "What is your favourite food?";
		$possibleQuestions[] = "Who is your favourite actor?";
		$possibleQuestions[] = "What kind of music do you like?";
		$possibleQuestions[] = "What is your favourite sport?";
		$possibleQuestions[] = "Who is your favourite actress?";
		$possibleQuestions[] = "What is your favourite colour?";
		$possibleQuestions[] = "What is your favourite band?";
		$possibleQuestions[] = "What is your favourite TV show?";
		$possibleQuestions[] = "Which football team do you support?";
		$possibleQuestions[] = "What is your favourite football team?";
		$possibleQuestions[] = "Your favourite cartoon?";
		$possibleQuestions[] = "What is your favourite video game?";
		$possibleQuestions[] = "What's your favourite pastime?";
		$possibleQuestions[] = "What kind of mood are you in right now?";
		$possibleQuestions[] = "What is your favourite movie?";
		$possibleQuestions[] = "What is your favourite time of year?";		
		
		echo $possibleQuestions[rand(0, count($possibleQuestions) - 1)];
		

		echo '</em> 
    </div> 
    <div style="clear: both"></div> 
    </form>';
	}
	
	?>

</div> </div>
 
<script type="text/javascript"> 
<?php if (!isset($habbletmode)){ echo 'document.observe("dom:loaded", function() {'; } ?>
    TagHelper.setTexts({
        tagLimitText: "You\'ve reached the tag limit - delete one of your tags if you want to add a new one.",
        invalidTagText: "Invalid tag",
        buttonText: "OK"
    });
	
<?php

if (isset($habbletmode))
{
	echo 'TagHelper.bindEventsToTagLists();';
}
else
{
    echo "TagHelper.init('" . USER_ID . "');";
	echo "});";
}

?>
</script> 