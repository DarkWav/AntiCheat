<?php

namespace DarkWav;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\plugin\PluginDescription;
use pocketmine\plugin\EventExecutor;
use pocketmine\plugin\MethodEventExecutor;
use pocketmine\player\PlayerListEntry;
use pocketmine\event\player\PlayerAnimationEvent;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerCommandPreprocessEvent;
use pocketmine\event\player\PlayerCreationEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PlayerEvent;
use pocketmine\event\player\PlayerGameModeChangeEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerItemHeldEvent;
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
use pocketmine\event\entity\EntityDamageByEntity;
use pocketmine\entity\Damageable;
use pocketmine\utils\Config;
use pocketmine\event\entity\EntityDamageEvent;

class AntiCheat extends PluginBase implements Listener{

    public function onEnable(){
	$this->saveDefaultConfig();
    $yml = new Config($this->getDataFolder() . "config.yml", Config::YAML);
    $this->yml = $yml->getAll();
    if($this->yml["Messages"] == "true"){
  	$this->getServer()->getLogger()->info(TextFormat::AQUA."[AntiCheat] AntiCheat Activated");
    $this->getServer()->getLogger()->info(TextFormat::AQUA."[AntiCheat] Shield Activated");
	$this->getServer()->getLogger()->info(TextFormat::AQUA."[AntiCheat] AntiCheat v1.5.1 [Wolverine]");
	 
    }

    }

    public function onDisable(){
    
	if($this->yml["Messages"] == "true"){
    $this->getServer()->getLogger()->warning(TextFormat::RED."[AntiCheat] You are no longer protected from cheats!");
    $this->getServer()->getLogger()->warning(TextFormat::RED."[AntiCheat] Shield Deactivated");
	$this->getServer()->getLogger()->warning(TextFormat::RED."[AntiCheat] AntiCheat Deactivated");
    
	}

    }
    
    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
    
    if ($cmd->getName() == "anticheat"){
    
          if(!isset($args[0])){
          
              $sender->sendMessage(TextFormat::AQUA."[AntiCheat] /anticheat admin|information");
              
            }
          
            if($args[0] == "admin") {
              
               $sender->sendMessage(TextFormat::AQUA."[AntiCheat] Sorry, currently no Admin commands found.");
            
            }
            
            elseif($args[0] == "information") {
            
               $sender->sendMessage(TextFormat::AQUA."[AntiCheat] AntiCheat v1.5.1 [Wolverine] ~ DarkWav (Darku)");
			   $sender->sendMessage(TextFormat::AQUA."[AntiCheat] ===== Blocked Hacks: =====");
			   $sender->sendMessage(TextFormat::AQUA."[AntiCheat] =     -ForceGameMode     =");
			   $sender->sendMessage(TextFormat::AQUA."[AntiCheat] =     -Unkillable        =");
			   $sender->sendMessage(TextFormat::AQUA."[AntiCheat] =     -OneHit            =");
			   $sender->sendMessage(TextFormat::AQUA."[AntiCheat] =     -Speed [BETA]      =");
			   $sender->sendMessage(TextFormat::AQUA."[AntiCheat] ==========================");
               
            }
            
      }

