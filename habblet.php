<?php
/*=======================================================================
| UberCMS - Advanced Website and Content Management System for uberEmu
| #######################################################################
| Copyright (c) 2010, Roy 'Meth0d'
| http://www.meth0d.org
| #######################################################################
| This program is free software: you can redistribute it and/or modify
| it under the terms of the GNU General Public License as published by
| the Free Software Foundation, either version 3 of the License, or
| (at your option) any later version.
| #######################################################################
| This program is distributed in the hope that it will be useful,
| but WITHOUT ANY WARRANTY; without even the implied warranty of
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
| GNU General Public License for more details.
\======================================================================*/

require_once "global.php";

$cmd = '';

if (isset($_GET['cmd']))
{
	$cmd = $_GET['cmd'];
}

switch (strtolower($cmd))
{
	case 'mytagslist':
	
		if (LOGGED_IN)
		{
			$tpl->Init();
			$taglist = new Template('comp-taglist');
			$taglist->SetParam('habbletmode', true);
			$tpl->AddTemplate($taglist);
			$tpl->Output();
		}
		
		break;
		
	case 'proxy':
	
		$tpl->Init();
		$tagcloud = new Template('habblet-tagcloud');
		$tpl->AddTemplate($tagcloud);
		$tpl->Output();
	
		break;
}
	
?>