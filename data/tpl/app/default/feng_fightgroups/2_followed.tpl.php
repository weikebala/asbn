<?php defined('IN_IA') or exit('Access Denied');?><!-- 
      followed.html
      <project>
      判断是否已经关注该微信公众号，引导关注
      Created by Administrator on 2016-02-29.
      Copyright 2016 Administrator. All rights reserved.
 -->
 <style type="text/css">
 	.topbox{width: 100%; max-width: 640px; min-width: 320px;position:fixed;top:0;z-index:20;}
.subscribe{width: 100%; left: 0; right: 0; background-color: rgba(0, 0, 0, 0.8); z-index: 4; overflow: hidden; margin: 0 auto; max-width: 640px; min-width: 320px;height:60px;}
.subscribe .img{width:40px; height:40px; position:absolute; left:10px; top:10px;}
.subscribe .img img{width:40px; height:40px; border-radius:3px;}
.subscribe .text{padding:10px 100px 10px 70px; line-height:20px; color:#fff; font-size:14px;}
.subscribe .text font{color:#FA5343;}
.subscribe .btn{position:absolute; right:10px; top:15px;}
.subscribe .btn .button{background:#FA5343;width:70px;height:30px;line-height:30px;text-align:center; border-radius:5px; color: #fff;border:none;}
.index-header{left: 0; right: 0; position: fixed; z-index: 4; overflow: hidden; margin: 0 auto; height:50px; background-color:#fff; top: 0; max-width: 640px; min-width: 320px; margin: 0 auto; width: 100%;position: relative;}
.index-header .index-header-right{font-size:1.875rem; color:#FA5343;position:absolute;right:10px;top:0.2rem;}
.city_txt{float:left; margin-left:10px;line-height:50px; font-size:16px;}
.city_txt i{color: #FA5343;}
.city_txt a{color: #333; padding-left:5px;}
.index-header .index-search-box{overflow: hidden; width: auto; background-color:#EFEFEF; border-radius:6px; height: 34px; line-height: 34px; position: absolute; right:10px; left:80px; top: 0; margin:8px auto; padding: 0 10px;}
.index-header .index-search-box .index-search-input{border: none; width:96%; height: 100%; font-size:14px;padding:0 2%;background:none;border:none;color:#666;line-height:34px;}
.index-header .index-search-box .submit{width: 30px; height: 30px; position: absolute; right:0; top: 6px; background: url(../images/top_s.png) no-repeat; background-size: 70%; border: none; text-indent: -9999em;}
.index-guanz-t{display: none; transition: width 2s; -moz-transition: width 2s; -webkit-transition: width 2s; -o-transition: width 2s; text-align: center; max-width: 640px; min-width: 320px;}
.index-guanz-t.active{display: block; transition: width 2s; -moz-transition: width 2s; -webkit-transition: width 2s; -o-transition: width 2s;}
.index-guanz-show{position: fixed; left: 50%; margin-left: -120px; top: 30%; background: #fff; z-index: 1001; width:200px; height:224px; padding:20px;}
.index-guanz-show img{width:200px;height:200px;}
.index-guanz-show p{color: #4C4D51; font-size:14px;line-height:24px;}
.index-show-close{position:absolute; top:-15px; right:-15px; width:30px; height:30px; border-radius:15px; background:#FA5343; color:#fff; line-height:30px; text-align:center; font-size:16px;}
.index-guanz-bg{background: rgba(0,0,0,0.7); position: fixed; top: 0; left: 0; right: 0; bottom: 0; z-index: 1000;}
.index-menu{margin: 0 auto; padding: 1.5% 2%; background-color: #FFF; overflow: hidden; margin-bottom: 0.3rem;}
.index-menu ul li{width: 21%;float:left; margin: 1% 2%; background-color: #FFF;}
.index-menu ul li img{max-height: 100%; width: 60%;margin: 0 auto; display: block;}
.index-menu ul li .index-menu-text{font-size: 1rem; color: #4C4D51; display: block; text-align: center; padding-top: 0.5rem;}
 </style>
<?php  if($attention['follow'] !=1 &&  $this->module['config']['guanzhu']==1) { ?>
    	<!--<div class="img"><img src="themes/haohaios/images/logo.gif"></div>
	    <div data-pro="text" class="m-simpleFooter-text">
	        <span class="m-detail-go-period"><font color="white">关注可接收组团以及发货消息!</font></span>
	    </div>
	    <div data-pro="ext" class="m-simpleFooter-ext">
	        <a class="w-button w-button-main m-detail-go-link" href="javascript:$('#m_popUp').show();window.scrollTo(0,0);" style="background-color: red;">去关注</a>
	    </div>-->
	     <div class="subscribe">
            <div class="img"><img src="<?php  echo tomedia($slogo)?>"></div>
            <div class="text">
                <p>欢迎进入<font><?php  echo $sname;?></font></p>
                <p>关注公众号,享专属服务</p>
            </div>
            <div class="btn">
                <a class="lizhuanz" href="javascript:$('#m_popUp').show();window.scrollTo(0,0);"><button class="button">立即关注</button></a>
            </div>
        </div>
<?php  } ?>

<!--弹出-->
<div class="m_popUp" id="m_popUp" style="display:none;">
	<div style="float: right;color: #FAFAFA;margin-top: 20px;margin-right: 20px;" onclick="$('#m_popUp').hide()">关闭</div>
    <div class="m_guide" style="height: 300px">
        <div class="m_how" style="margin-top: 0px;margin-left: 15%;">
            <h4 style="margin-top: 70px;text-align: center;">长按关注</h4>
            <h1 style="text-align: center;margin-left: 5%;">关注后,发货消息等将会通知您!</h4>
        </div>
        <div style="margin-left: auto;margin-right: auto;margin-top: 20px;width: 200px;height: 200px;background: #FAFAFA;">
        	<img src="<?php  echo tomedia($this->module['config']['followed_image'])?>" style="width: 200px;height: 200px;" />
        </div>
    </div>
</div>