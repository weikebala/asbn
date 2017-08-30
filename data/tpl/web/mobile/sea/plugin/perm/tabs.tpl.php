<?php defined('IN_IA') or exit('Access Denied');?><ul class="nav nav-tabs">

    <?php if(cv('perm.role')) { ?><li <?php  if($_GPC['method']=='role') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('perm/role')?>">角色管理</a></li><?php  } ?>
    <?php if(cv('perm.user')) { ?><li <?php  if($_GPC['method']=='user') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('perm/user')?>">操作员管理</a></li><?php  } ?>
    <?php if(cv('perm.log')) { ?><li <?php  if($_GPC['method']=='log') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('perm/log')?>">系统操作日志</a></li><?php  } ?>
    
    <?php  if($_W['isfounder']) { ?>
    <li  <?php  if($_GPC['method']=='setting') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('perm/setting')?>">插件信息设置</a></li>
   <li  <?php  if($_GPC['method']=='plugins') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('perm/plugins')?>">公众号插件权限设置</a></li>
    <li <?php  if($_GPC['method']=='set') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('perm/set')?>">基础设置</a></li>
   <?php  } ?>
</ul>
 