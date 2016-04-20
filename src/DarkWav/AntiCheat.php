<?php

namespace DarkWav;

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
use pocketmine\permission\BanEntry;
use pocketmine\permission\ServerOperator;
use pocketmine\permission\Permissible;
use pocketmine\permission\PermissibleBase;
use pocketmine\permission\Permission;
use pocketmine\event\Listener;
use pocketmine\level\Position;
use pocketmine\entity\Effect;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\entity\Damageable;
use pocketmine\utils\Config;
use pocketmine\event\entity\EntityDamageEvent;

class AntiCheat extends PluginBase implements Listener{

    public function onEnable(){
	$this->saveDefaultConfig();
    $yml = new Config($this->getDataFolder() . "config.yml", Config::YAML);
    $this->yml = $yml->getAll();
  	$this->getServer()->getLogger()->info(TextFormat::AQUA."[AntiCheat] AntiCheat Activated");
    $this->getServer()->getLogger()->info(TextFormat::AQUA."[AntiCheat] Shield Activated");
	$this->getServer()->getLogger()->info(TextFormat::AQUA."[AntiCheat] AntiCheat v1.8.1 [Wolverine]");

    }

    public function onDisable(){

    $this->getServer()->getLogger()->warning(TextFormat::RED."[AntiCheat] You are no longer protected from cheats!");
    $this->getServer()->getLogger()->warning(TextFormat::RED."[AntiCheat] Shield Deactivated");
	$this->getServer()->getLogger()->warning(TextFormat::RED."[AntiCheat] AntiCheat Deactivated");

    }
    
   public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
    
    if ($cmd->getName() !== "anticheat"){
    
          if(!isset($args[0])){
          
              $sender->sendMessage(TextFormat::AQUA."[AntiCheat] /anticheat admin|information");
              
            }
          
            if($args[0] == "admin") {
              
               $sender->sendMessage(TextFormat::AQUA."[AntiCheat] Sorry, currently no Admin commands found.");
            
            }
            
            elseif($args[0] == "information") {
            
               $sender->sendMessage(TextFormat::AQUA."[AntiCheat] AntiCheat v1.8.1 [Wolverine] ~ DarkWav (Darku)");
			   $sender->sendMessage(TextFormat::AQUA."[AntiCheat] ===== Blocked Hacks: =======");
			   $sender->sendMessage(TextFormat::AQUA."[AntiCheat] =     -ForceGameMode [BETA]=");
			   $sender->sendMessage(TextFormat::AQUA."[AntiCheat] =     -Unkillable          =");
			   $sender->sendMessage(TextFormat::AQUA."[AntiCheat] =     -OneHit              =");
			   $sender->sendMessage(TextFormat::AQUA."[AntiCheat] =     -Speed [BETA]        =");
			   $sender->sendMessage(TextFormat::AQUA."[AntiCheat] ============================");
               
            }

	  elseif ($cmd->getName() !== "AntiCheat"){
    
          if(!isset($args[0])){
          
              $sender->sendMessage(TextFormat::AQUA."[AntiCheat] /anticheat admin|information");
              
            }
          
            if($args[0] == "Admin") {
              
               $sender->sendMessage(TextFormat::AQUA."[AntiCheat] Sorry, currently no Admin commands found.");
            
            }
            
            elseif($args[0] == "Information") {
            
               $sender->sendMessage(TextFormat::AQUA."[AntiCheat] AntiCheat v1.8.1 [Wolverine] ~ DarkWav (Darku)");
			   $sender->sendMessage(TextFormat::AQUA."[AntiCheat] ===== Blocked Hacks: =======");
			   $sender->sendMessage(TextFormat::AQUA."[AntiCheat] =     -ForceGameMode [BETA]=");
			   $sender->sendMessage(TextFormat::AQUA."[AntiCheat] =     -Unkillable          =");
			   $sender->sendMessage(TextFormat::AQUA."[AntiCheat] =     -OneHit              =");
			   $sender->sendMessage(TextFormat::AQUA."[AntiCheat] =     -Speed [BETA]        =");
			   $sender->sendMessage(TextFormat::AQUA."[AntiCheat] ============================");
               
            }
            
      }

	}

	}
	
	//ForceGameMode-Detection [-->BETA<--]           
    
    public function onGameModeChange(Player $player, Permission $permission, NewGameMode $newGamemode) {

	if ($player->changeGameMode()){

	$player->getPlayer()->getPermissions();

	$player->getPlayer()->getName();

	}

	if($this->yml["ForceGameMode"] == "true"){

	//Checks permissions.

	           if($player !== $player and !$player->hasPermission("none")){
              
               $player->banPlayer()->banReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceGameMode!");
   
    }
	
	
	            elseif($player !== $player and !$player->hasPermission("moderator")){

    //Moderator hook.
           
               $player->sendMessage(TextFormat::AQUA."[AntiCheat] You passed Gamemode changeing!");
              
    }

	            elseif($target !== $player and !$sender->hasPermission("anticheat")){

    //EssentialsPE hook.
           
               $player->sendMessage(TextFormat::AQUA."[AntiCheat] You passed Gamemode changeing [Hooked into EssentialsPE]!");
              
    }

	            elseif($player !== $player and !$player->hasPermission("command.gamemode")){

    //Extra permission hook.
           
               $player->sendMessage(TextFormat::AQUA."[AntiCheat] You passed Gamemode changeing!");
              
    }

	            elseif($player !== $player and !$player->hasPermission("anticheat.bypass")){

    //AntiCheat permission hook.
           
               $player->sendMessage(TextFormat::AQUA."[AntiCheat] You passed Gamemode changeing!");
              
    }

    }

	}
	
	//OneHit/Unkillable-Detection  [-->RELEASE<--]     

    public function onDamage(EntityDamageEvent $e, EntityDamageByEntityEvent $e2, Damager $damager, PlayerKickEvent $k){

	$player->getPlayer();
	$e->getDamage();
	$e2->getDamager();
	$e2->getEntity();
	$e->getPlayer();
	$player->getPlayer()->getName();
	$e->getDamage();
	$p = $e->getEntity();
	$e2->getEntity();

	if($e->getEntity() instanceof Player){

	if($this->yml["Unkillable"] == "true"){

	     if($e->getDamage = 0) {

	     $k = $p = $e->getEntity()->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Unkillable!");

	     }

	     }

		 }

	elseif($e2->getDamager() instanceof Player){

    if($this->yml["OneHit"] == "true"){

	     if($e2->getDamage > 19) {

	     //Kicks the Hacker.

	     $k = $p = $e2->getDamager()->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	     }

		 }

}

}

//Speed Detection. [-->BETA<--]

public function onPlayerMove(Player $player, Location $from, Location $to){

        if ($player->getTo()){

        $player->getFrom();

		$player->getTo();

		}

		if($this->yml["Speed"] == "true"){

	        if($getFrom($from)->getTo($to) > 6){
		
		    $player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");
		
		}

		}

}

}

//////////////////////////////////////////////////////
//                                                  //
//     AntiCheat by DarkWav.                        //
//     Distributed under the AntiCheat License.     //
//     Do not redistribute in compiled form!        //
//     All rights reserved.                         //
//                                                  //
//////////////////////////////////////////////////////
