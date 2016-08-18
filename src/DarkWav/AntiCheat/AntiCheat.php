<?php

namespace DarkWav\AntiCheat;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\utils\Config;
use DarkWav\AntiCheat\Tasks\AntiCheatTick;

class AntiCheat extends PluginBase{

    public function onEnable(){
	@mkdir($this->getDataFolder());
	$this->saveDefaultConfig();
	$this->saveResource("AntiForceOP.txt");
	
	if($this->getConfig()->get("ForceOP")) $this->getServer()->getScheduler()->scheduleRepeatingTask(new AntiCheatTick($this), 500);
	$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
	
  	$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > AntiCheat Activated");
    	$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > Shield Activated");
	$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > AntiCheat v2.5.3 [Neutron Star]");
	
	if($this->getConfig()->get("OneHit")) $this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiOneHit");
	if($this->getConfig()->get("Unkillable")) $this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiUnkillable");
	if($this->getConfig()->get("ForceOP")) $this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiForceOP");
	if($this->getConfig()->get("NoClip")) $this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiNoClip");
	if($this->getConfig()->get("KillAura")) $this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiKillAura");
	if($this->getConfig()->get("Reach")) $this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiReach");
	if($this->getConfig()->get("NoKnockBack")) $this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiNoKnockBack");

		if($this->getConfig()->get("Plugin-Version") !== "2.5.3"){
			$this->getServer()->getLogger()->emergency(TextFormat::BLUE."[AntiCheat] > Your Config is incompatible with this plugin version, please update immediately!");
			$this->getServer()->shutdown();
		}

		if($this->getConfig()->get("Config-Version") !== "3.2.0"){
			$this->getServer()->getLogger()->warning(TextFormat::BLUE."[AntiCheat] > Your Config is out of date!");
		}

    }

    public function onDisable(){
    	$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > You are no longer protected from cheats!");
    	$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > Shield Deactivated");
	$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > AntiCheat Deactivated");
    }
    
	public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
		if ($cmd->getName() === 'anticheat' || $cmd->getName() === 'ac'){
			$sender->sendMessage(TextFormat::BLUE."[AntiCheat] > AntiCheat v2.5.3 [Neutron Star] ~ DarkWav (Developer), Pav155 (Config Designer)");
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
