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

				//Protection of Stone (ID = 1)

				if ($level->getBlock($pos)->getId() == 1 and $level->getBlock($pos) !== $event->getPlayer()->getFloor()){

					$event->getPlayer()->kick(TextFormat::BLUE."[AntiCheat] > NoClip is not allowed!");

				}

				//Protection of GrassBlock (ID = 2)

				if ($level->getBlock($pos)->getId() == 2 and $level->getBlock($pos) !== $event->getPlayer()->getFloor()){

					$event->getPlayer()->kick(TextFormat::BLUE."[AntiCheat] > NoClip is not allowed!");

				}

				//Protection of Dirt (ID = 3)

				if ($level->getBlock($pos)->getId() == 3 and $level->getBlock($pos) !== $event->getPlayer()->getFloor()){

					$event->getPlayer()->kick(TextFormat::BLUE."[AntiCheat] > NoClip is not allowed!");

				}

				//Protection of CobbleStone (ID = 4)

				if ($level->getBlock($pos)->getId() == 4 and $level->getBlock($pos) !== $event->getPlayer()->getFloor()){

					$event->getPlayer()->kick(TextFormat::BLUE."[AntiCheat] > NoClip is not allowed!");

				}

				//Protection of OakPlanks (ID = 5)

				if ($level->getBlock($pos)->getId() == 5 and $level->getBlock($pos) !== $event->getPlayer()->getFloor()){

					$event->getPlayer()->kick(TextFormat::BLUE."[AntiCheat] > NoClip is not allowed!");

				}

				//Protection of BedRock (ID = 7)

				if ($level->getBlock($pos)->getId() == 7 and $level->getBlock($pos) !== $event->getPlayer()->getFloor()){

					$event->getPlayer()->kick(TextFormat::BLUE."[AntiCheat] > NoClip is not allowed!");

				}

				//Protection of Wood (ID = 17)

				if ($level->getBlock($pos)->getId() == 17 and $level->getBlock($pos) !== $event->getPlayer()->getFloor()){

					$event->getPlayer()->kick(TextFormat::BLUE."[AntiCheat] > NoClip is not allowed!");

				}

				//Protection of Bricks (ID = 45)

				if ($level->getBlock($pos)->getId() == 45 and $level->getBlock($pos) !== $event->getPlayer()->getFloor()){

					$event->getPlayer()->kick(TextFormat::BLUE."[AntiCheat] > NoClip is not allowed!");

				}

				//Protection of Obsidian (ID = 49)

				if ($level->getBlock($pos)->getId() == 49 and $level->getBlock($pos) !== $event->getPlayer()->getFloor()){

					$event->getPlayer()->kick(TextFormat::BLUE."[AntiCheat] > NoClip is not allowed!");

				}

				//Protection of Ice (ID = 79)

				if ($level->getBlock($pos)->getId() == 79 and $level->getBlock($pos) !== $event->getPlayer()->getFloor()){

					$event->getPlayer()->kick(TextFormat::BLUE."[AntiCheat] > NoClip is not allowed!");

				}

				//Protection of Snow (ID = 80)

				if ($level->getBlock($pos)->getId() == 80 and $level->getBlock($pos) !== $event->getPlayer()->getFloor()){

					$event->getPlayer()->kick(TextFormat::BLUE."[AntiCheat] > NoClip is not allowed!");

				}

				//Protection of Netherrack (ID = 87)

				if ($level->getBlock($pos)->getId() == 87 and $level->getBlock($pos) !== $event->getPlayer()->getFloor()){

					$event->getPlayer()->kick(TextFormat::BLUE."[AntiCheat] > NoClip is not allowed!");

				}

				//Protection of Invisible Bedrock (ID = 95)

				if ($level->getBlock($pos)->getId() == 95 and $level->getBlock($pos) !== $event->getPlayer()->getFloor()){

					$event->getPlayer()->kick(TextFormat::BLUE."[AntiCheat] > NoClip is not allowed!");

				}

				//Protection of Stone Brick (ID = 98)

				if ($level->getBlock($pos)->getId() == 98 and $level->getBlock($pos) !== $event->getPlayer()->getFloor()){

					$event->getPlayer()->kick(TextFormat::BLUE."[AntiCheat] > NoClip is not allowed!");

				}

				//Protection of EndStone (ID = 121)

				if ($level->getBlock($pos)->getId() == 121 and $level->getBlock($pos) !== $event->getPlayer()->getFloor()){

					$event->getPlayer()->kick(TextFormat::BLUE."[AntiCheat] > NoClip is not allowed!");

				}

				//AC.DOUBLE.SLAB.ID = 157

				if ($level->getBlock($pos)->getId() == 157 and $level->getBlock($pos) !== $event->getPlayer()->getFloor()){

					$event->getPlayer()->kick(TextFormat::BLUE."[AntiCheat] > NoClip is not allowed!");

				}

				//AC.STONE.ID = 255

				if ($level->getBlock($pos)->getId() == 255 and $level->getBlock($pos) !== $event->getPlayer()->getFloor()){

					$event->getPlayer()->kick(TextFormat::BLUE."[AntiCheat] > NoClip is not allowed!");

				}

				//Protection of Clay (ID = 159)

				if ($level->getBlock($pos)->getId() == 159 and $level->getBlock($pos) !== $event->getPlayer()->getFloor()){

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

			}

			if ($this->getCfg->getConfig()->get("OneHit") == "true"){

				if ($event->getDamage() > 19.9) {

					$event->getDamager()->kick(TextFormat::BLUE."[AntiCheat] > OneHit is not allowed!");

				}

			}

		}

		if($event->getEntity() instanceof Player){

			if ($this->getCfg->getConfig()->get("NoKnockBack") == "true"){

				if ($event->getKnockBack() < $this->getCfg->getConfig()->get("MinKnockBack")){

					$event->getEntity()->kick(TextFormat::BLUE."[AntiCheat] > NoKnockBack is not allowed!");

				}

			}

			if ($this->getCfg->getConfig()->get("Unkillable") == "true"){

				if ($event->getDamage() < $this->getCfg->getConfig()->get("MinDamage")){

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