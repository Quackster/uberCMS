<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_admin'))
{
	exit;
}

function getExtension($str)
{
	$i = strrpos($str, '.');
	
	if (!$i)
	{
		return '';
	}
	
	$l = strlen($str) - $i;
	$ext = substr($str, $i + 1, $l);
	
	return $ext;
}

if (isset($_POST['name']))
{
	$image = $_FILES['img']['name'];
	
	if ($image && isset($_POST['name']) && isset($_POST['clickurl']))
	{
		$filename = strtolower($_POST['name']);
		$clickurl = $_POST['clickurl'];
		
		if (strlen($filename) >= 1 && strlen($clickurl) >= 1)
		{
			$ext = getExtension(strtolower($_FILES['img']['name']));
			
			$fileLoc = CWD . '/ads/' . $filename . '.' . $ext;
			$wwwLoc = WWW . '/ads/' . $filename . '.' . $ext;
			
			if ($ext == "gif")
			{
				if (copy($_FILES['img']['tmp_name'], $fileLoc))
				{
					dbquery("INSERT INTO room_ads (id,ad_image,ad_image_orig,ad_link,views,views_limit,enabled) VALUES (NULL,'" . $wwwLoc . "','" . $filename . '.' . $ext . "','" . filter($clickurl) . "',0,0,1)");
					fMessage('ok', 'Okay, interstitial ad uploaded.');
				}
				else
				{
					fMessage('error', 'Could not process file: ' . $fileLoc);
				}
			}
			else
			{
				fMessage('error', 'Invalid file type: ' . $ext);
			}
		}
		else
		{
			fMessage('error', 'Please enter a file name and URL.');
		}
	}
	else
	{
		fMessage('error', 'File upload error (unknown).');
	}
}

if (isset($_GET['delId']))
{
	dbquery("DELETE FROM room_ads WHERE ad_image_orig = '" . filter($_GET['delId']) . "'");
	
	if (@unlink(CWD . '/ads/' . filter($_GET['delId'])))
	{
		fMessage('ok', 'Deleted interstitial ad.');
	}
	
	header("Location: index.php?_cmd=roomads");
	exit;
}

if (isset($_GET['switchId']))
{
	$get = dbquery("SELECT enabled FROM room_ads WHERE ad_image_orig = '" . filter($_GET['switchId']) . "' LIMIT 1");
	
	if (mysql_num_rows($get) >= 1)
	{
		$enabled = mysql_result($get, 0);
		
		$set = "0";
		
		if ($enabled == "0")
		{
			$set = "1";
		}

		dbquery("UPDATE room_ads SET enabled = '" . $set . "' WHERE ad_image_orig = '" . filter($_GET['switchId']) . "' LIMIT 1");
	}
	
	header("Location: index.php?_cmd=roomads");
	exit;	
}

require_once "top.php";

?>			

<h1>Interstitials</h1>

<p>
	Interstitials are advertisements shown when users navigate between rooms, while the new room loads.
</p>

<h2>Ad gallery</h2>

<br />

<table border="1" width="100%">
<thead>
<tr>
	<td>Thumbnail <small>(click to enlarge)</small></td>
	<td>Filename</td>
	<td>Click URL</td>
	<td>Views</td>
	<td>Enable/disable</td>
	<td>Delete</td>
</tr>
</thead>
<tbody>
<?php

$handle = null;

if ($handle = opendir(CWD . '/ads'))
{
	while (false !== ($file = readdir($handle)))
	{
		$file = strtolower($file);
	
		if ($file == '.' || $file == '..' || getExtension($file) != "gif")
		{
			continue;
		}
		
		$hasDbEntry = false;
		$dbData = null;
		$dbGet = dbquery("SELECT * FROM room_ads WHERE ad_image_orig = '" . $file . "' LIMIT 1");
		
		if (mysql_num_rows($dbGet) >= 1)
		{
			$hasDbEntry = true;
			$dbData = mysql_fetch_assoc($dbGet);
		}

		echo '<tr>
		<td><a href="/ads/' . $file . '"><center><img src="' . WWW . '/ads/' . $file . '" height="150" width="200"></center></a></td>
		<td><a href="/ads/' . $file . '"><b>' . $file . '</b></a></td>
		<td>';
		
		if ($hasDbEntry)
		{
			echo '<a href="' . $dbData['ad_link'] . '">' . clean($dbData['ad_link']) . '</a>';
		}
		else
		{
			echo 'N/A';
		}
		
		echo '</td>
		<td>';
		
		if ($hasDbEntry)
		{
			echo $dbData['views'];
		}
		else
		{
			echo 'N/A';
		}
		
		echo '</td>
		<td>';
		
		if ($hasDbEntry)
		{
			if ($dbData['enabled'] == "0")
			{
				echo 'Currently <span style="color: darkred !important; font-size: 140%;">disabled</span>,<br /><input type="button" onclick="document.location = \'index.php?_cmd=roomads&switchId=' . $file . '\';" value="Enable">';
			}
			else
			{
				echo 'Currently enabled,<br /><input type="button" onclick="document.location = \'index.php?_cmd=roomads&switchId=' . $file . '\';" value="Disable">';
			}
		}
		else
		{
			echo '<strong style="color: darkred;">DB entry is missing!<br />Please reupload.</strong>';
		}
		
		echo '</td>
		<td><input type="button" onclick="document.location = \'index.php?_cmd=roomads&delId=' . $file . '\';" value="Delete"></td>
		</tr>';
	}
	
	closedir($handle);
}
	
?>
</tbody>
</table>

<h2>Upload an interstitial ad (GIF only!)</h2><br />
<form method="post" enctype="multipart/form-data">

<b>File:</b><br />
<input type="file" name="img"><br />
<br />

<b>Filename (alphanumeric characters only, no extension):</b><br />
<input type="text" name="name"><br />
<br />

<b>Click URL:</b><br />
<input type="clickurl" name="clickurl"><br />
<br />

<input type="submit" value="Submit">

</form>

<?php

require_once "bottom.php";

?>