<?php

namespace DarkWav\AntiCheat;

use pocketmine\utils\TextFormat;
use pocketmine\math\Vector3;
use pocketmine\Player;
use DarkWav\AntiCheat\EventListener;

class Observer
{

  public function __construct($player, AntiCheat $AntiCheat)
  {
    $this->Player              = $player;
    $this->PlayerName          = $this->Player->getName();
    $this->Main                = $AntiCheat;
    $this->Logger              = $AntiCheat->getServer()->getLogger();
    $this->PlayerAirCounter    = 0;
	$this->PlayerSpeedCounter  = 0;
  }  
  
  public function PlayerQuit()
  {
    $this->Logger->debug(TextFormat::BLUE . "[AntiCheat] > $this->PlayerName is no longer watched...");
  }

  public function PlayerJoin()
  {
    $this->Player->sendMessage(TextFormat::BLUE."[AntiCheat] > $this->PlayerName, I am watching you ...");
  }
  
  public function PlayerRejoin()
  {
    $this->Player->sendMessage(TextFormat::BLUE."[AntiCheat] > $this->PlayerName, I am still watching you ...");
  }

  public function OnMove($event)
  {
    # No Fly
    $YPosOld = $event->getFrom()->getY();
    $YPosNew = $event->getTo()->getY();  
	$PosOld  = new Vector3($event->getFrom()->getX(), 0, $event->getFrom()->getZ());
	$PosNew  = new Vector3($event->getTo()->getX(), 0, $event->getTo()->getZ());
	$level = $this->Player->getLevel();
    $pos   = new Vector3($this->Player->getX(), $this->Player->getY(), $this->Player->getZ());
    $BlockID = $level->getBlock($pos)->getId();

	if ($this->Player->getGameMode() !== 1)
	{

	if ($this->Player->isOnGround())
    {
        $this->Logger->debug(TextFormat::GREEN . "Player on ground");
    }
    else
    {
        $this->Logger->debug(TextFormat::RED . "Player is NOT on ground");
    } 

    if (!$this->Player->isOnGround())
    {

	if ($this->Main->getConfig()->get("Fly"))
    {    
	  if($BlockID != 8 and $BlockID != 9 and $BlockID != 10 and $BlockID != 11 and $BlockID != 65 and $BlockID != 106)
	  {
	    if ($YPosOld > $YPosNew)
	    {
	      # Player moves down
	      # do nothing: player may be jumping or falling down
	    }
	    elseif ($YPosOld <= $YPosNew)
	    {
	    	# Player moves up or horizontal
	    	$this->PlayerAirCounter++;
		}
		}
       }
	 }
	 else
     {
	   $this->PlayerAirCounter = 0;
     }
      
      if ($this->PlayerAirCounter > $this->Main->getConfig()->get("Fly-Threshold"))
      {
	    if ($this->Main->getConfig()->get("Fly-Punishment") == "kick")
        {
          $event->setCancelled(true);
          $this->Player->kick(TextFormat::BLUE.$this->Main->getConfig()->get("Fly-Message"));
        }

        if ($this->Main->getConfig()->get("Fly-Punishment") == "block")
        {
          $event->setCancelled(true);
      	  $this->Player->sendMessage(TextFormat::BLUE."[AntiCheat] You were frozen for Fly!");
        }
      }
	}

    # No Clip
    if ($this->Main->getConfig()->get("NoClip"))
    {
      //ANTI-FALSE-POSITIVES
      if ($BlockID != 0
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
      and $BlockID != 171
      and $BlockID != 175
      and $BlockID != 178
      and $BlockID != 244
      and $BlockID != 113
      and $BlockID != 85
      and $BlockID != 188
      and $BlockID != 189
      and $BlockID != 190
      and $BlockID != 191
      and $BlockID != 192
      and $BlockID != 139
	  and $BlockID != 88
	  and $BlockID != 193
      and $BlockID != 194
      and $BlockID != 195
      and $BlockID != 196
	  and $BlockID != 197
      and $BlockID != 120)
      {
        if ($this->Main->getConfig()->get("NoClip-Punishment") == "kick")
        {
          $event->setCancelled(true);
          $this->Player->kick(TextFormat::BLUE.$this->Main->getConfig()->get("NoClip-Message"));
        }

        if ($this->Main->getConfig()->get("NoClip-Punishment") == "block")
        {
          $event->setCancelled(true);
        }
      }
    }
	if ($this->Main->getConfig()->get("Speed"))
    {
      if ($PosOld->distance($PosNew) > $this->Main->getConfig()->get("MaxSpeed"))
        if ($this->Main->getConfig()->get("Speed-Punishment") == "kick")
        {
          $event->setCancelled(true);
		  $this->PlayerSpeedCounter++;
		  if ($this->PlayerSpeedCounter > $this->Main->getConfig()->get("Speed-Threshold"))
		  {
		    $this->PlayerSpeedCounter = 0;
            $this->Player->kick(TextFormat::BLUE.$this->Main->getConfig()->get("Speed-Message"));
		  }
        }

        if ($this->Main->getConfig()->get("Speed-Punishment") == "block")
        {
          $event->setCancelled(true);
        }
      }
    }
  public function onDamage($event, $event2)
  {
  $EntityPosition  = new Vector3($event->getEntity()->getX() , $event->getEntity()->getY() , $event->getEntity()->getZ());
  $DamagerPosition = new Vector3($event->getDamager()->getX(), $event->getDamager()->getY(), $event->getDamager()->getZ());
    if($event->getDamager() instanceof Player){

			//Reach Check

			if ($this->Main->getConfig()->get("Reach")){

				if ($DamagerPosition->getDistance($EntityPosition) > $this->Main->getConfig()->get("MaxRange")){

					if ($this->Main->getConfig()->get("Reach-Punishment") == "kick"){

						$event->setCancelled(true);
						$event->getDamager()->kick(TextFormat::BLUE.$this->Main->getConfig()->get("Reach-Message"));

					}

					if ($this->Main->getConfig()->get("Reach-Punishment") == "block"){

						$event->setCancelled(true);
					
					}

				}

			}

			//OneHit Detection

			if ($this->Main->getConfig()->get("OneHit")){

				if ($event->getDamage() > 19.9) {

					if ($this->Main->getConfig()->get("OneHit-Punishment") == "kick"){

						$event->setCancelled(true);
						$event->getDamager()->kick(TextFormat::BLUE.$this->Main->getConfig()->get("OneHit-Message"));

					}

					if ($this->Main->getConfig()->get("OneHit-Punishment") == "block"){

						$event->setCancelled(true);
					
					}

				}

			}

		}

		if($event->getEntity() instanceof Player){

			//NoNnockBack Detection

			if ($this->Main->getConfig()->get("NoKnockBack")){

				if ($event->getKnockBack() < $this->Main->getConfig()->get("MinKnockBack")){					

					$event->getEntity()->kick(TextFormat::BLUE.$this->Main->getConfig()->get("NoKnockBack-Message"));

				}

			}

			//Unkillable Detection

			if ($this->Main->getConfig()->get("Unkillable")){

				if ($event->getDamage() < $this->Main->getConfig()->get("MinDamage")){

					$event->getEntity()->kick(TextFormat::BLUE.$this->Main->getConfig()->get("Unkillable-Message"));

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