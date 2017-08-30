<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title>收货地址管理</title>
<style type="text/css">
    body {margin:0px; background:#efefef; font-family:'微软雅黑'; -moz-appearance:none;}
    a {text-decoration:none;}

    .address_addnav {height:44px; width:94%; padding:0 3%; border-bottom:1px solid #f0f0f0; border-top:1px solid #f0f0f0; margin-top:14px; line-height:42px; color:#666; background:#fff;}
    .address_list {height:50px; padding:0 10px;  border-bottom:1px solid #f0f0f0; border-top:1px solid #f0f0f0; margin-top:14px; background:#fff;}
    .address_list .ico {height:50px; width:30px;   float:left; color:#999;margin-right:-30px; z-index:2}
    .address_list .ico i { font-size:24px;margin-top:15px;margin-left:10px;z-index:2;position: relative;}
    .address_list .info {height:50px; width:100%; float:left;position: relative;}
    .address_list .info .inner { margin-left:40px;margin-right:50px;}
    .address_list .info .inner .addr {height:20px; width:100%; color:#999; line-height:26px; font-size:14px; overflow:hidden;}
    .address_list .info .inner .user {height:30px; width:100%; color:#666; line-height:30px; font-size:16px; overflow:hidden;}
    .address_list .info .inner .user span {color:#444; font-size:16px;}
    .address_list .btn { width:45px; float:right;margin-left:-45px;z-index:2;position: relative;}
    .address_list .btn .edit,.address_list .btn .remove {height:50px; float:right; color:#999; font-size:18px;margin-top:5px;}
    .address_list .btn .edit { margin-right:10px;}
    
.address_addnav {height:40px;  border-bottom:1px solid #f0f0f0; border-top:1px solid #f0f0f0; margin-top:14px; line-height:40px; color:#666; }
.address_main {height:auto;width:94%; padding:0px 3%; border-bottom:1px solid #f0f0f0; border-top:1px solid #f0f0f0; margin-top:14px; background:#fff;}
.address_main .line {height:44px; width:100%; border-bottom:1px solid #f0f0f0; line-height:44px;}

.address_main .line input {float:left; height:44px; width:100%; padding:0px; margin:0px; border:0px; outline:none; font-size:16px; color:#666;padding-left:5px;}
.address_main .line select  { border:none;height:25px;width:100%;color:#666;font-size:16px;}
.address_sub1 {height:44px; margin:14px 10px; background:#ff4f4f; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#fff;}
.address_sub2 {height:44px; margin:14px 10px; background:#ddd; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#666; border:1px solid #d4d4d4;}
</style>
<script type="text/javascript" src="../addons/sea/static/js/dist/area/cascade.js"></script>
<div id='container'></div>

<script id='address_list' type='text/html'>
    <div class="page_topbar">
        <a href="javascript:;" class="back" onclick="history.back()"><i class="fa fa-angle-left"></i></a>
        <div class="title">收货地址管理</div>
    </div>
    
   <%each list as value%>
   <div class="address_list" 
        data-addressid="<%value.id%>">
        <div class="ico" ><i class="fa <%if value.isdefault=='1'%>fa-check-circle-o<%else%>fa-circle-o<%/if%>" <%if value.isdefault=='1'%>style="color:#0c9"<%/if%>></i></div>
        <div class="info">
            <div class='inner'>
               <div class="addr"><%value.address%></div>
               <div class="user"><span><%value.realname%>  <%value.mobile%></span></div>
            </div>
        </div>
        <div class='btn'>
            <div class="remove" ><i class="fa fa-remove" style="margin-top:13px"></i></div>
            <div class="edit"><i class="fa fa-pencil" style="margin-top:14px"></i></div>
        </div>
    </div>
  <%/each%>
  <a href="javascript:;" id='new_address'><div class="address_addnav"><i class="fa fa-plus-circle" style="color:#999; margin:10px 10px 0 8px; font-size:18px;"></i>新增收货地址</div></a>
</script>
<script id='address_data' type='text/html'>
 
      <div class="page_topbar">
        <a href="javascript:;" class="back" id="editback"><i class="fa fa-angle-left"></i></a>
        <div class="title"> <%if !address.id%>添加收货地址<%else%>编辑收货地址<%/if%></div>
    </div>
    
    <div class="address_main" >
        <input type='hidden' id='addressid' value="<%address.id%>"/>
        <div class="line"><input type="text" placeholder="收件人" id="realname" value="<?php  if(address.realname) { ?><%address.realname%><?php  } ?>" /></div>
        <div class="line"><input type="text" placeholder="联系电话"  id="mobile" value="<?php  if(address.mobile) { ?><%address.mobile%><?php  } ?>"/></div>
        <div class="line"><select id="sel-provance" onChange="change_selectCity()" class="select"><option value="" selected="true">所在省份</option></select></div>
         <div class="line"><select id="sel-city" onChange="change_selectcounty();" class="select"><option value="" selected="true">所在城市</option></select></div>
         <div class="line"><select id="sel-area" class="select" onChange="change_area();"><option value="" selected="true">所在地区</option></select></div>
		 <?php  if($istradearea['is_tradearea']==1) { ?>
         <div class="line"><select id="sel-trade"><option id="area-first" value="0">全区域</option></select></div>
		 <?php  } ?>
        <div class="line"><input type="text" placeholder="详细地址(不包含省份城市)"  id="address" value="<?php  if(address.address) { ?><%address.address%><?php  } ?>"/></div>
<!--        <div class="line"><input type="text" placeholder="邮政编码"  id="zipcode" value="<?php  if(address.zipcode) { ?><%address.zipcode%><?php  } ?>"/></div>-->
    </div>
    <div class="address_sub1">确认</div>
    <div class="address_sub2">取消</div>

</script>

<script language="javascript">
    function change_selectCity(){
                selectCity();
				<?php  if($istradearea['is_tradearea']==1) { ?>
                change_tradearea();
				<?php  } ?>
                $("#sel-city").children("option").bind("click", function(){
                });
            }
			
	function change_selectcounty(){
                selectcounty(0);
				<?php  if($istradearea['is_tradearea']==1) { ?>
                change_tradearea();
				<?php  } ?>
            }
			
	function change_area(){
                change_tradearea();
            }
			
	function change_tradearea(){
                show_address(1);
            }
			
	function show_address(flag) {
                var province = $('#sel-provance').val();
                var city = $('#sel-city').val();
                var district = $('#sel-area').val();
                var addressid = $('#addressid').val();
                $.ajax({
                    url: "<?php  echo $this->createMobileUrl('shop/address',array('op'=>'trade'))?>",
                    dataType: "json",
                    data: {province:province,city:city,district:district,addressid:addressid},
                    success:function(json){
                        
                        createtradeare(json);

                    }
                });
                
            }

            function createtradeare(json){
                $("#area-first").nextAll().remove();
				  
                if (json.status == 1) {
                    var len = getJsonObjLength(json.result);
                    for (var i = 0; i < len; i++) {
						
                        if (json.result.tradeid == json.result[i]['id']) {
                            var option = "<option value="+json.result[i]['id']+" id=area_"+json.result[i]['id']+" selected='true'>"+json.result[i]['area']+"</option>";

                        }
						else{
                            var option = "<option value="+json.result[i]['id']+" id=area_"+json.result[i]['id']+">"+json.result[i]['area']+"</option>";
                        }

                        var option_id = $("#area_"+json.result[i]['id']+"").val();
                        if (option_id == undefined) {
                            $("#area-first").after(option);
							 
                        } 
                    }
                }else if (json.status == 0) {
                    $("#area-first").nextAll().remove();
                }

            }

        function getJsonObjLength(jsonObj) {
            var Length = 0;
            for (var item in jsonObj) {
                Length++;
            }
            return Length;
        }
			
    require(['tpl', 'core'], function(tpl, core) {
		
        function bindEditEvents(){
       
            $('.address_sub1').click(function(){
                
                if($(this).attr('saving')=='1'){
                        return;
                }
                if($('#realname').isEmpty()){
                    core.tip.show('请输入收件人!');
                    return;
                }
                if(!$('#mobile').isMobile()){
                    core.tip.show('请输入正确的联系电话!');
                    return;
                }
	       if($('#sel-provance').val()=='请选择省份'){
                    core.tip.show('请选择省份!');
                    return;
                }
	       if($('#sel-city').val()=='请选择城市'){
                    core.tip.show('请选择城市!');
                    return;
                }
	       if($('#sel-area').val()=='请选择地区'){
                    core.tip.show('请选择地区!');
                    return;
                }
				
           
                if($('#address').isEmpty()){
                    core.tip.show('请输入收货地址!');
                    return;
                } 
               
                $('.address_sub1').html('正在处理...').attr('saving',1);
                core.json('shop/address',{
                    op:'submit',
                    id:$('#addressid').val(),
                    addressdata: {
                        realname: $('#realname').val(),
                        mobile: $('#mobile').val(),
                        address: $('#address').val(),
                        province: $('#sel-provance').val(),
                        city: $('#sel-city').val(),
                        area: $('#sel-area').val(),
						tradearea_id: $('#sel-trade').val(),
                                //,zipcode: $('#zipcode').val()
                    }
                 },function(json){
                     if(json.status==1){
                         core.tip.show('保存成功!');
                         list();
                     }
                     else{
                         $('.address_sub1').html('确认').removeAttr('saving');
                         core.tip.show('保存失败');
                     }
                },true,true);
            });
 
            $('.address_sub2,#editback').click(function(){
                list();
            });
			
			
        }
		
        function list(){
            core.json('shop/address',{},function(json){
                 $('#container').html(  tpl('address_list',json.result) );

                 $('.edit').click(function(){
                    var id =$(this).closest('.address_list').data('addressid');
                    core.json('shop/address',{op:'get',id:id},function(json){
                        $('#container').html(  tpl('address_data',json.result) );
                        var address = json.result.address;
                        cascdeInit(address.province,address.city,address.area,address.name);
						<?php  if($istradearea['is_tradearea']==1) { ?>
						show_address(1);
						<?php  } ?>
                        bindEditEvents();
                     },true);
					 
                     
                 })
        
                 $('.ico').click(function(){
                     var id =$(this).closest('.address_list').data('addressid');
                      $('.ico i').removeClass('fa-check-circle-o').addClass('fa-circle-o').css('color','#999');
                          $('.address_list[data-addressid='+id +'] .ico i').removeClass('fa-circle-o').addClass('fa-check-circle-o').css('color','#0c9');
                         core.json('shop/address',{op:'setdefault',id:id},function(json){
                          if(json.status==1){
                              core.tip.show('设置默认地址成功');
                          }
                          else{
                              core.tip.show('设置默认地址失败');
                          }
                         },true,true);
                 });
            
                 $('.remove').click(function(){
                     var id =$(this).closest('.address_list').data('addressid');
                      core.tip.confirm('确认要删除此地址?',function(){

                             var aobj = $('.address_list[data-addressid='+id +']');
                             aobj.fadeOut(500,function(){ 
                                       aobj.remove();
                             });
                              core.json('shop/address',{op:'remove',id:id},function(json){
                                if(json.status==1){
                                    if(json.result && json.result.defaultid){
                                        $('.ico i').removeClass('fa-check-circle-o').addClass('fa-circle-o').css('color','#999');
                                        $('.address_list[data-addressid='+json.result.defaultid +'] .ico i').removeClass('fa-circle-o').addClass('fa-check-circle-o').css('color','#0c9');
                                    }
                                    core.tip.show('删除成功');
                                }
                                else{
                                    core.tip.show('删除失败');
                                }
                             },true,true);
                     }) 
                 });
               
                 $('#new_address').click(function(){
                      core.json('shop/address',{op:'new'},function(json){
                          var result = json.result;
                            $('#container').html(  tpl('address_data',result) );
                            cascdeInit(result.address.province,result.address.city,result.address.area);
                              <?php  if($trade['shareaddress']=='1' && is_weixin()) { ?>
                                    var shareAddress = <?php  echo json_encode($shareAddress)?>;
                                    WeixinJSBridge.invoke('editAddress',shareAddress,function(res){ 
                                        if(res.err_msg=='edit_address:ok'){
                                            $("#realname").val( res.userName  );
                                            $('#mobile').val( res.telNumber );
                                            $('#address').val( res.addressDetailInfo );
                                            cascdeInit(res.proviceFirstStageName,res.addressCitySecondStageName,res.addressCountiesThirdStageName);
                                        }
                                    });
                            <?php  } ?>
                            bindEditEvents();
                     },true);
                  });
            },true);
        }
        
        list();
        
    });
	
	
</script>
<?php  $show_footer = true?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
