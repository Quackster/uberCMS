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

class uberTpl
{
	private $outputData;
	private $params = Array();
	private $includeFiles = Array();
	
	public function Init()
	{
		global $core, $users;
	
		$this->SetParam('site_name', 'Uber');
		$this->SetParam('body_id', '');
		$this->SetParam('page_title', ' ');
		$this->SetParam('flash_build', 'flash_51_45');
		$this->SetParam('static_url', 'http://localhost');
		$this->SetParam('web_build', '51_b4ea29afdff17a13afb841a9811ebf55/4');
		$this->SetParam('web_build_str', '51-BUILD45 - 18.05.2010 16:16 - uk');
		$this->SetParam('req_path', WWW);
		$this->SetParam('www', WWW);
		$this->SetParam('hotel_status_fig', uberCore::GetSystemStatusString(true));
		$this->SetParam('hotel_status', uberCore::GetSystemStatusString(false));
		
		if (LOGGED_IN)
		{
			$this->SetParam('habboLoggedIn', 'true');
			$this->SetParam('habboName', USER_NAME);
			$this->SetParam('vipbalance', '<b>' . $users->GetUserVar(USER_ID, 'vip_points') . ' <img src="' . WWW . '/images/vipcoin.gif" style="vertical-align: middle;"></b>');
		}
		else
		{
			$this->SetParam('habboLoggedIn', 'false');
			$this->SetParam('habboName', 'null');
		}
	}
	
