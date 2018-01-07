<?php
namespace VCraftMCPE;

use pocketmine\{Player, Server};
use pocketmine\plugin\PluginBase;

use pocketmine\utils\TextFormat;

use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;
use pocketmine\event\Listener;
use pocketmine\command\{Command,CommandSender, CommandExecutor, ConsoleCommandSender};
use jojoe77777\FormAPI;
use onebone\economyapi\EconomyAPI;

class Main extends PluginBase implements Listener{
  
  const COMMAND_NAME = "enchantui";
  const FORM_API = "FormAPI";
  
  public $Enchants = [
    "EXIT" => [0],
    "PROTECTION" => [1],
    "FIRE PROTECTION" => [2],
    "FEATHER FALLING" => [3],
    "BLAST PROTECTION" => [4],
	"PROJECTILE PROTECTION" => [5],
	"THORNS" => [6],
	"RESPIRATION" => [7],
	"DEPTH STRIDER " => [8],
    "AQUA AFFINITY" => [9],
	"SHARPNESS" => [10],
    "SMITE" => [],
    "BANE OF ARTHROPODS" => [11],
    "KNOCKBACK" => [],
	"FIRE_ASPECT" => [12],
	"LOOTING" => [13],
    "EFFICIENCY" => [14],
	"SILK TOUCH" => [15],
    "UNBREAKING" => [16],
    "FORTUNE" => [17],
    "POWER" => [18],
	"PUNCH" => [19],
	"FLAME" => [20],
	"INFINITY" => [21],
	"LUCK_OF_THE_SEA" => [22],
    "LURE" => [23],
	"FROST_WALKER" => [24],
    "MENDING" => [25]
  ];
  public function onEnable(){
        $this->getLogger()->info("Enchant GUI has been  enabled");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
   public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
        if(strtolower($cmd->getName()) === self::COMMAND_NAME and $sender instanceof Player) $this->EnchantForm($sender);
        return true;
    }
  public function EnchantForm($player){
        $plugin = $this->getServer()->getPluginManager();
        $formapi = $plugin->getPlugin(self::FORM_API);
        $form = $formapi->createSimpleForm(function (Player $event, array $args){
            $result = $args[0];
            $player = $event->getPlayer();
            if($result === null){
            }
            switch($result){
                case 0:
                    return;
                case 1:
                    $this->ShopForm(1, $player);
               case 2:
                    $this->ShopForm(2, $player);
                case 3:
                    $this->ShopForm(3, $player);
                case 4:
                    $this->ShopForm(4, $player);
                case 5:
                    $this->ShopForm(5, $player);
                case 6:
                    $this->ShopForm(6, $player);
                case 7:
                    $this->ShopForm(7, $player);
                case 8:
                    $this->ShopForm(8, $player);
               case 9:
                    $this->ShopForm(9, $player);
                case 10:
                    $this->ShopForm(10, $player);
                case 11:
                    $this->ShopForm(11, $player);
                case 12:
                    $this->ShopForm(12, $player);
                case 13:
                    $this->ShopForm(13, $player);
                case 14:
                    $this->ShopForm(14, $player);
                case 15:
                    $this->ShopForm(15, $player);
                case 16:
                    $this->ShopForm(16, $player);
                case 17:
                    $this->ShopForm(17, $player);
                case 18:
                    $this->ShopForm(18, $player);
                case 19:
                    $this->ShopForm(19, $player);
                case 20:
                    $this->ShopForm(20, $player);
                case 21:
                    $this->ShopForm(21, $player);
                case 22:
                    $this->ShopForm(22, $player);
                case 23:
                    $this->ShopForm(23, $player);
                case 24:
                    $this->ShopForm(24, $player);
                case 25:
                    $this->ShopForm(25, $player);
                case 26:
                    $this->ShopForm(26, $player);
            }
        });
	  foreach($this->Enchants as $name => $price){
           $form->addButton($name);
         }
        $form->sendToPlayer($player);
  }
  public function ShopForm( $player, $id){
	  $api = $this->getServer()->getPluginManager()->getPlugin(self::FORM_API);
        $form = $api->createCustomForm(function (Player $event, array $data) use ($id){
            $player = $event->getPlayer();
          if(!($data[0] == null )) {
          }
         });
       $form->setTitle("Buy enchantment");
       $form->addSlider("Level", 1, 5, 1, -1);
       $form->sendToPlayer($player);
	  
  }
}
