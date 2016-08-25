<?php

namespace DarkWav\AntiCheat;

use pocketmine\plugin\PluginBase;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\permission\Permission;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityRegainHealthEvent;
use pocketmine\event\entity\Effect;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\math\Vector3;
use DarkWav\AntiCheat\AntiCheat;
use DarkWav\AntiCheat\Observer;
use pocketmine\event\Cancellable;

class EventListener implements Listener
{
  
  public function __construct(AntiCheat $Main)
  {
    $this->Main   = $Main;
    $this->Logger = $Main->getServer()->getLogger();
    $this->PlayerObservers = array();
	}

  public function onJoin(PlayerJoinEvent $event)
	{
		$player = $event->getPlayer();
		$name   = $player->getName();
		
		if (array_key_exists($name, $this->PlayerObservers))
		{
  		$obs = $this->PlayerObservers[$name];
  		$obs->Player = $player;
      $this->PlayerObservers[$name]->PlayerRejoin();
    }
    else
    {
  		$obs = new Observer($player, $this->Main);
	  	$this->PlayerObservers[$name] = $obs;
	  	$this->PlayerObservers[$name]->PlayerJoin();
	  } 	
  }
  
  public function onQuit(PlayerQuitEvent $event)
  {
		$player = $event->getPlayer();
		$name   = $player->getName();

  	$this->PlayerObservers[$name]->PlayerQuit();
  }

	public function onMove(PlayerMoveEvent $event)
	{
    $name = $event->getPlayer()->getName();
    $this->PlayerObservers[$name]->OnMove($event);
	}

	public function onDamage(EntityDamageByEntityEvent $event, EntityDamageEvent $event2)
	{
	  $name  = $event->getEntity()->getName();
	  $name2 = $event->getDamager()->getName();
    $this->PlayerObservers[$name]->OnDamage($event, $event2);
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