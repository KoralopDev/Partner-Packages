<?php

declare(strict_types=1);

namespace koralop\partnerpackages\module\invmenu\type\util\builder;

use koralop\partnerpackages\module\invmenu\type\InvMenuType;

interface InvMenuTypeBuilder{

	public function build() : InvMenuType;
}