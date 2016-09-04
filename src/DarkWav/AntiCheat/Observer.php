<?php

namespace DarkWav\AntiCheat;

use pocketmine\utils\TextFormat;
use pocketmine\math\Vector3;
use pocketmine\Player;
use DarkWav\AntiCheat\EventListener;
use pocketmine\entity\Effect;

class Observer
{

  public function __construct($player, AntiCheat $AntiCheat)
  {
    $this->Player              = $player;
    $this->PlayerName          = $this->Player->getName();
    $this->Main                = $AntiCheat;
    $this->Logger              = $AntiCheat->getServer()->getLogger();
    $this->Server              = $AntiCheat->getServer();
    $this->JoinCounter         = 0;

    $this->PlayerAirCounter    = 0;
    $this->PlayerSpeedCounter  = 0;
    $this->PlayerGlideCounter  = 0;

    $this->prev_tick    = -1.0;
    
    $this->x_arr_size   = 7;
    $this->x_arr_idx    = 0;
    $this->x_time_array = array_fill(0, $this->x_arr_size, 0.0);
    $this->x_dist_array = array_fill(0, $this->x_arr_size, 0.0);
    $this->x_time_sum   = 0.0;
    $this->x_distance   = 0.0;
    $this->x_dist_sum   = 0.0;
    $this->x_speed      = 0.0;
    
    $this->y_arr_size   = 10;
    $this->y_arr_idx    = 0;
    $this->y_time_array = array_fill(0, $this->y_arr_size, 0.0);
    $this->y_dist_array = array_fill(0, $this->y_arr_size, 0.0);
    $this->y_time_sum   = 0.0;
    $this->y_distance   = 0.0;
    $this->y_dist_sum   = 0.0;
    $this->y_speed      = 0.0;
    
    $this->x_pos_old    = new Vector3(0.0, 0.0, 0.0);
    $this->x_pos_new    = new Vector3(0.0, 0.0, 0.0);
    $this->y_pos_old    = 0.0;
    $this->y_pos_new    = 0.0;
  }  
  
  public function ResetObserver()
  {
    $this->PlayerAirCounter    = 0;
    $this->PlayerSpeedCounter  = 0;
    $this->PlayerGlideCounter  = 0;
    
    $this->prev_tick     = -1.0;
    
    $this->x_arr_size   = 7;
    $this->x_arr_idx    = 0;
    $this->x_time_array = array_fill(0, $this->x_arr_size, 0.0);
    $this->x_dist_array = array_fill(0, $this->x_arr_size, 0.0);
    $this->x_time_sum   = 0.0;
    $this->x_distance   = 0.0;
    $this->x_dist_sum   = 0.0;
    $this->x_speed      = 0.0;
    
    $this->y_arr_size   = 10;
    $this->y_arr_idx    = 0;
    $this->y_time_array = array_fill(0, $this->y_arr_size, 0.0);
    $this->y_dist_array = array_fill(0, $this->y_arr_size, 0.0);
    $this->y_time_sum   = 0.0;
    $this->y_distance   = 0.0;
    $this->y_dist_sum   = 0.0;
    $this->y_speed      = 0.0;

    $this->x_pos_old    = new Vector3(0.0, 0.0, 0.0);
    $this->x_pos_new    = new Vector3(0.0, 0.0, 0.0);    
    $this->y_pos_old    = 0.0;
    $this->y_pos_new    = 0.0;    
  }
  
  public function PlayerQuit()
  {
    if ($this->Main->getConfig()->get("I-AM-WATCHING-YOU"))
    {
      $this->Logger->debug(TextFormat::BLUE . "[AntiCheat] > $this->PlayerName is no longer watched...");
    }
  }

  public function PlayerJoin()
  {
    $this->JoinCounter++;
    if ($this->Main->getConfig()->get("I-AM-WATCHING-YOU"))
    {
      $this->Player->sendMessage(TextFormat::BLUE."[AntiCheat] > $this->PlayerName, I am watching you ...");
    }
  }
  
  public function PlayerRejoin()
  {
    $this->JoinCounter++;
    if ($this->Main->getConfig()->get("I-AM-WATCHING-YOU"))
    {
      $this->Player->sendMessage(TextFormat::BLUE."[AntiCheat] > $this->PlayerName, I am still watching you ...");
      $this->Logger->debug      (TextFormat::BLUE."[AntiCheat] > $this->PlayerName joined this server $this->JoinCounter times since server start");
    }
  }

