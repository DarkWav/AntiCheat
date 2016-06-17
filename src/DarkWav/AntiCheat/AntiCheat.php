<?php

namespace DarkWav\AntiCheat;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\plugin\PluginDescription;
use pocketmine\plugin\EventExecutor;
use pocketmine\plugin\MethodEventExecutor;
use pocketmine\event\player\PlayerAnimationEvent;
use pocketmine\event\player\PlayerCommandPreprocessEvent;
use pocketmine\event\player\PlayerEvent;
use pocketmine\event\player\PlayerGameModeChangeEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerKickEvent;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerPreLoginEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\Cancellable;
use pocketmine\permission\Permission;
use pocketmine\permission\Permissible;
use pocketmine\permission\PermissibleBase;
use pocketmine\event\Listener;
use pocketmine\entity\Effect;
use pocketmine\entity\Damageable;
use pocketmine\utils\Config;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityEvent;
use pocketmine\level\Position;
use pocketmine\math\Vector3;

class AntiCheat extends PluginBase implements Listener{

    public function onEnable(){
	$this->saveDefaultConfig();
	$this->saveResource("AntiForceOP.txt");
    $yml = new Config($this->getDataFolder() . "config.yml", Config::YAML);
    $this->yml = $yml->getAll();
  	$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > AntiCheat Activated");
    $this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > Shield Activated");
	$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > AntiCheat v2.1.0 [Racoon]");
	$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiForceGameMode");
	if($this->yml["ForceField"] == "true"){$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiForceField");}
	if($this->yml["OneHit"] == "true"){$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiOneHit");}
	if($this->yml["Unkillable"] == "true"){$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiUnkillable");}
	if($this->yml["AntiKnockBack"] == "true"){$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiAntiKnockBack");}
	if($this->yml["ForceOP"] == "true"){$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiForceOP");}
	if($this->yml["KillAura"] == "true"){$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiKillAura");}

    }

    public function onDisable(){

    $this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > You are no longer protected from cheats!");
    $this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > Shield Deactivated");
	$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > AntiCheat Deactivated");

    }
    
   public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
    
    if ($cmd->getName() == "anticheat"){
          
             $sender->sendMessage(TextFormat::BLUE."[AntiCheat] > AntiCheat v2.1.0 [Racoon] ~ DarkWav (Darku)");

			}

	if ($cmd->getName() == "ac"){
          
            $sender->sendMessage(TextFormat::BLUE."[AntiCheat] > AntiCheat v2.1.0 [Racoon] ~ DarkWav (Darku)");

			}

	}


    public function PlayerGameModeChangeEvent(PlayerKickEvent $k, Player $player, PlayerGameModeChangeEvent $c, Permission $permission, NewGameMode $newGamemode){

	//Checks permissions.

		if($player !== $player and !$player->hasPermission("none")){

			$c->player->kick(TextFormat::BLUE."[AntiCheat] > You were kicked for hacking ForceGameMode!");

			$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > $c->player is hacking ForceGameMode!");
   
		}
	
	
		if($player !== $player and !$player->hasPermission("moderator")){

    //Moderator hook.
           
			$player->sendMessage(TextFormat::BLUE."[AntiCheat] > You passed Gamemode changeing!");
              
		}

		if($target !== $player and !$sender->hasPermission("anticheat")){
           
			$player->sendMessage(TextFormat::BLUE."[AntiCheat] > You passed Gamemode changeing!");
              
		}
		
		if($player !== $player and !$player->hasPermission("command.gamemode")){

    //Extra permission hook.
           
			$player->sendMessage(TextFormat::BLUE."[AntiCheat] > You passed Gamemode changeing!");
            
		}

		if($player !== $player and !$player->hasPermission("anticheat.bypass")){

    //AntiCheat permission hook.
           
			$player->sendMessage(TextFormat::BLUE."[AntiCheat] > You passed Gamemode changeing!");

		}

	}
	
	public function onPlayerEvent(PlayerEvent $event){

		if ($this->yml["Unkillable"] == "true"){

			if ($event->getPlayer()->isOp()){

				if (!$event->getPlayer()->hasPermission("anticheat.op")){

					$event->getPlayer()->kick("ForceOP detected!");

				}

			}

		}

	}

	//Combat-Hack-Detection  (API extends 2.0)

    public function onEntityDamageByEntityEvent(EntityDamageByEntityEvent $event){

	//Unkillable-Detection

	     if ($this->yml["Unkillable"] == "true"){

			if ($event->getDamage() < 0.5) {

				$event->getEntity()->kick(TextFormat::BLUE."[AntiCheat] > Unkillable is not allowed!");

				$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > $event->getEntity() is hacking Unkillable!");

			}

	     }

	//OneHit-Detection

		if ($this->yml["OneHit"] == "true"){

			if ($event->getDamage() > 19.5) {

				$event->getDamager()->kick(TextFormat::BLUE."[AntiCheat] > OneHit is not allowed!");

				$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > $event->getDamager() is hacking OneHit!");

			}

		 }

	//AntiKnockBack-Detection

		if ($this->yml["AntiKnockBack"] == "true"){

			if ($event->getKnockBack() < 0.4) {

				$event->getEntity()->kick(TextFormat::BLUE."[AntiCheat] > AntiKnockBack is not allowed!");

				$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > $event->getEntity() is hacking AntiKnockBack!");

			}

		 }

    //ForceField-Detection

		if ($this->yml["ForceField"] == "true"){

			if ($event->getEntity() > 1) {

				$event->getDamager()->kick(TextFormat::BLUE."[AntiCheat] > ForceField is not allowed!");

				$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > $event->getDamager() is hacking ForceField!");

			}

		 }

    //KillAura-Detection

		if ($this->yml["KillAura"] == "true"){

			if ($event->getEntity()->getPosition() == $event->getDamager()->round()) {

				if ($event->getEntity()->getPosition() !== $event->getDamager()->getForward()) {

					$event->getDamager()->kick(TextFormat::BLUE."[AntiCheat] > KillAura is not allowed!");

					$this->getServer()->getLogger()->info(TextFormat::BLUE."[AntiCheat] > $event->getDamager() is hacking KillAura!");

				}

			}

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