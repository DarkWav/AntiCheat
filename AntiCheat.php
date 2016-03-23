<?php

namespace DarkWav;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\plugin\PluginDescription;
use pocketmine\plugin\EventExecutor;
use pocketmine\plugin\MethodEventExecutor;
use pocketmine\plugin\PluginLoader;
use pocketmine\plugin\PluginLoadOrder;
use pocketmine\plugin\PluginLogger;
use pocketmine\plugin\PluginManager;
use pocketmine\plugin\ScriptPluginLoader;
use pocketmine\player\PlayerListEntry;
use pocketmine\event\player\PlayerAnimationEvent;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerCommandPreprocessEvent;
use pocketmine\event\player\PlayerCreationEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PlayerEvent;
use pocketmine\event\player\PlayerGameModeChangeEvent;
use pocketmine\event\player\PlayerHungerChangeEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerItemConsumeEvent;
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
use pocketmine\entity\EntityDamageByEntity;

class AntiCheat extends PluginBase implements Listener{

    public function onEnable(){

    $this->getServer()->getLogger()->info(TextFormat::AQUA."[AntiCheat] AntiCheat Activated");
	$this->getServer()->getLogger()->info(TextFormat::AQUA."[AntiCheat] Shield Activated");
	$this->getServer()->getLogger()->info(TextFormat::AQUA."[AntiCheat] AntiCheat version = v1.3-R2");
	$this->getServer()->getLogger()->info(TextFormat::AQUA."[AntiCheat] Enabling EssentialsPE support");
	$this->getServer()->getLogger()->info(TextFormat::AQUA."[AntiCheat] Supported server software = ImagicalMine v1.4     [Elite]");
	$this->getServer()->getLogger()->info(TextFormat::AQUA."[AntiCheat] Supported server software = PocketMine-MP v1.6dev [Kappatsu Fugu]");
    
    }

    public function onDisable(){
    
    $this->getServer()->getLogger()->info(TextFormat::AQUA."[AntiCheat] AntiCheat Deactivated");    
    
    }
    
    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
    
    if ($cmd->getName() == "anticheat"){
    
          if(!isset($args[0])){
          
              $sender->sendMessage(TextFormat::AQUA."[AntiCheat] /anticheat Admin|Information");
              
            }
          
            if($args[0] == "Admin") {
              
               $sender->sendMessage(TextFormat::AQUA."[AntiCheat] Sorry, currently no Admin commands found.");
            
            }
            
            elseif($args[0] == "Information") {
            
               $sender->sendMessage(TextFormat::AQUA."[AntiCheat] AntiCheat v1.3-R2 [ELITE] ~ DarkWav (Darku)");
               
            }
            
      }
      
    }
	
	//ForceGameMode-Detection            
    
    public function onPlayerGameModeChange(Player $player, Permission $permission) {

	if ($player->changeGameMode()){

	$player->getPlayer()->getPermissions();

	$player->getPlayer()->getName();

	}

	//Checks permissions.

	           if($permission == "op") {
              
               $player->sendMessage(TextFormat::AQUA."[AntiCheat] You passed Gamemode changeing!");
   
    }

	            elseif($permission == "notoperator") {

    //Bans the Hacker.
           
               $player->banPlayer()->sendQuitMessage(TextFormat::AQUA."[AntiCheat] You were permanently banned for ForceGamemode-Cheating!")->banReason(TextFormat::AQUA."[AntiCheat] You were permanently banned for ForceGamemode-Cheating!");
              
    }
	
	            elseif($permission == "none") {

    //Bans the Hacker.
           
               $player->banPlayer()->sendQuitMessage(TextFormat::AQUA."[AntiCheat] You were permanently banned for ForceGamemode-Cheating!")->banReason(TextFormat::AQUA."[AntiCheat] You were permanently banned for ForceGamemode-Cheating!");
              
    }
	
	            elseif($permission == "moderator") {

    //Moderator hook.
           
               $player->sendMessage(TextFormat::AQUA."[AntiCheat] You passed Gamemode changeing!");
              
    }

	            elseif($permission == "essentials.gamemode") {

    //EssentialsPE hook.
           
               $player->sendMessage(TextFormat::AQUA."[AntiCheat] You passed Gamemode changeing [Hooked into EssentialsPE]!");
              
    }

	            elseif($permission == "command.gamemode") {

    //Extra permission hook.
           
               $player->sendMessage(TextFormat::AQUA."[AntiCheat] You passed Gamemode changeing!");
              
    }

	            elseif($permission == "anticheat.bypass") {

    //AntiCheat permission hook.
           
               $player->sendMessage(TextFormat::AQUA."[AntiCheat] You passed Gamemode changeing!");
              
    }

    }
	
	//ForceField-Detection           

    public function onEntityDamageByEntity(Damager $damager, Entity $entity) {

	if ($damager->damageEntity($entity)){

    //Getting name of Hacker.

	$damager->getDamager()->getName()->getEntity();
	$entity->getEntity()->getName();

	}

	//Checks how many Targets a player hits.

	if($entity = 1) {

	}

	elseif($entity = 2) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->sendQuitMessage(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 3) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->sendQuitMessage(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 4) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->sendQuitMessage(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 5) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->sendQuitMessage(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 6) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->sendQuitMessage(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 7) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->sendQuitMessage(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 8) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->sendQuitMessage(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 9) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->sendQuitMessage(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 10) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->sendQuitMessage(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 11) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->sendQuitMessage(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 12) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->sendQuitMessage(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 13) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->sendQuitMessage(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 14) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->sendQuitMessage(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 15) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->sendQuitMessage(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 16) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->sendQuitMessage(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 17) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->sendQuitMessage(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 18) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->sendQuitMessage(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 19) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->sendQuitMessage(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 20) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->sendQuitMessage(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

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
