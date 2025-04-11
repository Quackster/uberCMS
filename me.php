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

define('TAB_ID', 1);
define('PAGE_ID', 2);

require_once "global.php";

if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}
else if ($users->GetUserVar(USER_ID, 'newbie_status') == "0")
{
	header("Location: " . WWW . "/register/welcome");
	exit;
}

// Initialize template system
$tpl->Init();

// Initial variables
$tpl->SetParam('page_title', 'Home');

// Generate page header
$tpl->AddGeneric('head-init');
$tpl->AddIncludeSet('generic');
$tpl->AddIncludeFile(new IncludeFile('text/css', '%static_url%/web-gallery/v2/styles/personal.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/javascript', '%static_url%/web-gallery/static/js/habboclub.js'));
$tpl->AddIncludeFile(new IncludeFile('text/css', '%static_url%/web-gallery/v2/styles/minimail.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/css', '%static_url%/web-gallery/styles/myhabbo/control.textarea.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/javascript', '%static_url%/web-gallery/static/js/minimail.js'));
$tpl->WriteIncludeFiles();
$tpl->AddGeneric('head-overrides-generic');
$tpl->AddGeneric('head-bottom');

// Generate generic top/navigation/login box
$tpl->AddGeneric('generic-top');

// Column 1
$tpl->Write('<div id="column1" class="column">');

// Me/infofeed widget
$compMe = new Template('comp-me');
$compMe->SetParam('look', $users->GetUserVar(USER_ID, 'look'));
$compMe->SetParam('motto', $users->GetUserVar(USER_ID, 'motto'));
$compMe->SetParam('creditsBalance', intval($users->GetUserVar(USER_ID, 'credits')));
$compMe->SetParam('pixelsBalance', intval($users->GetUserVar(USER_ID, 'activity_points')));
$compMe->SetParam('lastSignedIn', $users->GetUserVar(USER_ID, 'last_online'));
$compMe->SetParam('clubStatus', ($users->HasClub(USER_ID)) ? '<a href="%www%/credits/uberclub">' . $users->GetClubDays(USER_ID) . '</a> Days' : '<a href="%www%/credits/uberclub">Join Uber Club &raquo;</a>');
//$compMe->SetParam('clubStatus', '');
$tpl->AddTemplate($compMe);

$tpl->AddGeneric('comp-minimail');
$tpl->AddGeneric('comp-hotcampaigns');

$tpl->Write('</div>');

// Column 2
$tpl->Write('<div id="column2" class="column">');
$tpl->AddGeneric('comp-news');
$tpl->AddGeneric('comp-usertags');
$tpl->AddGeneric('comp-twitter');
$tpl->Write('</div>');

// Column 3
$tpl->AddGeneric('generic-column3');

// Footer
$tpl->AddGeneric('footer');

// Output the page
$tpl->Output();

?>