  public function OnMove($event)
  {
    if ($this->Player->getGameMode() == 1 or $this->Player->getGameMode() == 3) return;

    #Anti Speed & Anti Fly
    if ($this->Main->getConfig()->get("Speed") or $this->Main->getConfig()->get("Fly"))
    {
      $this->x_pos_old = new Vector3($event->getFrom()->getX(), 0.0, $event->getFrom()->getZ());
      $this->x_pos_new = new Vector3($event->getTo()->getX()  , 0.0, $event->getTo()->getZ()  );
      $this->x_distance = $this->x_pos_old->distance($this->x_pos_new);

      $this->y_pos_old  = $event->getFrom()->getY();
      $this->y_pos_new  = $event->getTo()->getY();  
      $this->y_distance  = $this->y_pos_old - $this->y_pos_new;

      $tick = (double)$this->Server->getTick(); 
      $tps  = (double)$this->Server->getTicksPerSecond();

      if ($tps > 0.0 and $this->prev_tick != -1.0)
      {
        $tick_count = (double)($tick - $this->prev_tick);     // server ticks since last move 
        $delta_t    = (double)($tick_count) / (double)$tps;   // seconds since last move

        if ($delta_t < 2.0)  // "OnMove" message lag is less than 2 second to calculate a new moving speed
        {    
          $this->x_time_sum = $this->x_time_sum - $this->x_time_array[$this->x_arr_idx] + $delta_t;             // ringbuffer time     sum  (remove oldest, add new)
          $this->x_dist_sum = $this->x_dist_sum - $this->x_dist_array[$this->x_arr_idx] + $this->x_distance;    // ringbuffer distance sum  (remove oldest, add new) 
          $this->x_time_array[$this->x_arr_idx] = $delta_t;                                                     // overwrite oldest delta_t  with the new one
          $this->x_dist_array[$this->x_arr_idx] = $this->x_distance;                                            // overwrite oldest distance with the new one          
          $this->x_arr_idx++;                                                                                   // Update ringbuffer position
          if ($this->x_arr_idx >= $this->x_arr_size) $this->x_arr_idx = 0;          
          
          $this->y_time_sum = $this->y_time_sum - $this->y_time_array[$this->y_arr_idx] + $delta_t;             // ringbuffer time     sum  (remove oldest, add new)
          $this->y_dist_sum = $this->y_dist_sum - $this->y_dist_array[$this->y_arr_idx] + $this->y_distance;    // ringbuffer distance sum  (remove oldest, add new) 
          $this->y_time_array[$this->y_arr_idx] = $delta_t;                                                      // overwrite oldest delta_t  with the new one
          $this->y_dist_array[$this->y_arr_idx] = $this->y_distance;                                             // overwrite oldest distance with the new one          
          $this->y_arr_idx++;                                                                                    // Update ringbuffer position
          if ($this->y_arr_idx >= $this->y_arr_size) $this->y_arr_idx = 0;
        }

        // calculate speed: distance per time      
        if ($this->x_time_sum > 0) $this->x_speed = (double)$this->x_dist_sum / (double)$this->x_time_sum;
        else                       $this->x_speed = 0.0;
        
        // calculate speed: distance per time      
        if ($this->y_time_sum > 0) $this->y_speed = (double)$this->y_dist_sum / (double)$this->y_time_sum;
        else                       $this->y_speed = 0.0;
     
        # speed only part
        if ($this->Main->getConfig()->get("Speed"))
        {
          if ($this->x_speed > 10)
          {
            $this->PlayerSpeedCounter += 10;
          }
          else
          {
            if ($this->PlayerSpeedCounter > 0)
            { 
              $this->PlayerSpeedCounter--;
            }
          }
   
          if ($this->PlayerSpeedCounter > $this->Main->getConfig()->get("Speed-Threshold") * 10)
          {
            if ($this->Main->getConfig()->get("Speed-Punishment") == "kick")
            {
              $event->setCancelled(true);
              $this->ResetObserver();
              $this->Player->kick(TextFormat::BLUE. $this->Main->getConfig()->get("Speed-Message"));
              return;
            }
            if ($this->Main->getConfig()->get("Speed-Punishment") == "block")
            {
              $event->setCancelled(true);
            }
          }  
        }
        
      }
      $this->prev_tick = $tick;
    }

    # No Fly and No Glide
    if ($this->Main->getConfig()->get("Fly"))
    {
      $level   = $this->Player->getLevel();
      $pos     = new Vector3($this->Player->getX(), $this->Player->getY(), $this->Player->getZ());
      $BlockID = $level->getBlock($pos)->getId();

      if (!$this->Player->isOnGround())
      {
        if($BlockID != 8 and $BlockID != 9 and $BlockID != 10 and $BlockID != 11 and $BlockID != 65 and $BlockID != 106 and $BlockID != 30)
        {
          #if ($delta_t > 0) $y_raw_speed = $this->y_distance / $delta_t;
          #else              $y_raw_speed = 0.0;
          
          if ($this->y_pos_old > $this->y_pos_new)
          {
            $this->PlayerGlideCounter++;
            # Player moves down. Check Glide Hack
          }
          elseif ($this->y_pos_old <= $this->y_pos_new)
          {
            # Player moves up or horizontal
            $this->PlayerAirCounter++;
            if ($this->PlayerGlideCounter > 0)
            {
              $this->PlayerGlideCounter--;
            }   
          }
        }
      }
      else
      {
        $this->PlayerAirCounter   = 0;
        $this->PlayerGlideCounter = 0;
      }
      
      if ($this->PlayerGlideCounter > 25 && $this->y_speed < 20)
      {  
        if ($this->Main->getConfig()->get("Glide-Punishment") == "kick")
        {
          $this->ResetObserver();
          $event->setCancelled(true);
          $this->Player->kick(TextFormat::BLUE.$this->Main->getConfig()->get("Glide-Message"));
        }

        if ($this->Main->getConfig()->get("Glide-Punishment") == "block")
        {
          $event->setCancelled(true);
          $this->Player->sendMessage(TextFormat::BLUE."[AntiCheat] You were frozen for Glide!");
        }
      }
      
      if ($this->PlayerAirCounter > $this->Main->getConfig()->get("Fly-Threshold"))
      {
        if ($this->Main->getConfig()->get("Fly-Punishment") == "kick")
        {
          $event->setCancelled(true);
          $this->ResetObserver();
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
      and $BlockID != 128
      and $BlockID != 108
      and $BlockID != 109
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
  }

  public function OnDamage($event, $event2)
  {
  $EntityPosition  = new Vector3($event->getEntity()->getX() , $event->getEntity()->getY() , $event->getEntity()->getZ());
  $DamagerPosition = new Vector3($event->getDamager()->getX(), $event->getDamager()->getY(), $event->getDamager()->getZ());
    if($event->getDamager() instanceof Player){

      //Reach Check

      if ($this->Main->getConfig()->get("Reach")){

        if ($DamagerPosition->distance($EntityPosition) > $this->Main->getConfig()->get("MaxRange")){

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