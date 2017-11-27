<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;
use common\helpers\Url;
use common\models\Config;

AppAsset::register($this);
$path_info = Yii::$app->request->pathInfo;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script src="<?php echo Url::to('@web/js/jquery-2.1.4.min.js'); ?>"></script>
    <script src="<?php echo Url::to('@web/js/vue.min.dev.js'); ?>"></script>
    <script src="<?php echo Url::to('@web/plug/zui/js/zui.js'); ?>"></script>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrapper">
    <!--top-->
    <div class="topbanner">
        <object type="application/x-shockwave-flash" data="<?php echo Url::to('@web/img/index_nocar.swf'); ?>" width="1920" height="120" style="height: 120px">
            <param name="quality" value="high">
            <param name="wmode" value="opaque">
            <param name="swfversion" value="24.0.0.0">
        </object>
    </div>

    <div class="top">
        <div class="topCon" style="padding-top: 32px">
            <div class="logo"><img src="<?php echo Url::to('@web/img/logo.png'); ?>"></div>
            <div class="slogan" style="margin-left: 3%; margin-top: 0%;"><img src="<?php echo Url::to('@web/img/slogan_1.png'); ?>"></div>
            <div class="clear"></div>
        </div>
    </div>

    <!--首页导航开始  -->
    <div class="menu box">
        <ul class="w">
            <li><a href="<?php echo Url::toRoute('/'); ?>" <?php echo !$path_info ? 'class="active"' : ''; ?>>首页</a></li>
            <li><a href="<?php echo Url::toRoute('/news/sign-guide'); ?>" <?php echo $path_info=='news/sign-guide' ? 'class="active"' : ''; ?>>报名指南</a></li>
            <li><a href="<?php echo Url::toRoute('/feed'); ?>" <?php echo $path_info=='feed' ? 'class="active"' : ''; ?>>比赛公告</a></li>
            <li><a href="<?php echo Url::toRoute('/news'); ?>" <?php echo $path_info=='news' || $path_info=='news/item' ? 'class="active"' : ''; ?>>赛事动态</a></li>
            <li><a href="<?php echo Url::toRoute('/project'); ?>" <?php echo $path_info=='project' || $path_info=='project/item' ? 'class="active"' : ''; ?>>项目列表</a></li>
            <li><a href="<?php echo Url::toRoute('/news/contact'); ?>" <?php echo $path_info=='news/contact' ? 'class="active"' : ''; ?>>联系我们</a></li>
        </ul>

    </div>

    <div class="w">
        <?php echo $content; ?>
    </div>

    <!--底部开始-->
    <div class="bottom">

        <div class="bottomMid" style="margin-top: 1.7%">
            <img src="<?php echo Url::to('@web/img/bottomLogo2.png'); ?>">
            <div class="copyRight" style="text-align: right;color: #ffffff;letter-spacing: 1px;line-height: 18px">


                <div class="copyRight_child">
                    <div>指导单位</div>
                    <?php $GuidanceUnit = Config::findOne(['conf_key'=>'GuidanceUnit']); ?>
                    <span><?php echo $GuidanceUnit->conf_value; ?></span><br>
                </div>
                <div class="copyRight_child">
                    <div>主办单位</div>
                    <span>武汉市社会组织发展基金会</span><br>
                </div>

                <div class="copyRight_child copyRight_last">
                    <div>友情链接</div>
                    <span><a href="http://www.whnpo.org" target="_blank">武汉市社会组织发展基金会</a> |</span>
                </div>


            </div>
        </div>

    </div>
    <div class="statement">
        Copyright <?php echo date("Y"); ?> by <?php echo $_SERVER['HTTP_HOST']; ?> . All rights reserved  备案信息：鄂ICP备13012797号-1
    </div>
    <!--底部结束-->

    <div class="qrCode"><img src="<?php echo Url::to('@web/img/wx.jpg'); ?>"></div>

</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>