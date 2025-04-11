<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_sitemanagement'))
{
	exit;
}

if (isset($_GET['doDel']) && is_numeric($_GET['doDel']))
{
	dbquery("DELETE FROM site_news WHERE id = '" . intval($_GET['doDel']) . "' LIMIT 1"); 
	
	if (mysql_affected_rows() >= 1)
	{
		fMessage('ok', 'Article deleted.');
	}
	
	header("Location: index.php?_cmd=news&deleteOK");
	exit;
}

if (isset($_GET['doBump']) && is_numeric($_GET['doBump']))
{
	dbquery("UPDATE site_news SET datestr = '" . date('d-M-Y') . "', timestamp = '" . time() . "' WHERE id = '" . intval($_GET['doBump']) . "' LIMIT 1"); 
	
	if (mysql_affected_rows() >= 1)
	{
		fMessage('ok', 'Article date bumped.');
	}
	
	header("Location: index.php?_cmd=news&bumpOK");
	exit;
}

require_once "top.php";

?>			

<h1>Manage News</h1>

<br />

<p>
	You can use this overview to manage news articles. Topstories will be <span style="background-color: #CEE3F6; padding: 2px;">highlighted</span>.
</p>

<br />

<p>
	<a href="index.php?_cmd=newspublish">
		<b>
			Write new article
		</b>
	</a>
</p>

<br />

<table border="1" width="100%">
<thead>
<tr>
	<td>ID</td>
	<td>Title</td>
	<td>Topstory snippet</td>
	<td>Category</td>
	<td>Date</td>
	<td>Controls</td>
</tr>
</thead>
<tbody>
<?php

$getNews = dbquery("SELECT * FROM site_news ORDER BY timestamp DESC");
$i = 1;

while ($n = mysql_fetch_assoc($getNews))
{
	$highlight = '#fff';
	
	if ($i <= 3)
	{
		$highlight = '#CEE3F6';
	}
	else if ($i <= 5)
	{
		$highlight = '#EFFBFB';
	}
	
	echo '<tr style="background-color: ' . $highlight . ';">
	<td>' . $n['id'] . '</td>
	<td>' . clean($n['title']) . '</td>
	<td>' . clean($n['snippet']) . '</td>
	<td>' . clean(mysql_result(dbquery("SELECT caption FROM site_news_categories WHERE id = '" . $n['category_id'] . "' LIMIT 1"), 0)) . '</td>
	<td>' . $n['datestr'] . '</td>
	<td>
		<input type="button" value="View" onclick="document.location = \'' . WWW . '/articles/' . $n['id'] . '-' . $n['seo_link'] . '\';">&nbsp;
		<input type="button" value="Delete" onclick="document.location = \'index.php?_cmd=news&doDel=' . $n['id'] . '\';">&nbsp;
		<input type="button" value="Edit" onclick="document.location = \'index.php?_cmd=newsedit&u=' . $n['id'] . '\';">
		<input type="button" value="Update/bump date" onclick="document.location = \'index.php?_cmd=news&doBump=' . $n['id'] . '\';">&nbsp;
	</td>
	</tr>';
	
	$i++;
}

?>
</tbody>
</table>


<?php

require_once "bottom.php";

?>