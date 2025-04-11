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

class RoomManager
{
	public static function CreateRoom($name, $owner, $model)
	{
		dbquery("INSERT INTO rooms (roomtype,caption,owner,state,model_name) VALUES ('private','" . filter($name) . "','" . $owner . "','open','" . $model . "')");
		return intval(mysql_result(dbquery("SELECT id FROM rooms WHERE owner = '" . $owner . "' ORDER BY id DESC LIMIT 1"), 0));
	}
	
	public static function PaintRoom($roomId, $wallpaper, $floor)
	{
		dbquery("UPDATE rooms SET wallpaper = '" . $wallpaper . "', floor = '" . $floor . "' WHERE id = '" . $roomId . "' LIMIT 1");
		return (mysql_affected_rows() > 0) ? true : false;
	}
	
	public static function GetRoomVar($roomId, $var)
	{
		return mysql_result(dbquery("SELECT " . $var . " FROM rooms WHERE id = '" . $roomId . "' LIMIT 1"), 0);
	}
}

?>