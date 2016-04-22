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
	$this->getServer()->getLogger()->info(TextFormat::GOLD."[AntiCheat] AntiCheat v2.2.1 [Wolverine]");

    }

    public function onDisable(){

    $this->getServer()->getLogger()->info(TextFormat::GOLD."[AntiCheat] You are no longer protected from cheats!");
    $this->getServer()->getLogger()->info(TextFormat::GOLD."[AntiCheat] Shield Deactivated");
	$this->getServer()->getLogger()->info(TextFormat::GOLD."[AntiCheat] AntiCheat Deactivated");

    }
    
   public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
    
    if ($cmd->getName() == "anticheat"){
    
          if(!isset($args[0])){
          
             $sender->sendMessage(TextFormat::GOLD."[AntiCheat] AntiCheat v2.2.1 [Wolverine] ~ DarkWav (Darku)");
              
            }

			}

	elseif ($cmd->getName() == "ac"){
    
          if(!isset($args[0])){
          
             $sender->sendMessage(TextFormat::GOLD."[AntiCheat] AntiCheat v2.2.1 [Wolverine] ~ DarkWav (Darku)");
              
            }

			}
            
      }
	
	//OneHit/Unkillable/AntiKnockback-Detection  

    public function onDamage(EntityDamageEvent $d, EntityDamageByEntityEvent $e, Damager $damager, PlayerKickEvent $k){

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

	     if($d->getDamage < 0) {

	     $k->kickPlayer($e->getEntity())->kickMessage(TextFormat::GOLD."[AntiCheat] You were kicked for hacking Unkillable!");

	     }

	     }

		 }

	elseif($e->getDamager() instanceof Player){

    if($this->yml["OneHit"] == "true"){

	     if($d->getDamage > 19) {

	     //Kicks the Hacker.

	     $k->kickPlayer($e->getDamager())->kickMessage(TextFormat::GOLD."[AntiCheat] You were kicked for hacking OneHit!");

	     }

		 }

         }

    elseif($e->getEntity() instanceof Player){

	if($this->yml["AntiKnockback"] == "true"){

	     if($e->getKnockBack() < 0.7) {

	     $k->kickPlayer($e->getEntity())->kickMessage(TextFormat::AQUA."[AntiCheat] You were kicked for hacking AntiKnockback!");

	     }

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
