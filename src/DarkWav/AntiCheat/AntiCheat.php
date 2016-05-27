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
use pocketmine\event\player\PlayerCreationEvent;
use pocketmine\event\player\PlayerEvent;
use pocketmine\event\player\PlayerGameModeChangeEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerKickEvent;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerPreLoginEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerRespawnEvent;
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

class AntiCheat extends PluginBase implements Listener{

    public function onEnable(){
	$this->saveDefaultConfig();
    $yml = new Config($this->getDataFolder() . "config.yml", Config::YAML);
    $this->yml = $yml->getAll();
  	$this->getServer()->getLogger()->info(TextFormat::RED."[AntiCheat] > AntiCheat Activated");
    $this->getServer()->getLogger()->info(TextFormat::RED."[AntiCheat] > Shield Activated");
	$this->getServer()->getLogger()->info(TextFormat::RED."[AntiCheat] > AntiCheat v1.12.2 [Wolverine]");
	$this->getServer()->getLogger()->info(TextFormat::RED."[AntiCheat] > Enabling AntiForceGameMode");
	if($this->yml["ForceField"] == "true"){$this->getServer()->getLogger()->info(TextFormat::RED."[AntiCheat] > Enabling AntiForceField");}
	if($this->yml["OneHit"] == "true"){$this->getServer()->getLogger()->info(TextFormat::RED."[AntiCheat] > Enabling AntiOneHit");}
	if($this->yml["Unkillable"] == "true"){$this->getServer()->getLogger()->info(TextFormat::RED."[AntiCheat] > Enabling AntiUnkillable");}
	if($this->yml["AntiKnockBack"] == "true"){$this->getServer()->getLogger()->info(TextFormat::RED."[AntiCheat] > Enabling AntiAntiKnockBack");}
	$this->getServer()->getLogger()->info(TextFormat::RED."[AntiCheat] > Enabling AntiForceOP");
	$this->getServer()->getLogger()->info(TextFormat::RED."[AntiCheat] > Enabling AntiForceBan");
	$this->getServer()->getPluginManager()->registerEvents($this, $this);

    }

    public function onDisable(){

    $this->getServer()->getLogger()->info(TextFormat::RED."[AntiCheat] > You are no longer protected from cheats!");
    $this->getServer()->getLogger()->info(TextFormat::RED."[AntiCheat] > Shield Deactivated");
	$this->getServer()->getLogger()->info(TextFormat::RED."[AntiCheat] > AntiCheat Deactivated");

    }
    
   public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
    
    if ($cmd->getName() == "anticheat"){
          
             $sender->sendMessage(TextFormat::RED."[AntiCheat] > AntiCheat v1.12.2 [Wolverine] ~ DarkWav (Darku)");

			}

	if ($cmd->getName() == "ac"){
          
             $sender->sendMessage(TextFormat::RED."[AntiCheat] > AntiCheat v1.12.2 [Wolverine] ~ DarkWav (Darku)");

			}

	if ($cmd->getName() == "gamemode"){

			if($player !== $player and !$player->hasPermission("none")){
          
			$sender->kick(TextFormat::RED."[AntiCheat] > You were kicked for hacking ForceGameMode!");

			}

			}

	if ($cmd->getName() == "op"){

			if($player !== $player and !$player->hasPermission("none")){
          
			$sender->kick(TextFormat::RED."[AntiCheat] > You were kicked for hacking ForceOP!");

			}

			}

	if ($cmd->getName() == "ban"){

			if($player !== $player and !$player->hasPermission("none")){
          
			$sender->kick(TextFormat::RED."[AntiCheat] > You were kicked for hacking ForceBan!");

			}

			}

	if ($cmd->getName() == "ban-ip"){

			if($player !== $player and !$player->hasPermission("none")){
          
			$sender->kick(TextFormat::RED."[AntiCheat] > You were kicked for hacking ForceBan!");

			}

			}

