<?php

namespace koralop\partnerpackages\command;

use koralop\partnerpackages\Greek;
use koralop\partnerpackages\GreekUtils;
use koralop\partnerpackages\backup\ItemsBackup;
use koralop\partnerpackages\module\PartnerPackage;
use koralop\partnerpackages\module\invmenu\InvMenu;
use koralop\partnerpackages\module\invmenu\type\InvMenuTypeIds;
use koralop\partnerpackages\module\invmenu\transaction\InvMenuTransaction;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat as TF;

class PartnerPackagesCommand extends Command {

    public function __construct() {
        parent::__construct("pp", "Partner Package command", "/pp <give|content|edit>", ["partnerpackage"]);
        $this->setPermission("partnerpackage.command");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if (empty($args)) {
            $sender->sendMessage(TF::RED . "Usage: " . TF::GRAY . "/$commandLabel <give|content|edit>");
            return;
        }

        switch ($args[0]) {
            case "give":
                if (!Server::getInstance()->isOp($sender->getName())) {
                    $sender->sendMessage(TF::RED . "You don't have permissions");
                    return;
                }
                if (empty($args[1]) || empty($args[2]) || !is_numeric($args[2])) {
                    $sender->sendMessage(TF::RED . "Usage: /$commandLabel give <player|all> <amount>");
                    return;
                }

                $amount = (int)$args[2];

                if ($args[1] === "all") {
                    foreach (Greek::getInstance()->getServer()->getOnlinePlayers() as $player) {
                        GreekUtils::addPartner($player, $amount);
                        $player->sendMessage(TF::LIGHT_PURPLE . "You received " . TF::GOLD . "$amount" . TF::LIGHT_PURPLE . " Partner Package(s).");
                    }
                    $sender->sendMessage(TF::GREEN . "You gave $amount Partner Package(s) to all players.");
                    return;
                }

                $player = Greek::getInstance()->getServer()->getPlayerExact($args[1]);
                if ($player !== null) {
                    GreekUtils::addPartner($player, $amount);
                    $player->sendMessage(TF::LIGHT_PURPLE . "You received " . TF::GOLD . "$amount" . TF::LIGHT_PURPLE . " Partner Package(s).");
                    $sender->sendMessage(TF::GREEN . "You gave $amount Partner Package(s) to " . $player->getName() . ".");
                } else {
                    $sender->sendMessage(TF::RED . "Player not found.");
                }
                break;

            case "items":
            case "content":
                if (!$sender instanceof Player) {
                    $sender->sendMessage(TF::RED . "This command can only be executed in game.");
                    return;
                }

                $menu = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);
                $menu->setName(TF::BOLD . TF::LIGHT_PURPLE . "Partner Package");
                $menu->setListener(fn(InvMenuTransaction $tx) => $tx->discard());

                foreach (PartnerPackage::getItems() as $item) {
                    $menu->getInventory()->addItem($item);
                }

                $menu->send($sender);
                break;

            case "edit":
                if (!Server::getInstance()->isOp($sender->getName())) {
                    $sender->sendMessage(TF::RED . "You don't have permissions");
                    return;
                }
                if (!$sender instanceof Player) {
                    $sender->sendMessage(TF::RED . "This command can only be executed in game.");
                    return;
                }

                ItemsBackup::save($sender);
                $sender->sendMessage(TF::GREEN . "The Partner Package content has been updated.");
                break;

            default:
                $sender->sendMessage(TF::RED . "(Error) /pp help");
                break;
        }
    }
}
