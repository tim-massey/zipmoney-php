<?php
require_once dirname(__DIR__).'/lib/Http.php';
require_once dirname(__DIR__).'/lib/ApiConfig.php';
require_once dirname(__DIR__).'/lib/Api.php';
require_once dirname(__DIR__).'/lib/Response.php';
require_once dirname(__DIR__).'/lib/Exception.php';
require_once dirname(__DIR__).'/lib/Exception/Http.php';

/**
 * @category  ZipMoney
 * @package   ZipMoney_SDK
 * @author    Sagar Bhandari <sagar.bhandari@zipmoney.com.au>
 * @copyright 2015 ZipMoney Payments.
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.zipmoney.com.au/
 */

class ZipMoneyTestMain extends  PHPUnit_Framework_TestCase
{
  public function setUp(){ 

    $this->zApi         = new ZipMoney_Api(4,"4mod1Yim1GEv+D5YOCfSDT4aBEUZErQYMJ3EtdOGhQY=",ZipMoney_ApiConfig::ENVIRONMENT_TEST);
    $this->zApiConfig   = new ZipMoney_ApiConfig(ZipMoney_ApiConfig::ENVIRONMENT_TEST);
    $this->params       = array("merchant_id" => 4, "merchant_key" => "4mod1Yim1GEv+D5YOCfSDT4aBEUZErQYMJ3EtdOGhQY=");


	$this->_apiHeaders[] = 'Accept: application/json';
	$this->_apiHeaders[] = 'Content-Type: application/json';

  }
  
  public function tearDown(){
  	
  }

}