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

	$level = $event->getPlayer()->getLevel();

	$pos = new Vector3($event->getPlayer()->getX(), $event->getPlayer()->getY(), $event->getPlayer()->getZ());

		if ($this->getCfg->getConfig()->get("NoClip") == "true"){
		
			//ANTI-FALSE-POSITIVES

			if ($level->getBlock($pos)->getId() != 0
			
			and $level->getBlock($pos)->getId() != 427

			and $level->getBlock($pos)->getId() != 30
			
			and $level->getBlock($pos)->getId() != 31

			and $level->getBlock($pos)->getId() != 6

			and $level->getBlock($pos)->getId() != 32

			and $level->getBlock($pos)->getId() != 51

			and $level->getBlock($pos)->getId() != 90

			and $level->getBlock($pos)->getId() != 64
			
			and $level->getBlock($pos)->getId() != 71

			and $level->getBlock($pos)->getId() != 70
			
			and $level->getBlock($pos)->getId() != 72

			and $level->getBlock($pos)->getId() != 8
			
			and $level->getBlock($pos)->getId() != 9

			and $level->getBlock($pos)->getId() != 10
			
			and $level->getBlock($pos)->getId() != 11

			and $level->getBlock($pos)->getId() != 26
			
			and $level->getBlock($pos)->getId() != 27

			and $level->getBlock($pos)->getId() != 28
			
			and $level->getBlock($pos)->getId() != 66

			and $level->getBlock($pos)->getId() != 65
			
			and $level->getBlock($pos)->getId() != 96

			and $level->getBlock($pos)->getId() != 183
			
			and $level->getBlock($pos)->getId() != 184

			and $level->getBlock($pos)->getId() != 185
			
			and $level->getBlock($pos)->getId() != 186

			and $level->getBlock($pos)->getId() != 187
			
			and $level->getBlock($pos)->getId() != 171

			and $level->getBlock($pos)->getId() != 167
			
			and $level->getBlock($pos)->getId() != 132

			and $level->getBlock($pos)->getId() != 126
			
			and $level->getBlock($pos)->getId() != 111

			and $level->getBlock($pos)->getId() != 78
			
			and $level->getBlock($pos)->getId() != 83

			and $level->getBlock($pos)->getId() != 37
			
			and $level->getBlock($pos)->getId() != 38

			and $level->getBlock($pos)->getId() != 39
			
			and $level->getBlock($pos)->getId() != 40

			and $level->getBlock($pos)->getId() != 44
			
			and $level->getBlock($pos)->getId() != 50

			and $level->getBlock($pos)->getId() != 53
			
			and $level->getBlock($pos)->getId() != 54

			and $level->getBlock($pos)->getId() != 55
			
			and $level->getBlock($pos)->getId() != 59

			and $level->getBlock($pos)->getId() != 63
			
			and $level->getBlock($pos)->getId() != 127

			and $level->getBlock($pos)->getId() != 67
			
			and $level->getBlock($pos)->getId() != 131

			and $level->getBlock($pos)->getId() != 68
			
			and $level->getBlock($pos)->getId() != 134

			and $level->getBlock($pos)->getId() != 69
			
			and $level->getBlock($pos)->getId() != 135

			and $level->getBlock($pos)->getId() != 75
			
			and $level->getBlock($pos)->getId() != 136

			and $level->getBlock($pos)->getId() != 76
			
			and $level->getBlock($pos)->getId() != 140

			and $level->getBlock($pos)->getId() != 77
			
			and $level->getBlock($pos)->getId() != 141

			and $level->getBlock($pos)->getId() != 81
			
			and $level->getBlock($pos)->getId() != 142

			and $level->getBlock($pos)->getId() != 92
			
			and $level->getBlock($pos)->getId() != 143

			and $level->getBlock($pos)->getId() != 104
			
			and $level->getBlock($pos)->getId() != 144

			and $level->getBlock($pos)->getId() != 105
			
			and $level->getBlock($pos)->getId() != 145

			and $level->getBlock($pos)->getId() != 106
			
			and $level->getBlock($pos)->getId() != 146

			and $level->getBlock($pos)->getId() != 108
			
			and $level->getBlock($pos)->getId() != 147

			and $level->getBlock($pos)->getId() != 109
			
			and $level->getBlock($pos)->getId() != 148

			and $level->getBlock($pos)->getId() != 116
			
			and $level->getBlock($pos)->getId() != 151

			and $level->getBlock($pos)->getId() != 115
			
			and $level->getBlock($pos)->getId() != 156

			and $level->getBlock($pos)->getId() != 114
			
			and $level->getBlock($pos)->getId() != 158

			and $level->getBlock($pos)->getId() != 117
			
			and $level->getBlock($pos)->getId() != 163

			and $level->getBlock($pos)->getId() != 120
			
			and $level->getBlock($pos)->getId() != 164

			and $level->getBlock($pos)->getId() != 167
			
			and $level->getBlock($pos)->getId() != 428

			and $level->getBlock($pos)->getId() != 171
			
			and $level->getBlock($pos)->getId() != 429

			and $level->getBlock($pos)->getId() != 175
			
			and $level->getBlock($pos)->getId() != 430

			and $level->getBlock($pos)->getId() != 178
			
			and $level->getBlock($pos)->getId() != 431

			and $level->getBlock($pos)->getId() != 244
			
			and $level->getBlock($pos)->getId() != 120){

				if ($this->getCfg->getConfig()->get("NoClip-Punishment") == "kick"){

					$event->setCancelled(true);
					$event->getPlayer()->kick(TextFormat::BLUE.$this->getCfg->getConfig()->get("NoClip-Message"));

				}

				if ($this->getCfg->getConfig()->get("NoClip-Punishment") == "log"){

					$event->setCancelled(true);
					$this->getCfg->getServer()->getLogger()->warning(TextFormat::BLUE."[AntiCheat] $event->getPlayer()->getName() is hacking NoClip");
					
				}

			}

		}

	}

	public function onDamage(EntityDamageByEntityEvent $event, EntityDamageEvent $event2){

	$EntityPosition = new Vector3($event->getEntity()->getX(), $event->getEntity()->getY(), $event->getEntity()->getZ());
	$DamagerPosition = new Vector3($event->getDamager()->getX(), $event->getDamager()->getY(), $event->getDamager()->getZ());

		if($event->getDamager() instanceof Player){

			if ($this->getCfg->getConfig()->get("KillAura") == "true"){

			//KillAura Angle Check

				if ($event->getEntity()->getPosition() != $event->getDamager()->getForward()){

					if ($this->getCfg->getConfig()->get("KillAura-Punishment") == "kick"){

						$event->setCancelled(true);
						$event->getDamager()->kick(TextFormat::BLUE.$this->getCfg->getConfig()->get("KillAura-Message"));

					}

					if ($this->getCfg->getConfig()->get("KillAura-Punishment") == "log"){

						$event->setCancelled(true);
						$this->getCfg->getServer()->getLogger()->warning(TextFormat::BLUE."[AntiCheat] $event->getDamager()->getName() is hacking KillAura");
					
					}

				}

			}

			//Reach Check

			if ($this->getCfg->getConfig()->get("Reach") == "true"){

				if ($DamagerPosition->distance($EntityPosition) > $this->getCfg->getConfig()->get("MaxRange")){

					if ($this->getCfg->getConfig()->get("Reach-Punishment") == "kick"){

						$event->setCancelled(true);
						$event->getDamager()->kick(TextFormat::BLUE.$this->getCfg->getConfig()->get("Reach-Message"));

					}

					if ($this->getCfg->getConfig()->get("Reach-Punishment") == "log"){

						$event->setCancelled(true);
						$this->getCfg->getServer()->getLogger()->warning(TextFormat::BLUE."[AntiCheat] $event->getDamager()->getName() is hacking Reach");
					
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
						$this->getCfg->getServer()->getLogger()->warning(TextFormat::BLUE."[AntiCheat] $event->getDamager()->getName() is hacking OneHit");
					
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

						$this->getCfg->getServer()->getLogger()->warning(TextFormat::BLUE."[AntiCheat] $event->getEntity()->getName() is hacking NoKnockBack");
					
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

						$this->getCfg->getServer()->getLogger()->warning(TextFormat::BLUE."[AntiCheat] $event->getEntity()->getName() is hacking Unkillable");
					
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