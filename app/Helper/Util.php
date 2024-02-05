<?php

namespace App\Helper;

class Util
{
    public static function array_to_object($arr)
    {
        return json_decode(json_encode($arr));
    }
}
