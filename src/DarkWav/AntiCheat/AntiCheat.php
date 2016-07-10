<?php

namespace DarkWav\AntiCheat;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\plugin\PluginDescription;
use pocketmine\utils\Config;

class AntiCheat extends PluginBase{

    public function onEnable(){

	$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
	$this->saveDefaultConfig();
	$yml = new Config($this->getDataFolder() . "config.yml", Config::YAML);
    $this->yml = $yml->getAll();
	$this->saveResource("AntiForceOP.txt");
  	$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > AntiCheat Activated");
    $this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > Shield Activated");
	$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > AntiCheat v2.2.1 [Racoon]");
	if($this->yml["OneHit"] == "true"){$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiOneHit");}
	if($this->yml["Unkillable"] == "true"){$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiUnkillable");}
	if($this->yml["ForceOP"] == "true"){$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiForceOP");}
	if($this->yml["KillAura"] == "true"){$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiKillAura");}
	if($this->yml["NoKnockBack"] == "true"){$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiNoKnockBack");}

    }

    public function onDisable(){

    $this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > You are no longer protected from cheats!");
    $this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > Shield Deactivated");
	$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > AntiCheat Deactivated");

    }
    
	public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
   
		if ($cmd->getName() == "anticheat"){
          
             $sender->sendMessage(TextFormat::BLUE."[AntiCheat] > AntiCheat v2.2.1 [Racoon] ~ DarkWav (Darku)");

		}

		if ($cmd->getName() == "ac"){
		
		$sender->sendMessage(TextFormat::BLUE."[AntiCheat] > AntiCheat v2.2.1 [Racoon] ~ DarkWav (Darku)");

		}

	}

}

//////////////////////////////////////////////////////
//                                                  //
//     AntiCheat by DarkWav.                        //
//     Distributed under the ImagicalMine License.  //
//     Do not redistribute in modyfied form!        //
//     All rights reserved.                         //
//                                                  //
//////////////////////////////////////////////////////