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
use pocketmine\permission\Permission;
use pocketmine\event\Listener;
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
  	$this->getServer()->getLogger()->info(TextFormat::GOLD."[AntiCheat] AntiCheat Activated");
    $this->getServer()->getLogger()->info(TextFormat::GOLD."[AntiCheat] Shield Activated");
	$this->getServer()->getLogger()->info(TextFormat::GOLD."[AntiCheat] AntiCheat v2.3.1 [Wolverine]");

    }

    public function onDisable(){

    $this->getServer()->getLogger()->info(TextFormat::GOLD."[AntiCheat] You are no longer protected from cheats!");
    $this->getServer()->getLogger()->info(TextFormat::GOLD."[AntiCheat] Shield Deactivated");
	$this->getServer()->getLogger()->info(TextFormat::GOLD."[AntiCheat] AntiCheat Deactivated");

    }
    
   public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
    
    if ($cmd->getName() == "anticheat"){
    
          if(!isset($args[0])){
          
             $sender->sendMessage(TextFormat::GOLD."[AntiCheat] AntiCheat v2.3.1 [Wolverine] ~ DarkWav (Darku)");
              
            }

			}

	elseif ($cmd->getName() == "ac"){
    
          if(!isset($args[0])){
          
             $sender->sendMessage(TextFormat::GOLD."[AntiCheat] AntiCheat v2.3.1 [Wolverine] ~ DarkWav (Darku)");
              
            }

			}
            
      }

    public function onGameModeChange(PlayerKickEvent $k, Player $player, PlayerGameModeChangeEvent $c, Permission $permission, NewGameMode $newGamemode) {

	if ($player->changeGameMode()){

	$player->getPlayer()->getPermissions();

	$player->getPlayer()->getName();

	$c->getPlayer();

	}

	if($this->yml["ForceGameMode"] == "true"){

	//Checks permissions.

	           if($player !== $player and !$player->hasPermission("none")){
              
               $k->kickPlayer($c->getPlayer)->kickMessage(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceGameMode!");

			   $this->getServer()->getLogger()->info(TextFormat::GOLD."[AntiCheat] $c->getPlayer() is hacking ForceGameMode!");
   
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

	//Speed Detection. [-->BETA<--]

public function onPlayerMove(PlayerMoveEvent $m, PlayerKickEvent $k, Player $player, Location $from, Location $to){

        if ($player->getTo()){

        $player->getFrom();

		$player->getTo();

		}

		if($this->yml["Speed"] == "true"){

	        if($getFrom($from)->getTo($to) > 6){
		
		    $k->kickPlayer($m->getPlayer)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");
		
		}

		}

}
	
	//Combat-Hack-Detection  (API extends 2.3.1)

    public function onDamage(EntityDamageEvent $d, EntityDamageByEntityEvent $e, Damager $damager, PlayerKickEvent $k){

	$d->getDamage();
	$d->getEntity();
	$e->getDamager();
	$e->getEntity();
	$e->getKnockBack();

	//Unkillable-Detection

	if($e->getEntity() instanceof Player){

	     if($this->yml["Unkillable"] == "true"){

	     if($d->getDamage() < 0) {

	     $k->kickPlayer($e->getEntity())->kickMessage(TextFormat::GOLD."[AntiCheat] You were kicked for hacking Unkillable!");

	     }

	     }

		 }

	//OneHit-Detection

	elseif($e->getDamager() instanceof Player){

    if($this->yml["OneHit"] == "true"){

	     if($d->getDamage() > 19) {

	     //Kicks the Hacker.

	     $k->kickPlayer($e->getDamager())->kickMessage(TextFormat::GOLD."[AntiCheat] You were kicked for hacking OneHit!");

	     }

		 }

         }

	//AntiKnockBack-Detection

    elseif($e->getEntity() instanceof Player){

	if($this->yml["AntiKnockBack"] == "true"){

	     if($e->getKnockBack() < 0.7) {

	     $k->kickPlayer($e->getEntity())->kickMessage(TextFormat::AQUA."[AntiCheat] You were kicked for hacking AntiKnockback!");

	     }

	     }

		 }

	//ForceField-Detection

    //First Way to detect ForceField

    elseif($e->getDamager() instanceof Player){

	if($this->yml["ForceField"] == "true"){

	     if($e->getEntity() < 1) {

	     $k->kickPlayer($e->getDamager())->kickMessage(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	     }

	     }

		 }

    //Second Way to detect ForceField

    elseif($e->getDamager() instanceof Player){

	if($this->yml["ForceField"] == "true"){

	     if($e > 1) {

	     $k->kickPlayer($e->getDamager())->kickMessage(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	     }

	     }

		 }

	//Third Way to detect ForceField

    elseif($e->getDamager() instanceof Player){

	if($this->yml["ForceField"] == "true"){

	     if($d > 1) {

	     $k->kickPlayer($e->getDamager())->kickMessage(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

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
