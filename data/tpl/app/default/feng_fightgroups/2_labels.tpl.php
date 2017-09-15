<?php defined('IN_IA') or exit('Access Denied');?><?php  if($this->module['config']['goodstip'] == 2) { ?>
	<div class="cat_wrap" style="position: fixed;width: 100%;z-index: 20;">
		<div id="mod_cat" class="cat headroom cat_down cat_top" style="top: 0px;">
			<div class="cat_list" style="-webkit-backface-visibility: hidden;-webkit-perspective: 1000;">
				<a href="javascript:void(0);" data-cat="cat1" data-tagid="7" class="cat_item cat_new <?php  if($_GPC['type']=='isnew') { ?>cat_cur<?php  } ?>" onclick="location.href='<?php  echo $this->createMobileUrl('index',array('type'=>'isnew'))?>'"><span><?php  if($this->module['config']['tag1']) { ?><?php  echo $this->module['config']['tag1'];?><?php  } else { ?>上新<?php  } ?></span></a>
				<a href="javascript:void(0);" data-cat="cat3" data-tagid="9" class="cat_item cat_hot <?php  if($_GPC['type']=='ishot') { ?>cat_cur<?php  } ?>" onclick="location.href='<?php  echo $this->createMobileUrl('index',array('type'=>'ishot'))?>'"><span><?php  if($this->module['config']['tag2']) { ?><?php  echo $this->module['config']['tag2'];?><?php  } else { ?>疯抢<?php  } ?></span></a>
				<a href="javascript:void(0);" data-cat="tuijian" data-tagid="10" class="cat_item cat_all <?php  if($_GPC['type']=='isrecommand') { ?>cat_cur<?php  } ?>" onclick="location.href='<?php  echo $this->createMobileUrl('index',array('type'=>'isrecommand'))?>'"><span><?php  if($this->module['config']['tag3']) { ?><?php  echo $this->module['config']['tag3'];?><?php  } else { ?>推荐<?php  } ?></span></a>
				<a href="javascript:void(0);" data-cat="cat9" data-tagid="8" class="cat_item cat_qiang <?php  if($_GPC['type']=='isdiscount') { ?>cat_cur<?php  } ?>" onclick="location.href='<?php  echo $this->createMobileUrl('index',array('type'=>'isdiscount'))?>'"><span><?php  if($this->module['config']['tag4']) { ?><?php  echo $this->module['config']['tag4'];?><?php  } else { ?>优惠<?php  } ?></span></a>
			</div>
		</div>
	</div>
<?php  } ?>