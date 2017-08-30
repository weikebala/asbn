<?php defined('IN_IA') or exit('Access Denied');?><ul class="nav nav-tabs">
    <?php if(cv('fans.member')) { ?><li <?php  if($_GPC['method']=='member') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('fans/member')?>">会员更新</a></li><?php  } ?>
    <?php if(cv('fans.agent')) { ?><li <?php  if($_GPC['method']=='agent') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('fans/agent')?>">更新上级</a></li><?php  } ?>
</ul>
