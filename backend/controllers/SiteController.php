<?php
namespace backend\controllers;

use common\helpers\Json;
use common\helpers\Url;
use common\models\Banner;
use common\models\ClassLevel;
use common\models\Coach;
use common\models\Config;
use common\models\Feed;
use common\models\LoginCode;
use common\models\News;
use common\models\School;
use common\models\SchoolAdmin;
use common\models\Support;
use Yii;

class SiteController extends BaseController
{
    /**
     * 网站首页接口数据
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionError()
    {
        echo 'error';
    }

    public function actionInfo()
    {
        phpinfo();
    }
}
