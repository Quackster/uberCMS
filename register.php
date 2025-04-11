<?php
/*=======================================================================
| UberWeb - Lightweight site system for Uber
| #######################################################################
| Copyright (c) 2009, Roy 'Meth0d'
| http://www.meth0d.org
| #######################################################################
| This program is free software: you can redistribute it and/or modify
| it under the terms of the GNU General Public License as published by
| the Free Software Foundation, either version 3 of the License, or
| (at your option) any later version.
| #######################################################################
| This program is distributed in the hope that it will be useful,
| but WITHOUT ANY WARRANTY; without even the implied warranty of
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
| GNU General Public License for more details.
\======================================================================*/

require_once "global.php";
require_once "inc/recaptchalib.php";

if (LOGGED_IN)
{
	header("Location: " . WWW . "/me");
	exit;
}

$tpl->SetParam('error-messages-holder', '');
$tpl->SetParam('post-name', '');
$tpl->SetParam('post-pass', '');
$tpl->SetParam('post-tos-check', '');
$tpl->SetParam('post-mail', '');

if (isset($_GET['doSubmit']))
{
	if (isset($_POST['checkNameOnly']) && $_POST['checkNameOnly'] == 'true')
	{
		$name = $_POST['bean_avatarName'];

		echo '                <div class="field field-habbo-name">
                  <label for="habbo-name">Username</label>
                  <input type="text" id="habbo-name" size="32" value="' . clean($name) . '" name="bean.avatarName" class="text-field" maxlength="32"/>
                  <a href="#" class="new-button" id="check-name-btn"><b>Check</b><i></i></a> 
                  <input type="submit" name="checkNameOnly" id="check-name" value="Check"/>
                    <div id="name-suggestions">';

		if ($users->IsNameTaken($name))
		{
			echo '<div class="taken"><p>Sorry, the name <strong>' . clean($name) . '</strong> is taken!</p></div>';
		}
		else if ($users->IsNameBlocked($name))
		{
			echo '<div class="taken"><p>Sorry, that name is reserved or disallowed.</p></div>';
		}
		else if (!$users->IsValidName($name))
		{
			echo '<div class="taken"><p>Sorry, that name is invalid. Your name can contain lowercase, uppercase letters, and numbers.</p></div>';
		}
		else
		{
			echo '<div class="available"><p>The name <strong>' . clean($name) . '</strong> is available.</p></div>';
		}
							
		echo '                    </div>              
                  <p class="help">Your name can contain lowercase and uppercase letters and numbers.</p>
                </div>';
		
		exit;
	}
	else if (isset($_POST['bean_avatarName']))
	{
		$registerErrors = Array();
	
		$name = $_POST['bean_avatarName'];
		$password = $_POST['bean_password'];
		$password2 = $_POST['bean_retypedPassword'];
		$email = $_POST['bean_email'];
		$dob_day = $_POST['bean_day'];
		$dob_month = $_POST['bean_month'];
		$dob_year = $_POST['bean_year'];
		//$lang = $_POST['bean_lang'];
		
		$tpl->SetParam('post-name', $name);
		$tpl->SetParam('post-pass', $password);
		$tpl->SetParam('post-mail', $email);
		
		if (strlen($name) < 1 || strlen($name) > 32)
		{
			$registerErrors[] = "Your username must be 1 - 32 characters in length.";
		}
		
		if ($users->IsNameTaken($name))
		{
			$registerErrors[] = "Sorry, that name is taken.";
		}	
		else if ($users->IsNameBlocked($name))
		{
			$registerErrors[] = "Sorry, that name is reserved or disallowed.";
		}
		else if (!$users->IsValidName($name))
		{
			$registerErrors[] = "Sorry, that name is invalid. Your name can contain lowercase, uppercase letters, and numbers.";
		}
		
		if (strlen($password) < 6)
		{
			$registerErrors[] = "Your password must be at least 6 characters long.";
		}
		
		if ($password != $password2)
		{
			$registerErrors[] = "Your passwords do not match. Please try again.";
		}
		
		if (!$users->IsValidEmail($email))
		{
			$registerErrors[] = "Invalid e-mail address.";
		}
		
		if (!is_numeric($dob_day) || !is_numeric($dob_month) || !is_numeric($dob_year) || $dob_day <= 0 || $dob_day > 31 ||
			$dob_month <= 0 || $dob_month > 12 || $dob_year < 1900 || $dob_year > 2010)
		{
			$registerErrors[] = "Please enter a valid date of birth.";
		}
		
		if (!isset($_POST['bean_tos']) || $_POST['bean_tos'] != "accept")
		{
			$registerErrors[] = "You need to accept the Rules and Terms and Conditions to create an account.";
		}
		else
		{
			$tpl->SetParam('post-tos-check', 'checked');
		}
		
		/*if (strtolower($lang) != "yes, i will speak english" && strtolower($lang) != "yes, i will speak english.")
		{
			$registerErrors[] = "You must verify you will speak English to creat an account.";
		}*/
		
		/*
		$resp = recaptcha_check_answer ('6Le-aQoAAAAAAKaqhlUT0lAQbjqokPqmj0F1uvQm', $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
							
		if (!$resp->is_valid)
		{
			$registerErrors[] = "Invalid captcha code.";
		}	
		*/
		
		if (count($registerErrors) <= 0)
		{			
			// Add user
			$users->add($name, $core->uberHash($password), $email, 1, 'hd-180-1.ch-210-66.lg-270-82.sh-290-91.hr-100-', 'M');
			
			// Log user in
			$_SESSION['SHOW_WELCOME'] = true;
			$_SESSION['UBER_USER_N'] = $name;
			$_SESSION['UBER_USER_H'] = $core->uberHash($password);
			
			// Redirect user to welcome page
			header("Location: /register/welcome");
			exit;
		}
		else
		{
			$errResult = '<div class="error-messages-holder"> 
				<h3>Please fix the following problems and resubmit the form.</h3> 
				<ul>';
			
			foreach ($registerErrors as $err)
			{
				$errResult .= '<li><p class="error-message">' . $err . '</p></li>';
			}
			
			$errResult .= '</ul></div>';
		
			$tpl->SetParam('error-messages-holder', $errResult);
		}
	}
}

$tpl->Init();

$tpl->AddGeneric('head-init');
$tpl->AddIncludeSet('register');
$tpl->WriteIncludeFiles();
$tpl->AddGeneric('head-bottom');
$tpl->AddGeneric('page-register');
$tpl->AddGeneric('footer');

$tpl->SetParam('recaptcha_html', recaptcha_get_html("6Le-aQoAAAAAABnHRzXH_W-9-vx4B8oSP3_L5tb0"));
$tpl->SetParam('page_title', 'Register your account!');

$tpl->Output();

?>