<?php defined('IN_IA') or exit('Access Denied');?><ul class="nav nav-tabs">
     <li <?php  if($_GPC['method']=='clear') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('system/clear')?>">数据清理</a></li>
     <li <?php  if($_GPC['method']=='transfer') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('system/transfer')?>">数据复制转移</a></li>
     <li <?php  if($_GPC['method']=='backup') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('system/backup')?>">数据下载</a></li>
    <li <?php  if($_GPC['method']=='commission') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('system/commission')?>">加盟关系</a></li>
    <!--<li <?php  if($_GPC['method']=='copyright') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('system/copyright')?>">底部版权</a></li>-->
     
</ul>
