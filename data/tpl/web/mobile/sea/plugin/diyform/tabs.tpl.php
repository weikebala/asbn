<?php defined('IN_IA') or exit('Access Denied');?><ul class="nav nav-tabs">

    <?php if(cv('diyform.temp')) { ?><li <?php  if($_GPC['method']=='temp') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('diyform/temp')?>" style="cursor: pointer;">模板管理</a></li><?php  } ?>
    <?php if(cv('diyform.category')) { ?><li <?php  if($_GPC['method']=='category') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('diyform/category')?>" style="cursor: pointer;">分类管理</a></li><?php  } ?>
     <?php if(cv('diyform.data')) { ?>
    <?php  if($_GPC['method']=='data' && $operation=='post') { ?><li class="active"><a href="javascript:;" style="cursor: pointer;">添加数据</a></li><?php  } ?>
    <?php  if($_GPC['method']=='data' && $operation=='display') { ?><li class="active"><a href="javascript:;" style="cursor: pointer;">数据列表</a></li><?php  } ?>
    <?php  } ?>
     <?php if(cv('diyform.set')) { ?><li <?php  if($_GPC['method']=='set') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('diyform/set')?>" style="cursor: pointer;">基础设置</a></li><?php  } ?>
</ul>
