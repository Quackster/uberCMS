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
	
if (LOGGED_IN)
{
	header("Location: " . WWW . "/me");
	exit;
}

$tpl->Init();

$tpl->SetParam('page_title', 'Create your avatar, decorate your room, chat and make new friends.');
$tpl->SetParam('credentials_username', '');

$tpl->AddGeneric('head-init');
$tpl->AddIncludeSet('frontpage');
$tpl->WriteIncludeFiles();
$tpl->AddGeneric('head-overrides-fp');
$tpl->AddGeneric('head-bottom');

$frontpage = new Template('page-fp');
$frontpage->SetParam('login_result', '');

if (isset($_POST['credentials_username']) && isset($_POST['credentials_password']))
{
	$frontpage->SetParam('credentials_username', $_POST['credentials_username']);

	$credUser = filter($_POST['credentials_username']);
	$credPass = $core->UberHash($_POST['credentials_password']);
	
	$errors = array();
	
	if (strlen($_POST['credentials_username']) < 1)
	{
		$errors[] = "Please enter your user name";
	}
	
	if (strlen($_POST['credentials_password']) < 1)
	{
		$errors[] = "Please enter your password";
	}
	
	if (count($errors) == 0)
	{
		if ($users->ValidateUser($credUser, $credPass))
		{
			if (isset($_POST['page']))
			{
				$reqPage = filter($_POST['page']);
				$pos = strrpos($reqPage, WWW);
			
				if ($pos === false || $pos != 0)
				{
					die("<b>Security warning!</b> An malicious request was detected that tried redirecting you to an external site. Please proceed with caution, this may have been an attempt to steal your login details. <a href='" . WWW . "'>Return to site</a>");
				}
				else
				{
					$_SESSION['page-redirect'] = $reqPage;
				}
			}		
					
			$_SESSION['UBER_USER_N'] = $users->GetUserVar($users->Name2id($credUser), 'username');
			$_SESSION['UBER_USER_H'] = $credPass;
			
			if (isset($_POST['_login_remember_me']))
			{
				$_SESSION['set_cookies'] = true;
			}
			
			header("Location: " . WWW . "/security_check");
			exit;
		}
		else
		{
			$errors[] = "Incorrect password";
		}
	}

	if (count($errors) > 0)
	{
		$loginResult = '<div class="action-error flash-message"><div class="rounded"><ul>';

		foreach ($errors as $err)
		{
			$loginResult .= '<li>' . $err . '</li>';
		}
		
		$loginResult .= '</ul></div></div>';
		
		$frontpage->SetParam('login_result', $loginResult);
	}
}

$tpl->AddTemplate($frontpage);
$tpl->AddGeneric('footer');

$tpl->Output();

?>