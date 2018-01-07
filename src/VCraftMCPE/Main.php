<?php
namespace VCraftMCPE;

use pocketmine\{Player, Server};
use pocketmine\plugin\PluginBase;

use pocketmine\utils\TextFormat;

use pocketmine\item\Item;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\event\Listener;
use pocketmine\command\{Command,CommandSender, CommandExecutor, ConsoleCommandSender};
use jojoe77777\FormAPI;
use onebone\economyapi\EconomyAPI;

class Main extends PluginBase implements Listener{
  
  const COMMAND_NAME = "enchantui";
  const FORM_API = "FormAPI";
  public $Enchants = [
    "PROTECTION" => [100,368,0],
	"FIRE PROTECTION" => [373,101,35000,1000],
	"FEATHER FALLING" => [373,100,10000,1000],
	"Furnace" => [61,0,20,10],
    "Crafting Table" => [58,0,20,10],
	"Ender Chest " => [130,0,1000,500],
    "Enderpearl" => [368,0,1000,500],
    "Bone" => [352,0,50,25],
    "Book & Quill" => [386,0,100,0]
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
            if($result !== null){
				foreach($this->Enchants as $name => $uselessData){
				$this->BuyForm($player, $result);
				}
            }
        });
        $form->setTitle("enchant");
        $form->setContent("Enchants.");
        $form->addButton(TextFormat::RED . "Exit");
        foreach($this->Enchants as $name => $uselessData){
       $form->addButton($name);
		}
        $form->sendToPlayer($player);
  }
  public function BuyForm($player, $id){
	  var_dump($id);
	  $api = $this->getServer()->getPluginManager()->getPlugin(self::FORM_API);
        $form = $api->createCustomForm(function (Player $event, array $data) use ($id){
            $player = $event->getPlayer();
          if(!($data[0] == null )) {
			$player->getInventory()->addItem(Item::get($data[0],11,$id));
            $book->addEnchantment($enchantment);
          }
         });
       $form->setTitle("Buy enchantment");
       $form->addSlider("Level", 1, 5, 1, -1);
       $form->sendToPlayer($player);
  }
  
  
}
