<?php

namespace DarkWav\AntiCheat;

use pocketmine\utils\TextFormat;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\permission\Permission;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\math\Vector3;

class EventListener implements Listener{

	public function onEnable(){

		$yml = new Config($this->getDataFolder() . "config.yml", Config::YAML);

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
		//if($this->yml["WallHack"] == "true"){
			$level = $event->getPlayer()->getLevel();
			$pos = new Vector3($event->getPlayer()->getX(), $event->getPlayer()->getY(), $event->getPlayer()->getZ()); 
			if($event->getPlayer()->isOp()){
				return;
			}
			else if($level->getBlock($pos)->getId() > 0){
				$event->getPlayer()->kick(TextFormat::RED . "WallHack Detected!");
			}
		//}

		if ($this->yml["NoClip"] == "true"){

			if ($event->getPlayer()->getPosition()->level->getBlockIdAt() !== 0){

				$event->getPlayer()->kick(TextFormat::BLUE."[AntiCheat] > NoClip is not allowed!");

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

				if ($event->getDamage() > 19.9) {

					$event->getDamager()->kick(TextFormat::BLUE."[AntiCheat] > OneHit is not allowed!");

				}

			}

		}

		if($event->getEntity() instanceof Player){

			if ($this->yml["NoKnockBack"] == "true"){

				if ($event->getKnockBack() < $this->getConfig()->get("MinKnockBack")){

					$event->getEntity()->kick(TextFormat::BLUE."[AntiCheat] > NoKnockBack is not allowed!");

				}

			}

			if ($this->yml["Unkillable"] == "true"){

				if ($event->getDamage() < $this->getConfig()->get("MinDamage")){

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
