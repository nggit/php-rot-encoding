<?php

# Rot class
# PHP Rot Encoding
# (c) 20190105 nggit

namespace Nggit\PHPRotEncoding;

class Rot
{
    public $str, $encoded, $pin;

    public function __construct($str, $pin = array(0))
    {
        $this->str = $str;
        $this->pin = $pin;
    }

    public function encode()
    {
        $numargs = func_num_args();
        if ($numargs == 1) {
            $this->pin = str_split((string) func_get_arg(0));
        } elseif ($numargs > 1) {
            $this->pin = func_get_args();
        }
        $pin_arr       = $this->pin;
        $this->encoded = $this->str;
        foreach ($pin_arr as $pin_num) {
            $this->encoded .= "\3";
            $arr            = array();
            $str_len        = strlen($this->encoded);
            $pin_num       += 2;
            $split_len      = ceil($str_len / $pin_num);
            $str_padded_len = $split_len * $pin_num;
            $this->encoded .= str_repeat("\0", $str_padded_len - $str_len);
            for ($i = 0; $i < $split_len; $i++) {
                $arr[$i] = ''; // define offset
            }
            for ($j = 0; $j < $str_padded_len; $j++) { 
                $arr[$j % $split_len] .= $this->encoded[$j];
            }
            $this->encoded = implode($arr);
        }
        return $this->encoded;
    }

    public function decode()
    {
        $numargs = func_num_args();
        if ($numargs == 1) {
            $pin = str_split((string) func_get_arg(0));
        } elseif ($numargs > 1) {
            $pin = func_get_args();
        } else {
            $pin = $this->pin;
        }
        $pin_arr = $pin;
        $str     = isset($this->encoded) ? $this->encoded : $this->str;
        while ($pin_num = array_pop($pin_arr)) {
            $arr      = array();
            $str_len  = strlen($str);
            $pin_num += 2;
            for ($i = 0; $i < $pin_num; $i++) {
                $arr[$i] = ''; // define offset
            }
            for ($j = 0; $j < $str_len; $j++) { 
                $arr[$j % $pin_num] .= $str[$j];
            }
            $str = substr(rtrim(implode($arr)), 0, -1);
        }
        return $str;
    }
}
