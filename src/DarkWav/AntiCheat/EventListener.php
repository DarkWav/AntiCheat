<?php

namespace DarkWav\AntiCheat;

use pocketmine\utils\TextFormat;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\permission\Permission;
use pocketmine\permission\Permissible;
use pocketmine\plugin\PluginBase;
use pocketmine\plugin\Plugin;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityEvent;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\event\player\PlayerMoveEvent;

class EventListener implements Listener{

	public function onEnable(){

		$yml = Config($this->getDataFolder() . "config.yml", Config::YAML);

		$this->yml = $yml->getAll();
	
	}

	public function onMove(PlayerMoveEvent $event){

		if ($this->yml["ForceOP"] == "true"){

			if ($event->getPlayer()->isOp()){

				if (!$event->getPlayer()->hasPermission("anticheat.op")){

					$event->getPlayer()->kick(TextFormat::RED."ForceOP detected!");

				}

			}

		}

	}

	public function onDamage(EntityDamageByEntityEvent $event, EntityDamageEvent $event2){

		if($event->getDamager() instanceof Player){

			if ($this->yml["KillAura"] == "true"){

				if ($event->getEntity()->getPosition() !== $event->getDamager()->getForward()){

					$event->getDamager()->kick(TextFormat::BLUE."[AntiCheat] > KillAura is not allowed!");

				}

				if ($event->getEntity() > 1){

					$event->getDamager()->kick(TextFormat::BLUE."[AntiCheat] > KillAura is not allowed!");

				}

			}

			if ($this->yml["OneHit"] == "true"){

				if ($event->getDamage() > 19.5) {

					$event->getDamager()->kick(TextFormat::BLUE."[AntiCheat] > OneHit is not allowed!");

				}

			}

		}

		elseif($event->getEntity() instanceof Player){

			if ($this->yml["NoKnockBack"] == "true"){

				if ($event->getKnockBack() < 0.4){

					$event->getEntity()->kick(TextFormat::BLUE."[AntiCheat] > NoKnockBack is not allowed!");

				}

			}

			if ($this->yml["Unkillable"] == "true"){

				if ($event->getDamage() < 0.001) {

					$event->getEntity()->kick(TextFormat::BLUE."[AntiCheat] > Unkillable is not allowed!");

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