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
class ZipMoney_ApiConfigTest extends ZipMoneyTestMain
{

    public function testCanGetUrl()
    {
        //Testing Sandbox Urls
        $this->assertEquals("https://api.sandbox.zipmoney.com.au/v1/settings", $this->zApiConfig->getUrl( ZipMoney_ApiConfig::API_TYPE_MERCHANT_SETTINGS,ZipMoney_ApiConfig::ENVIRONMENT_TEST));
        $this->assertEquals("https://api.sandbox.zipmoney.com.au/v1/Heartbeat", $this->zApiConfig->getUrl( ZipMoney_ApiConfig::API_TYPE_HEART_BEAT,ZipMoney_ApiConfig::ENVIRONMENT_TEST));        
        $this->assertEquals("https://api.sandbox.zipmoney.com.au/v1/configure", $this->zApiConfig->getUrl( ZipMoney_ApiConfig::API_TYPE_MERCHANT_CONFIGURE,ZipMoney_ApiConfig::ENVIRONMENT_TEST));
        $this->assertEquals("https://api.sandbox.zipmoney.com.au/v1/checkout", $this->zApiConfig->getUrl( ZipMoney_ApiConfig::API_TYPE_CHECKOUT,ZipMoney_ApiConfig::ENVIRONMENT_TEST));
        $this->assertEquals("https://api.sandbox.zipmoney.com.au/v1/quote", $this->zApiConfig->getUrl( ZipMoney_ApiConfig::API_TYPE_QUOTE_QUOTE,ZipMoney_ApiConfig::ENVIRONMENT_TEST));
        $this->assertEquals("https://api.sandbox.zipmoney.com.au/v1/order", $this->zApiConfig->getUrl( ZipMoney_ApiConfig::API_TYPE_ORDER_SHIPPING_ADDRESS,ZipMoney_ApiConfig::ENVIRONMENT_TEST));
        $this->assertEquals("https://api.sandbox.zipmoney.com.au/v1/cancel", $this->zApiConfig->getUrl( ZipMoney_ApiConfig::API_TYPE_ORDER_CANCEL,ZipMoney_ApiConfig::ENVIRONMENT_TEST));
        $this->assertEquals("https://api.sandbox.zipmoney.com.au/v1/refund", $this->zApiConfig->getUrl( ZipMoney_ApiConfig::API_TYPE_ORDER_REFUND,ZipMoney_ApiConfig::ENVIRONMENT_TEST));

        //Testing Production Urls
        $this->assertEquals("https://api.zipmoney.com.au/v1/settings", $this->zApiConfig->getUrl( ZipMoney_ApiConfig::API_TYPE_MERCHANT_SETTINGS,ZipMoney_ApiConfig::ENVIRONMENT_LIVE));
        $this->assertEquals("https://api.zipmoney.com.au/v1/Heartbeat", $this->zApiConfig->getUrl( ZipMoney_ApiConfig::API_TYPE_HEART_BEAT,ZipMoney_ApiConfig::ENVIRONMENT_LIVE));        
        $this->assertEquals("https://api.zipmoney.com.au/v1/configure", $this->zApiConfig->getUrl( ZipMoney_ApiConfig::API_TYPE_MERCHANT_CONFIGURE,ZipMoney_ApiConfig::ENVIRONMENT_LIVE));
        $this->assertEquals("https://api.zipmoney.com.au/v1/checkout", $this->zApiConfig->getUrl( ZipMoney_ApiConfig::API_TYPE_CHECKOUT,ZipMoney_ApiConfig::ENVIRONMENT_LIVE));
        $this->assertEquals("https://api.zipmoney.com.au/v1/quote", $this->zApiConfig->getUrl( ZipMoney_ApiConfig::API_TYPE_QUOTE_QUOTE,ZipMoney_ApiConfig::ENVIRONMENT_LIVE));
        $this->assertEquals("https://api.zipmoney.com.au/v1/order", $this->zApiConfig->getUrl( ZipMoney_ApiConfig::API_TYPE_ORDER_SHIPPING_ADDRESS,ZipMoney_ApiConfig::ENVIRONMENT_LIVE));
        $this->assertEquals("https://api.zipmoney.com.au/v1/cancel", $this->zApiConfig->getUrl( ZipMoney_ApiConfig::API_TYPE_ORDER_CANCEL,ZipMoney_ApiConfig::ENVIRONMENT_LIVE));
        $this->assertEquals("https://api.zipmoney.com.au/v1/refund", $this->zApiConfig->getUrl( ZipMoney_ApiConfig::API_TYPE_ORDER_REFUND,ZipMoney_ApiConfig::ENVIRONMENT_LIVE));

        
    }
    
    public function testCanGetPath()
    {
        $this->assertEquals("settings", $this->zApiConfig->getPath( ZipMoney_ApiConfig::API_TYPE_MERCHANT_SETTINGS));
        $this->assertEquals("Heartbeat", $this->zApiConfig->getPath( ZipMoney_ApiConfig::API_TYPE_HEART_BEAT));        
        $this->assertEquals("configure", $this->zApiConfig->getPath( ZipMoney_ApiConfig::API_TYPE_MERCHANT_CONFIGURE));
        $this->assertEquals("checkout", $this->zApiConfig->getPath( ZipMoney_ApiConfig::API_TYPE_CHECKOUT));
        $this->assertEquals("quote", $this->zApiConfig->getPath( ZipMoney_ApiConfig::API_TYPE_QUOTE_QUOTE));
        $this->assertEquals("order", $this->zApiConfig->getPath( ZipMoney_ApiConfig::API_TYPE_ORDER_SHIPPING_ADDRESS));
        $this->assertEquals("cancel", $this->zApiConfig->getPath( ZipMoney_ApiConfig::API_TYPE_ORDER_CANCEL));
        $this->assertEquals("refund", $this->zApiConfig->getPath( ZipMoney_ApiConfig::API_TYPE_ORDER_REFUND));
 
    }

    

}