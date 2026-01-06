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

class HomesManager
{
	public static function HomeExists(string $linkType = 'user', int $linkId): bool
	{
		$result = dbquery("SELECT null FROM homes WHERE link_type = '" . strtolower($linkType) . "' AND link_id = '" . intval($linkId) . "' LIMIT 1");
		return $result ? mysqli_num_rows($result) > 0 : false;
	}
	
	public static function GetHomeId(string $linkType, int $linkId): int
	{
		if (!HomesManager::HomeExists($linkType, $linkId))
		{
			return 0;
		}

		$result = dbquery("SELECT home_id FROM homes WHERE link_type = '" . strtolower($linkType) . "' AND link_id = '" . intval($linkId) . "' LIMIT 1");
		if ($result) {
			$row = mysqli_fetch_row($result);
			return intval($row[0] ?? 0);
		}
		return 0;
	}
	
	public static function CreateHome($linkType, $linkId)
	{
		dbquery("INSERT INTO homes (home_id,link_type,link_id,allow_display) VALUES (NULL,'" . strtolower($linkType) . "','" . intval($linkId) . "','1')");
		
		$homeId = HomesManager::GetHomeId($linkType, $linkId);
		$home = HomesManager::GetHome($homeId);
		
		$home->AddItem('widget', 463, 39, 1, 'ProfileWidget', 'w_skin_defaultskin', 0);
		$home->AddItem('stickie', 42, 48, 2, 'Hi, and welcome to your Uber Home page. To get started click on edit. Here you will find your Inventory and the Webstore. The Inventory lists all the items that you can place on your page including stickers, backgrounds and widgets. The Webstore is where you can buy new items. Check it regularly for cool new items.', 'n_skin_noteitskin', 0);
		$home->AddItem('stickie', 120, 311, 3, 'Don\'t just leave your page blank, decorate it now!', 'n_skin_speechbubbleskin', 0);
		$home->AddItem('sticker', 593, 11, 4, 's_sticker_arrow_down', '', 0);
		$home->AddItem('sticker', 252, 12, 5, 's_paper_clip_1', '', 0);
		$home->AddItem('sticker', 341, 353, 6, 's_sticker_spaceduck', '', 0);
		$home->AddItem('sticker', 27, 32, 7, 's_needle_3', '', 0);
		
		return $homeId;
	}
	
	public static function GetHomeDataRow(int $id): ?array
	{
		$result = dbquery("SELECT * FROM homes WHERE home_id = '" . $id . "' LIMIT 1");
		return $result ? mysqli_fetch_assoc($result) : null;
	}
	
	public static function GetHome($id)
	{
		$data = HomesManager::GetHomeDataRow($id);
		
		if ($data == null)
		{
			return null;
		}
		
		return new Home($data['home_id'], $data['link_type'], $data['link_id']);
	}
}

class Home
{
	public $id = 0;
	public $linkType = '';
	public $linkId = 0;
	
	public function __construct(int $id, string $linkType, int $linkId)
	{
		$this->id = $id;
		$this->linkType = $linkType;
		$this->linkId = $linkId;
	}
	
	public function AddItem($type, $x, $y, $z, $data, $skin, $ownerId)
	{
		dbquery("INSERT INTO homes_items (home_id,type,x,y,z,data,skin,owner_id) VALUES ('" . $this->id .  "','" . $type . "','" . $x . "','" . $y . "','" . $z . "','" . filter($data) . "','" . $skin . "','" . $ownerId . "')");
	}
	
	public function GetItems(): array
	{
		$list = [];
		$get = dbquery("SELECT * FROM homes_items WHERE home_id = '" . $this->id . "' ORDER BY type ASC");

		if ($get) {
			while ($item = mysqli_fetch_assoc($get))
			{
				$list[] = new HomeItem((int)$item['id'], (int)$item['home_id'], $item['type'], $item['data'], $item['skin'], (int)$item['x'], (int)$item['y'], (int)$item['z'], (int)$item['owner_id']);
			}
		}

		return $list;
	}
}

class HomeItem
{
	public $id = 0;
	public $homeId = 0;
	
	public $type = '';
	public $data = '';
	public $skin = '';
	
	public $x = 0;
	public $y = 0;
	public $z = 0;
	
	public $ownerId = 0;
	
	public function __construct(int $id, int $homeId, string $type, string $data, string $skin, int $x, int $y, int $z, int $ownerId)
	{
		$this->id = $id;
		$this->homeId = $homeId;
		$this->type = $type;
		$this->data = $data;
		$this->skin = $skin;
		$this->x = $x;
		$this->y = $y;
		$this->z = $z;
		$this->ownerId = $ownerId;
	}
	
	public function GetHome()
	{
		return HomesManager::GetHome($this->homeId);
	}
	
	public function GetHtml()
	{
		switch ($this->type)
		{
			case 'widget':
			
				$widget = null;
			
				switch (strtolower($this->data))
				{
					case 'profilewidget':
				
						$widget = new Template('widget-profile');
						$widget->SetParam('user_id', $this->GetHome()->linkId);
						break;
				}
				
				$widget->SetParam('id', $this->id);
				$widget->SetParam('pos-x', $this->x);
				$widget->SetParam('pos-y', $this->y);
				$widget->SetParam('pos-z', $this->z);
				$widget->SetParam('skin', $this->skin);
			
				return $widget->GetHtml();
		
			case 'stickie':
			
				return '<div class="movable stickie ' . $this->skin . '-c" style="left: ' . $this->x . 'px; top: ' . $this->y . 'px; z-index: ' . $this->z . ';" id="stickie-' . $this->id . '"><div class="' . $this->skin . '" ><div class="stickie-header"><h3></h3><div class="clear"></div></div><div class="stickie-body"><div class="stickie-content"><div class="stickie-markup">' . clean($this->data) . '</div><div class="stickie-footer"></div></div></div></div></div>';
		
			case 'sticker':
			
				return '<div class="movable sticker ' . clean($this->data) . '" style="left: ' . $this->x . 'px; top: ' . $this->y . 'px; z-index: ' . $this->z . ';" id="sticker-' . $this->id . '"></div>';
		}
	}
}

?>