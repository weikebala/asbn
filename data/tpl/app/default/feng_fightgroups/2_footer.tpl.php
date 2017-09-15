<?php defined('IN_IA') or exit('Access Denied');?>	<style>
		.copyright {
    height: 40px;
    width: 100%;
    text-align: center;
    line-height: 40px;
    font-size: 12px;
    color: #999;
    margin-top: 10px;
}
	</style>
	<div class="copyright">版权所有 © <?php  if(!empty($share_data['copyright'])) { ?><?php  echo $share_data['copyright'];?><?php  } else { ?>海软支持<?php  } ?> </div>
	<?php  if($this->module['config']['ditype']!=2) { ?>
	<footer class="footer" style="z-index: 20;">
        <nav>
            <ul>
                <li><a href="<?php  echo $this->createMobileUrl('index')?>" class="nav-controller <?php  if($_GPC['do']=='index') { ?>active<?php  } ?>"><i class="fa fa-home"></i>首页</a></li>
                <li><a href="<?php  echo $this->createMobileUrl('mygroup',array('op'=>0));?>" class="nav-controller <?php  if($_GPC['do']=='mygroup') { ?>active<?php  } ?>"><i class="fa fa-group"></i>我的团</a></li>
                <li><a href="<?php  echo $this->createMobileUrl('myorder')?>" class="nav-controller <?php  if($_GPC['do']=='myorder') { ?>active<?php  } ?>"><i class="fa fa-list-alt"></i>我的订单</a></li>
                <li><a href="<?php  echo $this->createMobileUrl('person')?>" class="nav-controller <?php  if($_GPC['do']=='person') { ?>active<?php  } ?>"><i class="fa fa-user"></i>个人中心</a></li>
            </ul>
        </nav>
    </footer>
    <?php  } else if($this->module['config']['ditype']==2) { ?>
 <link href="<?php echo S_URL;?>css/common.css?v=135" rel="stylesheet">
<link href="<?php echo S_URL;?>css/widget_menu.css?v=135" rel="stylesheet">
<footer data-role="footer" >
    <div data-role="widget" data-widget="menu_4" class="menu_4">
        <div class="widget_wrap">
            <ul id="menu_4_ul" style="z-index:9999;background-color: #171717;opacity:0.8;" >
                <li <?php  if($_GPC['do']=='index') { ?>class="li3"<?php  } ?>>
                    <a href="<?php  echo $this->createMobileUrl('index');?>" data-fx="Modulefx">
                        <span class="icon iconfont">&#xe603;</span>
                        <p>首页</p>
                    </a>
                </li>
                
                <li <?php  if($_GPC['do']=='mygroup') { ?>class="li3"<?php  } ?>>
                    <a href="<?php  echo $this->createMobileUrl('mygroup');?>" data-fx="Modulefx">
                        <span class="icon iconfont">&#xe602;</span>
                        <p>我的团</p>
                    </a>
                </li>
                
                <li <?php  if($_GPC['do']=='category') { ?>class="li3"<?php  } ?>>
                    <a href="<?php  echo $this->createMobileUrl('category');?>" data-fx="Modulefx">
                        <span class="icon iconfont">&#xe605;</span>
                        <p>商品分类</p>
                    </a>
                </li>
                
                <li <?php  if($_GPC['do']=='myorder') { ?>class="li3"<?php  } ?>>
                    <a href="<?php  echo $this->createMobileUrl('myorder');?>" data-fx="Modulefx">
                        <span class="icon iconfont">&#xe604;</span>
                        <p>我的订单</p>
                    </a>
                </li>
                
                <li <?php  if($_GPC['do']=='person') { ?>class="li3"<?php  } ?>>
                    <a href="<?php  echo $this->createMobileUrl('person');?>" data-fx="Modulefx">
                        <span class="icon iconfont">&#xe601;</span>
                        <p>个人中心</p>
                    </a>
                </li>
                
            </ul>
        </div>
    </div>
</footer>
   <?php  } ?>
