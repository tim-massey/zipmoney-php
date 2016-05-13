<?php
namespace zipMoney;

use  zipMoney\Helper\Klass;

/**
 * @category  ZipMoney
 * @package   ZipMoney_SDK
 * @author    Sagar Bhandari <sagar.bhandari@zipmoney.com.au>
 * @copyright 2015 ZipMoney Payments.
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.zipmoney.com.au/
 */


class Request 
{
  public static $Order  = array ("id", "tax", "shipping_value", "total", "detail");

  public static $QueryOrder  = array ("id", "status", "error_message", "txn_id");

  public static $OrderDetail  = array("id",  "name", "sku", "quantity", "price","image_url", "description");

  public static $Address  = array("first_name", "last_name", "line1", "line2", "country","zip","city","state");

  public static $Consumer = array("first_name", "last_name", "phone", "email", "gender", "dob", "title");

  public static $Metadata = array("order_reference", "attributes");

  public static $Version  = array("client", "platform");

  public static $ApiCredentials = array("merchant_id", "merchant_key", "version"); 

  public static function Order($id, $tax, $shipping_value, $total, $detail = array())
  {
    $order =  Klass::factory(self::$Order);
    return $order->create($id, $tax, $shipping_value, $total, $detail );
  }
  
  public static function QueryOrder($id, $status = null, $error_message = null, $txn_id = null)
  {
    $order =  Klass::factory(self::$QueryOrder);
    return $order->create($id, $status, $error_message, $txn_id);
  }
  
  public static function OrderDetail($id, $name, $sku, $quantity, $price, $image_url, $description )
  {
    $order =  Klass::factory(self::$OrderDetail);
    return $order->create($id, $name, $sku, $quantity, $price, $image_url, $description );
  } 

  public static function Address($first_name, $last_name, $line1, $line2, $country, $zip, $city, $state)
  {
    $order =  Klass::factory(self::$Address);
    return $order->create($first_name, $last_name, $line1, $line2, $country, $zip, $city, $state);
  }

  public static function Consumer($first_name, $last_name, $email, $phone, $gender, $dob, $title)
  {
    $order =  Klass::factory(self::$Consumer);
    return $order->create($first_name, $last_name, $email, $phone, $gender, $dob, $title);
  }

}

class Order{

  public  $id;
  public  $tax; 
  public  $shipping_value;
  public  $total;
  public  $detail;


  public function __construct($id,$tax,$shipping_value,$total,$detail){

    $this->id = $id;
    $this->tax = $tax;
    $this->shipping_value = $shipping_value;
    $this->total = $total;
    $this->detail = $detail;

  }

}


class OrderItem{
  
  public  $id;
  public  $sku; 
  public  $name;
  public  $price;
  public  $quantity;
  public  $image_url;
  public  $description;


  public function __construct($id,$sku, $name, $price, $quantity, $image_url, $description){

    $this->id = $id;
    $this->sku = $tax;
    $this->tax = $tax;
    $this->shipping_value = $shipping_value;
    $this->total = $total;
    $this->detail = $detail;

  }

}