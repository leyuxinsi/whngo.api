<?php
/**
 * Created by PhpStorm.
 * User: yanying
 * Date: 2016/7/27
 * Time: 15:45
 */
namespace frontend\controllers;

use common\helpers\Json;
use yii\web\Controller;
use Yii;

class BaseController extends Controller{

    const SUCCESS_CODE = 1;
    const FAIL_CODE = -1;
    const DELETE_FALSE = 0;
    const DELETE_TRUE = 1;
    const STATUS_ACTIVE = 1;
    public $user_id;
    const NUMBER_ID = 1;

    public $description;

    public function beforeAction($action)
    {
        return parent::beforeAction($action);
    }

    /**
     * 验证用户是否登录，Ajax
     */
    public function checkLoginAjax()
    {
        if(!$this->user_id)
        {
            Json::returnJson(['code'=>self::FAIL_CODE,'msg'=>'登陆后才能评论']);
        }
    }

    /**
     * 错误统一输出
     * @param $model
     */
    public function returnError($model)
    {
        foreach($model->getErrors() as $errVal) {
            Json::returnJson(['code'=>self::FAIL_CODE,'msg'=>$errVal['0']]); // 错误一个一个的输出
        }
    }

    /**
     * 返回错误的消息
     * @param string $message 消息的内容
     * @return void
     */
    public function errorCode($message)
    {
        echo Json::encode(['code' => self::FAIL_CODE , 'msg'=>$message]);
        \Yii::$app->end();
    }

    /**
     * 返回成功信息
     * @param array $param
     */
    public function returnSuccess($param = [])
    {
        $callback = \Yii::$app->request->get('callback');
        $status = ['code'=>self::SUCCESS_CODE];
        $return = array_merge($status , $param);
        if($callback){
            echo $callback."(".Json::encode($return).")";
        }else{
            echo Json::encode($return);
        }
        \Yii::$app->end();
    }
}