<?php
namespace zipMoney\Tests;

use zipMoney\Request;
use zipMoney\Exception;
use zipMoney\Configuration;
use zipMoney\Api\Checkout;
use zipMoney\Api\Quote;
use zipMoney\Api\Refund;
use zipMoney\Api\Cancel;
use zipMoney\Api\Capture;
use zipMoney\Api\Settings;
use zipMoney\Api\Configure;
use zipMoney\Api\Query;

require_once dirname(__DIR__).'/vendor/autoload.php';

/**
 * @category  ZipMoney
 * @package   ZipMoney_SDK
 * @author    Sagar Bhandari <sagar.bhandari@zipmoney.com.au>
 * @copyright 2015 ZipMoney Payments.
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.zipmoney.com.au/
 */

class ApiTest extends TestZipMoney
{

    public function testCheckout()
    {
      $checkout = new Checkout();

      $checkout->request->charge = false;
      $checkout->request->currency_code = "AUD";
      $checkout->request->txn_id = false;
      $checkout->request->order_id =  $this->_current_order_id;
      $checkout->request->in_store = false;

      $checkout->request->cart_url    = "https://your-domain/checkout/cart/";
      $checkout->request->success_url = "https://your-domain/checkout/success/";
      $checkout->request->cancel_url  = "https://your-domain/zipmoney/express/cancel/";
      $checkout->request->error_url   = "https://your-domain/zipmoney/express/error/";
      $checkout->request->refer_url   = "https://your-domain/zipmoney/express/refer/";
      $checkout->request->decline_url = "https://your-domain/zipmoney/express/decline/";

      $checkout->request->order            = Request::Order(1,2,3,4);
      $checkout->request->order->detail[]  = Request::OrderDetail(10758,"GoPro Hero3+ Silver Edition - Silver",null, 1, 222,339.5,null);
      $checkout->request->order->detail[]  = Request::OrderDetail(10758,"GoPro Hero3+ Silver Edition - Silver11",null, 1, 333, 539.5,null);


      $checkout->request->billing_address  = Request::Address("firstname","lastname","address line 1","address line 1","Australia","postcode","Sydney","NSW");
      $checkout->request->shipping_address = Request::Address("firstname","lastname","address line 1","address line 1","Australia","postcode","Sydney","NSW");
      $checkout->request->consumer         = Request::Consumer("firstname","lastname","1234567890","your-email@email.com",1, "0001-01-01T00:00:00","title");

      try{

        $response      = $checkout->process();
        $responseArray = $response->toArray();

        $this->txn_id  = $responseArray['txn_id'];
          //  print_r($responseArray);

        $this->assertTrue($response->isSuccess());                  // Check if the response is success
        $this->assertEquals(201,$response->getStatusCode());        // Check if the response code is 201
        $this->assertTrue(!empty($responseArray['redirect_url']));  // Check if redirect_url is set
        $this->assertTrue(!empty($responseArray['txn_id']));        // Check if txn_id is set
        $this->assertEquals('New', $responseArray['status']);       // Check if status value is 'New'

      } catch (Exception $e){
        print_r($e->getMessage());
      }

    }

    public function testQuote()
    {

      $quote = new Quote();

      $quote->request->currency_code = "AUD";
      $quote->request->txn_id        = 2112;
      $quote->request->quote_id      = "91005500";

      $quote->request->cart_url    = "https://your-domain/checkout/cart/";
      $quote->request->success_url = "https://your-domain/checkout/success/";
      $quote->request->cancel_url  = "https://your-domain/zipmoney/express/cancel/";
      $quote->request->error_url   = "https://your-domain/zipmoney/express/error/";
      $quote->request->refer_url   = "https://your-domain/zipmoney/express/refer/";
      $quote->request->decline_url = "https://your-domain/zipmoney/express/decline/";

      $quote->request->order            = Request::Order(1,2,3,4);
      $quote->request->order->detail[]  = Request::OrderDetail(10758,"GoPro Hero3+ Silver Edition - Silver",null, 1, 222,339.5,null);
      $quote->request->order->detail[]  = Request::OrderDetail(10758,"GoPro Hero3+ Silver Edition - Silver11",null, 1, 333, 539.5,null);

      $quote->request->billing_address  = Request::Address("firstname","lastname","address line 1","address line 1","Australia","postcode","Sydney","NSW");
      $quote->request->shipping_address = Request::Address("firstname","lastname","address line 1","address line 1","Australia","postcode","Sydney","NSW");
      $quote->request->consumer         = Request::Consumer("firstname","lastname","1234567890","your-email@email.com",1, "0001-01-01T00:00:00","title");


      try{
        $response = $quote->process();
        $responseArray = $response->toArray();
        $this->assertEquals(201,$response->getStatusCode());        // Check if the response code is 201
        $this->assertTrue(!empty($responseArray['redirect_url']));  // Check if redirect_url is set
        $this->assertTrue(!empty($responseArray['quote_id']));      // Check if quote_id is set

      } catch (Exception $e){
        print_r($e->getMessage());
      }

    }

    public function testRefund()
    {

      $quote = new Refund();

      $quote->request->reason = "Test Reason";
      $quote->request->txn_id = 111;
      $quote->request->order_id = "91005501";

      $quote->request->order   = Request::Order(1,2,3,4);

      try{
        $response = $quote->process();
        $responseArray = $response->toArray();
        
        //print_r($responseArray);

        $this->assertFalse($response->isSuccess());  // Check if redirect_url is set

      } catch (Exception $e){
        print_r($e->getMessage());
      }

    }

    public function testCancel()
    {

      $quote = new Cancel();

      $quote->request->txn_id = 111;
      $quote->request->order_id = "91005501";

      $quote->request->order   = Request::Order(1,2,3,4);


      try{
        $response = $quote->process();
        $responseArray = $response->toArray();
        
       // print_r($responseArray);

        $this->assertFalse($response->isSuccess());  // Check if redirect_url is set

      } catch (Exception $e){
        print_r($e->getMessage());
      }

    }


    public function testCapture()
    {

      $quote = new Capture();

      $quote->request->txn_id = 111;
      $quote->request->order_id = "91005501";

      $quote->request->order   = Request::Order(1,2,3,4);

      try{
        $response = $quote->process();
        $responseArray = $response->toArray();
        //print_r($responseArray);

        $this->assertFalse($response->isSuccess());  // Check if redirect_url is set

      } catch (Exception $e){
        print_r($e->getMessage());
      }

    }


    public function testQuery()
    {

      $quote = new Query();
      $quote->request->orders[] = Request::QueryOrder(694123);

      try{

        $response      = $quote->process();
        $responseArray = $response->toArray();

      //  print_r($responseArray);

        $this->assertTrue($response->isSuccess());  // Check if redirect_url is set

      } catch (Exception $e){
        print_r($e->getMessage());
      }

    }


    public function testSettings()
    {

      $settings = new Settings();

      try{

        $response      = $settings->process();
        $responseArray = $response->toArray();

        $this->assertTrue($response->isSuccess());  // Check if redirect_url is set

      } catch (Exception $e){
        print_r($e->getMessage());
      }

    }


    public function testConfigure()
    {

      $configure = new Configure();

      $configure->request->base_url  = "http://localhost1/";

      try{

        $response      = $configure->process();
        $responseArray = $response->toArray();

        $this->assertTrue($response->isSuccess());  // Check if redirect_url is set

      } catch (Exception $e){
        print_r($e->getMessage());
      }

    }
} 