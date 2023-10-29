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
        // Mengambil referensi ke FormAPI
        $formAPI = $this->plugin->getServer()->getPluginManager()->getPlugin("InfoUI");

        if ($formAPI !== null) {
            $reloadedCount = 0;

            // Contoh jika Anda ingin memuat ulang semua UI Forms yang ada
            $forms = $formAPI->getAllForms();
            foreach ($forms as $form) {
                $form->reload(); // Memuat ulang UI Form
                $reloadedCount++;
            }

            $sender->sendMessage(TextFormat::GREEN . "Reloaded " . $reloadedCount . " UI Forms.");
        } else {
            $sender->sendMessage("FormAPI tidak ditemukan. Pastikan Anda telah menginstal dan mengaktifkan FormAPI.");
        }
    } else {
        $sender->sendMessage("Anda tidak memiliki izin untuk menjalankan perintah ini.");
    }
}
}
