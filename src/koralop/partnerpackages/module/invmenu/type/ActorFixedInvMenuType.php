<?php

declare(strict_types=1);

namespace koralop\partnerpackages\module\invmenu\type;

use koralop\partnerpackages\module\invmenu\inventory\InvMenuInventory;
use koralop\partnerpackages\module\invmenu\InvMenu;
use koralop\partnerpackages\module\invmenu\type\graphic\ActorInvMenuGraphic;
use koralop\partnerpackages\module\invmenu\type\graphic\InvMenuGraphic;
use koralop\partnerpackages\module\invmenu\type\graphic\network\InvMenuGraphicNetworkTranslator;
use pocketmine\inventory\Inventory;
use pocketmine\network\mcpe\protocol\types\entity\MetadataProperty;
use pocketmine\player\Player;

final class ActorFixedInvMenuType implements FixedInvMenuType{

	/**
	 * @param string $actor_identifier
	 * @param int $actor_runtime_identifier
	 * @param array<int, MetadataProperty> $actor_metadata
	 * @param int $size
	 * @param \partnerpackages\module\invmenu\type\graphic\network\InvMenuGraphicNetworkTranslator|null $network_translator
	 */
	public function __construct(
		readonly private string $actor_identifier,
		readonly private int $actor_runtime_identifier,
		readonly private array $actor_metadata,
		readonly private int $size,
		readonly private ?InvMenuGraphicNetworkTranslator $network_translator = null
	){}

	public function getSize() : int{
		return $this->size;
	}

	public function createGraphic(InvMenu $menu, Player $player) : ?InvMenuGraphic{
		return new ActorInvMenuGraphic($this->actor_identifier, $this->actor_runtime_identifier, $this->actor_metadata, $this->network_translator);
	}

	public function createInventory() : Inventory{
		return new InvMenuInventory($this->size);
	}
}