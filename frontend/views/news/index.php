<?php
/**
 * Created by PhpStorm.
 * User: yanyi
 * Date: 2017/1/20
 * Time: 11:23
 */
use common\helpers\Url;
use yii\helpers\Html;

$this->title = "赛事动态";
?>

<div class="w-md fl">

    <div class="w-panel pt-0 pb-0">

        <?php foreach($list['list'] as $value): ?>
            <div class="p-item">
                <div class="cover substr">
                    <a target="_blank" href="<?php echo Url::toRoute(['/news/item','id'=>$value['news_id']]); ?>">
                        <img class="lazy" width="232" height="140" data-original="<?php echo $value['cover'] ? Url::uploadUrl($value['cover']) : Url::to('@web/img/defaultpic.gif'); ?>" alt="" />
                    </a>
                </div>
                <div class="details">

                    <h3 class="substr">
                        <a href="<?php echo Url::toRoute(['/news/item','id'=>$value['news_id']]); ?>" target="_blank"><?php echo $value['title']; ?></a>
                    </h3>
                    <div class="summary substr"><?php echo mb_substr(strip_tags(Html::decode($value['content'])),0,50,'utf-8'); ?></div>
                    <ul class="author clearfix">
                        <li class="focus-btn">
                            <a href="<?php echo Url::toRoute(['/news/item','id'=>$value['news_id']]); ?>" class="btn btn-default">查看详情</a>
                        </li>
                    </ul>

                </div>
            </div>
        <?php endforeach; ?>

        <?php echo \yii\widgets\LinkPager::widget([
            'pagination' => $list['pagination'],
            'nextPageLabel' => '下一页',
            'prevPageLabel' => '上一页',
            'firstPageLabel' => '首页',
            'lastPageLabel' => '尾页',
            'options' => ['class' => 'pagination'],
        ]); ?>
    </div>
</div>

<div class="w-xs fr">
    <?php echo \Yii::$app->view->renderFile('@app/views/public/sidebar.php'); ?>
</div>

