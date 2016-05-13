<?php
namespace zipMoney\Helper;

class Util
{
   
    public static function objectToArray($d)
    {

        if (is_object($d)) {
            $d = get_object_vars($d);
        }

        if (is_array($d)) {
            return array_map(array('self',__FUNCTION__), $d);
        }
        else {
            return $d;
        }
    }
}