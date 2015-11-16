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

abstract class ZipMoney_WebHook
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
    

    public function __construct($merchantId,$merchantKey)
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

    public function listen()
    {
        $data = file_get_contents("php://input");

        if (!$data)
            throw new ZipMoney_Exception("Notification parameters cannot be empty");        

        $params = json_decode($data);

        $this->_processWebHookRequest($params);
    }


    protected function _processWebHookRequest($params)
    {


        if ($params->Type == 'SubscriptionConfirmation') {
            
            $this->_subscribe($params->SubscribeURL);

        } else if ($params->Type == 'Notification') {

            if (!$params->Message)
                throw new ZipMoney_Exception("Notification message cannot be empty");

            $message  = json_decode($params->Message);

            if (!$message->response)
                throw new ZipMoney_Exception("Notification response cannot be empty");

            if($this->_validateCredentials($message->response->merchantId,$message->response->merchantKey))
                throw new ZipMoney_Exception("Merchant Credentials donot match");

            if($message->response->type)
                $this->_processEvent();

            switch ($message->response->type) {
                case EVENT_TYPE_AUTH_SUCCESS:
                    # code...
                    // $this->eventAuthSuccess();
                    break;
                
                case EVENT_TYPE_AUTH_FAIL:
                    # code... 
                    // $this->eventAuthFail();
                    break;
                
                case EVENT_TYPE_AUTH_REVIEW:
                    # code...
                    // $this->eventAuthReview();
                    break;
                
                case EVENT_TYPE_CANCEL_SUCCESS:
                    # code...
                    // $this->eventCancelSuccess();
                    break;
                
                case EVENT_TYPE_CANCEL_FAIL:
                    # code...
                    // $this->eventCancelFail();
                    break;
                
                case EVENT_TYPE_CAPTURE_SUCCESS:
                    # code...
                    // $this->eventCaptureSuccess();
                    break;
                
                case EVENT_TYPE_CAPTURE_FAIL:
                    # code...
                    // $this->eventCaptureFail();
                    break;
                
                case EVENT_TYPE_REFUND_SUCCESS:
                    # code...
                    // $this->eventRefundSuccess();
                    break;
                
                case EVENT_TYPE_REFUND_FAIL:
                    # code...
                    // $this->eventRefundFail();
                    break;
                
                case EVENT_TYPE_ORDER_CANCELLED:
                    # code...
                    // $this->eventOrderCancel();
                    break;
                
                case EVENT_TYPE_CHARGE_SUCCESS:
                    # code...
                    // $this->eventChargeSuccess();
                    break;
                
                case EVENT_TYPE_CHARGE_FAIL:
                    # code... 
                    // $this->eventChargeFail();
                    break;
         
                default:
                    # code...
                    break;
            }

        }

    }



    private function _subscribe($subscribeUrl)
    {

        if(!$subscribeUrl)
            throw new ZipMoney_Exception("SubscribeURL cannot be empty");

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $subscribeUrl;
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);

    }
   
}