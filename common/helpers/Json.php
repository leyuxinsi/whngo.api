<?php
/**
 * Created by PhpStorm.
 * User: yanyi
 * Date: 2016/12/22
 * Time: 16:12
 */
namespace common\helpers;

use yii\helpers\BaseJson;

class Json extends BaseJson{

    public static function returnJson($value=''){
        if(!$value){
            echo parent::encode(['code'=>'1']);
        }else{
            echo parent::encode($value);
        }
        exit;
    }

}