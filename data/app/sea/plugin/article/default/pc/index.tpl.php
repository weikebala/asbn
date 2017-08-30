<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/navigation', TEMPLATE_INCLUDEPATH)) : (include template('common/navigation', TEMPLATE_INCLUDEPATH));?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php  echo $article['article_title'];?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" id="viewport" name="viewport">
<meta name="format-detection" content="telephone=no" />
<link href="../addons/sea/plugin/article/template/imgsrc/pc.css" rel="stylesheet">
<script type="text/javascript" src="../addons/sea/static/js/dist/jquery-1.11.1.min.js"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
    $(function(){
        jssdkconfig = <?php  echo json_encode($_W['account']['jssdkconfig']);?> || { jsApiList:[] };
        jssdkconfig.jsApiList = ['onMenuShareTimeline','onMenuShareAppMessage','hideOptionMenu','hideMenuItems','showMenuItems']
        wx.config(jssdkconfig);
        sharedata = <?php  echo json_encode($_W['shopshare'])?>;
        wx.ready(function () {
            //wx.hideOptionMenu();
            wx.hideMenuItems({
                menuList: [
                    <?php  if($article['page_set_option_nocopy']==1) { ?>
                        'menuItem:copyUrl',
                    <?php  } ?>
                    <?php  if($article['page_set_option_noshare_msg']==1) { ?>
                        'menuItem:share:appMessage',
                    <?php  } ?>
                    <?php  if($article['page_set_option_noshare_tl']==1) { ?>
                        'menuItem:share:timeline',
                    <?php  } ?>
                        'menuItem:share:qq',
                        'menuItem:share:QZone',
                        'menuItem:share:email',
                        'menuItem:openWithSafari',
                        'menuItem:openWithQQBrowser',
                ] 
            });
            wx.onMenuShareAppMessage(sharedata);
            wx.onMenuShareTimeline(sharedata);
        });
        // 微信jssdk 结束
        
        var state = true;
        $("#likebtn").click(function(){
            var num = parseInt($(this).find("span").text());
            if(state){
                state = false;
                $.ajax({
                    type: 'POST',
                    url: "<?php  echo $this->createPluginMobileUrl('article',array('method'=>'api','apido'=>'selectlike'))?>",
                    data: {aid:"<?php  echo $aid;?>"},
                    dataType:'json',
                    success: function(d){
                        if(d.result=='success-like'){
                            $("#likebtn").attr("state","1");
                            $("#likebtn span").text(num+1);
                            $("#likebtn div").addClass("rich_tool_likeon");
                            state = true;
                        }
                        if(d.result=='success-nolike'){
                            $("#likebtn").attr("state","0");
                            $("#likebtn span").text(num-1);
                            $("#likebtn div").removeClass("rich_tool_likeon");
                            state = true;
                        }
                   }
                });
            }
        });
    });
</script>

</head>

<body> 
    <div class="rich_primary all-divbox">
        <div class="rich_title"><?php  echo $article['article_title'];?></div>
        <div class="rich_mate">
            <div class="rich_mate_text"><?php  echo $article['article_date_v'];?></div>
            <div class="rich_mate_text"><?php  echo $article['article_author'];?></div>
            <a href="<?php  if(!empty($shop['share']['followurl'])) { ?><?php  echo $shop['share']['followurl'];?><?php  } else { ?>javascript:;<?php  } ?>"><div class="rich_mate_text href"><?php  echo $article['article_mp'];?></div></a>
        </div>
        <div class="rich_content">
            <?php  echo htmlspecialchars_decode($article['article_content'])?>
        </div>
        <div class="rich_tool">
            <?php  if(!empty($article['article_linkurl'])) { ?><a href="<?php  echo $article['article_linkurl'];?>"><div class="rich_tool_text link">阅读原文</div></a><?php  } ?>
            <?php  if(!empty($_W['openid'])) { ?>
                <div class="rich_tool_text">阅读 <?php  echo $readnum;?></div>
                <div class="rich_tool_text" id="likebtn">
                    <div class="rich_tool_like <?php  if(!empty($state['like'])) { ?>rich_tool_likeon<?php  } ?>"></div>
                    <span><?php  echo $likenum;?></span>
                </div>
            <?php  } ?>
            <?php  if($article['article_report']==1) { ?>
                <a href="<?php  echo $this->createPluginMobileUrl('article',array('method'=>'report','aid'=>$article['id']))?>"><div class="rich_tool_text right" style="margin-right: 0;">举报</div></a>
            <?php  } ?>
        </div>
		<!--如果设定的任务总金额显示@phpdb.net-->
		<?php  if($article['article_rule_money_total']>0) { ?>
		<div class="rich_tool">
			<p>任务总金额：<?php  echo $article['article_rule_money_total'];?>元</p>
			<p>截至目前累计奖励金额：<?php  echo $total_money;?>元</p>
		</div>
		<?php  } ?>
    </div>
    <?php  if($article['product_advs_type']!=0 && !empty($advs)) { ?>
        <div class="rich_sift">
            <?php  if(!empty($article['product_advs_title'])) { ?>
                <fieldset><legend><?php  echo $article['product_advs_title'];?></legend></fieldset>
            <?php  } ?>
            <div class="rich_sift_goods">
                <?php  if($advrand<0) { ?>
                    <div id='mySwipe' class='swipe'>
                        <div class='swipe-wrap'>
                            <?php  if(is_array($advs)) { foreach($advs as $adv) { ?>
                                <img src="<?php  echo $adv['img'];?>" <?php  if(!empty($adv['link'])) { ?>onclick="location.href='<?php  echo $adv['link'];?>'"<?php  } ?>/>
                            <?php  } } ?>
                        </div>
                    </div>
                    <div class="dots" id="dots">
                        <?php  if(is_array($advs)) { foreach($advs as $i => $adv) { ?>
                            <a href="javascript:;" <?php  if($i==0) { ?>class="on"<?php  } ?>></a>
                        <?php  } } ?>
                    </div>
                <?php  } else { ?>
                    <a href="<?php  if(empty($advs[$advrand]['link'])) { ?>javascript:;<?php  } else { ?><?php  echo $advs[$advrand]['link'];?><?php  } ?>"><img src="<?php  echo $advs[$advrand]['img'];?>"/></a>
                <?php  } ?>
            </div>
            <div class="rich_sift_text">
                <?php  if(!empty($article['product_advs_more'])) { ?>
                    <a href="<?php  if(!empty($article['product_advs_link'])) { ?><?php  echo $article['product_advs_link'];?><?php  } else { ?>javascript:;<?php  } ?>"><?php  echo $article['product_advs_more'];?></a>
                <?php  } ?>
            </div>
        </div>
    <?php  } ?>
<script type="text/javascript" src="../addons/sea/plugin/article/template/imgsrc/swipe.js"></script>
<script type="text/javascript" src="../addons/sea/plugin/article/template/imgsrc/swipe.config.js"></script>
</body>
</html>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>