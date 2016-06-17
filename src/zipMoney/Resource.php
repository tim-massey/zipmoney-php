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


use \zipMoney\Http as RestClient;


class Resource
{

    const RESOURCE_SETTINGS                         = 'settings';
    const RESOURCE_CONFIGURE                        = 'configure';
    const RESOURCE_QUOTE                            = 'quote';
    const RESOURCE_ORDER_CANCEL                     = 'cancel';
    const RESOURCE_ORDER_REFUND                     = 'refund';
    const RESOURCE_CHECKOUT                         = 'checkout';
    const RESOURCE_QUERY                            = 'query';
    const RESOURCE_CAPTURE                          = 'capture';
    const RESOURCE_HEART_BEAT                       = 'Heartbeat';


    public static function get($resource, $method = 'POST', $options = null, $query_string = null)
    {
        if(self::resource_exists($resource)){
          $url = self::getUrl($resource, ( strtoupper($method) == "GET"? $query_string:null ) );
          return new RestClient($url, "json", $options );
        }

      return false;  
    }


    public static function resource_exists($resource)
    {
        $refl = new \ReflectionClass('zipMoney\\Resource');
        $resources = $refl->getConstants();

        if(in_array($resource,array_values($resources)))
           return true;

        return false;
    }


    /**
     * Get ZipMoney API endpoint url by type and environment
     *
     * @param $vType
     * @param null $vEnvironment
     * @return null|string
     */
    public static function getUrl($resource, $env, $query_string = null)
    {
        $url      = null;

        if(Configuration::isSandbox($env)) {
          $base_url = Configuration::ENV_TEST_BASE_URL;
        } else {
          $base_url = Configuration::ENV_LIVE_BASE_URL;
        }
        
        if ($base_url && $resource) {
            $url = $base_url . ltrim($resource, '/');
        }

        return $url;
    }

   

   
}
