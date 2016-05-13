<?php
namespace zipMoney\Api;

use zipMoney\Gateway;
use zipMoney\Exception;
use zipMoney\Helper\Klass;

/**
 * @category  ZipMoney
 * @package   ZipMoney_SDK
 * @author    Sagar Bhandari <sagar.bhandari@zipmoney.com.au>
 * @copyright 2015 ZipMoney Payments.
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.zipmoney.com.au/
 */

class Settings 
{
  public  $request;

  private $_params = array("base_url", "version", "metadata");

  public function __construct()
  {

    $this->request  =  Klass::factory($this->_params);

  }

  public function process()
  {
 
    return Gateway::api()->settings($this->request);
  }

 

}