<?php defined('IN_IA') or exit('Access Denied');?><ul class="nav nav-tabs">
	<?php if(cv('bonus.agent')) { ?><li <?php  if($_GPC['method']=='agent') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('bonus/agent')?>">代理商管理</a></li><?php  } ?>
    <?php if(cv('bonus.agent')) { ?><li <?php  if($_GPC['method']=='agentdetail') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('bonus/agentdetail')?>">渠道商详情</a></li><?php  } ?>
	<?php if(cv('bonus.level')) { ?><li <?php  if($_GPC['method']=='level') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('bonus/level')?>">代理商等级</a></li><?php  } ?>
	<?php if(cv('bonus.send')) { ?><li <?php  if($_GPC['method']=='send') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('bonus/send')?>">级差分红</a></li><?php  } ?>
	<?php if(cv('bonus.sendall')) { ?><li <?php  if($_GPC['method']=='sendall') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('bonus/sendall')?>">全球分红</a></li><?php  } ?>
	<?php if(cv('bonus.detail')) { ?><li <?php  if($_GPC['method']=='detail') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('bonus/detail/list')?>">分红明细</a></li><?php  } ?>
    <?php if(cv('bonus.notice')) { ?><li  <?php  if($_GPC['method']=='notice') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('bonus/notice')?>">通知设置</a></li><?php  } ?>
    <?php if(cv('bonus.cover')) { ?><li <?php  if($_GPC['method']=='cover') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('bonus/cover')?>">分红中心入口设置</a></li><?php  } ?>
    <?php if(cv('bonus.set')) { ?><li <?php  if($_GPC['method']=='set') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('bonus/set')?>">基础设置</a></li><?php  } ?>
</ul>
