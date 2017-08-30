<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title><?php  echo $this->set['texts']['myteam']?></title>
<style type="text/css">
    body {margin:0px; background:#eee; font-family:'微软雅黑'; -moz-appearance:none;}
    a {text-decoration:none;}
    .team_top {height:44px; width:100%;  background:#f8f8f8;  border-bottom:1px solid #e3e3e3;}
    .team_top .title {height:44px; width:auto;margin-left:10px; float:left; font-size:16px; line-height:44px; color:#666;}

    .team_list_head {height:20px; width:94%; background:#fff; padding:10px 3%;border-bottom:1px solid #eaeaea;}
    .team_list_head .info {height:20px; width:60%; float:left;  font-size:16px; color:#666; line-height:20px; text-align:left;}
    .team_list_head .info span {font-size:14px; color:#999;}
    .team_list_head .num {height:20px; float:right; text-align:right; font-size:16px; color:#666; line-height:20px; font-size:14px; color:#999;}
    
    
    .team_list {height:40px; width:94%; background:#fff; padding:10px 3%;}
    .team_list .img { width:16%; height:40px; float:left; text-align:left;}
    .team_list .img img {height:40px; width:40px; }
    
    .team_list .info {height:40px; width:60%; float:left; border-right:1px solid #eaeaea; font-size:16px; color:#666; line-height:20px; text-align:left;}
    .team_list .info span {font-size:14px; color:#999;}
    .team_list .num {height:40px; width:23%; float:right; text-align:right; font-size:16px; color:#666; line-height:20px;}
    .team_list .num span {font-size:14px; color:#999;}
    .team_tab {height:30px; margin:5px; border:1px solid #ff6801; border-radius:5px; overflow:hidden;font-size:13px;background:#fff;padding-right: -2px;}
    .team_nav {height:30px;  background:#fff; color:#666; text-align:center; line-height:30px; float:left;}
    .team_navon {color:#fff; background:#ff6801;}
    .team_no {height:100px; width:100%; margin:50px 0px 60px; color:#ccc; font-size:12px; text-align:center;}
    #team_loading { padding:10px;color:#666;text-align: center;}

</style>
<div class="team_top">
    <div class="title" onclick='history.back()'><i class='fa fa-chevron-left'></i> <?php  echo $this->set['texts']['myteam']?>(<?php  echo $total;?>)</div>
</div>
<?php  if($total>0) { ?>
<!--
<div class="team_tab">
    <div class="team_nav team_navon" data-level='1'  style='width:<?php  echo $tabwidth;?>%'><?php  echo $this->set['texts']['c1']?>(<?php  echo $level1;?>)</div>
    <?php  if($this->set['level']>=2) { ?><div class="team_nav" data-level='2'  style='width:<?php  echo $tabwidth;?>%'><?php  echo $this->set['texts']['c2']?>(<?php  echo $level2;?>)</div><?php  } ?>
    <?php  if($this->set['level']>=3) { ?><div class="team_nav" data-level='3'  style='width:<?php  echo $tabwidth;?>%'><?php  echo $this->set['texts']['c3']?>(<?php  echo $level3;?>)</div><?php  } ?>
</div>-->
<?php  } ?>
<?php  if($agentlevels>0) { ?>

<!-- udpate 12-05 -->
<style>
   
.qudao-sec{
    margin-top: 8px;
    height: 32px;
    line-height: 32px;
    color: #666;
    font-size: 14px;border-bottom: 1px solid #eaeaea;
    text-align: center;
    background: #eee;
}
.data-show-waper{
    background: #fff;
    border-bottom: 1px solid #eaeaea;
}
.qudao-data-u{
    width: 100%;
    display: inline-block;
}
.qudao-data-u li{
    width: 33%;
    display: inline-block;
    height: 32px;
    line-height: 32px;color: #666;
    float: left;
    font-size: 14px;
}
.qudao-data{
    width: 100%;
    display: inline-block;
    padding: 0 10px;
}
.qudao-data-u-a li{
    text-align: center;
}
    </style>
<div class="data-show-waper">
    <div class="qudao-sec">渠道商数据</div>
    <div class="qudao-data">
        <ul class="qudao-data-u qudao-data-u-a">
            <li style="width:50%;">总粉丝：<?php  echo $allfensi;?></li>
            <li style="width:50%;">总连锁：<?php  echo $allliansuodian;?></li>
        </ul>
    </div>
    <div class="qudao-sec">业绩详情</div>
    <div class="qudao-data">
        <ul class="qudao-data-u">
            <li>月订单：<?php  echo $by_order_total;?></li>
            <li>月成交：<?php  echo $by_order_num;?></li>
            <li>月分红：<?php  echo $by_order_commission;?></li>
        </ul>
    </div>
    <div class="qudao-data">
        <ul class="qudao-data-u">
            <li>总订单：<?php  echo $all_order_total;?></li>
            <li>总成交：<?php  echo $all_order_num;?></li>
            <li>已分红：<?php  echo $all_order_commission;?></li>
        </ul>
    </div>
</div>


<!-- end update 12-05 -->
<?php  } ?>
<div class="team_list_head">
        <div class="info">成员信息</div>
        <div class="num">TA的<?php  echo $this->set['texts']['commission']?>/成员</div>
</div>
<div id='container'></div>

<script id='tpl_team' type='text/html'>
    <%each list as user%>
    <div class="team_list" style="height:80px">
        <div class="img"><img src="<%if user.nickname%><%user.avatar%><%else%>../addons/sea/plugin/commission/images/head.jpg<%/if%>"></div>
        <div class="info" style="height:80px"><%if user.nickname%><%user.nickname%><%else%>未获取<%/if%><br><span><%user.agenttime%></span></div>
        <div class="num" style="height:80px">+<%user.commission_total%><br><span><%user.agentcount%> 个成员<br/>粉丝:<%user.agentcount2%>个<br/>店铺:<%user.agentcount1%>个</span></div>
    </div>
    <%/each%>
</script>
<script id='tpl_empty' type='text/html'>
    <div class="team_no"><i class="fa fa-users" style="font-size:100px;"></i><br><span style="line-height:18px; font-size:16px;">您还没有相关成员~</span></div>
</script>

<script language="javascript">
    var page = 1;
   var current_level = 1;
    require(['tpl', 'core'], function (tpl, core) {

function bindScroller(){
    
        
        //加载更多
        var loaded = false;
        var stop = true;
        $(window).scroll(function () {
            if (loaded) {
                return;
            }
            $('#team_loading').remove();
            totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop());
            if ($(document).height() <= totalheight) {

                if (stop == true) {
                    stop = false;
                    $('#container').append('<div id="team_loading"><i class="fa fa-spinner fa-spin"></i> 正在加载...</div>');
                    page++;
                    core.pjson('commission/team', {level:current_level,page: page}, function (morejson) {
                        stop = true;
                        $('#team_loading').remove();
						console.log(morejson.result);
                        $("#container").append(tpl('tpl_team', morejson.result));
                        if (morejson.result.list.length < morejson.result.pagesize) {
                            $("#container").append('<div id="team_loading">已经加载完全部成员</div>');
                            loaded = true;
                            $(window).scroll = null;
                            return;
                        }
                    }, true);
                }
            }
        });
}
        function getTeam(level) {
            $('.team_nav').removeClass('team_navon');
            $('.team_nav[data-level=' + level + ']').addClass('team_navon');
            core.pjson('commission/team', {level: level, page: page}, function (json) {
                if (json.result.list.length <= 0) {
                    $('#container').html(tpl('tpl_empty'));
                    return;
                }
                $('#container').html(tpl('tpl_team', json.result));
                bindScroller();
            }, true);
        }
        $('.team_nav').unbind('click').click(function () {
            page = 1; current_level = $(this).data('level')
            getTeam(current_level);

        });

        getTeam(1);

    })
</script>
<?php  $show_footer=true?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
