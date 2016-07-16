<?php

namespace DarkWav\AntiCheat;

use pocketmine\command\ConsoleCommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\permission\Permission;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\math\Vector3;
use DarkWav\AntiCheat\AntiCheat;

class EventListener implements Listener{

	private $getConfig;

    public function __construct(AntiCheat $getConfig){

    $this->getCfg = $getConfig;

	}

	public function onMove(PlayerMoveEvent $event){

		if ($this->getCfg->getConfig()->get("ForceOP") == "true"){

			if ($event->getPlayer()->isOp()){

				if (!$event->getPlayer()->hasPermission("anticheat.op")){

					$event->getPlayer()->kick(TextFormat::RED."ForceOP detected!");

				}

			}

		}

		if ($this->getCfg->getConfig()->get("NoClip") == "true"){

			$level = $event->getPlayer()->getLevel();

			$pos = new Vector3($event->getPlayer()->getX(), $event->getPlayer()->getY(), $event->getPlayer()->getZ());

			if ($this->getCfg->getConfig()->get("NoClipSafeMode") == "true"){

				if ($level->getBlock($pos)->getId() > 0 and $level->getBlock($pos)->getId() < 6){

					$event->getPlayer()->kick(TextFormat::BLUE."[AntiCheat] > NoClip is not allowed!");

				}

				if ($level->getBlock($pos)->getId() > 11 and $level->getBlock($pos)->getId() < 26){

					$event->getPlayer()->kick(TextFormat::BLUE."[AntiCheat] > NoClip is not allowed!");

				}

				if ($level->getBlock($pos)->getId() > 40 and $level->getBlock($pos)->getId() < 44){

					$event->getPlayer()->kick(TextFormat::BLUE."[AntiCheat] > NoClip is not allowed!");

				}

				if ($level->getBlock($pos)->getId() > 44 and $level->getBlock($pos)->getId() < 50){

					$event->getPlayer()->kick(TextFormat::BLUE."[AntiCheat] > NoClip is not allowed!");

				}

				if ($level->getBlock($pos)->getId() > 78 and $level->getBlock($pos)->getId() < 81){

					$event->getPlayer()->kick(TextFormat::BLUE."[AntiCheat] > NoClip is not allowed!");

				}

				if ($level->getBlock($pos)->getId() > 85 and $level->getBlock($pos)->getId() < 90){

					$event->getPlayer()->kick(TextFormat::BLUE."[AntiCheat] > NoClip is not allowed!");

				}

				if ($level->getBlock($pos)->getId() == 112){

					$event->getPlayer()->kick(TextFormat::BLUE."[AntiCheat] > NoClip is not allowed!");

				}

				if ($level->getBlock($pos)->getId() > 120 and $level->getBlock($pos)->getId() < 126){

					$event->getPlayer()->kick(TextFormat::BLUE."[AntiCheat] > NoClip is not allowed!");

				}

				if ($level->getBlock($pos)->getId() > 151 and $level->getBlock($pos)->getId() < 156){

					$event->getPlayer()->kick(TextFormat::BLUE."[AntiCheat] > NoClip is not allowed!");

				}

				if ($level->getBlock($pos)->getId() == 157){

					$event->getPlayer()->kick(TextFormat::BLUE."[AntiCheat] > NoClip is not allowed!");

				}

				if ($level->getBlock($pos)->getId() == 159){

					$event->getPlayer()->kick(TextFormat::BLUE."[AntiCheat] > NoClip is not allowed!");

				}

				if ($level->getBlock($pos)->getId() == 162){

					$event->getPlayer()->kick(TextFormat::BLUE."[AntiCheat] > NoClip is not allowed!");

				}

				if ($level->getBlock($pos)->getId() == 198){

					$event->getPlayer()->kick(TextFormat::BLUE."[AntiCheat] > NoClip is not allowed!");

				}

				if ($level->getBlock($pos)->getId() == 243){

					$event->getPlayer()->kick(TextFormat::BLUE."[AntiCheat] > NoClip is not allowed!");

				}

				if ($level->getBlock($pos)->getId() > 245 and $level->getBlock($pos)->getId() < 255){

					$event->getPlayer()->kick(TextFormat::BLUE."[AntiCheat] > NoClip is not allowed!");

				}

				if ($level->getBlock($pos)->getId() > 171 and $level->getBlock($pos)->getId() < 175){

					$event->getPlayer()->kick(TextFormat::BLUE."[AntiCheat] > NoClip is not allowed!");

				}

			}

			if ($this->getCfg->getConfig()->get("NoClipSafeMode") == "false"){

				if ($level->getBlock($pos)->getId() !== 0){

					$event->getPlayer()->kick(TextFormat::BLUE."[AntiCheat] > NoClip is not allowed!");

				}

			}

		}

	}

	public function onDamage(EntityDamageByEntityEvent $event, EntityDamageEvent $event2){

		if($event->getDamager() instanceof Player){

			if ($this->getCfg->getConfig()->get("KillAura") == "true"){

				if ($event->getEntity()->getPosition() !== $event->getDamager()->getForward()){

					$event->getDamager()->kick(TextFormat::BLUE."[AntiCheat] > KillAura is not allowed!");

				}

				if ($event->getEntity() > 1){

					$event->getDamager()->kick(TextFormat::BLUE."[AntiCheat] > KillAura is not allowed!");

				}

			}

			if ($this->getCfg->getConfig()->get("OneHit") == "true"){

				if ($event->getDamage() > 19.9) {

					$event->getDamager()->kick(TextFormat::BLUE."[AntiCheat] > OneHit is not allowed!");

				}

			}

		}

		if($event->getEntity() instanceof Player){

			if ($this->getCfg->getConfig()->get("NoKnockBack") == "true"){

				if ($event->getKnockBack() < $this->getConfig()->get("MinKnockBack")){

					$event->getEntity()->kick(TextFormat::BLUE."[AntiCheat] > NoKnockBack is not allowed!");

				}

			}

			if ($this->getCfg->getConfig()->get("Unkillable") == "true"){

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