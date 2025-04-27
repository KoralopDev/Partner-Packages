<?php

declare(strict_types=1);

namespace koralop\partnerpackages\module\invmenu\type\util\builder;

use koralop\partnerpackages\module\invmenu\type\graphic\network\InvMenuGraphicNetworkTranslator;
use koralop\partnerpackages\module\invmenu\type\graphic\network\MultiInvMenuGraphicNetworkTranslator;
use koralop\partnerpackages\module\invmenu\type\graphic\network\WindowTypeInvMenuGraphicNetworkTranslator;

trait GraphicNetworkTranslatableInvMenuTypeBuilderTrait{

	/** @var \koralop\partnerpackages\module\invmenu\type\graphic\network\InvMenuGraphicNetworkTranslator[] */
	private array $graphic_network_translators = [];

	public function addGraphicNetworkTranslator(InvMenuGraphicNetworkTranslator $translator) : self{
		$this->graphic_network_translators[] = $translator;
		return $this;
	}

	public function setNetworkWindowType(int $window_type) : self{
		$this->addGraphicNetworkTranslator(new WindowTypeInvMenuGraphicNetworkTranslator($window_type));
		return $this;
	}

	protected function getGraphicNetworkTranslator() : ?InvMenuGraphicNetworkTranslator{
		if(count($this->graphic_network_translators) === 0){
			return null;
		}

		if(count($this->graphic_network_translators) === 1){
			return $this->graphic_network_translators[array_key_first($this->graphic_network_translators)];
		}

		return new MultiInvMenuGraphicNetworkTranslator($this->graphic_network_translators);
	}
}