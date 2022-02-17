<?php

namespace EngincanErgunGG;

define("MINUTE", 15);

use pocketmine\{
    plugin\PluginBase,
    scheduler\Task,
    Server
};

class AutoServerSave extends PluginBase {

    function onEnable() {
        $this->getScheduler()->scheduleRepeatingTask(new class($this) extends Task {
            function onRun(int $t) {
                $server = Server::getInstance();
                $server->broadcastMessage("§7> §3Sunucu Kaydediliyor..");
                foreach ($server->getOnlinePlayers() as $players) {
                    $players->save();
                }
                foreach ($server->getLevels() as $levels) {
                    $levels->save(true);
                }
                $server->broadcastMessage("§7> §aSunucu kaydedildi.");
            }
        }, 20*60*MINUTE);
        $this->getLogger()->info("Eklenti aktif edildi.");
    }
}
