<?php
namespace zipMoney;

use zipMoney\Configuration;
use zipMoney\Api;

/**
 * @category  ZipMoney
 * @package   ZipMoney_SDK
 * @author    Sagar Bhandari <sagar.bhandari@zipmoney.com.au>
 * @copyright 2015 ZipMoney Payments.
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.zipmoney.com.au/
 */

class Gateway
{
   private static $_api, $_config, $_webhook, $_express;

   public static function api()
   {

    if(!isset(self::$_api) && !self::$_api instanceof Api)
      self::configure_api();

    return self::$_api;
   }

   public static function webhook(){}

   public static function express(){}
   
   public static function configure_api()
   {

    self::$_api = new Api();

   }   
}