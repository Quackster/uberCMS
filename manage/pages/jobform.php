<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_sitemanagement'))
{
	exit;
}

$newOrderNum = intval(mysql_result(dbquery("SELECT MAX(order_num) FROM site_app_form LIMIT 1"), 0)) + 1;

if (isset($_GET['doDel']))
{
	dbquery("DELETE FROM site_app_form WHERE id = '" . filter($_GET['doDel']) . "' LIMIT 1");
	
	if (mysql_affected_rows() >= 1)
	{
		fMessage('ok', 'Deleted form element.');
	}
	
	header("Location: index.php?_cmd=jobform");
	exit;
}

if (isset($_GET['doUp']))
{
	dbquery("UPDATE site_app_form SET order_num = order_num + 1 WHERE id = '" . filter($_GET['doUp']) . "' LIMIT 1");
	
	if (mysql_affected_rows() >= 1)
	{
		fMessage('ok', 'Moved element up.');
	}
	
	header("Location: index.php?_cmd=jobform");
	exit;
}

if (isset($_GET['doDown']))
{
	dbquery("UPDATE site_app_form SET order_num = order_num - 1 WHERE id = '" . filter($_GET['doDown']) . "' LIMIT 1");
	
	if (mysql_affected_rows() >= 1)
	{
		fMessage('ok', 'Moved element down.');
	}
	
	header("Location: index.php?_cmd=jobform");
	exit;
}

if (isset($_POST['new-element-id']))
{
	$id = filter(strtolower($_POST['new-element-id']));
	$type = filter(strtolower($_POST['new-element-type']));
	$name = filter($_POST['new-element-name']);
	$descr = filter($_POST['new-element-descr']);
	$required = "no";
	
	if (isset($_POST['new-element-required']))
	{
		$required = filter(strtolower($_POST['new-element-required']));
	}
	
	$errors = Array();
	
	if (strlen($id) == 0 || strlen($id) > 24)
	{
		$errors[] = "Invalid ID supplied. Must be 0 - 24 chars long.";
	}
	
	if ($type != "textbox" && $type != "textarea"
	&& $type != "checkbox")
	{
		$type = "textbox";
	}
	
	if (count($errors) == 0)
	{
		fMessage('ok', 'Element added to application form!');
		
		$req = "0";
		
		if ($required == "yes")
		{
			$req = "1";
		}
		
		dbquery("INSERT INTO site_app_form (id,caption,descr,field_type,required,order_num) VALUES ('" . $id . "','" . $name . "','" . $descr . "','" . $type . "','" . $req . "','" . $newOrderNum . "')");
	}
	else
	{
		fMessage('error', 'Could not add element, please verify input.');
	}
}

require_once "top.php";

?>			

<h1>Job Application Form</h1>

<p>
	Whenever a user applies for a job, they will need to fill in a predefined application form, which you can manage here.
</p>

<h2>

<b>Add new form element</b> (<a href="#" onclick="t('elform');">Hide/show</a>)

<div id="elform" style="padding: 10px;">
<br />

<form method="post">

Field type:<br />
<select name="new-element-type">
<option value="textbox">Regular Text box</option>
<option value="textarea">Text area (for large text/multipile lines)</option>
<option value="checkbox">Checkbox (Description will be used as text)</option>
</select>

<br /><br />

Element ID (short, <u>unique</u>, and internal name to identify this field - no special chars please):<br />
<input type="text" value="" maxlength="24" name="new-element-id">

<br /><br />

Name on form:<br />
<input type="text" value="" maxlength="120" name="new-element-name">

<br /><br />

Description on form:<br />
<textarea name="new-element-descr" cols="50" rows="4"></textarea>

<br /><br />

<input type="checkbox" value="yes" name="new-element-required"> This is a required field

<br /><br />

<input type="submit" value="Add new element to form">

<br /><br />

</form>
</div>

</h2>

<h2>Manage/Preview Application Form</h2>
<br />

<form method="post">

<?php

$getElements = dbquery("SELECT * FROM site_app_form ORDER BY order_num ASC");

echo '<ol style="margin-left: 20px;">';

while ($el = mysql_fetch_assoc($getElements))
{
	echo '<li>';
	
	echo $el['id'] . '&nbsp;';
	
	if ($el['required'] == "1")
	{
		echo '<b style="color: darkred;"><small>(This is a required field)</small></b><br />';
	}
	
	echo '<div style="width: 75%; border: 1px dotted; background-color: #F2F2F2; margin-top: 5px; padding: 10px;">';
	
	switch ($el['field_type'])
	{
		case "checkbox":
		
			echo '<input type="checkbox" value="checked" name="' . $el['id'] . '"> ' . clean($el['descr']);
			break;
	
		case "textarea":
		
			echo clean($el['caption']) . '<br />';
			echo '<textarea name="' . $el['id'] . '"></textarea>';
			echo '<br />';
			echo '<small>' . $el['descr'] . '</small>';			
			break;
	
		case "textbox":
		default:
		
			echo clean($el['caption']) . '<br />';
			echo '<input type="text" name="' . $el['id'] . '" value="">';
			echo '<br />';
			echo '<small>' . $el['descr'] . '</small>';			
			break;
	}
	
	echo '</div>';
	
	echo '<Br />';
	echo 'Order num: ' . $el['order_num'] . ' | ';
	echo '<a href="index.php?_cmd=jobform&doUp=' . $el['id'] . '">Move up</a> | ';
	echo '<a href="index.php?_cmd=jobform&doDown=' . $el['id'] . '">Move down</a> | ';
	echo '<a href="index.php?_cmd=jobform&doDel=' . $el['id'] . '">Delete this element</a>';	
	
	echo '<br />';
	echo '<br />';
	echo '<br />';
	
	echo '</li>';
}

echo '<li><i>Submit button</i><br /><div style="border: 1px dotted; width: 50px; padding: 10px;">';
echo '<input type="submit" value="Submit">';
echo '</div></li>';

echo '</ol><br />';

?>

</form>


<?php

require_once "bottom.php";

?>