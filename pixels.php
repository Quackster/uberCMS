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

define('TAB_ID', 6);
define('PAGE_ID', 10);

require_once "global.php";

$tpl->Init();

$tpl->AddGeneric('head-init');

$tpl->AddIncludeSet('generic');
$tpl->AddIncludeFile(new IncludeFile('text/css', '%static_url%/web-gallery/v2/styles/newcredits.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/javascript', '%static_url%/web-gallery/static/js/newcredits.js'));
$tpl->WriteIncludeFiles();

$tpl->AddGeneric('head-overrides-generic');
$tpl->AddGeneric('head-bottom');
$tpl->AddGeneric('generic-top');
$tpl->AddGeneric('page-pixels');
$tpl->AddGeneric('generic-column3');
$tpl->AddGeneric('footer');

$tpl->SetParam('page_title', 'Pixels');
$tpl->SetParam('body_id', 'home');

$tpl->Output();

?>