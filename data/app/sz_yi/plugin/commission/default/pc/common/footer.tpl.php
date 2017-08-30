<?php defined('IN_IA') or exit('Access Denied');?><div class="foot fl wfs fz12">
	<?php  $set = m('common')->getSysset('custom');?>
    <p><?php  echo $set['custom1'];?></p>
    <p><?php  echo $set['custom2'];?></p>
</div>
</body>
</html>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer_base', TEMPLATE_INCLUDEPATH)) : (include template('common/footer_base', TEMPLATE_INCLUDEPATH));?>
