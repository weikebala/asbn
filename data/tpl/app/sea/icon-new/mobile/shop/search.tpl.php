<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="/addons/sea/static/css/sous.css">
<div class="ss-tb">
<div class="ss-hder">
<div class="ss-sk">
<div class="ss-ssk">
<span class="cp-ss-i"></span>
<form action="http://<?php  echo $_SERVER['SERVER_NAME'];?>/app/index.php" method="get" id="searchform">
    <input type="hidden" name="i" value="<?php  echo $_W['uniacid'];?>"/>
    <input type="hidden" name="c" value="entry"/>
    <input type="hidden" name="do" value="shop"/>
    <input type="hidden" name="m" value="sea"/>
    <input type="hidden" name="p" value="list"/>
  <input type="search" id="name" name="keywords" class="cp-ssk" placeholder="搜索喜欢的宝贝">
</form>
</div>
</div>
<div class="cpss-qx canBtn">取消</div>
</div>
</div>
<div class="cpss-cter">
  <div class="rs-k">
    <div class="rs-wz">热搜:</div>
    
  </div>
  <div class="rs-jh">
    <div class="rs-jh-list">
        <?php  if(is_array($hotkeyword)) { foreach($hotkeyword as $key => $vo) { ?>
        <a href="http://<?php  echo $_SERVER['SERVER_NAME'];?>/app/index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=shop&m=sea&p=list&keywords=<?php  echo $vo;?>" class="rs-lk"><?php  echo $vo;?></a>
        <?php  } } ?>
    </div>
  </div>
  <div class="rs-k">
    <div class="rs-wz" style="width:120px;text-align:left;">历史搜索:</div>
    
  </div>

  <div class="rs-jh">
    <div class="rs-jh-list hisData">
      <!--<a href="" class="rs-lk">花王纸尿布</a>
      <a href="" class="rs-lk">帝王蟹</a>
      <a href="" class="rs-lk">进口平行车</a>
      <a href="" class="rs-lk">奶粉</a>
      <a href="" class="rs-lk">兰蔻粉水</a>
      <a href="" class="rs-lk">奶粉</a>
      <a href="" class="rs-lk">兰蔻粉水</a>-->
    </div>
  </div>

  <div class="search-clark">
    <a  class="clear-btnk">清空历史记录</a>
  </div>
</div>
<script type="text/javascript">
  var S = {
    init:function(){
        this.cancle();
        this.getLocaldata();
        this.listenSubmit();
        this.deleteHis();
    },
    cancle:function(){
      $(".canBtn").on("click",function(){
        console.log(1);
        window.location.href="<?php  echo $_SERVER['HTTP_REFERER'];?>";
      });
    },
    listenSubmit:function(){
        $("#searchform").bind("submit",function(){
          var v=$("#name").val();
          var storage_str = localStorage.getItem("searchList");
          if(storage_str){
            storage_str+=v+"|";
          }else{
            storage_str=v+"|";
          }
          localStorage.setItem("searchList",storage_str);
        });
    },
    deleteHis:function(){
      $(".clear-btnk").click(function(){
        localStorage.removeItem("searchList");
        S.getLocaldata();
      });
    },
    getLocaldata:function(){
        var reclist=localStorage.getItem("searchList");
        if(reclist){
          var list=reclist.split("|");
          var li_list="";
          for(var i=0;i<list.length;i++){
            if(list[i]!=""){
              li_list+='<a href="http://<?php  echo $_SERVER['SERVER_NAME'];?>/app/index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=shop&m=sea&p=list&keywords='+list[i]+'" class="rs-lk">'+list[i]+'</a>';
            }
          }
          if(li_list!=""){
            $(".hisData").html(li_list);
          }
        }else{
          var ht='<div style="width:100%;disline:block;text-align:center;">无搜索历史</div>';
          $(".hisData").html(ht);
        }
    }

  };
  $(function(){S.init();});
</script>
</body>
</html>