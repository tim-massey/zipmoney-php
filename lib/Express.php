<?php
/**
 * @category  ZipMoney
 * @package   ZipMoney_SDK
 * @author    Sagar Bhandari <sagar.bhandari@zipmoney.com.au>
 * @copyright 2015 ZipMoney Payments.
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.zipmoney.com.au/
 */

class ZipMoney_ApiExpress
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

    /*
     * Listen for WebHook Request
     *
     * @param  $params
     */
    public function listen($action_type)
    {
        $data = file_get_contents("php://input");

        if (!$data)
            throw new ZipMoney_Exception("Notification parameters cannot be empty");        

            $params = json_decode($data);

            $this->_processRequest($params,$action_type);
    }


     /*
     * Process WebHook Request
     *
     * @param  $params
     * @param  $action_type
     */
    protected function _processRequest($params,$action_type)
    {
        
        if(!$this->_validateCredentials($params->merchant_id,$params->merchant_key))
            throw new ZipMoney_Exception("Merchant Credentials donot match");
        print_r($params);
        switch ($action_type) {
            case self::ACTION_RESPONSE_TYPE_GET_SHIPPING_METHODS:

                 $this->_actionGetShippingMethods($params);
                break;
           
            case self::ACTION_RESPONSE_TYPE_GET_QUOTE_DETAILS:
                
                 $this->_actionGetQuoteDetails($params);
                break;
           
            case self::ACTION_RESPONSE_TYPE_CONFIRM_SHIPPING_METHOD:

                 $this->_actionConfirmShippingMethods($params);
                break;
               
            case self::ACTION_RESPONSE_TYPE_CONFIRM_ORDER:
                 $this->_actionConfirmOrder($params);
                break;
           
            default:

                break;
        }

    }

    /*
     * Process get shipping methods call from the api.
     *
     * @param  $params
     */
    protected function _actionGetShippingMethods($params){}
   
    /*
     * Process confirm shipping method call from the api.
     *
     * @param  $params
     */
    protected function _actionConfirmShippingMethods($params){}

    /**
     * Process confirm order  call from the api.
     *
     * @param  $params
     */
    protected function _actionConfirmOrder($params){}

    /**
     * Process finalise orderd call from the api.
     *
     * @param  $params
     */
    protected function _actionFinaliseOrder($params){}

    /**
     * Process get quote details  call from the api.
     *
     * @param  $params
     */
    protected function _actionGetQuoteDetails($params){}
    
}