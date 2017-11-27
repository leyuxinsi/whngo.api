<?php
namespace frontend\controllers;

use common\models\Config;

/**
 * 单篇文章页
 */
class ContentController extends BaseController
{
    /**
     * 文章内容详情
     * @return string
     */
    public function actionIndex()
    {
        $config = Config::findOne(['conf_key'=>'signGuide']);
        return $this->render('index');
    }
}
