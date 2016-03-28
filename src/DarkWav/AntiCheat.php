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
use pocketmine\entity\EntityDamageByEntity;

class AntiCheat extends PluginBase implements Listener{

    public function onEnable(){

    $this->getServer()->getLogger()->info(TextFormat::AQUA."[AntiCheat] AntiCheat Activated");
	$this->getServer()->getLogger()->info(TextFormat::AQUA."[AntiCheat] Shield Activated");
	$this->getServer()->getLogger()->info(TextFormat::AQUA."[AntiCheat] AntiCheat version = v1.3.2-A12");
	$this->getServer()->getLogger()->debug(TextFormat::AQUA."[AntiCheat] Enabling EssentialsPE support");
	$this->getServer()->getLogger()->debug(TextFormat::AQUA."[AntiCheat] Supported server software = ImagicalMine v1.4     [Elite]");
	$this->getServer()->getLogger()->debug(TextFormat::AQUA."[AntiCheat] Supported server software = PocketMine-MP v1.6dev [Kappatsu Fugu]");
    
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
            
               $sender->sendMessage(TextFormat::AQUA."[AntiCheat] AntiCheat v1.3.2-Alpha12 [ALPHA] ~ DarkWav (Darku)");
               
            }
            
      }
      
    }
	
	//ForceGameMode-Detection            
    
    public function onPlayerGameModeChange(Player $player, Permission $permission, GameMode $gamemode) {

	if ($player->changeGameMode($gamemode)){

	$player->getPlayer()->getPermissions();

	$player->getPlayer()->getName();

	}

	//Checks permissions.

	           if($permission == "op") {
              
               $player->sendMessage(TextFormat::AQUA."[AntiCheat] You passed Gamemode changeing!");
   
    }
	
	            elseif($permission == "none") {

    //Bans the Hacker.
           
               $player->banPlayer()->banReason(TextFormat::AQUA."[AntiCheat] You were permanently banned for ForceGamemode-Cheating!");
              
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

	//ForceOP-Detection            
    
    public function onPlayerGetPermission(Player $player, Permission $permission, Switcher $switcher) {

	if ($player->getPermission($permission == "op")){

	$switcher->getPlayer()->getPermission();

	$switcher->getPlayer()->getName();

	}

	//Checks permissions.

	           if($permission == "op") {
              
               $player->sendMessage(TextFormat::AQUA."[AntiCheat] You passed ForceOP check!");
   
    }
	
	            elseif($permission == "none") {

    //Bans the Hacker.
           
               $player->banPlayer()->banReason(TextFormat::AQUA."[AntiCheat] You were permanently banned for ForceOP-Cheating!");
              
    }
	
	            elseif($permission == "moderator") {

    //Moderator hook.
           
               $player->sendMessage(TextFormat::AQUA."[AntiCheat] You passed ForceOP check!");
              
    }

	            elseif($permission == "command.op") {

    //Extra permission hook.
           
               $player->sendMessage(TextFormat::AQUA."[AntiCheat] You passed ForceOP check!");
              
    }

	            elseif($permission == "anticheat.bypass") {

    //AntiCheat permission hook.
           
               $player->sendMessage(TextFormat::AQUA."[AntiCheat] You passed ForceOP check!");
              
    }

    }

	//ForceEffect-Detection            
    
    public function onPlayerGetEffect(Player $player, Permission $permission, Effect $effect) {

	if ($player->getEffect()){

	$player->getPlayer()->getPermission();

	$player->getPlayer()->getName();

	$player->getPotion()->getEffect();

	}

	//Checks permissions.

	           if($permission == "op") {
   
    }
	
	            elseif($permission == "none") {

    //Bans the Hacker.
           
               $player->banPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for ForceEffect-Cheating! This could be a fale positive because you have thrown a Potion!");
              
    }
	
	            elseif($permission == "moderator") {

    }

	            elseif($permission == "command.op") {    
              
    }

	            elseif($permission == "anticheat.bypass") {      
              
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

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 3) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 4) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 5) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 6) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 7) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 8) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 9) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 10) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 11) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 12) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 13) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 14) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 15) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 16) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 17) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 18) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 19) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 20) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 21) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 22) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 23) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 24) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}

	elseif($entity = 25) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking ForceField!");

	}


}

//Speed Detection.

public function onPlayerMove(Player $player, Position $pos, Tick $tick, Time $h, Speed $speed) {

    if ($player->playerMove()){

	$player->getPosition();

	$player->getMoveSpeed();

	$player->getMoveTime();

	$this->getServer()->getTick();

	}

	if ($speed=4.3) {}
	elseif ($speed=5.0) {}
	elseif ($speed=6.0) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
	elseif ($speed=6.1) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
	elseif ($speed=6.2) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
	elseif ($speed=6.3) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
	elseif ($speed=6.4) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
	elseif ($speed=6.5) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
	elseif ($speed=6.6) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
	elseif ($speed=6.7) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
	elseif ($speed=6.8) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
	elseif ($speed=6.9) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
    elseif ($speed=7.0) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
    elseif ($speed=7.1) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
	elseif ($speed=7.2) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
	elseif ($speed=7.3) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
	elseif ($speed=7.4) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
	elseif ($speed=7.5) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
	elseif ($speed=7.6) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
	elseif ($speed=7.7) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
	elseif ($speed=7.8) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
	elseif ($speed=7.9) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
	elseif ($speed=8.0) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
    elseif ($speed=8.1) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
	elseif ($speed=8.2) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
	elseif ($speed=8.3) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
	elseif ($speed=8.4) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
	elseif ($speed=8.5) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
	elseif ($speed=8.6) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
	elseif ($speed=8.7) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
	elseif ($speed=8.8) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
	elseif ($speed=8.9) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
    elseif ($speed=9.0) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
    elseif ($speed=9.1) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
	elseif ($speed=9.2) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
	elseif ($speed=9.3) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
	elseif ($speed=9.4) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
	elseif ($speed=9.5) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
	elseif ($speed=9.6) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
	elseif ($speed=9.7) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
	elseif ($speed=9.8) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
	elseif ($speed=9.9) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}
	elseif ($speed=10.0) {$player->kickPlayer()->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking Speed!");}

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
