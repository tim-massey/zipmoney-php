<?php
namespace zipMoney\Helper;

class Util
{
   
    public static function objectToArray($d)
    {        
        return json_decode(json_encode($d), true);;
    }


    public static function prepareRequest($requestArray)
    {   
        $newArray = array();
        
        foreach ($requestArray as $key => $value) {

            if(is_array($value) && count($value)){
                
                // Check if return value is not empty
                if($retVal = self::prepareRequest($value))
                   $newArray[$key] = $retVal;

            } else {
                if(!is_null($value)){
                 $newArray[$key] = $value;
                }
            }
        }

        return $newArray;
    }
}