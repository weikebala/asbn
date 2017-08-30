<?php defined('IN_IA') or exit('Access Denied');?><ul class="nav nav-tabs">
    <?php if(cv('sale.deduct')) { ?><li <?php  if($_GPC['method']=='deduct') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('sale/deduct')?>">抵扣设置</a></li><?php  } ?>
    <?php if(cv('sale.enough')) { ?><li <?php  if($_GPC['method']=='enough') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('sale/enough')?>">满额优惠设置</a></li><?php  } ?>
   <?php if(cv('sale.recharge')) { ?><li <?php  if($_GPC['method']=='recharge') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('sale/recharge')?>">充值优惠设置</a></li><?php  } ?>
</ul>
  