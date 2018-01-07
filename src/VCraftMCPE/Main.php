<?php
namespace VCraftMCPE;

use pocketmine\{Player, Server};
use pocketmine\plugin\PluginBase;

use pocketmine\utils\TextFormat;

use pocketmine\item\Item;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\event\Listener;
use pocketmine\command\{Command,CommandSender, CommandExecutor, ConsoleCommandSender};
use jojoe77777\FormAPI;
use onebone\economyapi\EconomyAPI;

class Main extends PluginBase implements Listener{
  
  const COMMAND_NAME = "eshop";
  const FORM_API = "FormAPI";
 public $prices = [
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
  
  public $idss = [
    1 => ["PROTECTION"],
    2 => ["FIRE PROTECTION"],
    3 => ["FEATHER FALLING"],
    4 => ["BLAST PROTECTION"],
	5 => ["PROJECTILE PROTECTION"],
	6 => ["THORNS"],
	7 => ["RESPIRATION"],
	8 => ["DEPTH STRIDER"],
    9 => ["AQUA AFFINITY"],
	10 => ["SHARPNESS"],
    11 => ["SMITE"],
    12 => ["BANE OF ARTHROPODS"],
    13 => ["KNOCKBACK"],
	14 => ["FIRE_ASPECT"],
	15 => ["LOOTING"],
    16 => ["EFFICIENCY"],
	17 => ["SILK TOUCH"],
    18 => ["UNBREAKING"],
    19 => ["FORTUNE"],
    20 => ["POWER"],
	21 => ["PUNCH"],
	22 => ["FLAME"],
	23 => ["INFINITY"],
	24 => ["LUCK_OF_THE_SEA"],
    25 => ["LURE"],
	26 => ["FROST_WALKER"],
    27 => ["MENDING"]
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
            if($result > 0){
				$this->ShopForm($player, $result);
            }
        });
	  foreach($this->prices as $name => $price){
         $form->addButton($name);
         }
        $form->sendToPlayer($player);
  }
  public function ShopForm($player, $id){
	  $array = $this->idss;
	  $api = $this->getServer()->getPluginManager()->getPlugin(self::FORM_API);
        $form = $api->createCustomForm(function (Player $event, array $data) use ($id , $array){
			$player = $event->getPlayer();
			  $item = Item::get(340, 0, 1);
                $ench = Enchantment::getEnchantmentByName(strtolower($array[$id][0]));
                $item->addEnchantment(new EnchantmentInstance($ench, (int) $data[0]));
				$player->getInventory()->addItem($item);
         });
       $form->setTitle("Buy enchantment");
       $form->addSlider("Level", 1, 5, 1, -1);
       $form->sendToPlayer($player);
	  
  }
}

