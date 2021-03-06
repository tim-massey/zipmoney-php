<?php

namespace zipMoney\Webhook;

use zipMoney\Configuration;
use zipMoney\Exception;
/**
 * @category  ZipMoney
 * @package   ZipMoney_SDK
 * @author    Sagar Bhandari <sagar.bhandari@zipmoney.com.au>
 * @copyright 2015 ZipMoney Payments.
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.zipmoney.com.au/
 */


abstract class Express
{
    const ACTION_RESPONSE_TYPE_GET_SHIPPING_METHODS     = 'shippingmethods';
    const ACTION_RESPONSE_TYPE_GET_QUOTE_DETAILS        = 'quotedetails';
    const ACTION_RESPONSE_TYPE_CONFIRM_SHIPPING_METHOD  = 'confirmshippingmethod';
    const ACTION_RESPONSE_TYPE_CONFIRM_ORDER            = 'confirmorder';
    const ACTION_RESPONSE_TYPE_FINALISE_ORDER           = 'finaliseorder';
    const ACTION_RESPONSE_TYPE_CANCEL_QUOTE             = 'cancelquote';
    
    private $_merchantId  = null;

    private $_merchantKey = null;

    public function __construct()
    {
        
        $this->_merchantId  = Configuration::$merchant_id;

        $this->_merchantKey = Configuration::$merchant_key;

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
            throw new Exception("Notification parameters cannot be empty");        

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
            throw new Exception("Merchant Credentials donot match");

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

    /**
     * 
     * Add ZipMoney API keys to the response, if not already
     *
     */
    protected  function _addApiKeys(&$params)
    {

        if (!isset($params['merchant_id'])) {
            $params['merchant_id'] = $this->_merchantId;
        }

        if (!isset($params['merchant_key'])) { 
            $params['merchant_key'] = $this->_merchantKey;
        }

    }


    public function sendResponse($params)
    {

        if(!isset($params) ||  empty($params))
            throw new  Exception("Error Sending Response. No parameter provided", 1);
        
        //Add api keys to response
        $this->_addApiKeys($params);

        header('Content-Type: application/json');
        die(json_encode($params));
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