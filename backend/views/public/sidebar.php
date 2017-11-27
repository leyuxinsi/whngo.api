<?php
/**
 * Created by PhpStorm.
 * User: yanyi
 * Date: 2017/2/3
 * Time: 15:48
 */
use common\helpers\Url;
use common\models\Config;
$config = Config::findOne(['conf_key'=>'countDown']);
$end_time = strtotime($config->conf_value);
if($end_time <= time()){
    $txt = '已结束';
}else{
    $txt = ceil(($end_time - time()) / 86400);
}
?>
<div class="w-panel">
    <div class="countdown">
        <img src="<?php echo Url::to('@web/img/lasttime.png') ?>">
        <div class="timecount">
            <div class="digit">
                <span><?php echo $txt; ?></span>
            </div>
        </div>
    </div>
</div>

<div class="w-panel">
    <a href="<?php echo Url::toRoute('/news/sign-guide'); ?>">
        <img src="<?php echo Url::to('@web/img/link_03.png') ?>">
    </a>
</div>

<div class="w-panel">
    <img src="<?php echo Url::to('@web/img/label_12.jpg') ?>">
    <a href="<?php echo Url::toRoute('/project'); ?>">
        <img src="<?php echo Url::to('@web/img/link_13.jpg') ?>">
    </a>
</div>
