/**
 * Created by yanying on 2016/12/18.
 */

$(function() {
    $("img.lazy").lazyload({
        effect : "fadeIn",
        failure_limit : 30
    });
});

