<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/leaderboard/tabs', TEMPLATE_INCLUDEPATH)) : (include template('web/leaderboard/tabs', TEMPLATE_INCLUDEPATH));?>


<button id="run">粉丝计算任务</button>
<div id="dospace" style="display: none">
    正在执行:第(<span id="page">0</span>)页数据,总计<?php  echo $pagesum;?>页,请等待......
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>
<script type="text/javascript">
    var page = 1;
    function doFans(){
        $("#page").text(page);
        $.post("/web/index.php?c=site&a=entry&p=dofans&do=leaderboard&m=sea&op=run",{'dopage':page},function(res){
            if(res.type == "success"){
                page++;
                doFans();
            }else{
                $("#dospace").text("粉丝计算任务完成");
            }
        },"json");
    }
    $("#run").click(function(){
        $("#dospace").show();
        doFans();
    });
</script>