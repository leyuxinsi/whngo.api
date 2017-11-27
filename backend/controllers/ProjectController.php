<?php
namespace frontend\controllers;
use common\helpers\GrabImage;
use common\models\Project;
use common\models\ProjectImg;
use common\models\Support;
use common\models\User;
use Grafika\Grafika;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;

/**
 * 投票项目管理
 * Class ProjectController
 * @package frontend\controllers
 */

class ProjectController extends BaseController
{
    /**
     * 新闻首页
     * @return void
     */
    public function actionIndex()
    {
        $page = \Yii::$app->request->get('page',1);
        $page_size = \Yii::$app->request->get('page_size',20);
        $list = Project::findList($page,$page_size);
        // 查询一张图片作为封面图
        foreach ($list['list'] as $key => $value){
            $pro_img = ProjectImg::findOne(['pro_id'=>$value['pro_id']]);
            $list['list'][$key]['cover'] = \Yii::$app->params['uploadHost'].'/'. $pro_img->img_src;
        }

        $next_load = false;
        if($list['count'] > $page_size*$page){
            $next_load=true;
        }

        $this->returnSuccess(['project'=>$list['list'],'next_load'=>$next_load,'total_rows'=>$list['count']]);
    }

    /**
     * 项目详情页面
     */
    public function actionItem()
    {
        $pro_id = \Yii::$app->request->get('project_id');
        $project_info = Project::findById($pro_id);
        if(!$project_info){
            throw new NotFoundHttpException;
        }

        $project_img = ProjectImg::find()
            ->select(['CONCAT("'.\Yii::$app->params['uploadHost'].'/'.'",img_src) as img_url'])
            ->where(['pro_id'=>$pro_id,'delete_flag'=>self::DELETE_FALSE])
            ->asArray()->all();

        $this->returnSuccess(['header_cover'=>$project_img['0']['img_url'],'project_info'=>$project_info,'pro_img'=>$project_img]);
    }

    /**
     * 生成二维码接口
     */
    public function actionQrCode()
    {
        require_once '../../common/library/PHPQrcode/qrlib.php';

        $url = "http://wx.whngo.com/Index/item.html?id=".\Yii::$app->request->get('project_id');
        $margin = 1;  //外边距
        $size = 6;    //大小

        //设置 header 头,直接输出图片
        \Yii::$app->response->headers->set('Content-Type', 'image/png');

        //根据参数生成二维码 , 将其第二个参数值设为 false ,也就是不输出图片文件
        \QRcode::png($url, false, "L", $size, $margin);
        die();
    }

    /**
     * 获取项目支持列表
     */
    public function actionSupport()
    {
        $page = \Yii::$app->request->get('page',1);
        $page_size = \Yii::$app->request->get('page_size',20);
        $pro_id = \Yii::$app->request->get('project_id');
        $support = Support::findListByProId($pro_id,$page,$page_size);
        foreach ($support['list'] as $key => $value){
            $support['list'][$key]['create_time'] = date("Y-m-d",$value['create_time']);
        }

        $next_load = false;
        if($support['count'] > $page_size*$page){
            $next_load=true;
        }

        $this->returnSuccess(['support'=>$support['list'],'next_load'=>$next_load,'total_count'=>$support['count']]);
    }

    /**
     * 批处理一下之前的图片，制作缩略图
     */
    /*public function actionMake()
    {
        set_time_limit(0);
        $grab = new GrabImage();
        $user = User::find()->select(['user_id','headimg'])->where('user_id > 3379')->limit(500)->asArray()->all();

        foreach ($user as $value){
            if(!$value['headimg']){
                continue;
            }
            $icon_url = $grab->getInstances($value['headimg'] , \Yii::$app->params['uploadDir']);
            $model = User::findOne($value['user_id']);
            $model->cover = $icon_url;
            $model->save();
        }
    }*/

    /**
     * 创建缩略图，只管宽度，不管高度
     * @param $img_url
     * @param int $width
     * @param int $height
     * @return string
     */
    /*public function createThumb($img_url , $width = 232 , $height = 140)
    {
        $url_arr = explode('/',$img_url);
        $file_name = end($url_arr);
        $last_position =  strrpos($img_url , '/')+1;
        $prefix_dir = substr($img_url,0,$last_position);
        $thumb_name = 't_'.$width.'_'.$height.'_'.$file_name;
        $thumb_url = $prefix_dir.$thumb_name;

        $editor = Grafika::createEditor(); // Create the best available editor
        $editor->open($img_url);
        $editor->resizeFill($width , $height);
        $editor->save($thumb_url,null,100);
    }*/

}
