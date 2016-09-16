<?php

/**
 *
 * 8888888b.                   888               888    8888888888                                    888    d8b          888
 * 888   Y88b                  888               888    888                                           888    Y8P          888
 * 888    888                  888               888    888                                           888                 888
 * 888   d88P .d88b.   .d8888b 888  888  .d88b.  888888 8888888   .d8888b  .d8888b   .d88b.  88888b.  888888 888  8888b.  888
 * 8888888P" d88""88b d88P"    888 .88P d8P  Y8b 888    888       88K      88K      d8P  Y8b 888 "88b 888    888     "88b 888
 * 888       888  888 888      888888K  88888888 888    888       "Y8888b. "Y8888b. 88888888 888  888 888    888 .d888888 888
 * 888       Y88..88P Y88b.    888 "88b Y8b.     Y88b.  888            X88      X88 Y8b.     888  888 Y88b.  888 888  888 888
 * 888        "Y88P"   "Y8888P 888  888  "Y8888   "Y888 8888888888 88888P'  88888P'  "Y8888  888  888  "Y888 888 "Y888888 888
 *
 * Copyright (C) 2016 PocketEssential
 *
 * This is a public software, you cannot redistribute it a and/or modify any way
 * unless otherwise given permission to do so.
 *
 * @author PocketEssential
 * @link https://github.com/PocketEssential/
 *
 */


namespace PocketEssential\TeleportPlus;

use pocketmine\command\Command;
use pocketmine\Player;
use pocketmine\plugin\PluginLogger;
use pocketmine\command\CommandSender;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\level\Level;

class Main extends PluginBase implements Listener
{

    public function onEnable()
    {
        $this->getLogger()->info(TextFormat::GREEN . "TeleportPlus has been enabled");

    }

    public function onDisable()
    {
        $this->getLogger()->info(TextFormat::GREEN . "TeleportPlus has been disabled");
    }

    public function onCommand(CommandSender $sender, Command $command, $label, array $args)
    {
        $cmd = strtolower($command->getName());
        if ($cmd === "tpall") {
            if (!$sender->hasPermission("TeleportPlus.use")) return;

            $sender->sendMessage(TextFormat::BLUE . "Teleporting all players to you.....");
            foreach ($this->getServer()->getOnlinePlayers() as $p) {
                $p->teleport($sender);
                $p->sendMessage(TextFormat::RED . "You have been teleported to " . TextFormat::BLUE . $sender->getName());
            }
        } elseif ($cmd == "world") {
            $this->getServer()->loadLevel($args[0]);
            $level = $this->getServer()->getLevelByName($args[0]);
            $sender->sendMessage(TextFormat::DARK_RED . "Teleporting to $args[0]");
            $sender->teleport($level->getSafeSpawn());
            $sender->sendMessage(TextFormat::DARK_AQUA . "You have been teleported to $args[0]");
            return true;
        }
    }
}

