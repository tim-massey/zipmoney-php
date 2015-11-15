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
class ZipMoney_ResponseTest extends ZipMoneyTestMain
{

    public function testResponseCode()
    {

        $http     = new ZipMoney_Http($this->zApiConfig->getApiBaseUrl());
        $http->setHttpHeader($this->_apiHeaders);

        $response = $http->post($this->zApiConfig->getPath("merchant_settings"),$this->params);
        $rObj     = new ZipMoney_Response($response);

        $this->assertEquals(200,$rObj->getStatusCode(),"Not a succcess");

        $response = $http->post($this->zApiConfig->getPath("merchant_settings"));
        $rObj     = new ZipMoney_Response($response);

        $this->assertEquals(500,$rObj->getStatusCode());
    }
    
    public function testToArray()
    {
        $http     = new ZipMoney_Http($this->zApiConfig->getApiBaseUrl());
        $http->setHttpHeader($this->_apiHeaders);

        $response = $http->post($this->zApiConfig->getPath("merchant_settings"),$this->params);
        $rObj     = new ZipMoney_Response($response);
        $this->assertTrue(is_array($rObj->toArray()));

    }


    public function testToObject()
    {

        $http     = new ZipMoney_Http($this->zApiConfig->getApiBaseUrl());
        $http->setHttpHeader($this->_apiHeaders);

        $response = $http->post($this->zApiConfig->getPath("merchant_settings"),$this->params);
        $rObj     = new ZipMoney_Response($response);
        $this->assertTrue(is_object($rObj->toObject()));

    }

}