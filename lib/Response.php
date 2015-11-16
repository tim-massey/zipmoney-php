<?php
/**
 * @category  ZipMoney
 * @package   ZipMoney_SDK
 * @author    Sagar Bhandari <sagar.bhandari@zipmoney.com.au>
 * @copyright 2015 ZipMoney Payments.
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.zipmoney.com.au/
 */

class ZipMoney_Response 
{
    private $_response       = null;

    private $_responseBody   = null;

    private $_responseHeader = null;

    private $_statusCode     = null;

    public function __construct($response)
    {
        
        if(!isset($response) || empty($response)) 
            throw new  ZipMoney_Exception("Response Empty", 1);
        
        $this->_statusCode   = $response['status'];
        $this->_responseBody = $response['body'];
        $this->_responseHeader = $response['header'];

    }


    public function toArray()
    {   
        
        if(!$this->_responseBody)
          return false;
       
        return $this->_objectToArray(json_decode($this->_responseBody)); 
    }


    public function toObject()
    {   
        
        if(!$this->_responseBody)
          return false;
       
        return json_decode($this->_responseBody); 
    }


    private function _objectToArray($d)
    {

        if (is_object($d)) {
            $d = get_object_vars($d);
        }
    
        if (is_array($d)) {
            return array_map(array($this,__FUNCTION__), $d);
        }
        else {
            return $d;
        }
    }

    public function getRedirectUrl()
    {
        $responseArray = $this->toArray();

       return isset($responseArray['redirect_url']) && !empty($responseArray['redirect_url']) ? $responseArray['redirect_url']:null; 
    }

    public function getStatusCode()
    {
        return $this->_statusCode;
    }

}
