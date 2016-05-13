<?php
namespace zipMoney\Tests;

use \zipMoney\Api;
use \zipMoney\Configuration;

require_once dirname(__DIR__).'/vendor/autoload.php';
/**
 * @category  ZipMoney
 * @package   ZipMoney_SDK
 * @author    Sagar Bhandari <sagar.bhandari@zipmoney.com.au>
 * @copyright 2015 ZipMoney Payments.
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.zipmoney.com.au/
 */

class TestZipMoney extends  \PHPUnit_Framework_TestCase
{
  protected $_current_order_id;
  
  protected $_txn_id;


  public function setUp(){ 

    $this->zApi         = new Api(4,"4mod1Yim1GEv+D5YOCfSDT4aBEUZErQYMJ3EtdOGhQY=",Configuration::ENVIRONMENT_TEST);
    $this->zApiConfig   = new Configuration(Configuration::ENVIRONMENT_TEST);
    $this->params       = array("merchant_id" => 4, "merchant_key" => "4mod1Yim1GEv+D5YOCfSDT4aBEUZErQYMJ3EtdOGhQY=");

	  $this->_apiHeaders[] = 'Accept: application/json';
	  $this->_apiHeaders[] = 'Content-Type: application/json';

    Configuration::$merchant_id  = 4;
    Configuration::$merchant_key = "4mod1Yim1GEv+D5YOCfSDT4aBEUZErQYMJ3EtdOGhQY=";
    Configuration::$environment  = Configuration::ENVIRONMENT_TEST;

    $this->_current_order_id = rand(10000,9999999);

  }
  
  public function tearDown(){
  	
  }

}