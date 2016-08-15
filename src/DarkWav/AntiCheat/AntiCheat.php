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
	$this->saveResource("AntiForceOP.txt");
  	$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > AntiCheat Activated");
    $this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > Shield Activated");
	$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > AntiCheat v2.5.1 [Neutron Star]");
	if($this->getConfig()->get("OneHit") == "true"){$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiOneHit");}
	if($this->getConfig()->get("Unkillable") == "true"){$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiUnkillable");}
	if($this->getConfig()->get("ForceOP") == "true"){$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiForceOP");}
	if($this->getConfig()->get("NoClip") == "true"){$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiNoClip");}
	if($this->getConfig()->get("KillAura") == "true"){$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiKillAura");}
	if($this->getConfig()->get("Reach") == "true"){$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiReach");}
	if($this->getConfig()->get("NoKnockBack") == "true"){$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiNoKnockBack");}

		if($this->getConfig()->get("Plugin-Version") != "2.5.1" and $this->getConfig()->get("Plugin-Version") != "2.5.0"){

			$this->getServer()->getLogger()->critical(TextFormat::BLUE."[AntiCheat] > Your Config is incompatible with this plugin version, please update immediately!");

		}

		if($this->getConfig()->get("Config-Version") != "3.1.8"){

			$this->getServer()->getLogger()->warning(TextFormat::BLUE."[AntiCheat] > Your Config is out of date!");

		}

    }

    public function onDisable(){

    $this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > You are no longer protected from cheats!");
    $this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > Shield Deactivated");
	$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > AntiCheat Deactivated");
	$this->getServer()->shutdown();

    }
    
	public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
   
		if ($cmd->getName() == "anticheat"){
          
			$sender->sendMessage(TextFormat::BLUE."[AntiCheat] > AntiCheat v2.5.1 [Neutron Star] ~ DarkWav (Developer), Pav155 (Config Designer)");

		}

		if ($cmd->getName() == "ac"){
		
			$sender->sendMessage(TextFormat::BLUE."[AntiCheat] > AntiCheat v2.5.1 [Neutron Star] ~ DarkWav (Developer), Pav155 (Config Designer)");

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