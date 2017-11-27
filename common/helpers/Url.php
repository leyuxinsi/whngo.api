<?php
/**
 * Created by PhpStorm.
 * User: yanyi
 * Date: 2016/11/25
 * Time: 12:57
 */
namespace common\helpers;
use yii\helpers\BaseUrl;
use Yii;
class Url extends BaseUrl{

    /**
     * 获取当前完整URL
     * @return string
     */
    public static function currentUrl()
    {
        return Yii::$app->request->getHostInfo().Yii::$app->request->url;
    }

    /**
     * 设置登录后的回跳链接
     * @param string $url 如果有url，则跳转到url，否则设置为当前页面url
     * @param $url
     */
    public static function setBackUrl($url='')
    {
        Yii::$app->user->returnUrl = $url ? $url : self::currentUrl();
    }

    /**
     * 解析出URL的一级域名
     *
     * @param string $url
     * @return string
     */
    public static function parseUrlHost($url)
    {
        if(!$url) return false;
        $parse_url = parse_url($url);
        return $parse_url['scheme'].'://'.$parse_url['host'];
    }

    /**
     * 解析出url的文件名
     * @param string $file_path
     * @return string
     */
    public static function parseUrlFileName($file_path)
    {
        return substr(strrchr($file_path, '/'),1);
    }

    /**
     * 获取uploads的图片链接，带可以web浏览器访问的host
     * @param string $img_url
     * @param int|bool $width
     * @param int|bool $height
     * @return string
     */
    public static function uploadUrl($img_url , $width=false , $height=false)
    {
        if(!$img_url) return false;
        $upload_host = Yii::$app->params['uploadHost'];
        $file_name = substr(strrchr($img_url, '/'),1);

        $prefix_dir = substr($img_url , 0 , strrpos($img_url , '/')+1);
        if($width && $height)
        {
            $file_name = 't_'.$width.'_'.$height.'_'.$file_name;
        }
        return $upload_host.'/'.$prefix_dir.$file_name;
    }

    /**
     * 生成缩略图的路径
     * @param string $original_url
     * @param int $width
     * @param int $height
     * @return string
     */
    public static function createThumbPath($original_url , $width=0 , $height=0)
    {
        $prefix_dir = substr($original_url , 0 , strrpos($original_url , '/')+1);
        $file_name = substr(strrchr($original_url, '/'),1);
        return $prefix_dir.'t_'.$width.'_'.$height.'_'.$file_name;
    }

    /**
     * 获取官网的链接Host
     * @param string $route
     * @return string
     */
    public static function wwwUrl($route='')
    {
        return Yii::$app->params['wwwHost'].$route;
    }
}