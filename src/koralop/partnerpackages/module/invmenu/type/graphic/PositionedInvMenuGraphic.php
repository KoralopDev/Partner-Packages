<?php

declare(strict_types=1);

namespace koralop\partnerpackages\module\invmenu\type\graphic;

use pocketmine\math\Vector3;

interface PositionedInvMenuGraphic extends InvMenuGraphic{

	public function getPosition() : Vector3;
}