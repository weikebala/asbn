<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header_center', TEMPLATE_INCLUDEPATH)) : (include template('common/header_center', TEMPLATE_INCLUDEPATH));?>
<title>分享页面</title>

<style type="text/css">
body {margin:0px; background:#f4f4f4;}
.top1 {height:68px; background:#fff; border-bottom:#e3e3e3; overflow:hidden;}
.top1 .ico {height:44px; width:44px; margin:12px; background:#fe9900; border-radius:44px; font-size:30px; line-height:44px; text-align:center; color:#fff; float:left;}
.top1 .info1 {height:44px; padding:12px 0px; float:left;}
.top1 .info1 .t1 {height:22px; font-size:16px; color:#666; line-height:26px;}
.top1 .info1 .t2 {height:22px; font-size:13px; color:#999; line-height:20px;}
.top1 span {color:#ff6600}
.img {padding:1px;overflow:hidden;height:auto;width: 400px;float: left;}
.img img { width:100%;}

.info {float: left;width: 800px;height:auto; background:#fff; padding:10px; padding-bottom:80px; border-bottom:1px solid #eee; border-top:1px solid #eee;}
.info .title {height:38px; border-bottom:1px solid #eee; overflow:hidden;}
.info .title .ico {height:24px; width:24px; background:#fd6401; margin:7px 7px 7px 0px; border-radius:24px; font-size:12px; color:#fff; line-height:24px; text-align:center; float:left;}
.info .title .text {height:38px; line-height:38px; font-size:14px; color:#666; float:left;}
.info .con {height:auto; padding:10px 0px;}
.info .con .line {height:auto; overflow:hidden; margin-bottom:5px;}
.info .con .line .t1 {height:auto; width:55px; float:left; font-size:14px; color:#666; line-height:20px;}
.info .con .line .t2 {padding-left:55px; background:#f90;}
.info .con .line .t2 .t3 {height:auto; float:left; font-size:14px; color:#999;}
.info .info2 {height:auto; background:#fe924a; padding:10px; font-size:14px; color:#fff;}

.bottom {height:50px; width:100%; background:#fff; padding:10px; border-top:1px solid #eee; /*position:fixed; bottom:0px; left:0px;*/ box-shadow:1px 2px 10px rgba(0,0,0,0.2);overflow: hidden;width: 800px;float: left;}
.bottom .sub {height:50px; width:46%; margin-left:2%; float:left; border:1px solid #eee; border-radius:3px; font-size:16px; line-height:50px; text-align:center; color:#666;}


</style> 
 <?php  if(!empty($goods)) { ?>
      <div class="top1">
    	<div class="ico"><i class="fa fa-cny"></i></div>
        <div class="info1">
            <div class="t1"><?php  echo $this->set['texts']['commission1']?><span><?php  echo $commission;?></span>元</div>
            <div class="t2">已销售 <span><?php  echo $goods['sales'];?></span> 件</div>
        </div>
    </div>
    <?php  } ?>
    
    <!-- 系统生成图片 开始 -->
    <div class="all-divbox">
    <div class="img">
        <img id='posterimg' style='display:none' />
    </div>
    <!-- 系统生成图片 结束 -->
	<div class="info">
    	<div class="title">
        	<div class="ico"><i class="fa fa-cubes"></i></div>
            <div class="text">如何赚钱</div>
        </div>
        <div class="con">
          <div class="line">
           	<div class="t1">第一步</div>
                <div class="t2">
                	<div class="t3">转发商品链接或商品图片给微信好友；</div>
                </div>
          </div>
          <div class="line">
           	<div class="t1">第二步</div>
                <div class="t2">
                	<div class="t3">从您转发的链接或图片进入商城的好友，<?php  if($this->set['become_child']==1) { ?>如果您的好友下单，<?php  } ?><?php  if($this->set['become_child']==2) { ?>如果您的好友下单并付款，<?php  } ?>系统将自动锁定成为您的客户, 他们在微信商城中购买任何商品，您都可以获得<?php  echo $this->set['texts']['commission1']?>；</div>
                </div>
          </div>
          <div class="line">
           	<div class="t1">第三步</div>
                <div class="t2">
                	<div class="t3">您可以在<?php  echo $this->set['texts']['center']?>查看【<?php  echo $this->set['texts']['myteam']?>】和【<?php  echo $this->set['texts']['order']?>】，好友确认收货后<?php  echo $this->set['texts']['commission']?>方可<?php  echo $this->set['texts']['withdraw']?>。</div>
                </div>
          </div>
  	    </div>
        <div class="info2">说明：分享后会带有独有的推荐码，您的好友访问之后，系统会自动检测并记录客户关系。如果您的好友已被其他人抢先发展成了客户，他就不能成为您的客户，以最早发展成为客户为准。</div>
        <div  style="margin: 10px 0px;">专属推广链接：<input type="text" id="biao1" value="<?php  echo $share_my_Url?>" style="color:black;width: 86%;"  readonly="readonly" /></div>
        <input type="button" onClick="copyUrl2()" value="点击复制" style="background:#fe924a;border:0;padding:4px 8px;color:#fff;border-radius: 4px;" />
	</div>
<script type="text/javascript">
    function copyUrl2()
    {
        var Url2=document.getElementById("biao1");
        Url2.select(); 
        document.execCommand("Copy"); 
        alert("已复制推广链接。");
    }
</script>
    <!-- 底部浮层 开始 -->
    <div class="bottom">
        <?php  if(is_weixin()) { ?>
        <div id="btn1" class="sub" style="margin:0px;"><i class="fa fa-link" style="height:18px; width:18px; color:#fcac71; border:1px solid #fcac71; border-radius:20px; line-height:18px; text-align:center; font-size:14px;"></i> 链接推广</div>
        <div id="btn2" class="sub"><i class="fa fa-image" style="height:18px; width:18px; color:#63b3aa; border:1px solid #63b3aa; border-radius:20px; line-height:18px; text-align:center; font-size:12px;"></i> 图片推广</div>
        <?php  } else { ?>
        <!-- JiaThis Button BEGIN -->
        <div class="jiathis_style_m"></div>
        <script "text/javascript"> 
            var jiathis_config = { 
                url: "<?php  echo $_W['shopshare']['link']?>", 
                title: "<?php  echo $_W['shopshare']['title']?>", 
                summary:"<?php  echo $_W['shopshare']['desc']?>" 
            } 
        </script> 
        <script type="text/javascript" src="http://v3.jiathis.com/code/jiathis_m.js" charset="utf-8"></script>
        <!-- JiaThis Button END -->
        <?php  } ?>
    </div>
    <div id='cover'><img src='../addons/sea/static/images/guide.png' style='width:100%;' /></div>
    </div>
    <!-- 底部浮层 结束 -->
    <script language="javascript">
        require(['core'],function(core){
           if( "<?php  echo $infourl;?>"!=''){
                core.message('您需要完善您的资料才能继续!',"<?php  echo $infourl;?>","warning");
                return;
            }
            $('#btn1').click(function(){
                $('#cover').fadeIn(200).unbind('click').click(function(){
                    $(this).fadeOut(100);
                })
            });
            $('#btn2').click(function(){
                  core.tip.alert('长按图片收藏，然后发送给好友') ;
            });
            core.tip.show('正在生成海报，请稍后...','middle',0);
            $.ajax({
                url:'', 
                type:'post',
                success:function(img){ 
                    console.log(img);
                    $("#posterimg").attr('src',img).show();
                    core.tip.show(false);
                }
            })
        })
        </script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/bottom', TEMPLATE_INCLUDEPATH)) : (include template('common/bottom', TEMPLATE_INCLUDEPATH));?>
