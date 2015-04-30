<?php

/**
 *
 *
 * @category  Aligent
 * @package   ZipMoney_Api
 * @author    Andi Han <andi@aligent.com.au>
 * @copyright 2014 Aligent Consulting.
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.aligent.com.au/
 */
class ZipMoney_Api
{

    protected $_oApiSettings;
    protected $_vMerchantId;
    protected $_vMerchantKey;

    /**
     * @param $environment
     * @param $logHandler
     */
    public function __construct($vEnvironment, $vMerchantId, $vMerchantKey, $oLogHandler = null)
    {
        /** @var ZipMoney_ApiSettings $apiSettings */
        $this->_oApiSettings = new ZipMoney_ApiSettings($vEnvironment);
        $this->_vMerchantId = $vMerchantId;
        $this->_vMerchantKey = $vMerchantKey;
    }

    protected function _addApiKeysToRequest($aRequestData)
    {
        if(is_array($aRequestData)) {
            if (!isset($aRequestData['merchant_id'])) {
                $aRequestData['merchant_id'] = $this->_vMerchantId;
            }
            if (!isset($aRequestData['merchant_key'])) {
                $aRequestData['merchant_key'] = $this->_vMerchantKey;
            }
        }
        return $aRequestData;
    }

    /**
     * @param $requestData
     * @param $requestUrl
     * @return Zend_Http_Response
     * @throws Zend_Http_Client_Exception
     */
    protected function request($vJson, $vRequestUrl)
    {
        $aHttpClientConfig = array('maxredirects' => 0);

        $oClient = new Zend_Http_Client($vRequestUrl, $aHttpClientConfig);
        if ($vJson != null) {
//            $vJson = json_encode($aRequestData);
            $oClient->setRawData($vJson, 'application/json')->setMethod(Zend_Http_Client::POST);
            $oClient->setHeaders(array(
                'content-length' => strlen($vJson),
                'content-type' => 'application/json'));
        } else {
            $oClient->setMethod(Zend_Http_Client::GET);
        }

        $oResponse = $oClient->request();
        return $oResponse;
    }

    /**
     * Get URL contents for Terms and Conditions modal
     * @param $vUrl
     * @param int $iTimeout
     * @return Zend_Http_Response
     * @throws Zend_Http_Client_Exception
     */
    public function getUrlContent($vUrl, $iTimeout = 60)
    {
        $oClient = new Zend_Http_Client($vUrl, array('timeout' => $iTimeout));
        $oResponse = $oClient->request();
        return $oResponse;
    }

    /**
     * call Zip API endpoint
     * @param $vEndpoint
     * @param array $aRequestData
     * @return mixed|null|Zend_Http_Response
     */
    public function callZipApi($vEndpoint, $vJson)
    {
        $aRequestData = json_decode($vJson);
        $oResponse = null;
        $aRequestData = $this->_addApiKeysToRequest($aRequestData);
        $vJson = json_encode($aRequestData);
        $vRequestUrl = $this->_oApiSettings->getUrl($vEndpoint);
        $oResponse = $this->request($vJson, $vRequestUrl);
        return $oResponse;
    }
}