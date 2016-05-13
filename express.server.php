<?php

error_reporting(E_ALL);
ini_set("display_errors",1);


use zipMoney\Request;
use zipMoney\Exception;
use zipMoney\Configuration;
use zipMoney\Webhook\Express;


require_once dirname(__FILE__).'/vendor/autoload.php';

Configuration::$merchant_id  = 4;
Configuration::$merchant_key = "4mod1Yim1GEv+D5YOCfSDT4aBEUZErQYMJ3EtdOGhQY=";
Configuration::$environment  = Configuration::ENVIRONMENT_TEST;

class ZipMoneyExpress extends Express
{
    protected function _actionGetQuoteDetails($params)
    {
      $response = array("_actionGetQuoteDetails");

      $this->sendResponse($response);

    }


    protected function _actionGetShippingMethods($params)
    {
      $response = array("_actionGetShippingMethods");

      $this->sendResponse($response);

    }

    protected function _actionConfirmShippingMethods($params)
    {
      $response = array("_actionConfirmShippingMethods");

      $this->sendResponse($response);

    }

    protected function _actionConfirmOrder($params)
    {
      $response = array("_actionConfirmOrder");

      $this->sendResponse($response);

    }

}

try{

  $expressTest  = new ZipMoneyExpress();

  $action = trim($_GET['action']);
  $expressTest->listen($action);

 


} catch(Exception $e){
  echo $e->getMessage();
}