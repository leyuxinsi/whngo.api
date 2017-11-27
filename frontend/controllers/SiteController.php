<?php
namespace frontend\controllers;

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
     * @return void
     */
    public function actionIndex()
    {
        // 比赛结束时间
        $end_timestamp = Config::findOne(['conf_key'=>'ProjectEndTime'])->conf_value;
        $end_time_len = $end_timestamp-time();
        $end_time = [
            'time_stamp'=>$end_timestamp,
            'time_stamp_len'=>$end_time_len,
            "date_time"=>date("Y-m-d H:i:s",$end_timestamp)
        ];

        // banner
        $banner = Banner::findLists();

        // 项目展示图
        $host = \Yii::$app->params['uploadHost'].'/project_cover/';
        $project_cover=[
            ['name'=>'最左图','project_id'=>'186','cover'=>$host.'001.jpg'],
            ['name'=>'左二上图','project_id'=>'186','cover'=>$host.'002.jpg'],
            ['name'=>'左二下图','project_id'=>'165','cover'=>$host.'003.jpg'],
            ['name'=>'左三图','project_id'=>'115','cover'=>$host.'004.jpg'],
            ['name'=>'最右图','project_id'=>'243','cover'=>$host.'005.jpg'],
            ];

        // 比赛公告
        $feed = Feed::findListsByLimit();
        foreach ($feed as $key =>$value){
            $feed[$key]['create_time'] = date("Y-m-d");
            $feed[$key]['image'] = \Yii::$app->params['uploadHost'].'/'.unserialize($value['img_url'])['0'];
            unset($feed[$key]['img_url']);
        }

        // 最新评论数据
        $comment = Support::findLastSupport();

        $this->returnSuccess([
            'end_time'=>$end_time,
            'banner'=>$banner,
            'project_cover'=>$project_cover,
            'feed'=>$feed,
            'comment'=>$comment,
        ]);
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
