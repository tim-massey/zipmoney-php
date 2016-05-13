<?php
namespace zipMoney\Helper;

class Klass
{
   
    public static function factory($params = null)
    {
        $class = new self;
        foreach ($params as $value) {
            $class->$value = null;
        }

    return $class;
    }
 
  
    public  function create()
    {
        // Clone the empty blueprint-class ($this) into the new data $class.
        $class = clone $this;
 
        // Populate the new class.
        $properties = array_keys((array) $class);
        foreach (func_get_args() as $key => $value) {
            if (!is_null($value)) {
                $class->$properties[$key] = $value;
            }
        }
 
        // Return the populated class.
        return $class;
    }

    public function __isset($property){
        return isset($this->$property);
    } 

}