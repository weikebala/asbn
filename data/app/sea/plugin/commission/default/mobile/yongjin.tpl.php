<?php defined('IN_IA') or exit('Access Denied');?>﻿<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="format-detection" content="telephone=no">
  <title><?php  if($switch ==0) { ?>积分<?php  } ?> <?php  if($switch ==1) { ?>消费<?php  } ?> <?php  if($switch ==2) { ?>佣金<?php  } ?><?php  if($switch ==3) { ?>粉丝<?php  } ?><?php  if($switch ==4) { ?>销售<?php  } ?><?php  if($switch ==5) { ?>推广<?php  } ?> 排行榜</title>
  <link href="<?php  echo $_W['siteroot'];?>app/resource/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="/addons/sea/static/css/jfpx/integral2.css">
  <script type='text/javascript' src='resource/js/lib/jquery-1.11.1.min.js'></script>

  <style>
.black6{ height:10px; line-height:10px; clear:both;}
.credit_nav1 {height:30px;width:100%; background:#fff; color:#666; text-align:center; line-height:30px; float:left;}
.credit_nav2 {height:30px;width:50%; background:#fff; color:#666; text-align:center; line-height:30px; float:left;}
.credit_nav3 {height:30px;width:33.33%; background:#fff; color:#666; text-align:center; line-height:30px; float:left;}
.credit_nav4 {height:30px;font-size:18px;width:25%; background:#fff; color:#666; text-align:center; line-height:30px; float:left;}
.credit_nav5 {height:30px;font-size:15px;width:20%; background:#fff; color:#666; text-align:center; line-height:30px; float:left;}
.credit_nav6 {height:30px;font-size:13px;width:16.66%; background:#fff; color:#666; text-align:center; line-height:30px; float:left;}

.credit_navon {color:#fff; background:#eb5f5f;}
</style>
</head>
<body style="background-color:#FFC502;padding-top:0px; padding-bottom:0px;" class="body-gray my-memvers">
<div class="black6"></div>
<!-- 积分排行 -->
<section style="background:#ff9900;margin-top:-17px;">
</section>
<div class="list-myorder" style="background:#ffffff;">
  <ul class="ul-product" style="color:#ffcc00;font-size:20px;">
           <li style="width:100%">
            <?php  if($isopen['isintegral']) { ?><a href="<?php  echo $this->createPluginMobileUrl('commission/yongjin')?>"><div class="credit_nav<?php  echo $count;?> <?php  if($type == 0) { ?>credit_navon<?php  } ?>" data-type='0'><?php  echo $name['integralname'];?></div></a><?php  } ?>
            <?php  if($isopen['isexpense']) { ?><a href="<?php  echo $this->createPluginMobileUrl('commission/yongjin',array('type'=>1))?>"><div class="credit_nav<?php  echo $count;?>   <?php  if($type == 1) { ?>credit_navon<?php  } ?>" data-type='1'><?php  echo $name['expensename'];?></div></a><?php  } ?>
            <?php  if($isopen['iscommission']) { ?><a href="<?php  echo $this->createPluginMobileUrl('commission/yongjin',array('type'=>2))?>"><div  class="credit_nav<?php  echo $count;?>  <?php  if($type == 2) { ?>credit_navon<?php  } ?>" data-type='2'><?php  echo $name['commissionname'];?></div></a><?php  } ?>
            <?php  if($isopen['isfans']) { ?><a href="<?php  echo $this->createPluginMobileUrl('commission/yongjin',array('type'=>3))?>"><div  class="credit_nav<?php  echo $count;?>  <?php  if($type == 3) { ?>credit_navon<?php  } ?>" data-type='3'><?php  echo $name['fansname'];?></div></a><?php  } ?>
            <?php  if($isopen['issales']) { ?><a href="<?php  echo $this->createPluginMobileUrl('commission/yongjin',array('type'=>4))?>"><div  class="credit_nav<?php  echo $count;?>  <?php  if($type == 4) { ?>credit_navon<?php  } ?>" data-type='4'><?php  echo $name['salesname'];?></div></a><?php  } ?>
            <?php  if($isopen['istuiguang']) { ?><a href="<?php  echo $this->createPluginMobileUrl('commission/yongjin',array('type'=>5))?>"><div  class="credit_nav<?php  echo $count;?>  <?php  if($type == 5) { ?>credit_navon<?php  } ?>" data-type='5'><?php  echo $name['tuiguangname'];?></div></a><?php  } ?>
            </li>

            <li style="height:100px;background-color:#eb5f5f;padding-left:30px;padding-top:15px;font-size:15px">
              <div>我的名次
                    <span class="pic" onClick="newMsg('<?php  echo $avatar["openid"];?>');" style="float:right;"><img src="<?php  echo tomedia($avatar['avatar']);?>"  style="border-radius:50px;"></span>
              </div>
              <div style="padding-top:30px"><?php  if($m_num) { ?><?php  echo $m_num;?><?php  } else if(!$m_num) { ?>未上榜<?php  } ?>
               <span style="float:right;">
                      总<?php  if($switch ==0) { ?>积分:<?php  echo number_format($m)?><?php  } ?><?php  if($switch ==1) { ?>消费:<?php  echo number_format($m)?><?php  } ?><?php  if($switch ==2) { ?>佣金:<?php  echo number_format($m)?><?php  } ?> <?php  if($switch ==3) { ?>粉丝:<?php  echo $m?><?php  } ?> <?php  if($switch ==4) { ?>销售额:<?php  echo number_format($m)?><?php  } ?> <?php  if($switch ==5) { ?>推广额:<?php  echo number_format($m)?><?php  } ?>   
                    </span>
              </div>
              
                    
            </li>
           
       <?php  if($isopen['isintegral']) { ?>
           <?php  if($switch == 0) { ?>
           <?php  $key=1?>
       <?php  if(is_array($list)) { foreach($list as $member) { ?> 
      <li>

            <?php  if($key==10) { ?>
            <span style="float:left;margin-right:10px;border-radius:3px;text-align:center;"><?php  echo $key;?></span>
            <?php  } else { ?>
            <span style="float:left;margin-left:10px;margin-right:10px;border-radius:3px;text-align:center;"><?php  echo $key;?></span>
            <?php  } ?>
            <?php  if($key==1||$key==2||$key==3) { ?>
            <span style="float:right;margin-left:10px;border-radius:3px;"><img style="width:30px;height:42px;" src="/addons/sea/static/images/0<?php  echo $key;?>.jpg" style="border-width:0px;"></span>
            <?php  } ?>
        <span class="pic" onClick="newMsg('<?php  echo $member["openid"];?>');"><img src="<?php  echo tomedia($member['avatar']);?>"  style="border-radius:50px;"></span>
        <div class="text">
          <span class="pro-name">昵称：<?php  echo $member['nickname'];?></span>
            <div class="pro-pric" style="color:#ff9900;font-size:25px;"><span>积分：</span><?php  echo number_format($member['credit1'],0,'','')?></div>
        </div>
      </li>
      <?php  $key++?>
      <?php  } } ?>
          <?php  } ?>
          <?php  } ?>
          
          <?php  if($isopen['isexpense']) { ?>
          <?php  if($switch == 1) { ?>
          <?php  $key=1?>
      <?php  if(is_array($list)) { foreach($list as $member) { ?>
      <li>
            <?php  if($key==10) { ?>
            <span style="float:left;margin-right:8px;border-radius:3px;text-align:center;"><?php  echo $key;?></span>
            <?php  } else { ?>
            <span style="float:left;margin-left:10px;margin-right:10px;border-radius:3px;text-align:center;"><?php  echo $key;?></span>
            <?php  } ?>
            <?php  if($key==1||$key==2||$key==3) { ?>
            <span style="float:right;margin-left:10px;border-radius:3px;"><img style="width:30px;height:42px;" src="/addons/sea/static/images/0<?php  echo $key;?>.jpg" style="border-width:0px;"></span>
            <?php  } ?>
        <span class="pic" onClick="newMsg('<?php  echo $member["openid"];?>');"><img src="<?php  echo tomedia($member['avatar']);?>"  style="border-radius:50px;"></span>
        <div class="text">
          <span class="pro-name">昵称：<?php  echo $member['nickname'];?></span>
            <div class="pro-pric" style="color:#ff9900;font-size:25px;"><span>消费：</span><?php  echo number_format($member['ordermoney'],0,'','')?></div>
        </div>
      </li>
     <?php  $key++?>
     <?php  } } ?>
         <?php  } ?>
         <?php  } ?>
           
           <?php  if($isopen['iscommission']) { ?>
           <?php  if($switch == 2) { ?>
           <?php  $key=1?>
           <?php  if(is_array($list)) { foreach($list as $member) { ?>
           <?php  if($key <= 50) { ?>
      <li>
            <?php  if($key==10) { ?>
            <span style="float:left;margin-right:10px;border-radius:3px;text-align:center;"><?php  echo $key;?></span>
            <?php  } else { ?>
            <span style="float:left;margin-left:10px;margin-right:10px;border-radius:3px;text-align:center;"><?php  echo $key;?></span>
            <?php  } ?>
            
            <?php  if($key==1||$key==2||$key==3) { ?>
            <span style="float:right;margin-left:10px;border-radius:3px;"><img style="width:30px;height:42px;" src="/addons/sea/static/images/0<?php  echo $key;?>.jpg" style="border-width:0px;"></span>
            <?php  } ?>
            
        <span class="pic" onClick="newMsg('<?php  echo $member["openid"];?>');"><img src="<?php  echo tomedia($member['avatar']);?>" style="border-radius:50px;"></span>
        <div class="text">
          <span class="pro-name">昵称：<?php  echo $member['nickname'];?></span>
            <!-- <div class="pro-pric" style="color:#ff9900;font-size:25px;"><span>佣金：<?php  echo number_format($member['commission'],0,'','')?></span></div> -->

            <div class="pro-pric" style="color:#ff9900;font-size:25px;"><span>佣金：</span><?php  echo number_format($member['commission'],0,'','')?></div>
        </div>
      </li>
            <?php  } ?>
            <?php  $key++?>
            <?php  } } ?>
            <?php  } ?>
            <?php  } ?>

          <!--粉丝榜-->
            <?php  if($isopen['isfans']) { ?>
           <?php  if($switch == 3) { ?>
           <?php  $key=1?>
           <?php  if(is_array($list)) { foreach($list as $member) { ?>
           <?php  if($key <= 50) { ?>
      <li>
            <?php  if($key==10) { ?>
            <span style="float:left;margin-right:10px;border-radius:3px;text-align:center;"><?php  echo $key;?></span>
            <?php  } else { ?>
            <span style="float:left;margin-left:10px;margin-right:10px;border-radius:3px;text-align:center;"><?php  echo $key;?></span>
            <?php  } ?>
            
            <?php  if($key==1||$key==2||$key==3) { ?>
            <span style="float:right;margin-left:10px;border-radius:3px;"><img style="width:30px;height:42px;" src="/addons/sea/static/images/0<?php  echo $key;?>.jpg" style="border-width:0px;"></span>
            <?php  } ?>
            
        <span class="pic" onClick="newMsg('<?php  echo $member["openid"];?>');"><img src="<?php  echo tomedia($member['avatar']);?>" style="border-radius:50px;"></span>
        <div class="text">
          <span class="pro-name">昵称：<?php  echo $member['nickname'];?></span>
            <!-- <div class="pro-pric" style="color:#ff9900;font-size:25px;"><span>佣金：<?php  echo number_format($member['commission'],0,'','')?></span></div> -->

            <div class="pro-pric" style="color:#ff9900;font-size:25px;"><span>粉丝：</span><?php  echo $member['fanscount']?></div>
        </div>
      </li>
            <?php  } ?>
            <?php  $key++?>
            <?php  } } ?>
            <?php  } ?>
            <?php  } ?>

            <!--销售榜-->
            <?php  if($isopen['issales']) { ?>
           <?php  if($switch == 4) { ?>
           <?php  $key=1?>
           <?php  if(is_array($list)) { foreach($list as $member) { ?>
           <?php  if($key <= 50) { ?>
      <li>
            <?php  if($key==10) { ?>
            <span style="float:left;margin-right:10px;border-radius:3px;text-align:center;"><?php  echo $key;?></span>
            <?php  } else { ?>
            <span style="float:left;margin-left:10px;margin-right:10px;border-radius:3px;text-align:center;"><?php  echo $key;?></span>
            <?php  } ?>
            
            <?php  if($key==1||$key==2||$key==3) { ?>
            <span style="float:right;margin-left:10px;border-radius:3px;"><img style="width:30px;height:42px;" src="/addons/sea/static/images/0<?php  echo $key;?>.jpg" style="border-width:0px;"></span>
            <?php  } ?>
            
        <span class="pic" onClick="newMsg('<?php  echo $member["openid"];?>');"><img src="<?php  echo tomedia($member['avatar']);?>" style="border-radius:50px;"></span>
        <div class="text">
          <span class="pro-name">昵称：<?php  echo $member['nickname'];?></span>
            <!-- <div class="pro-pric" style="color:#ff9900;font-size:25px;"><span>佣金：<?php  echo number_format($member['commission'],0,'','')?></span></div> -->

            <div class="pro-pric" style="color:#ff9900;font-size:25px;"><span>销售额：</span><?php  echo number_format($member['ordersell'],0,'','')?></div>
        </div>
      </li>
            <?php  } ?>
            <?php  $key++?>
            <?php  } } ?>
            <?php  } ?>
            <?php  } ?>

      <!--推广榜-->
            <?php  if($isopen['istuiguang']) { ?>
           <?php  if($switch == 5) { ?>
           <?php  $key=1?>
           <?php  if(is_array($list)) { foreach($list as $member) { ?>
           <?php  if($key <= 50) { ?>
      <li>
            <?php  if($key==10) { ?>
            <span style="float:left;margin-right:10px;border-radius:3px;text-align:center;"><?php  echo $key;?></span>
            <?php  } else { ?>
            <span style="float:left;margin-left:10px;margin-right:10px;border-radius:3px;text-align:center;"><?php  echo $key;?></span>
            <?php  } ?>
            
            <?php  if($key==1||$key==2||$key==3) { ?>
            <span style="float:right;margin-left:10px;border-radius:3px;"><img style="width:30px;height:42px;" src="/addons/sea/static/images/0<?php  echo $key;?>.jpg" style="border-width:0px;"></span>
            <?php  } ?>
            
        <span class="pic" onClick="newMsg('<?php  echo $member["openid"];?>');"><img src="<?php  echo tomedia($member['avatar']);?>" style="border-radius:50px;"></span>
        <div class="text">
          <span class="pro-name">昵称：<?php  echo $member['nickname'];?></span>
            <!-- <div class="pro-pric" style="color:#ff9900;font-size:25px;"><span>佣金：<?php  echo number_format($member['commission'],0,'','')?></span></div> -->

            <div class="pro-pric" style="color:#ff9900;font-size:25px;"><span>推广总额：</span><?php  echo number_format($member['ordersum'],0,'','')?></div>
        </div>
      </li>
            <?php  } ?>
            <?php  $key++?>
            <?php  } } ?>
            <?php  } ?>
            <?php  } ?>      
  </ul>
</div>
<?php  if($switch ==0) { ?>
<div align="center"><span style="color:#fff;font-size:16px; padding-bottom:60px;">赶紧加油获得更多积分上榜吧</span></div>
<?php  } ?>
<?php  if($switch ==1) { ?>
<div align="center"><span style="color:#fff;font-size:16px; padding-bottom:60px;">赶紧加油获得更多消费上榜吧</span></div>
<?php  } ?>
<?php  if($switch ==2) { ?>
<div align="center"><span style="color:#fff;font-size:16px; padding-bottom:60px;">赶紧加油获得更多佣金上榜吧</span></div>
<?php  } ?>
<?php  if($switch ==3) { ?>
<div align="center"><span style="color:#fff;font-size:16px; padding-bottom:60px;">赶紧加油获得更多粉丝上榜吧</span></div>
<?php  } ?>
<?php  if($switch ==4) { ?>
<div align="center"><span style="color:#fff;font-size:16px; padding-bottom:60px;">赶紧加油获得更多销售上榜吧</span></div>
<?php  } ?>
<?php  if($switch ==5) { ?>
<div align="center"><span style="color:#fff;font-size:16px; padding-bottom:60px;">赶紧加油获得更多推广上榜吧</span></div>
<?php  } ?>
<?php  $show_footer=true?>
<?php  $footer_current='member'?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
