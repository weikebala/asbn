<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('member/center', TEMPLATE_INCLUDEPATH)) : (include template('member/center', TEMPLATE_INCLUDEPATH));?>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<title>佣金排行榜</title>
	<!--<link href="<?php  echo $_W['siteroot'];?>app/resource/css/bootstrap.min.css" rel="stylesheet">-->
	 <link rel="stylesheet" type="text/css" href="/addons/sea/static/css/jfpx/integral.css"> 
	 
	<script type='text/javascript' src='resource/js/lib/jquery-1.11.1.min.js'></script>
	<style type="text/css">
		.list-myorder{padding-left:250px;padding-top:10px;}
	</style>
</head>
<body style="background-color:#FFF;padding-top:0px; padding-bottom:0px;" class="body-gray my-memvers">

<!-- 佣金排行 -->
<section style="background:#ff9900;margin-top:-17px;">
	<!--<img src="/addons/sea/static/images/integral.jpg" border="0" width="100%">-->
</section>
<div class="list-myorder" style="background:#ffffff;">
	<ul class="ul-product" style="color:#ffcc00;font-size:20px;">
           <?php  $key=1?>
           <?php  if(is_array($arr)) { foreach($arr as $member) { ?>
           <?php  if($key <=10) { ?>
			<li>
            <span style="float:left;margin-right:10px;border-radius:3px;"><?php  echo $key;?></span>
            
            <?php  if($key==1||$key==2||$key==3) { ?>
            <span style="float:right;margin-left:10px;border-radius:3px;"><img style="width:30px;height:42px;" src="/addons/sea/static/images/0<?php  echo $key;?>.jpg" style="border-width:0px;"></span>
            <?php  } ?>
            
				<span class="pic" onClick="newMsg('<?php  echo $member["openid"];?>');"><img src="<?php  echo tomedia($member['avatar']);?>" style="border-radius:50px;"></span>
				<div class="text">
					<span class="pro-name">昵称：<?php  echo $member['nickname'];?></span>
						<div class="pro-pric" style="color:#ff9900;font-size:25px;"><span>佣金：<?php  echo $member['commission'];?></span></div>
				</div>
			</li>
            <?php  } ?>
            <?php  $key++?>
            <?php  } } ?>
	</ul>

	<div align="center"><span style="color:#FFC502;font-size:16px; padding-bottom:60px;">赶紧加油获得更多佣金上榜吧</span></div>
</div>

<?php  $show_footer=true?>
<?php  $footer_current='member'?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/bottom', TEMPLATE_INCLUDEPATH)) : (include template('common/bottom', TEMPLATE_INCLUDEPATH));?>
