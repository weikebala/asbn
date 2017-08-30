<?php defined('IN_IA') or exit('Access Denied');?><!-- download -->
<style type="text/css">
    .down-sec {
        background: url(/addons/sea/static/images/1px646469.png) repeat;
        height: 35px;
        width: 100%;
        position: fixed;
        bottom: 50px;
        left: 0rem;
        z-index: 500;
    }
    .disl-flt {
        display: inline-block;
        width: 100%;
        float: left;
    }
    .down-main {
        height: 35px;
        position: relative;
    }

    .dowm-app-main {
        height: 25px;
        margin-top: 5px;
        margin-left: 28px;
    }
    .down-tip {
        line-height: 25px;
        color: #fff;
        font-size: 12px;
        color: #fff;
        margin-left: 4px;
    }
    .down-btn-open {
        height: 25px;
        line-height: 25px;
        text-align: center;
        width: 73px;
        color: #333;
        background: #fff;
        border-radius: 2px;
        float: right;
        margin-right: 40px;
        font-size: 12px;
    }
    .close-down-lk {
        height: 35px;
        width: 28px;
        position: absolute;
        top: 0rem;
        left: 0rem;
        font-size: 12px;
    }
    .down-close-sec-ico {
        width: 13px;
        height: 13px;
        float: left;
        display: inline-block;
        background:url(/addons/sea/static/images/img_03.png);
        background-size: 13px 13px;
    }
    <?php  if($designer) { ?>
    .down-sec{
        bottom:68px;
    }
    <?php  } ?>
</style>
<section id="dtip" class="down-sec">
    <div class="disl-flt down-main">
        <div class="disl-flt dowm-app-main">
      <span class="down-log-ico-span">
        <i class="p-ico down-log-ico"></i>
      </span>
            <!-- end -->
            <span class="down-log-ico-span down-tip">下载APP, 发现更多精彩</span>
            <a class="down-btn-open" href="<?php echo UPLOADAPPURL;?>">点击打开</a>
        </div>
        <!-- end -->
        <a href="javascript:;" class="close-down-lk">
            <i onclick="H.hdDown()" class="p-ico down-close-sec-ico"></i>
        </a>
    </div>
</section>
<script type="text/javascript">
    var H = {
        init:function(){
            var qxtip=sessionStorage.getItem("qxtip");
            if(qxtip=="yes"){
                $("#dtip").hide();
            }
        },
        hdDown:function(){
            sessionStorage.setItem("qxtip","yes");
            $("#dtip").fadeOut();
        }
    };
    $(function(){H.init();});
</script>