	if ($cmd->getName() == "ban-device"){

			if($player !== $player and !$player->hasPermission("none")){
          
			$sender->kick(TextFormat::RED."[AntiCheat] > You were kicked for hacking ForceBan!");

			}

			}

	}


    public function onGameModeChange(PlayerKickEvent $k, Player $player, PlayerGameModeChangeEvent $c, Permission $permission, NewGameMode $newGamemode) {

	if($this->yml["ForceGameMode"] == "true"){

	//Checks permissions.

	           if($player !== $player and !$player->hasPermission("none")){

			   $c->getPlayer()->kick(TextFormat::RED."[AntiCheat] > You were kicked for hacking ForceGameMode!");

			   $this->getServer()->getLogger()->info(TextFormat::RED."[AntiCheat] > $k->getPlayer() is hacking ForceGameMode!");
   
    }
	
	
	            elseif($player !== $player and !$player->hasPermission("moderator")){

    //Moderator hook.
           
               $player->sendMessage(TextFormat::RED."[AntiCheat] > You passed Gamemode changeing!");
              
    }

	            elseif($target !== $player and !$sender->hasPermission("anticheat")){
           
               $player->sendMessage(TextFormat::RED."[AntiCheat] > You passed Gamemode changeing!");
              
    }

	            elseif($player !== $player and !$player->hasPermission("command.gamemode")){

    //Extra permission hook.
           
               $player->sendMessage(TextFormat::RED."[AntiCheat] > You passed Gamemode changeing!");
              
    }

	            elseif($player !== $player and !$player->hasPermission("anticheat.bypass")){

    //AntiCheat permission hook.
           
               $player->sendMessage(TextFormat::RED."[AntiCheat] > You passed Gamemode changeing!");
              
    }

    }

	}
	
	//Combat-Hack-Detection  (API extends 1.1)

    public function onDamage(EntityDamageEvent $d, EntityDamageByEntityEvent $e, Damager $damager){

	//Unkillable-Detection

	     if ($this->yml["Unkillable"] == "true"){

	     if ($d->getDamage() < 0.5) {

		 $d->getEntity()->kick(TextFormat::RED."[AntiCheat] > You were kicked for hacking Unkillable!");

		 $this->getServer()->getLogger()->info(TextFormat::RED."[AntiCheat] > $e->getEntity() is hacking Unkillable!");

	     }

	     }

	//OneHit-Detection

	  if ($this->yml["OneHit"] == "true"){

	     if ($d->getDamage() > 19.5) {

	     //Kicks the Hacker.

		 $e->getDamager()->kick(TextFormat::RED."[AntiCheat] > You were kicked for hacking OneHit!");

		 $this->getServer()->getLogger()->info(TextFormat::RED."[AntiCheat] > $e->getDamager() is hacking OneHit!");

	     }

		 }

	//AntiKnockBack-Detection

	if ($this->yml["AntiKnockBack"] == "true"){

	     if ($e->getKnockBack() < 0.5) {

		 $e->getEntity()->kick(TextFormat::RED."[AntiCheat] > You were kicked for hacking AntiKnockBack!");

		 $this->getServer()->getLogger()->info(TextFormat::RED."[AntiCheat] > $e->getEntity() is hacking AntiKnockback!");

	     }

	     }

    //ForceField-Detection

	if ($this->yml["ForceField"] == "true"){

	     if ($e->getEntity() > 1) {

		 $e->getDamager()->kick(TextFormat::RED."[AntiCheat] > You were kicked for hacking ForceField!");

		 $this->getServer()->getLogger()->info(TextFormat::RED."[AntiCheat] > $e->getDamager() is hacking ForceField!");

	     }

	     if ($d->getEntity() > 1) {

		 $e->getDamager()->kick(TextFormat::RED."[AntiCheat] > You were kicked for hacking ForceField!");

		 $this->getServer()->getLogger()->info(TextFormat::RED."[AntiCheat] > $e->getDamager() is hacking ForceField!");

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
