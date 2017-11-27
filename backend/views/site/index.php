<?php

/* @var int $level */
use common\helpers\Url;
$this->title = '武汉社会组织公益创投大赛';
?>

<div class="w-panel">
    <div id="myNiceCarousel" class="carousel slide" data-ride="carousel">
        <!-- 圆点指示器 -->
        <ol class="carousel-indicators">
            <?php for ($i=0;$i<count($banner);$i++): ?>
            <li data-target="#myNiceCarousel" data-slide-to="<?php echo $i; ?>" <?php echo !$i ? 'class="active"' : ''; ?>></li>
            <?php endfor; ?>
        </ol>

        <!-- 轮播项目 -->
        <div class="carousel-inner">
            <?php foreach ($banner as $key => $value): ?>
                <div class="item <?php echo !$key ? 'active' : ''; ?>">
                    <img alt="First slide" src="<?php echo Url::uploadUrl($value['ban_pic_src']); ?>">
                    <div class="carousel-caption">
                        <h3><?php echo $value['ban_name']; ?></h3>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- 项目切换按钮 -->
        <a class="left carousel-control" href="#myNiceCarousel" data-slide="prev">
            <span class="icon icon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#myNiceCarousel" data-slide="next">
            <span class="icon icon-chevron-right"></span>
        </a>
    </div>
</div>

<div class="w clearfix">
    <div class="w-md fl">
        <div class="w-panel">
            <div class="leftCon">
                <h3 class="mod-title">赛事动态 <small><a href="<?php echo Url::toRoute('/feed'); ?>">更多>></a></small></h3>
                <div id="notice" class="carousel slide" data-ride="carousel">
                    <!-- 圆点指示器 -->
                    <ol class="carousel-indicators">
                        <?php for ($i=0;$i<count($feed);$i++): ?>
                            <li data-target="#notice" data-slide-to="<?php echo $i; ?>" <?php echo !$i ? 'class="active"' : ''; ?>></li>
                        <?php endfor; ?>
                    </ol>

                    <!-- 轮播项目 -->
                    <div class="carousel-inner">
                        <?php foreach ($feed as $key => $value): ?>
                            <?php
                            $img_group = unserialize($value['img_url']);
                            ?>
                        <div class="item <?php echo !$key ? 'active' : ''; ?>" style="background: url('<?php echo $img_group['0'] ? Url::uploadUrl($img_group['0']) : Url::to('@web/img/slide1.jpg'); ?>')">
                            <div class="carousel-caption">
                                <?php $content = mb_substr($value['content'],0,140,'utf-8'); ?>
                                <h3><?php echo mb_strlen($value['content'],'utf-8') > 140 ? $content .'...' : $content .''; ?></h3>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- 项目切换按钮 -->
                    <a class="left carousel-control" href="#notice" data-slide="prev">
                        <span class="icon icon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#notice" data-slide="next">
                        <span class="icon icon-chevron-right"></span>
                    </a>
                </div>
            </div>

            <div class="leftCon_1">
                <h3 class="mod-title">比赛公告 <small><a href="<?php echo Url::toRoute('/news'); ?>">更多>></a></small></h3>
                <div class="announce">
                    <ul>
                        <?php foreach($news as $key => $value): ?>
                        <li>
                            <a href="<?php echo Url::toRoute(['/news/item','id'=>$value['news_id']]); ?>"><?php echo $value['title']; ?></a>
                            <div class="announce_time_index"><?php echo $key+1; ?></div>
                            <div class="right_arrow1"></div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <div class="showPics">
                <!--图集-->

                <?php foreach($pic_news as $value): ?>
                <div class="showPic">
                    <a href="<?php echo Url::toRoute(['/news/item','id'=>$value['news_id']]); ?>" target="_blank">
                        <img src="<?php echo Url::uploadUrl($value['cover']); ?>" width="233" height="130">
                    </a>
                    <span><?php echo $value['title']; ?></span>
                    <div class="showPic_txt"></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="w-xs fr">
        <?php echo \Yii::$app->view->renderFile('@app/views/public/sidebar.php'); ?>
    </div>
</div>

<div class="w mt-0">
    <div class="w-panel">
        <div class="sponsor">
            <img src="<?php echo Url::to('@web/img/wanke.jpg'); ?>" alt="">
        </div>
        <div class="sponsor"><img src="<?php echo Url::to('@web/img/zz2.png'); ?>" border="0">

        </div>
        <div class="sponsor"><img src="<?php echo Url::to('@web/img/zz3.png'); ?>" border="0">
        </div>
    </div>
</div>