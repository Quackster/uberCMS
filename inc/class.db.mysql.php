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

class MySQL
{
	private $connected = false;
	private $hostname = "localhost";
	private $username = "uber_uberdb";
	private $password = "F5eWRuca";
	private $database = "uber_db";
	private $link;
	
	public function MySQL($host, $user, $pass, $db)
	{
		$this->connected = false;	
		$this->hostname = $host;
		$this->username = $user;
		$this->password = $pass;
		$this->database = $db;
	}
	
	public function IsConnected()
	{
		if ($this->connected)
		{
			return true;
		}
		
		return false;
	}

	public function Connect()
	{
		$this->link = mysql_connect($this->hostname, $this->username, $this->password) or $this->error(mysql_error());
		mysql_select_db($this->database, $this->link) or $this->error(mysql_error());
	 	
		$this->connected = true;
	}
	
	public function Disconnect()
	{
		if($this->connected)
		{
			@mysql_close($this->link) or $this->error("could not close conn");
			$this->connected = false;
		}
	}
	
	public function DoQuery($query)
	{
		$resultset = @mysql_query($query, $this->link) or $this->error(mysql_error());
		return $resultset;
	}
	
	public function Evaluate($resultset)
	{
		return @mysql_result($resultset, 0);
	}
	
	public function Error($errorString)
	{
		global $core;
		
		$core->systemError('Database Error', $errorString);
	}
	
	public function __destruct()
	{
		$this->disconnect();
	}
}

?>
