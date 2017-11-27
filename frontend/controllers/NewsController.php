<?php
namespace frontend\controllers;

use common\models\Config;
use common\models\News;
use yii\bootstrap\Html;
use yii\web\NotFoundHttpException;

/**
 * 比赛公告
 */

class NewsController extends BaseController
{
    /**
     * 新闻首页
     * @return void
     */
    public function actionIndex()
    {
        $page = \Yii::$app->request->get('page',1);
        $page_size = \Yii::$app->request->get('page_size',20);
        $list = News::findList($page,$page_size);
        foreach ($list['list'] as $key => $value){
            $list['list'][$key]['cover'] = \Yii::$app->params['uploadHost'].'/'.$value['cover'];
            $list['list'][$key]['content'] = mb_substr(strip_tags(Html::decode($value['content'])),0,100,'utf-8');
        }
        $next_load = false;
        if($list['count'] > $page*$page_size){
            $next_load=true;
        }
        $this->returnSuccess(['list'=>$list['list'],'total_rows'=>$list['count'],'next_load'=>$next_load]);
    }

    /**
     * 新闻详情页面
     */
    public function actionItem()
    {
        $news_id = \Yii::$app->request->get('news_id');
        $news = News::find()->select(['title','cover','content','create_time'])->where(['news_id'=>$news_id])->asArray()->limit(1)->one();
        if(!$news){
            throw new NotFoundHttpException;
        }
        $news['cover'] = \Yii::$app->params['uploadHost'].'/'.$news['cover'];
        $news['content'] = Html::decode($news['content']);
        $news['create_time'] = date("Y-m-d",$news['create_time']);
        $this->returnSuccess(['news_info'=>$news]);
    }

    /**
     * 报名指南
     */
    public function actionSignGuide()
    {
        $config = Config::findOne(['conf_key'=>'signGuide']);
        $data = [
            'title'=>'报名指南',
            'create_time'=>date("Y-m-d",$config['create_time']),
            'content'=>Html::decode($config['conf_value']),
        ];
        return $this->returnSuccess(['content'=>$data]);
    }

    /**
     * 联系我们
     */
    public function actionContact()
    {
        $config = Config::findOne(['conf_key'=>'contact']);
        $data = [
            'title'=>'联系我们',
            'create_time'=>date("Y-m-d",$config['create_time']),
            'content'=>Html::decode($config['conf_value']),
        ];
        return $this->render('item',$data);
    }
}
