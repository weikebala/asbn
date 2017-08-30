<?php defined('IN_IA') or exit('Access Denied');?><ul class="nav nav-tabs">
    <li <?php  if($_GPC['p'] == 'fans') { ?> class="active" <?php  } ?>><a href="<?php  echo $this->createWebUrl('leaderboard/fans')?>">粉丝榜</a></li>
    <li <?php  if($_GPC['p'] == 'sale') { ?> class="active" <?php  } ?>><a href="<?php  echo $this->createWebUrl('leaderboard/sale')?>">店铺销售榜</a></li>
    <li <?php  if($_GPC['p'] == 'promotion') { ?> class="active" <?php  } ?>><a href="<?php  echo $this->createWebUrl('leaderboard/promotion')?>">推广榜</a></li>
    <li <?php  if($_GPC['p'] == 'dofans') { ?> class="active" <?php  } ?>><a href="<?php  echo $this->createWebUrl('leaderboard/dofans')?>">粉丝计算任务</a></li>
</ul>
