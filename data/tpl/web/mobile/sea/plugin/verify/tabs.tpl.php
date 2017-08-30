<?php defined('IN_IA') or exit('Access Denied');?><ul class="nav nav-tabs">
    <?php if(cv('verify.keyword')) { ?><li <?php  if($_GPC['method']=='keyword') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('verify/keyword')?>">关键词设置</a></li><?php  } ?>
    <?php if(cv('verify.store')) { ?><li <?php  if($_GPC['method']=='store') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('verify/store')?>">核销门店管理</a></li><?php  } ?>
    <?php if(cv('verify.saler')) { ?><li  <?php  if($_GPC['method']=='saler') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('verify/saler')?>">核销员管理</a></li><?php  } ?>
</ul>
