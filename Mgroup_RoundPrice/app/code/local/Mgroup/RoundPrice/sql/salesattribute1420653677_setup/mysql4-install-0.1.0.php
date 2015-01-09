<?php
$installer = $this;
$installer->startSetup();

$installer->addAttribute("quote_address", "roundprice_total", array("type"=>"varchar"));
$installer->addAttribute("order", "roundprice_total", array("type"=>"varchar"));
$installer->endSetup();
	 