<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\helpers;

use Yii;
use yii\base\Object;

/**
 * Created by PhpStorm.
 * 抓取远程图片到本地，可以抓取不带有后缀的图片哦
 * User: yanying
 * Date: 2015/11/17
 * Time: 17:30
 */
class GrabImage extends Object{

    /**
     * @var string 需要抓取的图片的地址URL
     */
    public $img_url;
    /**
     * @var string 需要保存的文件名称
     */
    public $file_name;
    /**
     * @var string 保存的路径名称 一般为日期路径
     */
    public $save_dir;
    /**
     * @var string 文件的拓展名
     */
    public $extension;

    public $date_dir;

    /**
     * @param string $img_url 需要抓取的图片地址
     * @param string $base_dir 本地保存的路径
     * @return bool|int
     */
    public function getInstances($img_url , $base_dir)
    {
        $this->img_url = $img_url;
        $this->date_dir = date("Ym").'/'.date("d").'/';
        $this->save_dir = $base_dir.$this->date_dir;
        return $this->start();
    }

    /**
     * 开始抓取图片
     */
    public function start()
    {
        if($this->setDir())
        {
            return $this->getRemoteImg();
        }
        else
        {
            return false;
        }
    }

    /**
     * 设置图片保存路径
     *
     * @return bool
     */
    public function setDir()
    {
        //图片保存路径,默认保存在该代码所在目录(可根据实际需求修改保存路径)
        if(!file_exists($this->save_dir))
        {
            mkdir($this->save_dir,0777,TRUE);
        }

        $this->file_name = uniqid().Yii::$app->security->generateRandomString(16);//文件名

        return true;
    }

    /**
     * 抓取远程图片核心方法，可以同时抓取有后缀名的图片和没有后缀名的图片
     *
     * @return bool|int
     */
    public function getRemoteImg()
    {
        /*$url = "http://wx.qlogo.cn/mmopen/NDCVy4LIiatBibEYNpgNrCgTqWC8WEYeQwIQMCFZGB4I0mibAuCHVibZucu8wUCHrLHdSGkYq2iauGkWGXl378eWHrJrS1tfIXcae/0";
        $url="http://img4.doubanio.com/view/photo/photo/public/p2284634879.jpg";*/
        // mime 和 扩展名 的映射
        $mimes=array(
            'image/bmp'=>'bmp',
            'image/gif'=>'gif',
            'image/jpeg'=>'jpg',
            'image/png'=>'png',
            'image/x-icon'=>'ico'
        );
        // 获取响应头
        if(($headers=get_headers($this->img_url, 1))!==false)
        {
            // 获取响应的类型
            $type=$headers['Content-Type'];
            if(is_array($type))
            {
                $type = $type['1'];
            }
            // 如果符合我们要的类型
            if(isset($mimes[$type]))
            {
                $this->extension=$mimes[$type];
                $file=$this->save_dir.$this->file_name.".".$this->extension;
                // 获取数据并保存
                $contents=@file_get_contents($this->img_url);
                if(file_put_contents($file, $contents))
                {
                    return $this->date_dir.$this->file_name.".".$this->extension;
                }
            }
        }
        return false;

    }
}
