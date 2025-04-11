<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_sitemanagement'))
{
	exit;
}

if (isset($_POST['content']))
{
	$title = filter($_POST['title']);
	$teaser = filter($_POST['teaser']);
	$topstory = WWW . '/images/ts/' . filter($_POST['topstory']);
	$content = filter($_POST['content']);
	$seoUrl = filter($_POST['url']);
	$category = intval($_POST['category']);
	
	if (strlen($seoUrl) < 1 || strlen($title) < 1 || strlen($teaser) < 1 || strlen($content) < 1)
	{
		fMessage('error', 'Please fill in all fields.');
	}
	else
	{
		dbquery("INSERT INTO site_news (title,category_id,seo_link,topstory_image,body,snippet,datestr,timestamp) VALUES ('" . $title . "','" . $category . "','" . $seoUrl . "','" . $topstory . "','" . $content . "','" . $teaser . "','" . date('d-M-Y') . "', '" . time() . "')");
		fMessage('ok', 'News article published.');
		
		header("Location: index.php?_cmd=news");
		exit;
	}
}

require_once "top.php";

?>			

<script type="text/javascript">
function previewTS(el)
{
	document.getElementById('ts-preview').innerHTML = '<img src="<?php echo WWW; ?>/images/ts/' + el + '" />';
}

function suggestSEO(el)
{
	var suggested = el;
	
	suggested = suggested.toLowerCase();
	suggested = suggested.replace(/^\s+/, ''); 
	suggested = suggested.replace(/\s+$/, '');
	suggested = suggested.replace(/[^a-z 0-9]+/g, '');
	
	while (suggested.indexOf(' ') > -1)
	{
		suggested = suggested.replace(' ', '-');
	}
	
	document.getElementById('url').value = suggested;
}
</script>

<h1>Publish News</h1>
<form method="post">

<br />

<div style="float: left;">

<strong>Article title:</strong><br />
<input type="text" value="<?php if (isset($_POST['title'])) { echo clean($_POST['title']); } ?>" name="title" size="50" onkeyup="suggestSEO(this.value);" style="padding: 5px; font-size: 130%;"><br />
<br />

<strong>Category:</strong><br />
<select name="category">
<?php

$getOptions = dbquery("SELECT * FROM site_news_categories ORDER BY caption ASC");

while ($option = mysql_fetch_assoc($getOptions))
{
	echo '<option value="' . intval($option['id']) . '" ' . (($option['id'] == $_POST['category']) ? 'selected' : '') . '>' . clean($option['caption']) . '</option>';
}

?>
</select><br />
<br />

<strong>SEO-friendly URL:</strong><br />
<div style="border: 1px dotted; width: 300px; padding: 5px;">
<?php echo WWW; ?>/[id]-<input type="text" id="url" name="url" value="<?php if (isset($_POST['url'])) { echo clean($_POST['url']); } ?>" maxlength="120">/<br />
</div>
<small>This will be automatically suggested for you when you type a title. Required for us to be friendly to search engines.</small><br />
<br />

<strong>Frontpage teaser text:</strong><br />
<textarea name="teaser" cols="48" rows="5" style="padding: 5px; font-size: 120%;"><?php if (isset($_POST['teaser'])) { echo clean($_POST['teaser']); } ?></textarea><br />
<br />

<strong>Topstory image:</strong><br />

	<select onkeypress="previewTS(this.value);" onchange="previewTS(this.value);" name="topstory" id="topstory" style="padding: 5px; font-size: 120%;">
	<?php
	
	if ($handle = opendir(CWD . '/images/ts'))
	{
		while (false !== ($file = readdir($handle)))
		{
			if ($file == '.' || $file == '..')
			{
				continue;
			}	
			
			echo '<option value="' . $file . '"';
			
			if (isset($_POST['topstory']) && $_POST['topstory'] == $file)
			{
				echo ' selected';
			}
			
			echo '>' . $file . '</option>';
		}
	}

	?>
	</select>
	
</div>

<div id="ts-preview" style="margin-left: 20px; padding: 10px; float: left; text-align: center; vertical-align: middle;">

	<small>(Select an Topstory image from the list to preview it here)</small>

</div>

<div style="clear: both;"></div>

<br /><br />

<script type="text/javascript" src="./tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
	mode : "exact",
	elements : "content",
	theme : "advanced",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_resizing : true,
	theme_advanced_statusbar_location : "bottom"
});
</script>

<textarea id="content" name="content" style="width:80%"><?php if (isset($_POST['content'])) { echo clean($_POST['content']); } ?></textarea>

<br />
<br />

<input type="submit" value="Submit">

</form>


<?php

require_once "bottom.php";

?>