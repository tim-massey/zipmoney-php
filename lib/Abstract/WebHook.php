<?php
/**
 * @category  ZipMoney
 * @package   ZipMoney_SDK
 * @author    Sagar Bhandari <sagar.bhandari@zipmoney.com.au>
 * @copyright 2015 ZipMoney Payments.
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.zipmoney.com.au/
 */

/*
 *  Event Types
-----------------------
    authorise_succeeded
    authorise_failed
    authorise_under_review
    cancel_succeeded
    cancel_failed
    capture_succeeded
    capture_failed
    refund_succeeded
    refund_failed
    order_cancelled
    charge_succeeded
    charge_failed
*/

abstract class ZipMoney_Abstract_WebHook
{
    private $_merchantId = null;

    private $_merchantKey = null;

    const EVENT_TYPE_AUTH_SUCCESS = "authorise_succeeded";
    const EVENT_TYPE_AUTH_FAIL    = "authorise_failed";
    const EVENT_TYPE_AUTH_REVIEW  = "authorise_under_review";

    const EVENT_TYPE_CANCEL_SUCCESS = "cancel_succeeded";
    const EVENT_TYPE_CANCEL_FAIL    = "cancel_failed";

    const EVENT_TYPE_CAPTURE_SUCCESS = "capture_succeeded";
    const EVENT_TYPE_CAPTURE_FAIL    = "capture_failed";

    const EVENT_TYPE_REFUND_SUCCESS = "refund_succeeded";
    const EVENT_TYPE_REFUND_FAIL    = "refund_failed";

    const EVENT_TYPE_ORDER_CANCELLED = "order_cancelled";

    const EVENT_TYPE_CHARGE_SUCCESS = "charge_succeeded";
    const EVENT_TYPE_CHARGE_FAIL    = "charge_failed";

    const EVENT_TYPE_CONFIG_UPDATE  = "configuration_updated";
    

    public function __construct($merchantId,$merchantKey)
    {
        
        $this->_merchantId  = $merchantId;

        $this->_merchantKey = $merchantKey;

    }

    /*
     * Validate credentials contained in WebHook Request
     *
     * @param  $merchantId
     * @param  $merchantKey
     * @return true|false
     */
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
    public function listen()
    {
        $data = file_get_contents("php://input");

        if (!$data)
            throw new ZipMoney_Exception("Notification parameters cannot be empty");        

        $params = json_decode($data);

        if(!$params)
            throw new ZipMoney_Exception("Invalid Parameters");        

        if (isset($params->Type) && $params->Type == 'SubscriptionConfirmation') {
            
            $this->_subscribe($params->SubscribeURL);
           
            die();

        } else if (isset($params->Type) &&  $params->Type == 'Notification') {
            
            $this->_processRequest($params);
        }

    }

    /*
     * Process WebHook Request
     *
     * @param  $params
     */
    protected function _processRequest($params)
    {

        if (!$params->Message)
            throw new ZipMoney_Exception("Notification message cannot be empty");

        $message  = json_decode($params->Message);
        

        if (!$message->response)
            throw new ZipMoney_Exception("Notification response cannot be empty");

        if(!$this->_validateCredentials($message->response->merchant_id,$message->response->merchant_key))
            throw new ZipMoney_Exception("Merchant Credentials donot match");

        switch ($message->type) {
            case self::EVENT_TYPE_AUTH_SUCCESS:
                # code...
                 $this->_eventAuthSuccess($message->response);
                break;
            
            case self::EVENT_TYPE_AUTH_FAIL:
                # code... 
                 $this->_eventAuthFail($message->response);
                break;
            
            case self::EVENT_TYPE_AUTH_REVIEW:
                # code...
                 $this->_eventAuthReview($message->response);
                break;
            
            case self::EVENT_TYPE_CANCEL_SUCCESS:
                # code...
                 $this->_eventCancelSuccess($message->response);
                break;
            
            case self::EVENT_TYPE_CANCEL_FAIL:
                # code...
                 $this->_eventCancelFail($message->response);
                break;
            
            case self::EVENT_TYPE_CAPTURE_SUCCESS:
                # code...
                $this->_eventCaptureSuccess($message->response);
                break;
            
            case self::EVENT_TYPE_CAPTURE_FAIL:
                # code...
                 $this->_eventCaptureFail($message->response);
                break;
            
            case self::EVENT_TYPE_REFUND_SUCCESS:
                # code...
                 $this->_eventRefundSuccess($message->response);
                break;
            
            case self::EVENT_TYPE_REFUND_FAIL:
                # code...
                 $this->_eventRefundFail($message->response);
                break;
            
            case self::EVENT_TYPE_ORDER_CANCELLED:
                # code...
                 $this->_eventOrderCancel($message->response);
                break;
            
            case self::EVENT_TYPE_CHARGE_SUCCESS:
                # code...
                 $this->_eventChargeSuccess($message->response);
                break;
            
            case self::EVENT_TYPE_CHARGE_FAIL:
                # code... 
                 $this->_eventChargeFail($message->response);
                break;
            
            case self::EVENT_TYPE_CONFIG_UPDATE:
                # code... 
                 $this->_eventConfigUpdate($message->response);
                break;
     
            default:
                # code...
                break;
        }

    }

    /*
     * Process Authorisation Success
     *
     * @param  $response
     */
    protected function _eventAuthSuccess($response){}  

    /*
     * Process Authorisation Failure
     *
     * @param  $response
     */
    protected function _eventAuthFail($response){}

    /*
     * Process Authorisation Review 
     *
     * @param  $response
     */
    protected function _eventAuthReview($response){}
    
    /*
     * Process Cancel Success 
     *
     * @param  $response
     */
    protected function _eventCancelSuccess($response){}

    /*
     * Process Cancel Fail 
     *
     * @param  $response
     */
    protected function _eventCancelFail($response){}

    /*
     * Process Capture Success 
     *
     * @param  $response
     */
    protected function _eventCaptureSuccess($response){}

    /*
     * Process Capture Failure 
     *
     * @param  $response
     */
    protected function _eventCaptureFail($response){}

    /*
     * Process Refund Success 
     *
     * @param  $response
     */
    protected function _eventRefundSuccess($response){}

    /*
     * Process Refund Fail 
     *
     * @param  $response
     */
    protected function _eventRefundFail($response){}

    /*
     * Process Order Cancel
     *
     * @param  $response
     */
    protected function _eventOrderCancel($response){}

    /*
     * Process Charge Success 
     *
     * @param  $response
     */
    protected function _eventChargeSuccess($response){}

    /*
     * Process Charge Fail 
     *
     * @param  $response
     */
    protected function _eventChargeFail($response){}
    
    /*
     * Process Charge Fail 
     *
     * @param  $response
     */
    protected function _eventConfigUpdate($response){}

    /*
     * Subscribe url on the endpoint
     *
     * @param  $subscribeUrl
     */
    private function _subscribe($subscribeUrl)
    {
        if(!$subscribeUrl)
            throw new ZipMoney_Exception("SubscribeURL cannot be empty");

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $subscribeUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);

    }
   
}