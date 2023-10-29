<?php
namespace NurAzliYT\InfoUI\Command; // Namespace dengan folder "Command"

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\Plugin;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class ReloadCommand extends Command {

    private $plugin;

    public function __construct(Plugin $plugin) {
        parent::__construct("reloadallui", "Reload all UI Forms", "/reloadallui");
        $this->setPermission("reload.allui"); // Set the permission as needed
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if ($this->testPermission($sender)) {
            // Example if you want to reload all existing UI Forms:
            $uiForms = UIFormManager::getInstance()->getAllForms();
            $reloadedCount = 0;

            foreach ($uiForms as $uiForm) {
                $uiForm->reload();
                $reloadedCount++;
            }

            $sender->sendMessage(TextFormat::GREEN . "Reloaded " . $reloadedCount . " UI Forms.");
        } else {
            $sender->sendMessage("You don't have permission to run this command.");
        }
    }
}
