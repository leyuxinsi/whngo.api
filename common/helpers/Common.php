<?php
/**
 * Created by PhpStorm.
 * User: yanyi
 * Date: 2016/11/25
 * Time: 12:57
 */
namespace common\helpers;

class Common{

    /**
     * 判断用户访问是否是微信客户端
     */
    public static function is_weixin(){
        if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
            return true;
        }
        return false;
    }
}