	public function AddIncludeSet($set)
	{
		switch (strtolower($set))
		{
			case "frontpage":
			
				$this->AddIncludeFile(new IncludeFile('text/javascript', '%static_url%/web-gallery/static/js/libs2.js'));
				$this->AddIncludeFile(new IncludeFile('text/javascript', '%static_url%/web-gallery/static/js/landing.js'));
				$this->AddIncludeFile(new IncludeFile('text/css', '%static_url%/web-gallery/v2/styles/frontpage.css', 'stylesheet'));			
//				$this->AddIncludeFile(new IncludeFile('text/css', '%static_url%/web-gallery/static/styles/frontpage.css', 'stylesheet'));			
				break;
				
			case "register":

				$this->AddIncludeFile(new IncludeFile('text/javascript', '%static_url%/web-gallery/static/js/visual.js'));
				$this->AddIncludeFile(new IncludeFile('text/javascript', '%static_url%/web-gallery/static/js/common.js'));			
				$this->AddIncludeFile(new IncludeFile('text/css', '%static_url%/web-gallery/v2/styles/style.css', 'stylesheet'));		
				$this->AddIncludeFile(new IncludeFile('text/css', '%static_url%/web-gallery/v2/styles/buttons.css', 'stylesheet'));	
				$this->AddIncludeFile(new IncludeFile('text/css', '%static_url%/web-gallery/v2/styles/boxes.css', 'stylesheet'));	
				$this->AddIncludeFile(new IncludeFile('text/css', '%static_url%/web-gallery/v2/styles/tooltips.css', 'stylesheet'));
				$this->AddIncludeFile(new IncludeFile('text/css', '%static_url%/web-gallery/v2/styles/embeddedregistration.css', 'stylesheet'));
				$this->AddIncludeFile(new IncludeFile('text/javascript', '%static_url%/web-gallery/static/js/simpleregistration.js'));
				break;
		
			case "process-template":
			
				$this->AddIncludeFile(new IncludeFile('text/javascript', '%static_url%/web-gallery/static/js/libs2.js'));
				$this->AddIncludeFile(new IncludeFile('text/javascript', '%static_url%/web-gallery/static/js/visual.js'));
				$this->AddIncludeFile(new IncludeFile('text/javascript', '%static_url%/web-gallery/static/js/libs.js'));
				$this->AddIncludeFile(new IncludeFile('text/javascript', '%static_url%/web-gallery/static/js/common.js'));
				$this->AddIncludeFile(new IncludeFile('text/javascript', '%static_url%/web-gallery/static/js/fullcontent.js'));
				$this->AddIncludeFile(new IncludeFile('text/css', '%static_url%/web-gallery/v2/styles/style.css', 'stylesheet'));		
				$this->AddIncludeFile(new IncludeFile('text/css', '%static_url%/web-gallery/v2/styles/buttons.css', 'stylesheet'));	
				$this->AddIncludeFile(new IncludeFile('text/css', '%static_url%/web-gallery/v2/styles/boxes.css', 'stylesheet'));	
				$this->AddIncludeFile(new IncludeFile('text/css', '%static_url%/web-gallery/v2/styles/tooltips.css', 'stylesheet'));	
				$this->AddIncludeFile(new IncludeFile('text/css', '%static_url%/web-gallery/v2/styles/process.css', 'stylesheet'));	
				break;
				
			case 'myhabbo':
			
				$this->AddIncludeFile(new IncludeFile('text/javascript', '%static_url%/web-gallery/static/js/libs2.js'));
				$this->AddIncludeFile(new IncludeFile('text/javascript', '%static_url%/web-gallery/static/js/visual.js'));
				$this->AddIncludeFile(new IncludeFile('text/javascript', '%static_url%/web-gallery/static/js/libs.js'));
				$this->AddIncludeFile(new IncludeFile('text/javascript', '%static_url%/web-gallery/static/js/common.js'));
				$this->AddIncludeFile(new IncludeFile('text/javascript', '%static_url%/web-gallery/static/js/fullcontent.js'));
				$this->AddIncludeFile(new IncludeFile('text/css', '%static_url%/web-gallery/v2/styles/style.css', 'stylesheet'));		
				$this->AddIncludeFile(new IncludeFile('text/css', '%static_url%/web-gallery/v2/styles/buttons.css', 'stylesheet'));	
				$this->AddIncludeFile(new IncludeFile('text/css', '%static_url%/web-gallery/v2/styles/boxes.css', 'stylesheet'));	
				$this->AddIncludeFile(new IncludeFile('text/css', '%static_url%/web-gallery/v2/styles/tooltips.css', 'stylesheet'));				
				$this->AddIncludeFile(new IncludeFile('text/css', '%static_url%/web-gallery/styles/myhabbo/myhabbo.css', 'stylesheet'));
				$this->AddIncludeFile(new IncludeFile('text/css', '%static_url%/web-gallery/styles/myhabbo/skins.css', 'stylesheet'));
				$this->AddIncludeFile(new IncludeFile('text/css', '%static_url%/web-gallery/styles/myhabbo/dialogs.css', 'stylesheet'));
				$this->AddIncludeFile(new IncludeFile('text/css', '%static_url%/web-gallery/styles/myhabbo/buttons.css', 'stylesheet'));
				$this->AddIncludeFile(new IncludeFile('text/css', '%static_url%/web-gallery/styles/myhabbo/control.textarea.css', 'stylesheet'));
				$this->AddIncludeFile(new IncludeFile('text/css', '%static_url%/web-gallery/styles/myhabbo/boxes.css', 'stylesheet'));
				$this->AddIncludeFile(new IncludeFile('text/css', '%static_url%/web-gallery/v2/styles/myhabbo.css', 'stylesheet'));
				$this->AddIncludeFile(new IncludeFile('text/css', '%static_url%/web-gallery/styles/myhabbo/assets.css', 'stylesheet'));
				$this->AddIncludeFile(new IncludeFile('text/javascript', '%static_url%/web-gallery/static/js/homeview.js'));
				$this->AddIncludeFile(new IncludeFile('text/css', '%static_url%/web-gallery/v2/styles/lightwindow.css', 'stylesheet'));
				break;
			
			case 'default':
			default:
			
				$this->AddIncludeFile(new IncludeFile('text/javascript', '%static_url%/web-gallery/static/js/libs2.js'));
				$this->AddIncludeFile(new IncludeFile('text/javascript', '%static_url%/web-gallery/static/js/visual.js'));
				$this->AddIncludeFile(new IncludeFile('text/javascript', '%static_url%/web-gallery/static/js/libs.js'));
				$this->AddIncludeFile(new IncludeFile('text/javascript', '%static_url%/web-gallery/static/js/common.js'));
				$this->AddIncludeFile(new IncludeFile('text/javascript', '%static_url%/web-gallery/static/js/fullcontent.js'));
				$this->AddIncludeFile(new IncludeFile('text/css', '%static_url%/web-gallery/static/styles/common.css', 'stylesheet'));		
				$this->AddIncludeFile(new IncludeFile('text/css', '%static_url%/web-gallery/v2/styles/style.css', 'stylesheet'));		
				$this->AddIncludeFile(new IncludeFile('text/css', '%static_url%/web-gallery/v2/styles/buttons.css', 'stylesheet'));	
				$this->AddIncludeFile(new IncludeFile('text/css', '%static_url%/web-gallery/v2/styles/boxes.css', 'stylesheet'));	
				$this->AddIncludeFile(new IncludeFile('text/css', '%static_url%/web-gallery/v2/styles/tooltips.css', 'stylesheet'));		
				break;
		}
	}
	
