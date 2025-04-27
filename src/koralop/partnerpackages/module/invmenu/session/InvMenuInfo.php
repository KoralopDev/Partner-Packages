<?php

declare(strict_types=1);

namespace koralop\partnerpackages\module\invmenu\session;

use koralop\partnerpackages\module\invmenu\InvMenu;
use koralop\partnerpackages\module\invmenu\type\graphic\InvMenuGraphic;

final class InvMenuInfo{

	public function __construct(
		readonly public InvMenu $menu,
		readonly public InvMenuGraphic $graphic,
		readonly public ?string $graphic_name
	){}
}