<?php defined('IN_IA') or exit('Access Denied');?><ul class="nav nav-tabs">
    
 
   <?php if(cv('coupon.coupon')) { ?><li <?php  if($_GPC['method']=='coupon') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('coupon/coupon')?>">超级券管理</a></li><?php  } ?>
   <?php if(cv('coupon.category')) { ?><li <?php  if($_GPC['method']=='category') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('coupon/category')?>">分类管理</a></li><?php  } ?>
    <?php if(cv('coupon.regsend')) { ?><li <?php  if($_GPC['method']=='regsend') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('coupon/regsend')?>">关注优惠券设置</a></li><?php  } ?>
    <?php if(cv('coupon.log')) { ?> <li <?php  if($_GPC['method']=='log') { ?>class="active"<?php  } ?> ><a href="<?php  echo $this->createPluginWebUrl('coupon/log')?>">超级券记录</a></li><?php  } ?>
   <?php  if($_GPC['method']=='send') { ?> <li class="active"><a href="#">发放超级券</a></li><?php  } ?>
   <?php if(cv('coupon.center')) { ?><li <?php  if($_GPC['method']=='center') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('coupon/center')?>">领券中心设置</a></li><?php  } ?>
   <?php if(cv('coupon.set')) { ?><li <?php  if($_GPC['method']=='set') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('coupon/set')?>">其他设置</a></li><?php  } ?>
   
</ul>
