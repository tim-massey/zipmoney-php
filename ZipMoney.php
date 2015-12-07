<?php
/**
 * @category  ZipMoney
 * @package   ZipMoney_SDK
 * @author    Sagar Bhandari <sagar.bhandari@zipmoney.com.au>
 * @copyright 2015 ZipMoney Payments.
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.zipmoney.com.au/
 */

set_include_path(get_include_path() . PATH_SEPARATOR . realpath(dirname(__FILE__)));

require_once 'lib/Http.php';
require_once 'lib/Exception.php';
require_once 'lib/Exception/Http.php';
require_once 'lib/Abstract/Express.php';
require_once 'lib/Abstract/WebHook.php';
require_once 'lib/Response.php';
require_once 'lib/ApiConfig.php';
require_once 'lib/Api.php';



if (version_compare(PHP_VERSION, '5.2.1', '<')) {
    throw new ZipMoney_Exception('PHP version >= 5.2.1 required');
}
