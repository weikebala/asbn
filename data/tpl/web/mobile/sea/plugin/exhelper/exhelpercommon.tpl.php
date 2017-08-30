<?php defined('IN_IA') or exit('Access Denied');?><script language='javascript' src="../addons/sea/plugin/exhelper/static/js/exhelper.js"></script>
<script language='javascript' src="../addons/sea/plugin/exhelper/static/js/LodopFuncs.js"></script>
<script language='javascript'>
    $(function(){
         Exhelper.init({
             baseurl: "<?php  echo $this->createPluginWebUrl('exhelper')?>"
         })
    })
</script>