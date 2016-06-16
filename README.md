# PHP Client Library  for zipMoney


## Installation

Add this line to your application's composer.json:

```php
"zipmoney/zipmoney-php":"^1.0" 
```

And then execute:

    $ composer update

Or install it yourself as:
    
    $ composer require zipmoney/zipmoney-php
    
## Usage
### Configuration
```php
# Configure the api credentials 

\zipMoney\Configuration::$merchant_id  = merchant_id;
\zipMoney\Configuration::$merchant_key = merchant_key;
\zipMoney\Configuration::$environment  = sandbox|production;
```

### Api Operations  

##### Checkout
Order should be created before payment 

```php
# Initialize the checkout
$checkout = new \zipMoney\Api\Checkout();

$checkout->request->charge = false;
$checkout->request->currency_code = "AUD";
$checkout->request->txn_id = false;
$checkout->request->order_id =  $this->_current_order_id;
$checkout->request->in_store = false;

$checkout->request->cart_url    = "https://your-domain/checkout/cart/";
$checkout->request->success_url = "https://your-domain/checkout/success/";
$checkout->request->cancel_url  = "https://your-domain/zipmoney/express/cancel/";
$checkout->request->error_url   = "https://your-domain/zipmoney/express/error/";
$checkout->request->refer_url   = "https://your-domain/zipmoney/express/refer/";
$checkout->request->decline_url = "https://your-domain/zipmoney/express/decline/";

// Order Info
$order = new \zipMoney\Request\Order;
$order->id = 1;
$order->tax = 110;
$order->shipping_tax = 0;
$order->shipping_value = 10;
$order->total = 120;

// Order Item 1
$order_item = new \zipMoney\Request\OrderItem;
$order_item->id = 10758;
$order_item->sku  = "item-10758"; 
$order_item->name = "GoPro Hero3+ Silver Edition - Silver";
$order_item->price =  110;
$order_item->quantity = 1; 
  
$order->detail[] = $order_item;

// Order Item 2
$order_item = new \zipMoney\Request\OrderItem;
$order_item->id = 10759;
$order_item->sku  = "item-10759"; 
$order_item->name = "GoPro Hero3+ Silver Edition - Silver1";
$order_item->price =  110;
$order_item->quantity = 1;

$order->detail[] = $order_item;

$checkout->request->order = $order;

// Billing Address
$billingAddress  = new \zipMoney\Request\Address;

$billingAddress->first_name = "firstname";
$billingAddress->last_name = "lastname";
$billingAddress->line1 = "line1";
$billingAddress->line2 = "line2";
$billingAddress->country = "Australia";
$billingAddress->zip = "postcode";
$billingAddress->city = "Sydney";
$billingAddress->state = "NSW";
  
$checkout->request->billing_address  = $billingAddress;

// Shipping Address
$shippingAddress = new \zipMoney\Request\Address;

$shippingAddress->first_name = "firstname";
$shippingAddress->last_name = "lastname";
$shippingAddress->line1 = "line1";
$shippingAddress->line2 = "line2";
$shippingAddress->country = "Australia";
$shippingAddress->zip = "postcode";
$shippingAddress->city = "Sydney";
$shippingAddress->state = "NSW";
 
$checkout->request->shipping_address  = $shippingAddress;


// Consumer Info
$consumer  = new \zipMoney\Request\Consumer;

$consumer->first_name = "firstname";
$consumer->last_name = "lastname";
$consumer->phone = 0400000000;
$consumer->email = "test@test.com.au";
$consumer->gender = "male";
$consumer->dob = "2016-06-16T15:31:23.8051383+10:00";
$consumer->title = "mr";

$checkout->request->consumer  = $consumer;
$checkout->request->version = new Request\Version;
$checkout->request->version->platform = "php";

try{
  $response = $checkout->process();
  
  if($response->isSuccess()){
    //Do Something
  } else {
    //Handle Error
  }

} catch (Exception $e){
    // Handle Error
}
```

##### Quote
Order should be created after payment is complete, usually when the zipMoney api invokes the /confirmorder endpoint of the store or on the return journey

