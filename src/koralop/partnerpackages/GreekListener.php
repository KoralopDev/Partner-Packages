<?php

namespace koralop\partnerpackages;

use koralop\partnerpackages\module\PartnerPackage;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\Item;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class GreekListener implements Listener {

    public function onInteract(PlayerInteractEvent $event): void {
        if ($event->getItem()->getNamedTag()->getTag("PartnerPackage") !== null &&
            $event->getItem()->getNamedTag()->getString("PartnerPackage") === "greek") {
            $this->givePackage($event->getPlayer());
            $event->getItem()->setCount($event->getItem()->getCount() - 1);
            $event->getPlayer()->getInventory()->setItemInHand($event->getItem());
            GreekUtils::spawnEffects($event->getPlayer(), $event->getPlayer()->getPosition());
            $event->cancel();
        }
    }

    private function givePackage(Player $player): void {
        if (($item = PartnerPackage::getRandomItem()) instanceof Item) {
            $player->getInventory()->addItem($item);
            $player->sendMessage(TF::GOLD . "You received" . TF::WHITE . ": " . $item->getName());
        } else {
            $player->sendMessage(TF::RED . "No items found in the PartnerPackage.");
        }
    }
}
