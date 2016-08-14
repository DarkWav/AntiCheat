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
use pocketmine\event\Cancellable;

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

				//Protection of Stone (ID = 1)

				if ($level->getBlock($pos)->getId() == 1 and $level->getBlock($pos) != $event->getPlayer()->getFloorY()){

					if ($this->getCfg->getConfig()->get("NoClip-Punishment") == "kick"){

						$event->setCancelled(true);
						$event->getPlayer()->kick(TextFormat::BLUE.$this->getCfg->getConfig()->get("NoClip-Message"));

					}

					if ($this->getCfg->getConfig()->get("NoClip-Punishment") == "log"){

						$this->getServer()->getLogger()->warning(TextFormat::BLUE."[AntiCheat] $event->getPlayer()->getName() is hacking NoClip");
						$event->setCancelled(true);
					
					}

				}

				//Protection of GrassBlock (ID = 2)

				if ($level->getBlock($pos)->getId() == 2 and $level->getBlock($pos) != $event->getPlayer()->getFloorY()){

					if ($this->getCfg->getConfig()->get("NoClip-Punishment") == "kick"){

						$event->setCancelled(true);
						$event->getPlayer()->kick(TextFormat::BLUE.$this->getCfg->getConfig()->get("NoClip-Message"));

					}

					if ($this->getCfg->getConfig()->get("NoClip-Punishment") == "log"){

						$this->getServer()->getLogger()->warning(TextFormat::BLUE."[AntiCheat] $event->getPlayer()->getName() is hacking NoClip");
						$event->setCancelled(true);
					
					}


				}

				//Protection of Dirt (ID = 3)

				if ($level->getBlock($pos)->getId() == 3 and $level->getBlock($pos) != $event->getPlayer()->getFloorY()){

					if ($this->getCfg->getConfig()->get("NoClip-Punishment") == "kick"){

						$event->setCancelled(true);
						$event->getPlayer()->kick(TextFormat::BLUE.$this->getCfg->getConfig()->get("NoClip-Message"));

					}

					if ($this->getCfg->getConfig()->get("NoClip-Punishment") == "log"){

						$this->getServer()->getLogger()->warning(TextFormat::BLUE."[AntiCheat] $event->getPlayer()->getName() is hacking NoClip");
						$event->setCancelled(true);
					
					}

				}

				//Protection of CobbleStone (ID = 4)

				if ($level->getBlock($pos)->getId() == 4 and $level->getBlock($pos) != $event->getPlayer()->getFloorY()){

					if ($this->getCfg->getConfig()->get("NoClip-Punishment") == "kick"){

						$event->setCancelled(true);
						$event->getPlayer()->kick(TextFormat::BLUE.$this->getCfg->getConfig()->get("NoClip-Message"));

					}

					if ($this->getCfg->getConfig()->get("NoClip-Punishment") == "log"){

						$this->getServer()->getLogger()->warning(TextFormat::BLUE."[AntiCheat] $event->getPlayer()->getName() is hacking NoClip");
						$event->setCancelled(true);
					
					}

				}

				//Protection of OakPlanks (ID = 5)

				if ($level->getBlock($pos)->getId() == 5 and $level->getBlock($pos) != $event->getPlayer()->getFloorY()){

					if ($this->getCfg->getConfig()->get("NoClip-Punishment") == "kick"){

						$event->setCancelled(true);
						$event->getPlayer()->kick(TextFormat::BLUE.$this->getCfg->getConfig()->get("NoClip-Message"));

					}

					if ($this->getCfg->getConfig()->get("NoClip-Punishment") == "log"){

						$this->getServer()->getLogger()->warning(TextFormat::BLUE."[AntiCheat] $event->getPlayer()->getName() is hacking NoClip");
						$event->setCancelled(true);
					
					}

				}

				//Protection of BedRock (ID = 7)

				if ($level->getBlock($pos)->getId() == 7 and $level->getBlock($pos) != $event->getPlayer()->getFloorY()){

					if ($this->getConfig()->get("NoClip-Punishment") == "kick"){

						$event->setCancelled(true);
						$event->getPlayer()->kick(TextFormat::BLUE.$this->getCfg->getConfig()->get("NoClip-Message"));

					}

					if ($this->getCfg->getConfig()->get("NoClip-Punishment") == "log"){

						$this->getServer()->getLogger()->warning(TextFormat::BLUE."[AntiCheat] $event->getPlayer()->getName() is hacking NoClip");
						$event->setCancelled(true);
					
					}

				}

				//Protection of Wood (ID = 17)

				if ($level->getBlock($pos)->getId() == 17 and $level->getBlock($pos) != $event->getPlayer()->getFloorY()){

					if ($this->getCfg->getConfig()->get("NoClip-Punishment") == "kick"){

						$event->setCancelled(true);
						$event->getPlayer()->kick(TextFormat::BLUE.$this->getCfg->getConfig()->get("NoClip-Message"));

					}

					if ($this->getCfg->getConfig()->get("NoClip-Punishment") == "log"){

						$this->getServer()->getLogger()->warning(TextFormat::BLUE."[AntiCheat] $event->getPlayer()->getName() is hacking NoClip");
						$event->setCancelled(true);
					
					}

				}

				//Protection of Bricks (ID = 45)

				if ($level->getBlock($pos)->getId() == 45 and $level->getBlock($pos) != $event->getPlayer()->getFloorY()){

					if ($this->getCfg->getConfig()->get("NoClip-Punishment") == "kick"){

						$event->setCancelled(true);
						$event->getPlayer()->kick(TextFormat::BLUE.$this->getCfg->getConfig()->get("NoClip-Message"));

					}

					if ($this->getCfg->getConfig()->get("NoClip-Punishment") == "log"){

						$this->getServer()->getLogger()->warning(TextFormat::BLUE."[AntiCheat] $event->getPlayer()->getName() is hacking NoClip");
						$event->setCancelled(true);
					
					}

				}

				//Protection of Obsidian (ID = 49)

				if ($level->getBlock($pos)->getId() == 49 and $level->getBlock($pos) != $event->getPlayer()->getFloorY()){

					if ($this->getCfg->getConfig()->get("NoClip-Punishment") == "kick"){

						$event->setCancelled(true);
						$event->getPlayer()->kick(TextFormat::BLUE.$this->getCfg->getConfig()->get("NoClip-Message"));

					}

					if ($this->getCfg->getConfig()->get("NoClip-Punishment") == "log"){

						$this->getServer()->getLogger()->warning(TextFormat::BLUE."[AntiCheat] $event->getPlayer()->getName() is hacking NoClip");
						$event->setCancelled(true);
					
					}

				}

		}

	}

	public function onDamage(EntityDamageByEntityEvent $event, EntityDamageEvent $event2){

		if($event->getDamager() instanceof Player){

			if ($this->getCfg->getConfig()->get("KillAura") == "true"){

			$EntityPosition = new Vector3($event->getEntity()->getX(), $event->getEntity()->getY(), $event->getEntity()->getZ());
			$DamagerPosition = new Vector3($event->getDamager()->getX(), $event->getDamager()->getY(), $event->getDamager()->getZ());

			//KillAura Angle Check

				if ($event->getEntity()->getPosition() != $event->getDamager()->getForward()){

					if ($this->getCfg->getConfig()->get("KillAura-Punishment") == "kick"){

						$event->setCancelled(true);
						$event->getDamager()->kick(TextFormat::BLUE.$this->getCfg->getConfig()->get("KillAura-Message"));

					}

					if ($this->getCfg->getConfig()->get("KillAura-Punishment") == "log"){

						$event->setCancelled(true);
						$this->getServer()->getLogger()->warning(TextFormat::BLUE."[AntiCheat] $event->getDamager()->getName() is hacking KillAura");
					
					}

				}

			//Reach Check

				if ($DamagerPosition->distance($EntityPosition) > $this->getCfg->getConfig()->get("MaxRange")){

					if ($this->getCfg->getConfig()->get("Reach-Punishment") == "kick"){

						$event->setCancelled(true);
						$event->getDamager()->kick(TextFormat::BLUE.$this->getCfg->getConfig()->get("Reach-Message"));

					}

					if ($this->getCfg->getConfig()->get("Reach-Punishment") == "log"){

						$event->setCancelled(true);
						$this->getServer()->getLogger()->warning(TextFormat::BLUE."[AntiCheat] $event->getDamager()->getName() is hacking Reach");
					
					}

				}

			}

			//OneHit Detection

			if ($this->getCfg->getConfig()->get("OneHit") == "true"){

				if ($event->getDamage() > 19.9) {

					if ($this->getCfg->getConfig()->get("OneHit-Punishment") == "kick"){

						$event->setCancelled(true);
						$event->getDamager()->kick(TextFormat::BLUE.$this->getCfg->getConfig()->get("OneHit-Message"));

					}

					if ($this->getCfg->getConfig()->get("OneHit-Punishment") == "log"){

						$event->setCancelled(true);
						$this->getServer()->getLogger()->warning(TextFormat::BLUE."[AntiCheat] $event->getDamager()->getName() is hacking OneHit");
					
					}

				}

			}

		}

		if($event->getEntity() instanceof Player){

			//NoNnockBack Detection

			if ($this->getCfg->getConfig()->get("NoKnockBack") == "true"){

				if ($event->getKnockBack() < $this->getCfg->getConfig()->get("MinKnockBack")){

					if ($this->getCfg->getConfig()->get("NoKnockBack-Punishment") == "kick"){

						$event->getEntity()->kick(TextFormat::BLUE.$this->getCfg->getConfig()->get("NoKnockBack-Message"));

					}

					if ($this->getCfg->getConfig()->get("NoKnockBack-Punishment") == "log"){

						$this->getServer()->getLogger()->warning(TextFormat::BLUE."[AntiCheat] $event->getEntity()->getName() is hacking NoKnockBack");
					
					}

				}

			}

			//Unkillable Detection

			if ($this->getCfg->getConfig()->get("Unkillable") == "true"){

				if ($event->getDamage() < $this->getCfg->getConfig()->get("MinDamage")){

					if ($this->getCfg->getConfig()->get("Unkillable-Punishment") == "kick"){

						$event->getEntity()->kick(TextFormat::BLUE.$this->getCfg->getConfig()->get("Unkillable-Message"));

					}

					if ($this->getCfg->getConfig()->get("Unkillable-Punishment") == "log"){

						$this->getServer()->getLogger()->warning(TextFormat::BLUE."[AntiCheat] $event->getEntity()->getName() is hacking Unkillable");
					
					}

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