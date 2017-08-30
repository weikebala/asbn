<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<div class='panel panel-default' style='margin-top:10px;'>

    <?php  if(is_array($category)) { foreach($category as $ck => $cv) { ?>
	 <?php  if(count($cv['plugins'])<=0) { ?><?php  continue;?><?php  } ?>
    <div class="panel-heading">
        <?php  echo $cv['name'];?>
    </div>
    <div class='panel-body'>
        <?php  if(is_array($cv['plugins'])) { foreach($cv['plugins'] as $plugin) { ?>
        <?php if(cp($plugin['identity'])) { ?>
        <a class='btn btn-default' href="<?php  echo $this->createPluginWebUrl($plugin['identity'])?>" title="<?php  echo $plugin['name'];?>">
            <i class="fa fa-external-link-square fa-2x"></i>
            <br/>
            <span><?php  echo $plugin['name'];?></span>
        </a>
		<?php  } else { ?>
		 
        <?php  } ?>
        <?php  } } ?>
    </div>
	<?php  } } ?>
</div>


<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>
