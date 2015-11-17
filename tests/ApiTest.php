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
class ZipMoney_ApiTest extends ZipMoneyTestMain
{

    private static $_current_order_id = null;

    private static $_txn_id = null;


    public function testCheckout()
    {
        $input = (array)json_decode(file_get_contents("./tests/fixtures/checkout.json"));
        $input['order_id'] = rand(10000,9999999);   
        self::$_current_order_id = $input['order_id'];
        $input['order']->id =  self::$_current_order_id;   
       // $input['metadata']->scenario  = 7;

        $response = $this->zApi->checkout($input);
        $responseArray = $response->toArray();

        self::$_txn_id = $responseArray['txn_id'];

        $this->assertEquals(201,$response->getStatusCode());        // Check if the response code is 201
        $this->assertTrue(!empty($responseArray['redirect_url']));  // Check if redirect_url is set
        $this->assertTrue(!empty($responseArray['txn_id']));        // Check if txn_id is set
        $this->assertEquals('New', $responseArray['status']);       // Check if status value is 'New'
        
       // print_r($responseArray);

        $response = $this->zApi->checkout($input);
        $this->assertEquals(409,$response->getStatusCode());        // Check returns duplicate return 409

    }


    public function testQuote()
    {

        $input = (array)json_decode(file_get_contents("./tests/fixtures/quote.json"));
        $input['order_id']  =  self::$_current_order_id;   
        $input['order']->id =  self::$_current_order_id;   
        $input['txn_id']    =  self::$_txn_id;   

        // Check success   returns 201
        $response = $this->zApi->quote($input);
        $responseArray = $response->toArray();
        
        $this->assertEquals(200,$response->getStatusCode());        // Check if the response code is 201
        $this->assertTrue(!empty($responseArray['redirect_url']));  // Check if redirect_url is set
        $this->assertTrue(!empty($responseArray['quote_id']));      // Check if quote_id is set

    } 


    public function testQuery()
    {

        $input = (array)json_decode(file_get_contents("./tests/fixtures/query.json"));
        $input['orders'][0]->id     =  self::$_current_order_id;   
        $input['orders'][0]->txn_id =  self::$_txn_id;   

        // Check success   returns 201
        $response = $this->zApi->query($input);
        $responseArray = $response->toArray();

        //print_r($responseArray);

        $this->assertEquals(201,$response->getStatusCode());                                          // Check if the response code is 201
        $this->assertEquals('Order not found',$responseArray['order_statuses'][0]['error_message']);  // Check for error_message if new order
        $this->assertEquals('New',$responseArray['order_statuses'][0]['status']);                     // Check if status is true

        $input['orders'][0]->id     = 2190145;   

        $response      = $this->zApi->query($input);
        $responseArray = $response->toArray();

        //print_r($responseArray);

        $this->assertEquals(201,$response->getStatusCode());                           // Check if the response code is 201
        $this->assertEmpty($responseArray['order_statuses'][0]['error_message']);      // Check if error_message is null
        $this->assertEquals('Refunded',$responseArray['order_statuses'][0]['status']); // Check if status is true
        $this->assertTrue(!empty($responseArray['order_statuses'][0]['txn_id']));      // Check if txn_id is set

    } 

    public function testCancel()
    {

        $input = (array)json_decode(file_get_contents("./tests/fixtures/cancel.json"));
        $input['order_id']  =  self::$_current_order_id;   
        $input['order']->id =  self::$_current_order_id;   
        $input['txn_id']    =  self::$_txn_id;   

        $response = $this->zApi->cancel($input);
        $responseArray = $response->toArray();
        
        print_r($responseArray);

        $this->assertEquals(201,$response->getStatusCode());        // Check if the response code is 201
        $this->assertEquals('Review', $responseArray['status']);  // Check if status value is 'Cancelled'

    }
     
    public function testRefund()
    {

        $input = (array)json_decode(file_get_contents("./tests/fixtures/refund.json"));
        $input['order_id']  =  self::$_current_order_id;   
        $input['order']->id =  self::$_current_order_id;   
        $input['txn_id']    = '2105-yE1xB0btXw';// self::$_txn_id;   

        // Check success   returns 201
        $response = $this->zApi->refund($input);
        $responseArray = $response->toArray();

      //  print_r($input);
        print_r($responseArray);

        $this->assertEquals(201,$response->getStatusCode());        // Check if the response code is 201
        $this->assertTrue(!empty($responseArray['redirect_url']));  // Check if redirect_url is set
        $this->assertTrue(!empty($responseArray['quote_id']));      // Check if quote_id is set

    }


    public function testCapture()
    {
        
    
        $input = (array)json_decode(file_get_contents("./tests/fixtures/capture.json"));
        $input['order_id']  = self::$_current_order_id;   
        $input['order']->id = self::$_current_order_id;   
        $input['txn_id']    = self::$_txn_id;   

        // Check success   returns 201
        $response = $this->zApi->capture($input);
        $responseArray = $response->toArray();

        print_r($responseArray);

        $this->assertEquals(201,$response->getStatusCode());                                          // Check if the response code is 201
        

        $input['order_id']  =  2190145;
        $input['order']->id =  2190145; 
        $input['txn_id']    = '2105-yE1xB0btXw';// self::$_txn_id;   


        $response      = $this->zApi->capture($input);
        $responseArray = $response->toArray();


        $this->assertEquals(201,$response->getStatusCode());                           // Check if the response code is 201
     
     }

    public function testConfigure()
    {
        
        $input = (array)json_decode(file_get_contents("./tests/fixtures/configure.json"));
        $response      = $this->zApi->configure($input);
        $responseArray = $response->toArray();


        $this->assertEquals(200,$response->getStatusCode());        // Check if the response code is 201
    
    }
    
    public function testSettings()
    {
        
        $input = (array)json_decode(file_get_contents("./tests/fixtures/configure.json"));
        $response      = $this->zApi->settings($input);
        $responseArray = $response->toArray();

        $this->assertEquals(200,$response->getStatusCode());        // Check if the response code is 201

    }
    
    public function testHeartbeat()
    {
        
        $response      = $this->zApi->heartbeat();
        $responseArray = $response->toArray();

        $this->assertEquals(200,$response->getStatusCode());        // Check if the response code is 201

    }
    
} 