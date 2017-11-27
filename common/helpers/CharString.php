<?php
/**
 * Created by PhpStorm.
 * User: yanyi
 * Date: 2017/1/12
 * Time: 12:55
 */
namespace common\helpers;

class CharString{

    public static function createOrderNumber()
    {
        return date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }
}