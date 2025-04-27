<?php

namespace koralop\partnerpackages\module;

use koralop\partnerpackages\Greek;
use koralop\partnerpackages\GreekUtils;
use pocketmine\item\Item;

class PartnerPackage {

    public static function getItems(): array {
        $path = Greek::getInstance()->getDataFolder() . "content.json";

        if (!file_exists($path)) {
            return [];
        }

        $data = json_decode(file_get_contents($path), true);
        $contents = $data["contents"] ?? [];

        $items = [];
        foreach ($contents as $serialized) {
            $item = GreekUtils::deserialize($serialized);
            if ($item instanceof Item) {
                $items[] = $item;
            }
        }

        return $items;
    }

    public static function getRandomItem(): ?Item {
        $items = self::getItems();
        if (empty($items)) {
            return null;
        }
        return $items[array_rand($items)];
    }
}
