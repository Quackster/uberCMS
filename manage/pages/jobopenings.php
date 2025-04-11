<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_sitemanagement'))
{
	exit;
}

if (isset($_GET['doDel']))
{
	dbquery("DELETE FROM site_app_openings WHERE id = '" . intval(filter($_GET['doDel'])) . "' LIMIT 1");
	
	if (mysql_affected_rows() >= 1)
	{
		fMessage('ok', 'Deleted listed opening.');
	}
	
	header("Location: index.php?_cmd=jobopenings");
	exit;
}

if (isset($_POST['n-name']) && strlen($_POST['n-name']) >= 1)
{
	dbquery("INSERT INTO site_app_openings (id,name,text_descr,text_reqs,text_duties) VALUES (NULL,'" . filter($_POST['n-name']) . "','" . filter($_POST['n-descr']) . "','" . filter($_POST['n-reqs']) . "','" . filter($_POST['n-duties']) . "')");
	fMessage('ok', 'Job opening listed!');
	header("Location: index.php?_cmd=jobopenings");
	exit;
}

if (isset($_POST['edit']) && is_numeric($_POST['edit']))
{
	dbquery("UPDATE site_app_openings SET name = '" . filter($_POST['e-name']) . "', text_descr = '" . filter($_POST['e-descr']) . "', text_reqs = '" . filter($_POST['e-reqs']) . "', text_duties = '" . filter($_POST['e-duties']) . "' WHERE id = '" . intval($_POST['edit']) . "' LIMIT 1");
	fMessage('ok', 'Job opening updated!');
	header("Location: index.php?_cmd=jobopenings");
	exit;	
}

require_once "top.php";

?>			

<h1>Job openings</h1>

<p>
	Job openings will be shown in the Support Center on the website. Users
	will be given a chance to apply for them. They may also submit an open application
	if their desired position is not listed. Submitted applications can be moderated via <a href="index.php?_cmd=jobapps">Moderate Job Applications</a>.
</p>

<h2>Add new opening</h2><br />
<form method="post">

Name:<br />
<input type="text" maxlength="100" name="n-name"><br />
<br />
Description:<br />
<textarea name="n-descr" cols="50" rows="4"></textarea><br />
<br />
Requirements:<br />
<textarea name="n-reqs" cols="50" rows="4"></textarea><br />
<br />
Responsibilites & Duties:<br />
<textarea name="n-duties" cols="50" rows="4"></textarea><br />
<br />

<input type="submit" value="Add"><br />

</form>

<br />

<h3>Current openings listed:</h3>

<?php

$get = dbquery("SELECT * FROM site_app_openings");

while ($opening = mysql_fetch_assoc($get))
{
	echo '<h2>';
	echo '<a href="#"><b style="font-size: 135%;">' . clean($opening['name']) . '</b></a><br />' . clean($opening['text_descr']) . '&nbsp;';
	echo '(<a href="#" onclick="t(\'edit-' . $opening['id'] . '\');">Edit</a>)';
	echo '&nbsp;(<a href="index.php?_cmd=jobopenings&doDel=' . $opening['id'] . '">Remove</a>)';
	
	echo '<div id="edit-' . $opening['id'] . '" style="display: none;">';
	echo '<br /><h3>Edit job openings</h3><br />';
	
	echo '<form method="post">
	<input type="hidden" name="edit" value="' . $opening['id'] . '">
	Name:<br />
	<input type="text" maxlength="100" name="e-name" value="' . clean($opening['name']) . '"><br />
	<br />
	Description:<br />
	<textarea name="e-descr" cols="50" rows="4">' . clean($opening['text_descr']) . '</textarea><br />
	<br />
	Requirements:<br />
	<textarea name="e-reqs" cols="50" rows="4">' . clean($opening['text_reqs']) . '</textarea><br />
	<br />
	Responsibilites & Duties:<br />
	<textarea name="e-duties" cols="50" rows="4">' . clean($opening['text_duties']) . '</textarea><br />
	<br />
	<input type="submit" value="Save changes"><br />
	</form>';
	
	echo '</div>';
	
	echo '</h2>';
}

require_once "bottom.php";

?>