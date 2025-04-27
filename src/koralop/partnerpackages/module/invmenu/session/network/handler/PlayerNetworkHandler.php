<?php

declare(strict_types=1);

namespace koralop\partnerpackages\module\invmenu\session\network\handler;

use Closure;
use koralop\partnerpackages\module\invmenu\session\network\NetworkStackLatencyEntry;

interface PlayerNetworkHandler{

	public function createNetworkStackLatencyEntry(Closure $then) : NetworkStackLatencyEntry;
}