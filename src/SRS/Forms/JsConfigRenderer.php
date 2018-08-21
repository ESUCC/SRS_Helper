<?php

namespace SRS\Forms;

use \Zend\Json\Encoder;
use \Zend\Json\Expr;


class JsConfigRenderer extends Encoder
{

    public static function encode($value, $cycleCheck = false, array $options = array())
    {
        if(empty($value)) {
            return;
        }
        	
        $encoder = new self(($cycleCheck) ? true : false, $options);
        return $encoder->encodeValue($value);
    }

    protected function encodeObject(&$value)
    {
        if($value instanceof Expr) {
            return $value;
        } else {
            parent::_encodeObject($value);
        }
    }

    protected function encodeArray($array)
    {
        $tmpArray = array();

        // Check for associative array
        if (!empty($array) && (array_keys($array) !== range(0, count($array) - 1))) {
            // Associative array
            $result = '{';
            foreach ($array as $key => $value) {
                //$key =  $key;
                //$tmpArray[] = $this->_encodeString($key)
                $tmpArray[] = $key . ':' . $value;
            }
            $result .= implode(',', $tmpArray);
            $result .= '}';
        } else {
            // Indexed array
            $result = '[';
            $length = count($array);
            for ($i = 0; $i < $length; $i++) {
                $tmpArray[] = $this->encodeValue($array[$i]);
            }
            $result .= implode(',', $tmpArray);
            $result .= ']';
        }

        return $result;
    }

}