<?php
namespace zipMoney\Tests;

use zipMoney\Http;
use zipMoney\Response;

require_once dirname(__DIR__).'/vendor/autoload.php';

/**
 * @category  ZipMoney
 * @package   ZipMoney_SDK
 * @author    Sagar Bhandari <sagar.bhandari@zipmoney.com.au>
 * @copyright 2015 ZipMoney Payments.
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.zipmoney.com.au/
 */
class ResponseTest extends TestZipMoney
{

    public function testResponseCode()
    {

        $http     = new Http($this->zApiConfig->getApiBaseUrl());
        $http->setHttpHeader($this->_apiHeaders);

        $response = $http->post($this->zApiConfig->getPath("merchant_settings"),$this->params);
        $rObj     = new Response($response);

        $this->assertEquals(200,$rObj->getStatusCode(),"Not a succcess");

        $response = $http->post($this->zApiConfig->getPath("merchant_settings"));
        $rObj     = new Response($response);

        $this->assertEquals(500,$rObj->getStatusCode());
    }
    
    public function testToArray()
    {
        $http     = new Http($this->zApiConfig->getApiBaseUrl());
        $http->setHttpHeader($this->_apiHeaders);

        $response = $http->post($this->zApiConfig->getPath("merchant_settings"),$this->params);
        $rObj     = new Response($response);
        $this->assertTrue(is_array($rObj->toArray()));

    }


    public function testToObject()
    {

        $http     = new Http($this->zApiConfig->getApiBaseUrl());
        $http->setHttpHeader($this->_apiHeaders);

        $response = $http->post($this->zApiConfig->getPath("merchant_settings"),$this->params);
        $rObj     = new Response($response);
        $this->assertTrue(is_object($rObj->toObject()));

    }

    // public function testGetRedirectUrl()
    // {

    //     $http     = new Http($this->zApiConfig->getApiBaseUrl());
    //     $http->setHttpHeader($this->_apiHeaders);

    //     $response = $http->post($this->zApiConfig->getPath("merchant_settings"),$this->params);
    //     $rObj     = new Response($response);
    //     $this->assertTrue(is_object($rObj->toObject()));

    // }

}