```php
# Initialize the checkout
$quote = new \zipMoney\Api\Quote();

$quote->request->currency_code = "AUD";
$quote->request->txn_id        = 2112;
$quote->request->quote_id      = "91005500";

$quote->request->cart_url    = "https://your-domain/checkout/cart/";
$quote->request->success_url = "https://your-domain/checkout/success/";
$quote->request->cancel_url  = "https://your-domain/zipmoney/express/cancel/";
$quote->request->error_url   = "https://your-domain/zipmoney/express/error/";
$quote->request->refer_url   = "https://your-domain/zipmoney/express/refer/";
$quote->request->decline_url = "https://your-domain/zipmoney/express/decline/";

// Order Info
$order = new \zipMoney\Request\Order;
$order->id = 1;
$order->tax = 110;
$order->shipping_tax = 0;
$order->shipping_value = 10;
$order->total = 120;

// Order Item 1
$order_item = new \zipMoney\Request\OrderItem;
$order_item->id = 10758;
$order_item->sku  = "item-10758"; 
$order_item->name = "GoPro Hero3+ Silver Edition - Silver";
$order_item->price =  110;
$order_item->quantity = 1; 

$order->detail[] = $order_item;

// Order Item 1
$order_item = new \zipMoney\Request\OrderItem;
$order_item->id = 10759;
$order_item->sku  = "item-10759"; 
$order_item->name = "GoPro Hero3+ Silver Edition - Silver1";
$order_item->price =  110;
$order_item->quantity = 1;

$order->detail[] = $order_item;

$quote->request->order = $order;


// Billing Address
$billingAddress  = new \zipMoney\Request\Address;

$billingAddress->first_name = "firstname";
$billingAddress->last_name = "lastname";
$billingAddress->line1 = "line1";
$billingAddress->line2 = "line2";
$billingAddress->country = "Australia";
$billingAddress->zip = "postcode";
$billingAddress->city = "Sydney";
$billingAddress->state = "NSW";

$quote->request->billing_address  = $billingAddress;


// Shipping Address
$shippingAddress = new \zipMoney\Request\Address;

$shippingAddress->first_name = "firstname";
$shippingAddress->last_name = "lastname";
$shippingAddress->line1 = "line1";
$shippingAddress->line2 = "line2";
$shippingAddress->country = "Australia";
$shippingAddress->zip = "postcode";
$shippingAddress->city = "Sydney";
$shippingAddress->state = "NSW";

$quote->request->shipping_address  = $shippingAddress;


// Consumer Info
$consumer  = new \zipMoney\Request\Consumer;

$consumer->first_name = "firstname";
$consumer->last_name = "lastname";
$consumer->phone = 0400000000;
$consumer->email = "test@test.com.au";
$consumer->gender = "male";
$consumer->dob = "2016-06-16T15:31:23.8051383+10:00";
$consumer->title = "mr";

$quote->request->consumer  = $consumer;

$quote->request->version = new Request\Version;

$quote->request->version->platform = "php";

try{
  $response = $quote->process();
  
  if($response->isSuccess()){
    //Do Something
  } else {
    // Handle Error
  }

} catch (Exception $e){
    // Handle Error
}
```

##### Refund
Performs full or partial refund of the order

```php
# Initialize the refund'

$refund = new \zipMoney\Api\Refund();

$refund->request->reason = "Test Reason";
$refund->request->txn_id = 111;
$refund->request->order_id = "91005501";

// Order info
$order = new \zipMoney\Request\Order;
$order->id = 1;
$order->tax = 110;
$order->shipping_value = 10;
$order->total = 120;

$refund->request->order = $order;

try{
  $response = $refund->process();
  
  if($response->isSuccess()){
    //Do Something
  } else {
    // Handle Error
  }

} catch (Exception $e){
    //Handle Error
}
```


##### Cancel
Performs cancellation of the order

```ruby
# Initialize the cancel
$cancel = new \zipMoney\Api\Cancel();

$cancel->request->txn_id = 111;
$cancel->request->order_id = "91005501";

// Order info
$order = new \zipMoney\Request\Order;
$order->id = 1;
$order->tax = 110;
$order->shipping_value = 10;
$order->total = 120;

$cancel->request->order = $order;

try{
  $response   = $cancel->process();
  
  if($response->isSuccess()){
    //Do Something
  } else {
    // Handle Error
  }

} catch (Exception $e){
    //Handle Error
} 
```


##### Capture
Captures the payment for the order

```php
# Initialize the capture
$capture = new \zipMoney\Api\Capture();  
$capture->request->txn_id = 111;
$capture->request->order_id = "91005501";

$order = new \zipMoney\Request\Order;
$order->id = 1;
$order->tax = 110;
$order->shipping_value = 10;
$order->total = 120;

$capture->request->order = $order;

try{
  $response = $capture->process();
  
  if($response->isSuccess()){
    //Do Something
  } else {
    // Handle Error
  }

} catch (Exception $e){
    //Handle Error
} 
```

##### Query
Queries orders

```php
# Initialize the query
$query = new \zipMoney\Api\Query();

$queryOrder = new  \zipMoney\Request\QueryOrder;
$queryOrder->id = 1234;

$query->request->orders[] = $queryOrder;

try{
  $response = $query->process();
  
  if($response->isSuccess()){
    //Do Something
  } else {
    // Handle Error
  }

} catch (Exception $e){
    //Handle Error
}
```

## License
The package is available as open source under the terms of the [MIT License](http://opensource.org/licenses/MIT).