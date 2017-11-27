<?php
/**
 * Created by PhpStorm.
 * User: yanying
 * Date: 2016/8/25
 * Time: 22:23
 */
namespace common\models;
use yii\db\ActiveRecord;
use common\helpers\Json;

class BaseModel extends ActiveRecord{

    const DELETE_TRUE = 1;
    const DELETE_FALSE = 0;
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    const PAGE_SIZE=20;
    const FAIL_CODE = 0;
    const NUMBER_ID = 1;
    /**
     * 错误统一输出
     */
    public function returnError()
    {
        foreach($this->getErrors() as $errVal) {
            Json::returnJson(['code'=>self::FAIL_CODE,'msg'=>$errVal['0']]); // 错误一个一个的输出
        }
    }
}