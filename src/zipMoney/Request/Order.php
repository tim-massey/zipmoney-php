<?php
namespace zipMoney\Request;

/**
 * @category  ZipMoney
 * @package   ZipMoney_SDK
 * @author    Sagar Bhandari <sagar.bhandari@zipmoney.com.au>
 * @copyright 2015 ZipMoney Payments.
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.zipmoney.com.au/
 */



class Order{

  public  $id = null;

  public  $tax = null; 

  public  $shipping_tax = null;

  public  $shipping_value = null;
  
  public  $discount_amount = null;

  public  $total = null;

  public  $detail = array();

}
