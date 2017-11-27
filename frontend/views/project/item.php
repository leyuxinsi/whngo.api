<?php
/**
 * Created by PhpStorm.
 * User: yanyi
 * Date: 2017/1/20
 * Time: 11:23
 */
use common\helpers\Url;
$this->title = $item['pro_name'];
?>
<!-- 左边内容开始  -->
<div class="w-md fl">
    <div class="w-panel p-details">
        <div class="title pb-10">
            <h1 class="mb-15"><?php echo $item['pro_name']; ?></h1>
            <p>
                <span>时间：2016-05-24</span>
                <span>类别：<?php echo $item['type_name']; ?></span>
            </p>
        </div>

        <div class="content"><?php echo $item['pro_content']; ?></div>

        <?php
        //var_dump($pro_img);
        ?>
        <div class="pro-img">
            <?php foreach($pro_img as $value): ?>
            <img src="<?php echo Url::uploadUrl($value['img_src'],false,false) ?>" />
            <?php endforeach; ?>
        </div>
    </div>

    <div class="w-panel pb-0">
        <div class="panel-headimg">
            <h3>TA的支持者</h3>
        </div>
        <div class="comments">
            <?php foreach($support['list'] as $value):?>
            <section class="comments-list">
                <div class="comment">
                    <a href="Javascript:void(0);" class="avatar">
                        <img src="<?php echo $value['headimg']; ?>" alt="<?php echo $value['user_nickname']; ?>">
                    </a>
                    <div class="content">
                        <div class="pull-right text-muted"><?php echo date("Y-m-d",$value['create_time']); ?></div>
                        <div><strong><?php echo $value['user_nickname']; ?></strong> <span class="text-muted">支持了</span> <span class="red"><?php echo $value['total_price']; ?></span>&nbsp;元</div>
                        <div class="text"><?php echo $value['word']; ?></div>

                    </div>
                </div>
            </section>
            <?php endforeach; ?>
            <?php echo \yii\widgets\LinkPager::widget([
                'pagination' => $support['pagination'],
                'nextPageLabel' => '下一页',
                'prevPageLabel' => '上一页',
                'firstPageLabel' => '首页',
                'lastPageLabel' => '尾页',
                'options' => ['class' => 'pagination'],
            ]); ?>
        </div>
    </div>
</div>

<div class="w-xs fr">
    <div class="w-panel side-author">
        <div class="headimg">
            <img width="100" height="100" src="<?php echo $item['headimg']; ?>" />
        </div>
        <h3><?php echo $item['user_nickname'] ?></h3>
        <p><?php echo $item['pro_company'] ? $item['pro_company'] : '未填写申报单位'; ?></p>
        <div class="count clearfix">
            <dl>
                <dt><?php echo $item['funds_amount'] ?><em>元</em></dt>
                <dd>已筹金额</dd>
            </dl>
            <dl>
                <dt><?php echo $item['support_amount'] ?><em>次</em></dt>
                <dd>支持次数</dd>
            </dl>
            <dl>
                <dt><?php echo $item['focus_amount'] ?><em>次</em></dt>
                <dd>关注次数</dd>
            </dl>
        </div>
    </div>

    <?php echo \Yii::$app->view->renderFile('@app/views/public/sidebar.php'); ?>
</div>