	public function AddGeneric($tplName)
	{
		$tpl = new Template($tplName);
		$this->outputData .= $tpl->GetHtml();
	}
	
	public function AddTemplate($tpl)
	{
		$this->outputData .= $tpl->GetHtml();
	}
	
	public function SetParam($param, $value)
	{
		$this->params[$param] = is_object($value) ? $value->fetch() : $value;
	}
	
	public function UnsetParam($param)
	{
		unset($this->params[$param]);
	}
	
	public function AddIncludeFile($incFile)
	{
		$this->includeFiles[] = $incFile;
	}
	
	public function WriteIncludeFiles()
	{
		foreach ($this->includeFiles as $f)
		{
			$this->Write($f->GetHtml() . LB);
		}
	}
	
	public function Write($str)
	{
		$this->outputData .= $str;
	}
	
	public function FilterParams($str)
	{
		foreach ($this->params as $param => $value)
		{
			$str = str_ireplace('%' . $param . '%', $value, $str);
		}
		
		return $str;
	}
	
	public function Output()
	{
		global $core;
	
		$this->Write(LB . LB . '<!-- uberCMS: Took ' . (microtime(true) - $core->execStart) . ' to output this page -->' . LB . LB);
		
		echo $this->FilterParams($this->outputData);
	}
}

class Template
{
	private $params = Array();
	private $tplName = '';
	
	public function Template($tplName)
	{
		$this->tplName = $tplName;
	}
	
	public function GetHtml()
	{
		global $users;
	
		extract($this->params);
	
		$file = CWD . 'inc/tpl/' . $this->tplName . '.tpl';
	
		if (!file_exists($file))
		{
			uberCore::SystemError('Template system error', 'Could not load template: ' . $this->tplName);
		}
		
		ob_start();
		include($file);
		$data = ob_get_contents();
		ob_end_clean();	
		
		return $this->FilterParams($data);
	}
	
	public function FilterParams($str)
	{
		foreach ($this->params as $param => $value)
		{
			if (is_object($value))
			{
				continue;
			}
		
			$str = str_ireplace('%' . $param . '%', $value, $str);
		}
		
		return $str;
	}
	
	public function SetParam($param, $value)
	{
		$this->params[$param] = $value;
	}
	
	public function UnsetParam($param)
	{
		unset($this->params[$param]);
	}		
}

class IncludeFile
{
	private $type;
	private $src;
	private $rel;
	private $name;

	public function IncludeFile($type, $src, $rel = '', $name = '')
	{
		global $tpl;
	
		$this->type = $type;
		$this->src = $src;
		$this->rel = $rel;
		$this->name = $name;
	}
	
	public function GetHtml()
	{
		switch ($this->type)
		{
			case 'application/rss+xml':
			
				return '<link rel="' . $this->rel . '" type="' . $this->type . '" title="' . $this->name . '" href="' . $this->src . '" />';
		
			case 'text/javascript':
			
				return '<script src="' . $this->src . '" type="text/javascript"></script>';
				
			case 'text/css':
			default:
			
				return '<link rel="' . $this->rel . '" href="' . $this->src . '" type="' . $this->type . '" />';
		}
	}
}

?>