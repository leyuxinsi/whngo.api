<?php
/**
 * Created by PhpStorm.
 * User: yanying
 * Date: 2016/11/22
 * Time: 0:17
 */
namespace common\helpers;

class Formatter{
    /**
     * 格式化时间
     * 一个小时之内显示多少分钟前，不足一分钟显示一分钟
     * 一天之内，显示多少小时
     * 第二天之内，显示昨天
     * 3天之内显示几天前
     * 一年之内，不显示年
     * 一年之外，显示加上年
     * @param $time
     * @return string
     */
    public static function formatDate($time){

        $year = date("Y" , $time);
        $mon = date("m" , $time);
        $day = date("d" , $time);
        $hours = date("H" , $time);
        $min = date("i" , $time);

        // 大于一年
        if($year < date("Y")){
            return date("Y年m月d日" , $time);
        }else{
            // 小于一年
            // 大于一个月
            if($mon < date("m")){
                return date("m月d日",$time);
            }else{
                // 大于一天，并且大于一个月
                if(($day < date("d"))){
                    // 小于3天
                    if((date("d")-$day)<3){
                        return date("d")-$day.'&nbsp;天前';
                    }else{
                        // 大于3天
                        return date("m月d日",$time);
                    }
                }else{
                    // 今天
                    if($hours < date("H")){
                        // 一个小时外
                        return date("H") - $hours .'&nbsp;小时前';
                    }else{
                        // 一个小时内
                        return date("i")-$min.'&nbsp;分钟前';
                    }
                }
            }

        }
    }
}