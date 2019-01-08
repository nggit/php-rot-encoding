<?php

# Rot class
# PHP Rot Encoding
# (c) 20190105 nggit

namespace Nggit\PHPRotEncoding;

class Rot
{
    public $str, $encoded, $pin;

    public function __construct($str, $pin = 0)
    {
        $this->str = $str;
        $this->pin = $pin;
    }

    public function encode($pin = null)
    {
        if (isset($pin)) {
            $this->pin = $pin;
        }
        $pin_str       = (string) $this->pin;
        $pin_len       = strlen($pin_str);
        $this->encoded = $this->str;
        $i             = 0;
        while ($i < $pin_len) {
            $this->encoded .= "\3";
            $arr            = array();
            $str_len        = strlen($this->encoded);
            $pin_str[$i]    = ($pin_str[$i] + 2) * ceil($str_len / 10);
            $split_len      = ceil($str_len / $pin_str[$i]);
            $str_padded_len = $split_len * $pin_str[$i];
            $this->encoded .= str_repeat("\0", $str_padded_len - $str_len);
            for ($j = 0; $j < $split_len; $j++) {
                $arr[$j] = ''; // define offset
            }
            for ($k = 0; $k < $str_padded_len; $k++) { 
                $arr[$k % $split_len] .= $this->encoded[$k];
            }
            $this->encoded = implode($arr);
            $i++;
        }
        return $this->encoded;
    }

    public function decode($pin = null)
    {
        if ($pin === null) {
            $pin = $this->pin;
        }
        $pin_str = (string) $pin;
        $pin_len = strlen($pin_str);
        $str     = isset($this->encoded) ? $this->encoded : $this->str;
        $i       = $pin_len;
        while ($i > 0) {
            $i--;
            $arr         = array();
            $str_len     = strlen($str);
            $pin_str[$i] = ($pin_str[$i] + 2) * ceil($str_len / 10);
            for ($j = 0; $j < $pin_str[$i]; $j++) {
                $arr[$j] = ''; // define offset
            }
            for ($k = 0; $k < $str_len; $k++) { 
                $arr[$k % $pin_str[$i]] .= $str[$k];
            }
            $str = substr(rtrim(implode($arr)), 0, -1);
        }
        return $str;
    }
}
