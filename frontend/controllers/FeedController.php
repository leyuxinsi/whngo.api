<?php
namespace frontend\controllers;

use common\models\Feed;

/**
 * 比赛动态
 */
class FeedController extends BaseController
{
    /**
     * 动态首页
     * @return void
     */
    public function actionIndex()
    {
        $feed = Feed::findListsByLimit();
        foreach ($feed as $key =>$value){
            $feed[$key]['create_time'] = date("Y-m-d");
            $feed[$key]['image'] = \Yii::$app->params['uploadHost'].'/'.unserialize($value['img_url'])['0'];
            unset($feed[$key]['img_url']);
        }
        $this->returnSuccess(['feed'=>$feed]);
    }
}
