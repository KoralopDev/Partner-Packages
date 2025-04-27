<?php

namespace koralop\partnerpackages;

use koralop\partnerpackages\backup\ItemsBackup;
use koralop\partnerpackages\command\PartnerPackagesCommand;
use koralop\partnerpackages\module\invmenu\InvMenuHandler;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as TF;

class Greek extends PluginBase {

    private static self $instance;

    protected function onLoad(): void {
        self::$instance = $this;
    }

    protected function onEnable(): void {
        if (!InvMenuHandler::isRegistered()) {
            InvMenuHandler::register($this);
        }

        $this->getServer()->getPluginManager()->registerEvents(new GreekListener(), $this);
        $this->getServer()->getCommandMap()->register("partnerpackage", new PartnerPackagesCommand());
        $this->getLogger()->info(TF::LIGHT_PURPLE . "PartnerPackages " . TF::WHITE . "by " . TF::GOLD . "Koralop.");
        ItemsBackup::init();
    }

    public static function getInstance(): self {
        return self::$instance;
    }
}
