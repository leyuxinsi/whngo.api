<?php
/**
 * Created by PhpStorm.
 * User: yanyi
 * Date: 2017/1/20
 * Time: 10:47
 */
use common\helpers\Url;
$this->title = $title.' - 武汉社会组织公益创投大赛';
$path_info = Yii::$app->request->pathInfo;
?>
<!-- 左边内容开始  -->
<div class="w-md fl">
    <div class="w-panel new-item">
        <div class="new-banner">
            <img src="<?php echo Url::to('@web/img/ssxw.jpg') ?>">
        </div>
        <div class="title">
            <h1><?php echo $title; ?></h1>
            <p>
                <span>时间：<?php echo $create_time; ?></span>
                <span>发布人：公益创投编辑</span>
            </p>
        </div>
        <div class="content"><?php echo $content; ?></div>
    </div>

    <?php /*if($path_info=='news/item'): */?><!--
    <div class="w-panel">
        <a href="">上一篇：</a><a href="">上一篇：没有了 </a><br>
        <a href="">下一篇：</a><a href="">下一篇：没有了 </a>
    </div>
    --><?php /*endif; */?>
</div>
<!-- 左边内容结束  -->

<!--右侧-->
<div class="w-xs fr">
    <?php echo \Yii::$app->view->renderFile('@app/views/public/sidebar.php'); ?>
</div>