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
	private bool $connected = false;
	private string $hostname = "localhost";
	private string $username = "uber_uberdb";
	private string $password = "F5eWRuca";
	private string $database = "uber_db";
	private ?mysqli $link = null;

	public function __construct(string $host, string $user, string $pass, string $db)
	{
		$this->connected = false;
		$this->hostname = $host;
		$this->username = $user;
		$this->password = $pass;
		$this->database = $db;
	}

	public function IsConnected(): bool
	{
		return $this->connected;
	}

	public function Connect(): void
	{
		$this->link = mysqli_connect($this->hostname, $this->username, $this->password, $this->database);
		if (!$this->link) {
			$this->error(mysqli_connect_error());
		}

		$this->connected = true;
	}

	public function Disconnect(): void
	{
		if ($this->connected && $this->link) {
			mysqli_close($this->link);
			$this->connected = false;
		}
	}

	public function DoQuery(string $query)
	{
		if (!$this->link) {
			$this->error('No database connection');
			return false;
		}
		$resultset = mysqli_query($this->link, $query);
		if ($resultset === false) {
			$this->error(mysqli_error($this->link));
		}
		return $resultset;
	}

	public function Evaluate($resultset)
	{
		if ($resultset instanceof mysqli_result) {
			$row = mysqli_fetch_row($resultset);
			return $row[0] ?? null;
		}
		return null;
	}

	public function Escape(string $str): string
	{
		return mysqli_real_escape_string($this->link, $str);
	}

	public function AffectedRows(): int
	{
		return mysqli_affected_rows($this->link);
	}

	public function Error(string $errorString): void
	{
		global $core;

		$core->systemError('Database Error', $errorString);
	}

	public function __destruct()
	{
		$this->Disconnect();
	}
}

?>
