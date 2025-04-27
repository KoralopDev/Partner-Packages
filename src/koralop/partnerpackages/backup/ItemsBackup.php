<?php

namespace koralop\partnerpackages\backup;

use koralop\partnerpackages\Greek;
use koralop\partnerpackages\GreekUtils;
use pocketmine\block\Block;
use pocketmine\item\Item;
use pocketmine\player\Player;
use pocketmine\utils\Config;

class ItemsBackup {

    private static Config $content;

    public static function init(): void {
        $path = Greek::getInstance()->getDataFolder() . "content.json";

        self::$content = new Config($path, Config::JSON, ["contents" => []]);
        self::$content->save();
    }

    public static function save(Player $player): void {
        $items = [];

        foreach ($player->getInventory()->getContents() as $item) {
            if ($item instanceof Block) {
                $items[] = GreekUtils::serialize($item->asItem());
            } elseif ($item instanceof Item) {
                $items[] = GreekUtils::serialize($item);
            }
        }

        self::$content->set("contents", $items);
        self::$content->save();
    }
}
