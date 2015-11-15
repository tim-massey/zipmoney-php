<?php
/**
 * @category  ZipMoney
 * @package   ZipMoney_SDK
 * @author    Sagar Bhandari <sagar.bhandari@zipmoney.com.au>
 * @copyright 2015 ZipMoney Payments.
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.zipmoney.com.au/
 */

class ZipMoney_Api
{
    protected $_apiConfig = null;
    
    protected $_merchantId  = null;
    
    protected $_merchantKey = null;
    
    protected $_client = null;
    
    protected $_params = array();
    
    private   $_apiVersion = "1.0.0";

    private   $_apiHeaders = array();
    
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
    public function __construct($merchantId, $merchantKey, $environment,  $type = "json", $config = null)
    {
        
 
        if(!$merchantId)
            throw new  ZipMoney_Exception_Http("Merchant Id should be provided", 1);

        if(!$merchantKey)
            throw new  ZipMoney_Exception_Http("Merchant Key should be provided", 1);

        if(!$environment)
            throw new  ZipMoney_Exception_Http("Environment should be provided", 1);

        /** @var ZipMoney_ApiSettings $apiSettings */
        $this->_apiConfig   = new ZipMoney_ApiConfig($environment);
        $this->_client      = new ZipMoney_Http($this->_apiConfig->getApiBaseUrl(),$type,$config);



        $this->_merchantId  = $merchantId;
        $this->_merchantKey = $merchantKey;   

        $this->_setApiHeaders($type);

        $this->_client->setHttpHeader($this->_apiHeaders);

    }

    /**
     * Call checkout method on the endpoint
     *
     * @param  $orderArray
     * @return ZipMoney_Response
     * @throws ZipMoney_Exception_Http
     */
    public function checkout($orderArray)
    {
       $method = $this->_apiConfig->getPath(__FUNCTION__);
       
       if(!is_array($orderArray))
            throw new ZipMoney_Exception("Argument should be an array", 1);

    return $this->request($method, $orderArray);
    }

    /**
     * Call quote method on the endpoint
     *
     * @param  $quoteArray
     * @return ZipMoney_Response
     * @throws ZipMoney_Exception_Http
     */
    public function quote($quoteArray)
    {        
        $method = $this->_apiConfig->getPath(__FUNCTION__);

        if(!is_array($quoteArray))
            throw new ZipMoney_Exception("Argument should be an array", 1);

    return $this->request($method,$quoteArray);
    }

    /**
     * Call refund method on the endpoint
     *
     * @param  $refundArray
     * @return ZipMoney_Response
     * @throws ZipMoney_Exception_Http
     */
    public function refund($refundArray)
    {
        $method = $this->_apiConfig->getPath(__FUNCTION__);
        
        if(!is_array($refundArray))
            throw new ZipMoney_Exception("Argument should be an array", 1);

    return $this->request($method,$refundArray);
    }

    /**
     * Call cancel method on the endpoint
     *
     * @param  $cancelArray
     * @return ZipMoney_Response
     * @throws ZipMoney_Exception_Http
     */
    public function cancel($cancelArray)
    {       
       $method = $this->_apiConfig->getPath(__FUNCTION__);
        
        if(!is_array($cancelArray))
            throw new ZipMoney_Exception("Argument should be an array", 1);

    return $this->request($method,$cancelArray);
    }

    /**
     * Call query method on the endpoint
     *
     * @param  $queryArray
     * @return ZipMoney_Response
     * @throws ZipMoney_Exception_Http
     */
    public function query($queryArray)
    {       
        $method = $this->_apiConfig->getPath(__FUNCTION__);
        
        if(!is_array($queryArray))
            throw new ZipMoney_Exception("Argument should be an array", 1);

    return $this->request($method,$queryArray);
    }

    /**
     * Call settings method on the endpoint
     *
     * @param  $queryArray
     * @return ZipMoney_Response
     * @throws ZipMoney_Exception_Http
     */
    public function settings()
    {       
        $method = $this->_apiConfig->getPath(__FUNCTION__);
   
    return $this->request($method,array());
    }

    /**
     * Call heartbeat method on the endpoint
     *
     * @param  $captureArray
     * @return ZipMoney_Response
     * @throws ZipMoney_Exception_Http
     */
    public function hearbeat()
    {
        $method = $this->_apiConfig->getPath(__FUNCTION__);
      
    return  $this->request($method);
    }


    /**
     * Get base url
     *
     * @param $environment
     * @return String
     */
    public function getBaseUrl($environment = null)
    {
        return $this->_apiConfig->getApiBaseUrl($environment);
    }

    /**
     * Get endpoint url
     *
     * @param $type
     * @param $environment
     * @return String
     */
    public function getEndpointUrl($endpointType, $environment = null)
    {
        return $this->_apiConfig->getUrl($endpointType, $environment);
    }


    /**
     * Add Http Headers   
     *  
     * @param $type
     */
    protected function _setApiHeaders($type)
    {
         
         $this->_apiHeaders[] = 'Accept: '.$this->_type[$type];

         $this->_apiHeaders[] = 'Content-Type: '.$this->_type[$type];

         $this->_apiHeaders[] = 'User-Agent: ' . self::USER_AGENT;

         $this->_apiHeaders[] = 'Api-Version: ' . self::API_VERSION;

    }

    /**
     * 
     * Add ZipMoney API keys to the request, if not already
     *
     */
    protected  function _addApiKeys()
    {

        if (!isset($this->_params['merchant_id'])) {
            $this->_params['merchant_id'] = $this->_merchantId;
        }

        if (!isset($this->_params['merchant_key'])) { 
            $this->_params['merchant_key'] = $this->_merchantKey;
        }

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
    protected function _request($method, $params = null, $timeout = 60)
    {
        $config = array('timeout' => $timeout);

        if(!isset($method) || empty($method))
            throw new ZipMoney_Exception("Api method not provided", 1);
        
        $this->_params = $params;
   
        $this->_addApiKeys();

        // if params is provided, consider it as a POST 
        if($params){      

           $response = $this->_client->post($method,$this->_params);
        }     
        else {

           $response = $this->_client->get($method,$this->_params);
        }

       return new ZipMoney_Response($response);
    }

    
}