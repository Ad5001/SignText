<?php

namespace ST;

use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\Command;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat as TF;
use pocketmine\plugin\PluginBase;
use pocketmine\block\Sign;



class Main extends PluginBase implements Listener{


public function onEnable(){
$this->getServer()->getPluginManager()->registerEvents($this,$this);
	$this->getServer()->getLogger()->notice(TF::YELLOW."[SignText]Plugin Loaded!");
	$this->line1 = [];
	$this->line2 = [];
	$this->line3 = [];
	$this->line4 = [];
	$this->Setter = [];
}



	public function onCommand(CommandSender $sender, Command $command, $label, array $args){
		if(!isset($args[0])){
			$sender->sendMessage("use: /signtext <line 1| line 2| line 3| line 4>");
		unset($sender,$cmd,$label,$args);
		return;
		}
		switch($args[0]){
			case "set":
		if(isset($args[1]) && isset($args[2]) && isset($args[3]) && isset($args[4])){
			$this->addSetter($sender);
			$this->line1[$sender->getName()] = $args[1];
			$this->line2[$sender->getName()] = $args[2];
			$this->line3[$sender->getName()] = $args[3];
			$this->line4[$sender->getName()] = $args[4];
			$sender->sendMessage(TF::AQUA."Please tap a sign!");
			break;
		}else{
			$sender->sendMessage("Please do: /signtext <line 1| line 2| line 3| line 4>");
		}
		}
	}
public function onInteract(PlayerInteractEvent $ev){
	$p = $ev->getPlayer();
	$block = $ev->getBlock();
	
	if($block->getID() != 63 && $block->getID() != 68){
	$p->sendMessage(TF::GREEN."Please tap on a sign!");
	return;
	}
if(isset($this->Setter[$p->getName()])){
	 
	if($block instanceof Sign){
	$block->setText($this->line1[$p->getName()],$this->line2[$p->getName()],$this->line3[$p->getName()],$this->line4[$p->getName()]);
	$p->sendMessage(TF::BLUE."Text setted!");
	unset($this->Setter[$p->getName()]);
}
}
}

public function addSetter(Player $p){
	$this->Setter[$p->getName()] = array("Player" => $p->getName());
}
}