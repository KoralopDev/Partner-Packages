<?php

declare(strict_types=1);

namespace koralop\partnerpackages\module\invmenu\type\graphic\network;

use koralop\partnerpackages\module\invmenu\session\InvMenuInfo;
use koralop\partnerpackages\module\invmenu\session\PlayerSession;
use pocketmine\network\mcpe\protocol\ContainerOpenPacket;

interface InvMenuGraphicNetworkTranslator{

	public function translate(PlayerSession $session, InvMenuInfo $current, ContainerOpenPacket $packet) : void;
}