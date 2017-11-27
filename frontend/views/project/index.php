<?php
/**
 * Created by PhpStorm.
 * User: yanyi
 * Date: 2017/1/20
 * Time: 11:23
 */
use common\helpers\Url;
use yii\helpers\Html;
$this->title = "项目列表";
?>

<div class="w-md fl">

    <div class="w-panel pt-0 pb-0">
        <?php if(!$list['list']): ?>
        <div class="alert alert-info" style="margin-top: 20px;">暂无项目</div>
        <?php endif; ?>

        <?php foreach($list['list'] as $value): ?>
            <div class="p-item">

                <div class="cover substr">
                    <a target="_blank" href="<?php echo Url::toRoute(['/project/item','id'=>$value['pro_id']]); ?>">
                        <img class="lazy" width="232" height="140" data-original="<?php echo Url::uploadUrl($value['cover'],232,140); ?>" alt="" />
                    </a>
                </div>
                <div class="details">

                    <h3 class="substr">
                        <a href="<?php echo Url::toRoute(['/project/item','id'=>$value['pro_id']]); ?>" target="_blank"><?php echo $value['pro_name']; ?></a>
                    </h3>

                    <div class="number">
                        <span><?php echo $value['support_amount']; ?>&nbsp;人支持</span>
                        <span class="pointer">●</span>
                        <span>已筹&nbsp;￥<?php echo $value['funds_amount']; ?>&nbsp;元</span>
                    </div>
                    <div class="summary substr"><?php echo $value['pro_content']; ?></div>
                    <ul class="author clearfix">
                        <li class="headimg">
                            <img class="lazy" width="30" height="30" data-original="<?php echo $value['headimg']; ?>" alt="" />
                        </li>
                        <li class="nickname substr">
                            <?php echo $value['user_nickname']; ?>
                        </li>
                        <li class="focus-btn">
                            <a href="<?php echo Url::toRoute(['/project/item','id'=>$value['pro_id']]); ?>" class="btn btn-default">查看详情</a>
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

