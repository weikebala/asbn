<?php defined('IN_IA') or exit('Access Denied');?><ul class="nav nav-tabs">
    <?php if(cv('sysset.view.shop')) { ?><li <?php  if($_GPC['op']=='shop') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('sysset',array('op'=>'shop'))?>">商城设置</a></li><?php  } ?>
    <?php if(cv('sysset.view.pcset')) { ?><li <?php  if($_GPC['op']=='pcset') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('sysset',array('op'=>'pcset'))?>">PC端设置</a></li><?php  } ?>
    <?php if(cv('sysset.view.follow')) { ?><li  <?php  if($_GPC['op']=='follow') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('sysset',array('op'=>'follow'))?>">引导及分享设置</a></li><?php  } ?>
    <?php if(cv('sysset.view.notice')) { ?><li  <?php  if($_GPC['op']=='notice') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('sysset',array('op'=>'notice'))?>">提醒及模板消息设置</a></li><?php  } ?>
    <?php if(cv('sysset.view.trade')) { ?><li  <?php  if($_GPC['op']=='trade') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('sysset',array('op'=>'trade'))?>">交易设置</a></li><?php  } ?>
	
	<?php if(cv('sysset.view.refund')) { ?><li  <?php  if($_GPC['op']=='refund') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('sysset',array('op'=>'refund'))?>">退货地址</a></li><?php  } ?>
	
    <?php if(cv('sysset.view.pay')) { ?><li  <?php  if($_GPC['op']=='pay') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('sysset',array('op'=>'pay'))?>">支付方式设置</a></li><?php  } ?>
    <?php if(cv('sysset.view.template')) { ?><li  <?php  if($_GPC['op']=='template') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('sysset',array('op'=>'template'))?>">模板设置</a></li><?php  } ?>
    <?php if(cv('sysset.view.member')) { ?><li  <?php  if($_GPC['op']=='member') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('sysset',array('op'=>'member'))?>">会员设置</a></li><?php  } ?>
    <?php if(cv('sysset.view.category')) { ?><li  <?php  if($_GPC['op']=='category') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('sysset',array('op'=>'category'))?>">分类层级设置</a></li><?php  } ?>
    <?php if(cv('sysset.view.contact')) { ?><li  <?php  if($_GPC['op']=='contact') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('sysset',array('op'=>'contact'))?>">联系方式设置</a></li><?php  } ?>
    <?php if(cv('sysset.view.sms')) { ?><li  <?php  if($_GPC['op']=='sms') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('sysset',array('op'=>'sms'))?>">短信设置</a></li><?php  } ?>
	<?php if(cv('sysset.view.phb')) { ?><li  <?php  if($_GPC['op']=='phb') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('sysset',array('op'=>'phb'))?>">排行榜设置</a></li><?php  } ?>
    <?php if(cv('sysset.view.upgrade')) { ?><li  <?php  if($_GPC['op']=='display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('upgrade',array('op'=>'display'))?>">系统升级</a></li><?php  } ?>
</ul> 
