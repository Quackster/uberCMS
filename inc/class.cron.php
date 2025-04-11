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

class uberCron
{
	function Execute()
	{
		$query = dbquery("SELECT id FROM site_cron WHERE enabled = '1' ORDER BY prio ASC");
		
		while ($job = mysql_fetch_assoc($query))
		{
			if ($this->GetNextExec($job['id']) <= time())
			{
				$this->RunJob($job['id']);
			}
		}
	}
	
	function RunJob($jobId)
	{
		global $core;
		
		$script = mysql_result(dbquery("SELECT scriptfile FROM site_cron WHERE id = '" . $jobId . "' LIMIT 1"), 0);
		
		if (!$this->CheckScript($script))
		{
			$core->SystemError('Cron Error', 'Could not execute cron job \'' . $script . '\': could not locate script file.');
			return;
		}

		require_once INCLUDES . 'cron_scripts' . DS . $script;
		
		dbquery("UPDATE site_cron SET last_exec = '" . time() . "' WHERE id = '" . $jobId . "' LIMIT 1");
	}
	
	function CheckScript($script)
	{
		if (file_exists(INCLUDES . 'cron_scripts' . DS . $script))
		{
			return true;
		}
		
		return false;
	}
	
	function GetNextExec($jobId)
	{
		$query = dbquery("SELECT last_exec,exec_every FROM site_cron WHERE id = '" . $jobId . "' LIMIT 1");
		
		if (mysql_num_rows($query) == 1)
		{
			$data = mysql_fetch_assoc($query);
						
			return $data['last_exec'] + $data['exec_every'];		
		}
		
		return -1;
	}
}

?>