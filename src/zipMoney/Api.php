<?php
/**
 * @category  ZipMoney
 * @package   ZipMoney_SDK
 * @author    Sagar Bhandari <sagar.bhandari@zipmoney.com.au>
 * @copyright 2015 ZipMoney Payments.
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.zipmoney.com.au/
 */

namespace zipMoney;

use zipMoney\Helper\Util;

class Api
{
    protected $_config = null;
    
    protected $_merchantId  = null;
    
    protected $_merchantKey = null;
    
    protected $_client = null;

    private   $_options = array();
    
    private   $_type = array("json" => "application/json","xml"=>"application/xml");

    const   USER_AGENT  = "ZipMoney PHP SDK";

    const   API_VERSION = "1.0.0";


    /**
     * @param $environment
     * @param $merchantId
     * @param $merchantKey
     * @param $type
     * @param $config
     */
    public function __construct()
    {
       
        $this->_setApiHeaders("json");

    }

    /**
     * Call ZipMoney API endpoint
     *
     * @param $method
     * @param $params
     * @param int $timeout
     * @return ZipMoney_Response
     * @throws ZipMoney_Exception_Http
     */
    public function request($resource, $payload = null, $timeout = 60)
    {
        
        $method   = isset($payload) ? "POST" : "GET";

        $resource = Resource::get($resource,$method,$this->_options);

        if(!isset($resource) || empty($resource))
            throw new \Exception("Api resource not available", 1);

        $payload = Util::objectToArray($payload);

        $payload = Util::prepareRequest($payload);

        $payload = $this->append_api_credentials($payload);
        
        if($method == "POST" ){      
          $response = $resource->post($payload);
        }     
        else {
          $response  = $resource->get($payload);
        }


       return new Response($response);
    }


    /**
     * Call checkout method on the endpoint
     *
     * @param  $params
     * @return Response
     */
    public function checkout($params)
    {

     return $this->request(Resource::RESOURCE_CHECKOUT, $params);
    }

    /**
     * Call cancel method on the endpoint
     *
     * @param  $params
     * @return Response
     */
    public function cancel($params)
    {               
        return $this->request(Resource::RESOURCE_ORDER_CANCEL, $params);
    }

    /**
     * Call quote method on the endpoint
     *
     * @param  $params
     * @return Response
     */
    public function quote($params)
    {        
        return $this->request(Resource::RESOURCE_QUOTE,$params);
    }

    /**
     * Call refund method on the endpoint
     *
     * @param  $params
     * @return Response
     */
    public function refund($params)
    {
        return $this->request(Resource::RESOURCE_ORDER_REFUND, $params);
    }

    
    /**
     * Call query method on the endpoint
     *
     * @param  $params
     * @return Response
     */
    public function query($params)
    {       
        return $this->request(Resource::RESOURCE_QUERY, $params);
    } 

    /**
     * Call capture method on the endpoint
     *
     * @param  $params
     * @return Response
     */
    public function capture($params)
    {       
        return $this->request(Resource::RESOURCE_CAPTURE, $params);
    }

    /**
     * Call settings method on the endpoint
     *
     * @param  $params
     * @return Response
     */
    public function settings($params)
    {        
        return $this->request(Resource::RESOURCE_SETTINGS, $params);
    }

    /**
     * Call configure method on the endpoint
     *
     * @param  $params
     * @return Response
     */
    public function configure($params)
    {    
        return $this->request(Resource::RESOURCE_CONFIGURE, $params);
    }

    /**
     * Call heartbeat method on the endpoint
     *
     * @return zipMoney\Response
     */
    public function heartbeat()
    {
        return $this->request(Resource::RESOURCE_HEARBEAT, $params);
    }

    /**
     * Add Http Headers   
     *  
     * @param $type
     */
    protected function _setApiHeaders($type)
    {
         
        $this->_options['headers'][] = 'Accept: '.$this->_type[$type];
        $this->_options['headers'][] = 'Content-Type: '.$this->_type[$type];
        $this->_options['headers'][] = 'User-Agent: ' . self::USER_AGENT;
        $this->_options['headers'][] = 'Api-Version: ' . self::API_VERSION;

    }

    /**
     * 
     * Add ZipMoney API keys to the request, if not already
     * @param $payload
     * @return array
     */
    protected  function append_api_credentials($payload)
    {

        if (!isset($payload['merchant_id'])) {
            $payload['merchant_id']  = Configuration::$merchant_id;
        }

        if (!isset($payload['merchant_key'])) { 
            $payload['merchant_key'] = Configuration::$merchant_key;
        }

      return $payload;
    }

   
    
}