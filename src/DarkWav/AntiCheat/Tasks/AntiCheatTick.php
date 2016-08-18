<?php
namespace DarkWav\AntiCheat\Tasks;

use pocketmine\scheduler\PluginTask;
use pocketmine\utils\TextFormat;

class AntiCheatTick extends PluginTask {
    public function __construct($plugin) {
        parent::__construct($plugin);
        $this->plugin = $plugin;
    }

    public function onRun($currentTick) {

		$this->plugin->getServer()->getLogger()->debug(TextFormat::BLUE."[AntiCheat] Running ForceOP Check");

		foreach($this->plugin->getServer()->getOnlinePlayers() as $player){

			if ($player->isOp()){

				if (!$player->hasPermission("anticheat.op")){

					$player->kick(TextFormat::RED."ForceOP detected!");

				}

			}

		}

	}

}
