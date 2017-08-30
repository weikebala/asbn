<?php defined('IN_IA') or exit('Access Denied');?><ul class="nav nav-tabs">
    
    <?php if(cv('creditshop.cover')) { ?><li <?php  if($_GPC['method']=='cover') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('creditshop/cover')?>">积分商城入口设置</a></li><?php  } ?>
    <?php if(cv('creditshop.goods')) { ?><li <?php  if($_GPC['method']=='goods') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('creditshop/goods')?>">商品管理</a></li><?php  } ?>
    <?php if(cv('creditshop.category')) { ?><li <?php  if($_GPC['method']=='category') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('creditshop/category')?>">分类管理</a></li><?php  } ?>
    <?php if(cv('creditshop.adv')) { ?><li <?php  if($_GPC['method']=='adv') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('creditshop/adv')?>">幻灯片管理</a></li><?php  } ?>
    <?php if(cv('creditshop.log.view0')) { ?><li <?php  if($_GPC['method']=='log' && $type==0) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('creditshop/log',array('type'=>0))?>">兑换记录</a></li><?php  } ?>
    <?php if(cv('creditshop.log.view1')) { ?><li <?php  if($_GPC['method']=='log' && $type==1) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('creditshop/log',array('type'=>1))?>">抽奖记录</a></li><?php  } ?>
    <?php if(cv('creditshop.notice')) { ?><li  <?php  if($_GPC['method']=='notice') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('creditshop/notice')?>">通知设置</a></li><?php  } ?>
    <?php if(cv('creditshop.set')) { ?><li <?php  if($_GPC['method']=='set') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('creditshop/set')?>">基础设置</a></li><?php  } ?>
    
</ul>
