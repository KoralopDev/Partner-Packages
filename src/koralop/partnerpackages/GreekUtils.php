<?php

namespace koralop\partnerpackages;

use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\LevelEventPacket;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\GhastShootSound;

class GreekUtils {

    public static function addPartner(Player $player, int $amount = 1): void {
        $item = VanillaBlocks::ENDER_CHEST()->asItem();
        $item->setCustomName(TF::MINECOIN_GOLD.TF::BOLD . "Partner Packages");
        $item->getNamedTag()->setString("PartnerPackage", "greek");
        $item->setCount($amount);
        $player->getInventory()->addItem($item);
    }

    public static function spawnEffects(Player $player, Vector3 $position): void {
        $player->getWorld()->addSound($position, new GhastShootSound());
        self::particles($player, $position);
    }

    public static function serialize(Item $item): string {
        return base64_encode(gzcompress(self::itemToJson($item)));
    }

    public static function deserialize(string $item): Item {
        return self::jsonToItem(gzuncompress(base64_decode($item)));
    }

    private static function itemToJson(Item $item): string {
        return base64_encode(serialize($item->nbtSerialize()));
    }

    private static function jsonToItem(string $json): Item {
        return Item::nbtDeserialize(unserialize(base64_decode($json)));
    }

    private static function particles(Player $player, Vector3 $position): void {
        for ($i = 0; $i < 5; $i++) {
            $player->getNetworkSession()->sendDataPacket(LevelEventPacket::standardParticle(10, 0, $position));
        }
    }
}
