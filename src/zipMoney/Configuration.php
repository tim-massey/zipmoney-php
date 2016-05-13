<?php
/**
 * @category  Aligent
 * @package   ZipMoney_SDK
 * @author    Andi Han <andi@aligent.com.au>
 * @copyright 2014 Aligent Consulting.
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.aligent.com.au/
 */

namespace zipMoney;

class Configuration
{
    const API_VERSION       = "2.0.0";
    const API_PLATFORM      = "PHP";
    const API_NAME          = "zipMoney PHP SDK";

    const ENVIRONMENT_TEST  = 'sandbox';
    const ENVIRONMENT_LIVE  = 'production';

    const ENV_TEST_BASE_URL = 'https://api.sandbox.zipmoney.com.au/v1/';
    const ENV_LIVE_BASE_URL = 'https://api.zipmoney.com.au/v1/';


    public static $merchant_id;
   
    public static $merchant_key;
    
    public static $environment;


    public function __construct($environment = self::ENVIRONMENT_LIVE)
    {
        $this->environment = $environment;
    }


    public static function isSandbox($environment = null)
    {
        if ($environment) {
            return ($environment == self::ENVIRONMENT_TEST);
        } else {
            return (self::$environment == self::ENVIRONMENT_TEST);
        }
    }

    
}
