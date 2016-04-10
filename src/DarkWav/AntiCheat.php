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
use Key\keyghabhjaksbxcklcabhgckwhbjvfajkvdfj;

class AntiCheat extends PluginBase implements Listener {

    public function onEnable(){

    $this->getServer()->getLogger()->info(TextFormat::AQUA."[AntiCheat] AntiCheat Activated");
	$this->getServer()->getLogger()->info(TextFormat::AQUA."[AntiCheat] Shield Activated");
	$this->getServer()->getLogger()->info(TextFormat::AQUA."[AntiCheat] AntiCheat version = v1.4 (b2)");
	$this->getServer()->getLogger()->warning(TextFormat::RED."[AntiCheat] If you are using Genisys ITX Core, this Plugin may not work!");
	$this->getServer()->getLogger()->debug(TextFormat::AQUA."[AntiCheat] Enabling EssentialsPE support");
	$this->getServer()->getLogger()->debug(TextFormat::AQUA."[AntiCheat] Supported server software = ImagicalMine  v1.4    [Elite] (100% Stable!)");
	$this->getServer()->getLogger()->debug(TextFormat::AQUA."[AntiCheat] Supported server software = PocketMine-MP v1.6dev [Kappatsu Fugu] (Could cause lag!");
    $this->getServer()->getLogger()->debug(TextFormat::RED."[AntiCheat] Supported server software = Genisys       v1.1dev [Icaros] (BETA-FEATURE!)");
    
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
            
               $sender->sendMessage(TextFormat::AQUA."[AntiCheat] AntiCheat v1.4 (build 2) [Ultimate] ~ DarkWav (Darku)");
               
            }
            
      }
      
    }
	
	//ForceGameMode-Detection            
    
    public function onPlayerGameModeChangeEvent(Player $player, Permission $permission, NewGameMode $newGamemode) {

	if ($player->gamemode = (int) $newGamemode()){

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
	
	//OneHit-Detection           

    public function onEntityDamageByEntity(Damager $damager, Entity $entity, Damage $damage) {

	if ($entity->getDamage($entity)){

    //Getting name of Hacker.

	$damager->getDamager()->getName()->getEntity();
	$entity->getEntity()->getName();
	$damage->getDamage();

	}

	//Checks how many Targets a player hits.

	if($damage = 1) {

	}

	elseif($damage = 20) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 21) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 22) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 23) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 24) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 25) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 26) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 27) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 28) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 29) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 30) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 31) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 32) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 33) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 34) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 35) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 36) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 37) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 38) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 39) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 40) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 41) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 42) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 43) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 44) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

	elseif($damage = 45) {

	//Kicks the Hacker.

	$damager->kickPlayer($damager)->kickReason(TextFormat::AQUA."[AntiCheat] You were kicked for hacking OneHit!");

	}

}

//Speed Detection.

public function onPlayerMove(Player $player, Location $from, Location $to){

        if ($player->getTo()){

        $player->getFrom();

		$player->getTo();

		}

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

//////////////////////////////////////////////////////
//                                                  //
//     AntiCheat by DarkWav.                        //
//     Distributed under the AntiCheat License.     //
//     Do not redistribute in compiled form!        //
//     All rights reserved.                         //
//                                                  //
//////////////////////////////////////////////////////
