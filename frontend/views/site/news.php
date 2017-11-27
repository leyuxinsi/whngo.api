<?php
/**
 * Created by PhpStorm.
 * User: yanying
 * Date: 2016/12/18
 * Time: 20:06
 */
use yii\helpers\Html;
?>
<div class="news">
    <h3><?php echo $item['title']; ?></h3>
    <p class="mt-15">时间：<?php echo date("Y-m-d H:i:s",$item['create_time']); ?></p>
    <div class="content">
        <?php echo Html::decode($item['content']); ?>
    </div>

</div>
