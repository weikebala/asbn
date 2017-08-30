<?php defined('IN_IA') or exit('Access Denied');?><ul class="nav nav-tabs">
    <li <?php  if($_GPC['method']=='') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('poster')?>">海报管理</a></li>
    <?php  if($_GPC['method']=='scan') { ?><li class="active"><a href="<?php  echo $this->createPluginWebUrl('poster/scan',array('id'=>$_GPC['id']))?>">扫描记录</a></li><?php  } ?>
    <?php  if($_GPC['method']=='log') { ?><li class="active"><a href="<?php  echo $this->createPluginWebUrl('poster/log',array('id'=>$_GPC['id']))?>">关注记录</a></li><?php  } ?>
</ul>
