<?php
namespace zipMoney\Tests;

use zipMoney\Request;
use zipMoney\Exception;
use zipMoney\Configuration;
use zipMoney\Webhook\Webhook;

require_once dirname(__DIR__).'/vendor/autoload.php';

/**
 * @category  ZipMoney
 * @package   ZipMoney_SDK
 * @author    Sagar Bhandari <sagar.bhandari@zipmoney.com.au>
 * @copyright 2015 ZipMoney Payments.
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.zipmoney.com.au/
 */

class ExpressTest extends TestZipMoney
{
    public $webhook_url = "local.zipmoney.com.au/zipMoney-php-sdk/express.server.php";

    public function testGetQuoteDetails()
    {
      $ch = curl_init( $this->webhook_url . "?action=quotedetails");
      $payload = array("merchant_id"=>4,"merchant_key"=>"4mod1Yim1GEv+D5YOCfSDT4aBEUZErQYMJ3EtdOGhQY=");
     
      curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($payload) );
      curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
      curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
      $result = curl_exec($ch);
      $status = curl_getinfo($ch,CURLINFO_HTTP_CODE);
      curl_close($ch);
      $this->assertEquals(200,$status);
    
    } 

    public function testParametersValidation()
    {
      $ch = curl_init( $this->webhook_url . "?action=quotedetails");
      $payload = array("merchant_id"=>4,"merchant_key"=>"4mod1Yim1GEv+D5YOCfSDT4aBEUZErQYMJ3EtdOGhQY=");
     
      //curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($payload) );
      curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
      curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
      $result = curl_exec($ch);
      $status = curl_getinfo($ch,CURLINFO_HTTP_CODE);
      curl_close($ch);
      $this->assertEquals("Notification parameters cannot be empty",$result);
      $this->assertEquals(200,$status);
    } 


    public function testMechantIdValid()
    {
      $ch = curl_init( $this->webhook_url . "?action=quotedetails");
      $payload = array("merchant_id"=>45,"merchant_key"=>"4mod1Yim1GEv+D5YOCfSDT4aBEUZErQYMJ3EtdOGhQY=");
     
      curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($payload) );
      curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
      curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
      $result = curl_exec($ch);
      $status = curl_getinfo($ch,CURLINFO_HTTP_CODE);
      curl_close($ch);
      $this->assertEquals("Merchant Credentials donot match",$result);
      $this->assertEquals(200,$status);
    
    } 

    public function testShippingMethods()
    {
            $ch = curl_init( $this->webhook_url . "?action=shippingmethods");
      $payload = array("merchant_id"=>4,"merchant_key"=>"4mod1Yim1GEv+D5YOCfSDT4aBEUZErQYMJ3EtdOGhQY=");
     
      curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($payload) );
      curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
      curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
      $result = curl_exec($ch);
      $status = curl_getinfo($ch,CURLINFO_HTTP_CODE);
      curl_close($ch);
      $this->assertEquals(200,$status);
    
    } 
    
    public function testConfirmShippingMethods()
    {
      $ch = curl_init( $this->webhook_url . "?action=confirmshippingmethod");
      $payload = array("merchant_id"=>4,"merchant_key"=>"4mod1Yim1GEv+D5YOCfSDT4aBEUZErQYMJ3EtdOGhQY=");
     
      curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($payload) );
      curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
      curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
      $result = curl_exec($ch);
      $status = curl_getinfo($ch,CURLINFO_HTTP_CODE);
      curl_close($ch);
      $this->assertEquals(200,$status);
    
    } 

    public function testConfirmOrder()
    {
      $ch = curl_init( $this->webhook_url . "?action=confirmorder");
      $payload = array("merchant_id"=>4,"merchant_key"=>"4mod1Yim1GEv+D5YOCfSDT4aBEUZErQYMJ3EtdOGhQY=");
     
      curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($payload) );
      curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
      curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
      $result = curl_exec($ch);
      $status = curl_getinfo($ch,CURLINFO_HTTP_CODE);
      curl_close($ch);
      $this->assertEquals(200,$status);
    
    } 
} 