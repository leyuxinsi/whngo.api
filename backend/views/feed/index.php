<?php
/**
 * Created by PhpStorm.
 * User: yanyi
 * Date: 2017/2/3
 * Time: 16:36
 */
use common\helpers\Url;
$this->title = "比赛公告";
?>

<div class="w-md fl">
    <?php foreach($result['list'] as $value): ?>
    <div class="w-panel feed-item">
        <div class="info">
            <div class="avatar"><img src="<?php echo Url::to('@web/img/moneytype.png'); ?>" alt=""></div>
            <div class="nickname">
                <h3>汉公益 <span>官方公告</span></h3>
                <p><?php echo date("Y-m-d H:i:s" , $value['create_time']); ?></p>
            </div>
        </div>
        <div class="content"><?php echo $value['content']; ?></div>
        <div class="img">
            <?php
            $img_group = unserialize($value['img_url']);
            foreach ($img_group as $img_url):
            ?>
            <img src="<?php echo Url::uploadUrl($img_url,false,false); ?>" alt="">
            <?php endforeach; ?>
        </div>
    </div>
    <?php endforeach; ?>

    <?php echo \yii\widgets\LinkPager::widget([
        'pagination' => $result['pagination'],
        'nextPageLabel' => '下一页',
        'prevPageLabel' => '上一页',
        'firstPageLabel' => '首页',
        'lastPageLabel' => '尾页',
        'options' => ['class' => 'pagination'],
    ]); ?>
</div>

<div class="w-xs fr">
    <?php echo \Yii::$app->view->renderFile('@app/views/public/sidebar.php'); ?>
</div>