	  if ($cmd->getName() == "AntiCheat"){
    
          if(!isset($args[0])){
          
              $sender->sendMessage(TextFormat::AQUA."[AntiCheat] /AntiCheat Admin|Information");
              
            }
          
            if($args[0] == "Admin") {
              
               $sender->sendMessage(TextFormat::AQUA."[AntiCheat] Sorry, currently no Admin commands found.");
            
            }
            
            elseif($args[0] == "Information") {
            
               $sender->sendMessage(TextFormat::AQUA."[AntiCheat] AntiCheat v1.5.1 [Wolverine] ~ DarkWav (Darku)");
			   $sender->sendMessage(TextFormat::AQUA."[AntiCheat] ===== Blocked Hacks: =====");
			   $sender->sendMessage(TextFormat::AQUA."[AntiCheat] =     -ForceGameMode     =");
			   $sender->sendMessage(TextFormat::AQUA."[AntiCheat] =     -Unkillable        =");
			   $sender->sendMessage(TextFormat::AQUA."[AntiCheat] =     -OneHit            =");
			   $sender->sendMessage(TextFormat::AQUA."[AntiCheat] =     -Speed [BETA]      =");
			   $sender->sendMessage(TextFormat::AQUA."[AntiCheat] ==========================");
               
            }
            
      }

    }
	
	//ForceGameMode-Detection [-->STABLE<--]           
    
    public function onGameModeChange(Player $player, Permission $permission, NewGameMode $newGamemode) {

	if ($player->gamemode = (int) $newGamemode()){

	$player->getPlayer()->getPermissions();

	$player->getPlayer()->getName();

	}

	if($this->yml["ForceGameMode"] == "true"){

	//Checks permissions.

	           if($player !== $player and !$player->hasPermission("none")){
              
               $player->sendMessage(TextFormat::AQUA."[AntiCheat] You passed Gamemode changeing!");
   
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
	
	//OneHit/Unkillable-Detection  [-->STABLE<--]     

    public function onDamage(EntityDamageEvent $e, Damager $damager, Entity $entity, Player $player, Damage $damage){

	if ($e->getDamage($entity)){

    //Getting name of Hacker.

	$damager->getDamager()->getName()->getEntity();
	$entity->getEntity()->getName();
	$damage->getDamage();
	$player = $entity->getEntity();
	$player = $entity->getDamage();
	$damager = $entity->getDamager()->getDamage();
	$player = $damager->getDamager();
	$player = $damager->getDamage();
	$e->getDamage();
	$e->getDamager();
	$e->getEntity();
	$e->getPlayer();
	$player->getPlayer()->getName();

	}

	if($this->yml["OneHit/Unkillable"] == "true"){

	//Checks how many Targets a player hits.

	if($damage = 0) {

	$player = $entity->kickPlayer($entity)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Unkillable!");

	}

	elseif($damage = 20) {

	//Kicks the Hacker.

	$player = $damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 20-100000) {

	//Kicks the Hacker.

	$player = $damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 21) {

	//Kicks the Hacker.

	$player = $damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 22) {

	//Kicks the Hacker.

	$player = $damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 23) {

	//Kicks the Hacker.

	$player = $damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 24) {

	//Kicks the Hacker.

	$player = $damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 25) {

	//Kicks the Hacker.

	$player = $damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 26) {

	//Kicks the Hacker.

	$player = $damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 27) {

	//Kicks the Hacker.

	$player = $damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 28) {

	//Kicks the Hacker.

	$player = $damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 29) {

	//Kicks the Hacker.

	$player = $damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 30) {

	//Kicks the Hacker.

    $player = $damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 31) {

	//Kicks the Hacker.

	$player = $damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 32) {

	//Kicks the Hacker.

	$player = $damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 33) {

	//Kicks the Hacker.

	$player = $damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 34) {

	//Kicks the Hacker.

	$player = $damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 35) {

	//Kicks the Hacker.

	$player = $damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 36) {

	//Kicks the Hacker.

	$player = $damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 37) {

	//Kicks the Hacker.

	$player = $damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 38) {

	//Kicks the Hacker.

	$player = $damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 39) {

	//Kicks the Hacker.

	$player = $damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 40) {

	//Kicks the Hacker.

	$player = $damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 41) {

	//Kicks the Hacker.

	$player = $damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 42) {

	//Kicks the Hacker.

	$player = $damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 43) {

	//Kicks the Hacker.

	$player = $damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 44) {

	//Kicks the Hacker.

	$player = $damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 45) {

	//Kicks the Hacker.

	$player = $damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

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

        if($getFrom($from)->getTo($to) == 1) {}

	    elseif($getFrom($from)->getTo($to) == 6){$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
		elseif($getFrom($from)->getTo($to) == 7){$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
        elseif($getFrom($from)->getTo($to) == 8){$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
        elseif($getFrom($from)->getTo($to) == 9){$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
        elseif($getFrom($from)->getTo($to) == 10){$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
        elseif($getFrom($from)->getTo($to) == 11){$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
        elseif($getFrom($from)->getTo($to) == 12){$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
        elseif($getFrom($from)->getTo($to) == 13){$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
        elseif($getFrom($from)->getTo($to) == 14){$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
        elseif($getFrom($from)->getTo($to) == 15){$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
        elseif($getFrom($from)->getTo($to) == 16){$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
        elseif($getFrom($from)->getTo($to) == 17){$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
        elseif($getFrom($from)->getTo($to) == 18){$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
		elseif($getFrom($from)->getTo($to) == 19){$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
		elseif($getFrom($from)->getTo($to) == 20){$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
		elseif($getFrom($from)->getTo($to) == 21){$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
		elseif($getFrom($from)->getTo($to) == 22){$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
		elseif($getFrom($from)->getTo($to) == 23){$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
		elseif($getFrom($from)->getTo($to) == 24){$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
		elseif($getFrom($from)->getTo($to) == 25){$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}

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
