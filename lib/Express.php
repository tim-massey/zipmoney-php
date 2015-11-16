<?php
/**
 * @category  ZipMoney
 * @package   ZipMoney_SDK
 * @author    Sagar Bhandari <sagar.bhandari@zipmoney.com.au>
 * @copyright 2015 ZipMoney Payments.
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.zipmoney.com.au/
 */

class ZipMoney_Api_Express
{
    const ACTION_RESPONSE_TYPE_GET_SHIPPING_METHODS     = 'get_shipping_methods';
    const ACTION_RESPONSE_TYPE_GET_QUOTE_DETAILS        = 'get_quote_details';
    const ACTION_RESPONSE_TYPE_CONFIRM_SHIPPING_METHOD  = 'confirm_shipping_method';
    const ACTION_RESPONSE_TYPE_CONFIRM_ORDER            = 'confirm_order';
    const ACTION_RESPONSE_TYPE_FINALISE_ORDER           = 'finalise_order';
    const ACTION_RESPONSE_TYPE_CANCEL_QUOTE             = 'cancel_quote';
    
    private $_merchantId  = null;

    private $_merchantKey = null;

    public function __construct($merchantId, $merchantKey)
    {
        
        $this->_merchantId  = $merchantId;

        $this->_merchantKey = $merchantKey;

    }

    private function _validateCredentials($merchantId,$merchantKey)
    {

        if($merchantId == $this->_merchantId && $merchantKey == $this->_merchantKey){
            return true;
        }
        else{
            return false;
        }
        
    }


    private function _validateToken($merchantId,$merchantKey)
    {

        if($merchantId == $this->_merchantId && $merchantKey == $this->_merchantKey){
            return true;
        }
        else{
            return false;
        }
        
    }


    /*
     * Call checkout method on the endpoint
     *
     * @param  $orderArray
     * @return ZipMoney_Response
     * @throws ZipMoney_Exception_Http
     */
    public function getShippingMethods($orderArray)
    {
       $method = $this->_apiConfig->getPath(__FUNCTION__);
       
       if(!is_array($orderArray))
            throw new ZipMoney_Exception("Argument should be an array", 1);

    return $this->_request($method, $orderArray);
    }

    /**
     * Call cancel method on the endpoint
     *
     * @param  $cancelArray
     * @return ZipMoney_Response
     * @throws ZipMoney_Exception_Http
     */
    public function confirmOrder($cancelArray)
    {       
       $method = $this->_apiConfig->getPath("order_cancel");
        
        if(!is_array($cancelArray))
            throw new ZipMoney_Exception("Argument should be an array", 1);

    return $this->_request($method,$cancelArray);
    }

    /**
     * Call quote method on the endpoint
     *
     * @param  $quoteArray
     * @return ZipMoney_Response
     * @throws ZipMoney_Exception_Http
     */
    public function finaliseOrder($quoteArray)
    {        
        $method = $this->_apiConfig->getPath("quote_quote");

        if(!is_array($quoteArray))
            throw new ZipMoney_Exception("Argument should be an array", 1);

    return $this->_request($method,$quoteArray);
    }

    /**
     * Call refund method on the endpoint
     *
     * @param  $refundArray
     * @return ZipMoney_Response
     * @throws ZipMoney_Exception_Http
     */
    public function getQuoteDetails($refundArray)
    {
        $method = $this->_apiConfig->getPath(__FUNCTION__);
        
        if(!is_array($refundArray))
            throw new ZipMoney_Exception("Argument should be an array", 1);

    return $this->_request($method,$refundArray);
    }

    
    
}