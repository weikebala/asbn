<?php defined('IN_IA') or exit('Access Denied');?><div id="div_fastnav" class="fast-nav-wrapper">
    <ul class="fast-nav">
        <li id="li_menu">
            <a href="javascript:menu();">
                <i class="nav-menu"></i>
            </a>
        </li>
    </ul>
    <div id='sub-nav' class="sub-nav ios" style="display:none;">
        <a href="<?php  echo $this->createMobileUrl('rules');?>">
            <i class="home"></i>
            玩法
        </a>
        <a onclick="show();">
            <i class="announced"></i>
            团群
        </a>
    </div>
</div>
<script>
	function menu(){
		var sub = document.getElementById('sub-nav');
		if(sub.style.display == 'none'){
			sub.style.display = 'block';
		}else{
			sub.style.display = 'none';
		}
		setTimeout(menutime,3000);
	}
	function menutime(){
		var sub = document.getElementById('sub-nav');
		if(sub.style.display == 'block'){
			sub.style.display = 'none';
		}
	}
	
</script>
