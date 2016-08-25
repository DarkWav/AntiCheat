<?php

namespace DarkWav\AntiCheat;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\utils\Config;
use DarkWav\AntiCheat\Tasks\AntiCheatTick;
use pocketmine\event\player\PlayerJoinEvent;

class AntiCheat extends PluginBase
{
  public $Config;
  public $Logger;
  
  public function onEnable()
  {
	  @mkdir($this->getDataFolder());
	  $this->saveDefaultConfig();
	  $this->saveResource("AntiForceOP.txt");
	
	  $Config = $this->getConfig();
	  $Logger = $this->getServer()->getLogger();
		
	  if($Config->get("ForceOP"))
	  {
	    $this->getServer()->getScheduler()->scheduleRepeatingTask(new AntiCheatTick($this), 500);
	  }  
	  $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
	
  	$Logger->info(TextFormat::BLUE . "[AntiCheat] > AntiCheat Activated"            );
    $Logger->info(TextFormat::BLUE . "[AntiCheat] > Shield Activated"               );
	$Logger->info(TextFormat::BLUE . "[AntiCheat] > AntiCheat v2.6.1 [Neutron Star]");
	
	  if($Config->get("OneHit"     )) $Logger->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiOneHit"     );
	  if($Config->get("Unkillable" )) $Logger->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiUnkillable" );
	  if($Config->get("ForceOP"    )) $Logger->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiForceOP"    );
	  if($Config->get("NoClip"     )) $Logger->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiNoClip"     );
	  if($Config->get("Fly"        )) $Logger->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiFly"        );
	  if($Config->get("Fly"        )) $Logger->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiHighJump"   );
	  if($Config->get("Fly"        )) $Logger->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiSpider"     );
	  if($Config->get("Fly"        )) $Logger->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiJesus"      );
	  if($Config->get("Reach"      )) $Logger->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiReach"      );
	  if($Config->get("Speed"      )) $Logger->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiSpeed"      );
	  if($Config->get("NoKnockBack")) $Logger->info(TextFormat::BLUE."[AntiCheat] > Enabling AntiNoKnockBack");

		if($Config->get("Plugin-Version") !== "2.6.1")
		{
			$Logger->emergency(TextFormat::BLUE."[AntiCheat] > Your Config is incompatible with this plugin version, please update immediately!");
			$this->getServer()->shutdown();
		}

		if($Config->get("Config-Version") !== "3.3.1")
		{
			$Logger->warning(TextFormat::BLUE."[AntiCheat] > Your Config is out of date!");
		}
  }

  public function onDisable()
  {
    $Logger = $this->getServer()->getLogger();

  	$Logger->info(TextFormat::BLUE."[AntiCheat] > You are no longer protected from cheats!");
  	$Logger->info(TextFormat::BLUE."[AntiCheat] > Shield Deactivated");
	$Logger->info(TextFormat::BLUE."[AntiCheat] > AntiCheat Deactivated");
	$this->getServer()->shutdown();
  }
    
	public function onCommand(CommandSender $sender, Command $cmd, $label, array $args)
	{
		if ($cmd->getName() === 'anticheat' || $cmd->getName() === 'ac')
		{
			$sender->sendMessage(TextFormat::BLUE."[AntiCheat] > AntiCheat v2.6.1 [Neutron Star] ~ DarkWav");
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
