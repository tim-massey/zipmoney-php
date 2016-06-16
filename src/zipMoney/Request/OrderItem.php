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



class OrderItem{
  
  public  $id = null;

  public  $sku = null; 

  public  $name = null;

  public  $price = null;

  public  $quantity = null;

  public  $image_url = null;

  public  $description = null;

  public  $discount_percent = null;

  public  $discount_amount = null;
  
  public  $category = null;

}