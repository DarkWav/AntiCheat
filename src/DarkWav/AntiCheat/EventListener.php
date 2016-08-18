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

	$BlockID = $level->getBlock($pos)->getId()

		if ($this->getCfg->getConfig()->get("NoClip") == "true"){
		
			//ANTI-FALSE-POSITIVES

			if ($BlockID != 0
			
			and $BlockID != 427

			and $BlockID != 30
			
			and $BlockID != 31

			and $BlockID != 6

			and $BlockID != 32

			and $BlockID != 51

			and $BlockID != 90

			and $BlockID != 64
			
			and $BlockID != 71

			and $BlockID != 70
			
			and $BlockID != 72

			and $BlockID != 8
			
			and $BlockID != 9

			and $BlockID != 10
			
			and $BlockID != 11

			and $BlockID != 26
			
			and $BlockID != 27

			and $BlockID != 28
			
			and $BlockID != 66

			and $BlockID != 65
			
			and $BlockID != 96

			and $BlockID != 183
			
			and $BlockID != 184

			and $BlockID != 185
			
			and $BlockID != 186

			and $BlockID != 187
			
			and $BlockID != 171

			and $BlockID != 167
			
			and $BlockID != 132

			and $BlockID != 126
			
			and $BlockID != 111

			and $BlockID != 78
			
			and $BlockID != 83

			and $BlockID != 37
			
			and $BlockID != 38

			and $BlockID != 39
			
			and $BlockID != 40

			and $BlockID != 44
			
			and $BlockID != 50

			and $BlockID != 53
			
			and $BlockID != 54

			and $BlockID != 55
			
			and $BlockID != 59

			and $BlockID != 63
			
			and $BlockID != 127

			and $BlockID != 67
			
			and $BlockID != 131

			and $BlockID != 68
			
			and $BlockID != 134

			and $BlockID != 69
			
			and $BlockID != 135

			and $BlockID != 75
			
			and $BlockID != 136

			and $BlockID != 76
			
			and $BlockID != 140

			and $BlockID != 77
			
			and $BlockID != 141

			and $BlockID != 81
			
			and $BlockID != 142

			and $BlockID != 92
			
			and $BlockID != 143

			and $BlockID != 104
			
			and $BlockID != 144

			and $BlockID != 105
			
			and $BlockID != 145

			and $BlockID != 106
			
			and $BlockID != 146

			and $BlockID != 108
			
			and $BlockID != 147

			and $BlockID != 109
			
			and $BlockID != 148

			and $BlockID != 116
			
			and $BlockID != 151

			and $BlockID != 115
			
			and $BlockID != 156

			and $BlockID != 114
			
			and $BlockID != 158

			and $BlockID != 117
			
			and $BlockID != 163

			and $BlockID != 120
			
			and $BlockID != 164

			and $BlockID != 167
			
			and $BlockID != 428

			and $BlockID != 171
			
			and $BlockID != 429

			and $BlockID != 175
			
			and $BlockID != 430

			and $BlockID != 178
			
			and $BlockID != 431

			and $BlockID != 244
			
			and $BlockID != 120){

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