<?php

declare(strict_types=1);

namespace koralop\partnerpackages\module\invmenu\type;

use koralop\partnerpackages\module\invmenu\InvMenu;
use koralop\partnerpackages\module\invmenu\type\graphic\InvMenuGraphic;
use pocketmine\inventory\Inventory;
use pocketmine\player\Player;

interface InvMenuType{

	public function createGraphic(InvMenu $menu, Player $player) : ?InvMenuGraphic;

	public function createInventory() : Inventory;
}