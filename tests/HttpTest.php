<?php
require_once "ZipMoneyTestMain.php";
/**
 * @category  ZipMoney
 * @package   ZipMoney_SDK
 * @author    Sagar Bhandari <sagar.bhandari@zipmoney.com.au>
 * @copyright 2015 ZipMoney Payments.
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.zipmoney.com.au/
 */
class ZipMoney_HttpTest extends ZipMoneyTestMain
{

    public function testEndpointUrlSet()
    {

    	$http = new ZipMoney_Http("https://api.sandbox.zipmoney.com.au/v1/");
        $http->setHttpHeader($this->_apiHeaders);

  		$this->assertEquals("https://api.sandbox.zipmoney.com.au/v1/", PHPUnit_Framework_Assert::readAttribute($http, '_baseEndpointUrl'));
    }

    public function testCanPost()
    {
    	$http = new ZipMoney_Http($this->zApiConfig->getApiBaseUrl());
        $http->setHttpHeader($this->_apiHeaders);

    	$response = $http->post($this->zApiConfig->getPath("merchant_settings"),$this->params);

    	$this->assertEquals(200,$response['status']);
    }   

 	public function testCanGet()
    {

    	$http = new ZipMoney_Http($this->zApiConfig->getApiBaseUrl());
        $http->setHttpHeader($this->_apiHeaders);

    	$response = $http->get($this->zApiConfig->getPath("heartbeat"));
    	
		$this->assertTrue(true,$response['status']);
    }


}