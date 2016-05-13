<?php

error_reporting(E_ALL);
ini_set("display_errors",1);


use zipMoney\Request;
use zipMoney\Exception;
use zipMoney\Configuration;
use zipMoney\Webhook\Webhook;


require_once dirname(__FILE__).'/vendor/autoload.php';

Configuration::$merchant_id  = 4;
Configuration::$merchant_key = "4mod1Yim1GEv+D5YOCfSDT4aBEUZErQYMJ3EtdOGhQY=";
Configuration::$environment  = Configuration::ENVIRONMENT_TEST;

class ZipMoneyWebHook extends Webhook
{
    
}


try{
  $webhookTest  = new ZipMoneyWebHook();
  $webhookTest->listen();
} catch(Exception $e){
  echo $e->getMessage();
}