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
class ZipMoney_ApiSettings
{
    const ENVIRONMENT_TEST    = 'sanbox';
    const ENVIRONMENT_LIVE    = 'production';

    const ENV_TEST_ENDPOINT_SETTINGS                = 'http://api.staging.zipmoney.com.au/v1/settings';
    const ENV_TEST_ENDPOINT_CONFIGURE               = 'http://api.staging.zipmoney.com.au/v1/configure';
    const ENV_TEST_ENDPOINT_QUOTE                   = 'http://api.staging.zipmoney.com.au/v1/quote';
    const ENV_TEST_ENDPOINT_ORDER_SHIPPING_ADDRESS  = 'http://api.staging.zipmoney.com.au/v1/order';     // TODO: to be confirmed with ZipMoney
    const ENV_TEST_ENDPOINT_ORDER_CANCEL            = 'http://api.staging.zipmoney.com.au/v1/cancel';     // TODO: to be confirmed with ZipMoney

    const ENV_LIVE_ENDPOINT_SETTINGS                = '';
    const ENV_LIVE_ENDPOINT_CONFIGURE               = '';
    const ENV_LIVE_ENDPOINT_QUOTE                   = '';
    const ENV_LIVE_ENDPOINT_ORDER_SHIPPING_ADDRESS  = '';     // TODO: to be confirmed with ZipMoney
    const ENV_LIVE_ENDPOINT_ORDER_CANCEL            = 'http://api.staging.zipmoney.com.au/v1/cancel';     // TODO: to be confirmed with ZipMoney

    const API_TYPE_MERCHANT_SETTINGS                = 'merchant_settings';
    const API_TYPE_MERCHANT_CONFIGURE               = 'merchant_configure';
    const API_TYPE_QUOTE_QUOTE                      = 'quote_quote';
    const API_TYPE_ORDER_SHIPPING_ADDRESS           = 'order_shipping_address';
    const API_TYPE_ORDER_CANCEL                     = 'order_cancel';

    protected $_vEnv;

    public function __construct($vEnv = self::ENVIRONMENT_LIVE)
    {
        $this->_vEnv = $vEnv;
    }

    public function getUrl($vType)
    {
        $vUrl = null;
        if($this->_isEnvLive()) {
            switch ($vType) {
                case self::API_TYPE_MERCHANT_SETTINGS:
                    $vUrl = self::ENV_LIVE_ENDPOINT_SETTINGS;
                    break;
                case self::API_TYPE_MERCHANT_CONFIGURE:
                    $vUrl = self::ENV_LIVE_ENDPOINT_CONFIGURE;
                    break;
                case self::API_TYPE_QUOTE_QUOTE:
                    $vUrl = self::ENV_LIVE_ENDPOINT_QUOTE;
                    break;
                case self::API_TYPE_ORDER_SHIPPING_ADDRESS:
                    $vUrl = self::ENV_LIVE_ENDPOINT_ORDER_SHIPPING_ADDRESS;
                    break;
                case self::API_TYPE_ORDER_CANCEL:
                    $vUrl = self::ENV_LIVE_ENDPOINT_ORDER_CANCEL;
                    break;
                default:
                    break;
            }

        } else if($this->_isEnvTest()) {
            switch ($vType) {
                case self::API_TYPE_MERCHANT_SETTINGS:
                    $vUrl = self::ENV_TEST_ENDPOINT_SETTINGS;
                    break;
                case self::API_TYPE_MERCHANT_CONFIGURE:
                    $vUrl = self::ENV_TEST_ENDPOINT_CONFIGURE;
                    break;
                case self::API_TYPE_QUOTE_QUOTE:
                    $vUrl = self::ENV_TEST_ENDPOINT_QUOTE;
                    break;
                case self::API_TYPE_ORDER_SHIPPING_ADDRESS:
                    $vUrl = self::ENV_TEST_ENDPOINT_ORDER_SHIPPING_ADDRESS;
                    break;
                case self::API_TYPE_ORDER_CANCEL:
                    $vUrl = self::ENV_TEST_ENDPOINT_ORDER_CANCEL;
                    break;
                default:
                    break;
            }
        } else {
            // incorrect environment
            return null;
        }
        return $vUrl;
    }

    protected function _isEnvLive()
    {
        return ($this->_vEnv == self::ENVIRONMENT_LIVE);
    }

    protected function _isEnvTest()
    {
        return ($this->_vEnv == self::ENVIRONMENT_TEST);
    }
}