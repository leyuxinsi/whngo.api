<?php
/**
 * Created by PhpStorm.
 * User: yanying
 * Date: 2016/12/25
 * Time: 16:49
 */
?>
<div class="am-panel am-panel-default" style="padding: 20px 0;">
    <div class="am-panel-bd am-cf">
        <form class="am-form" id="saveLocationForm">
            <fieldset>
                <div class="am-form-group">
                    <label for="account">账号</label>
                    <input type="text" name="account" class="" id="account" placeholder="输入账号">
                </div>

                <div class="am-form-group">
                    <label for="password">密码</label>
                    <input type="password" name="password" class="" id="password" placeholder="输入密码">
                </div>

                <div class="am-form-group">
                    <label for="Latitude">Latitude</label>
                    <input type="text" id="Latitude" name="latitude" readonly="readonly">
                </div>

                <div class="am-form-group">
                    <label for="Longitude">Longitude</label>
                    <input type="text" id="Longitude" name="longitude" readonly="readonly">
                </div>

                <p><button type="button" id="saveLocation" class="am-btn am-btn-block am-btn-primary">保存</button></p>

            </fieldset>
        </form>
    </div>
</div>

<script>
    var saveUrl = "<?php echo \common\helpers\Url::toRoute('/site/location'); ?>";
    $().ready(function () {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else{
            showError('该浏览器不支持获取位置信息');
        }
    });
    function showPosition(position) {
        $("#Latitude").val(position.coords.latitude);
        $("#Longitude").val(position.coords.longitude);
    }

    $("#saveLocation").on('click',function () {
        var self = $("#saveLocation");
        self.button('button');
        $.ajax({
            url:saveUrl,
            dataType:"json",
            type:'post',
            data:$("#saveLocationForm").serialize(),
            success:function(e){

                self.button('reset');

                if(e.code==1){
                    showError("操作成功");
                }else{
                    showError(e.msg);
                }
            }

        });
    });
</script>
