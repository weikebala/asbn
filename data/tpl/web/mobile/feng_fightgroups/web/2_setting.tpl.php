<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="main">
	<form action="" method="post" class="form-horizontal form" id="setting-form">
		<div class="panel panel-default">
			<div class="panel-heading">参数设置</div>
			<div class="panel-body">
				<ul class="nav nav-tabs" id="myTab">
					<li class="active" ><a href="#tab_basic">基本设置</a></li>
					<li><a href="#tab_share">分享设置</a></li>
					<li><a href="#tab_param">退款设置</a></li>
					<li><a href="#tab_param1">通知设置</a></li>
					<li><a href="#tab_param2">拼团信息设置</a></li>
					<li><a href="#tab_param5">商品标签设置</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane  active" id="tab_basic">
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">拼团模式</label>
							<div class="col-xs-12 col-sm-8">
								<label class="radio radio-inline" onclick="$('.picmode').hide();$('.goodstip').show();$('.showtype').show();">
									<input type="radio" name="mode" value="1" <?php  if(intval($settings['mode']) == 1) { ?>checked="checked"<?php  } ?>> 精简模式
								</label>
								<label class="radio radio-inline" onclick="$('.picmode').show();$('.goodstip').hide();$('.showtype').hide();">
									<input type="radio" name="mode" value="2" <?php  if(intval($settings['mode']) == 2) { ?>checked="checked"<?php  } ?>> 多功能模式
								</label>
								<span class="help-block">精简模式类似拼好货，多功能模式功能会更多一些。</span>
							</div>
						</div>
						<div class="form-group picmode" <?php  if($settings['mode']==1) { ?>style="display:none;"<?php  } ?>>
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">首页显示</label>
							<div class="col-xs-12 col-sm-8">
								<label class="radio radio-inline">
									<input type="radio" name="picmode" value="1" <?php  if(intval($settings['picmode']) == 1) { ?>checked="checked"<?php  } ?>> 小图模式（两列）
								</label>
								<label class="radio radio-inline">
									<input type="radio" name="picmode" value="2" <?php  if(intval($settings['picmode']) == 2) { ?>checked="checked"<?php  } ?>> 大图模式（一列）
								</label>
							</div>
						</div>
						<div class="form-group showtype" <?php  if($settings['mode']==2) { ?>style="display:none;"<?php  } ?>>
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">首页风格</label>
							<div class="col-xs-12 col-sm-8">
								<label class="radio radio-inline">
									<input type="radio" name="showtype" value="1" <?php  if(intval($settings['showtype']) == 1) { ?>checked="checked"<?php  } ?>> 上下模式
								</label>
								<label class="radio radio-inline">
									<input type="radio" name="showtype" value="2" <?php  if(intval($settings['showtype']) == 2) { ?>checked="checked"<?php  } ?>> 左右模式
								</label>
								<span class="help-block">默认为经典上下模式。</span>
							</div>
						</div>
						<div class="form-group showtype">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">底部栏风格</label>
							<div class="col-xs-12 col-sm-8">
								<label class="radio radio-inline">
									<input type="radio" name="ditype" value="1" <?php  if(intval($settings['ditype']) == 1) { ?>checked="checked"<?php  } ?>> 经典模式
								</label>
								<label class="radio radio-inline">
									<input type="radio" name="ditype" value="2" <?php  if(intval($settings['ditype']) == 2) { ?>checked="checked"<?php  } ?>> 单独分类模式
								</label>
								<span class="help-block">默认为经典模式。[修改为单独分类模式后，请前往分类管理添加新分类，且商品所属分类需要重新编辑]</span>
							</div>
						</div>
						<div class="form-group goodstip" <?php  if($settings['mode']==2) { ?>style="display:none;"<?php  } ?>>
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">商品标签</label>
							<div class="col-xs-12 col-sm-8">
								<label class="radio radio-inline">
									<input type="radio" name="goodstip" value="1" <?php  if(intval($settings['goodstip']) == 1) { ?>checked="checked"<?php  } ?>> 关闭
								</label>
								<label class="radio radio-inline">
									<input type="radio" name="goodstip" value="2" <?php  if(intval($settings['goodstip']) == 2) { ?>checked="checked"<?php  } ?>> 开启
								</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">分享团</label>
							<div class="col-xs-12 col-sm-8">
								<label class="radio radio-inline">
									<input type="radio" name="sharestatus" value="1" <?php  if(intval($settings['sharestatus']) == 1) { ?>checked="checked"<?php  } ?>> 开启
								</label>
								<label class="radio radio-inline">
									<input type="radio" name="sharestatus" value="2" <?php  if(intval($settings['sharestatus']) == 2) { ?>checked="checked"<?php  } ?>> 关闭
								</label>
								<span class="help-block">分享团在商品详情页，用于更快组团，默认开启。</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">商品搜索</label>
							<div class="col-xs-12 col-sm-8">
								<label class="radio radio-inline">
									<input type="radio" name="searchstatus" value="1" <?php  if(intval($settings['searchstatus']) == 1) { ?>checked="checked"<?php  } ?>> 开启
								</label>
								<label class="radio radio-inline">
									<input type="radio" name="searchstatus" value="2" <?php  if(intval($settings['searchstatus']) == 2) { ?>checked="checked"<?php  } ?>> 关闭
								</label>
								<span class="help-block">首页商品搜索，默认关闭。</span>
							</div>
						</div>
						<div class="form-group goodstip" <?php  if($settings['mode']==2) { ?>style="display:none;"<?php  } ?>>
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">分享团显示方式</label>
							<div class="col-xs-12 col-sm-8">
								<label class="radio radio-inline">
									<input type="radio" name="share_type" value="1" <?php  if(intval($settings['share_type']) == 1) { ?>checked="checked"<?php  } ?>> 直接显示
								</label>
								<label class="radio radio-inline">
									<input type="radio" name="share_type" value="2" <?php  if(intval($settings['share_type']) == 2) { ?>checked="checked"<?php  } ?>> 附近团按钮
								</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">自动签收时间</label>
							<div class="col-xs-12 col-sm-2 input-group" >
								<input type="text" name="gettime" class="form-control" value="<?php  echo $settings['gettime'];?>" />
								<span class="input-group-addon">天</span>
							</div>
							<span class="help-block" style="margin-left: 16.66666667%;">自发货后计时，签收时间。默认为5天</span>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">核销订单维持“待核销”天数</label>
							<div class="col-xs-12 col-sm-2 input-group" >
								<input type="text" name="checkgettime" class="form-control" value="<?php  echo $settings['checkgettime'];?>" />
								<span class="input-group-addon">天</span>
							</div>
							<span class="help-block" style="margin-left: 16.66666667%;">自购买后计时N天后该订单金额成为商家可结算金额。默认为5天（没有核销商品的可不填）</span>
						</div>
					<!-- 关注参数设置开始 -->
					<div class="tab-pane" id="tab_followed">
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">关注二维码</label>
							<div class="col-sm-8">
								<?php  echo tpl_form_field_image('followed_image', $settings['followed_image']);?>(建议430*430)
							</div>
						</div>
					</div>
					<div class="form-group goodstip" >
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">顶部引导关注提示</label>
							<div class="col-xs-12 col-sm-8">
								<label class="radio radio-inline">
									<input type="radio" name="guanzhu" value="1" <?php  if(intval($settings['guanzhu']) == 1) { ?>checked="checked"<?php  } ?>> 未关注时显示
								</label>
								<label class="radio radio-inline">
									<input type="radio" name="guanzhu" value="2" <?php  if(intval($settings['guanzhu']) == 2) { ?>checked="checked"<?php  } ?>> 不显示
								</label>
							</div>
						</div>
					<!-- 关注参数设置结束 -->
					<div class="form-group goodstip" <?php  if($settings['mode']==2) { ?>style="display:none;"<?php  } ?>>
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">他人代付</label>
							<div class="col-xs-12 col-sm-8">
								<label class="radio radio-inline">
									<input type="radio" name="otherpay" value="1" <?php  if(intval($settings['otherpay']) == 1) { ?>checked="checked"<?php  } ?>> 开启
								</label>
								<label class="radio radio-inline">
									<input type="radio" name="otherpay" value="2" <?php  if(intval($settings['otherpay']) == 2) { ?>checked="checked"<?php  } ?>> 关闭
								</label>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="tab_share">
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">分享标题</label>
							<div class="col-sm-8">
								<input type="text" name="share_title" class="form-control" value="<?php  echo $settings['share_title'];?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">组团分享图片</label>
							<div class="col-xs-12 col-sm-8">
								<label class="radio radio-inline">
									<input type="radio" name="share_imagestatus" value="1" <?php  if(intval($settings['share_imagestatus']) == 1) { ?>checked="checked"<?php  } ?>> 该商品图片
								</label>
								<label class="radio radio-inline">
									<input type="radio" name="share_imagestatus" value="2" <?php  if(intval($settings['share_imagestatus']) == 2) { ?>checked="checked"<?php  } ?>> 用户头像
								</label>
								<label class="radio radio-inline">
									<input type="radio" name="share_imagestatus" value="3" <?php  if(intval($settings['share_imagestatus']) == 3) { ?>checked="checked"<?php  } ?>> 自定义
								</label>
								<span class="help-block">分享给好友时的图片，默认为该商品图片。</span>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">自定义分享图片</label>
							<div class="col-sm-8">
								<?php  echo tpl_form_field_image('share_image', $settings['share_image']);?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">分享描述</label>
							<div class="col-sm-8">
								<textarea style="height:150px;" id="description" name="share_desc" class="form-control description" cols="60"><?php  echo $settings['share_desc'];?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">代付分享标题(不开代付功能可不填)</label>
							<div class="col-sm-8">
								<input type="text" name="daifushare_title" class="form-control" value="<?php  echo $settings['daifushare_title'];?>" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">代付分享图片(不开代付功能可不填)</label>
							<div class="col-sm-8">
								<?php  echo tpl_form_field_image('daifushare_image', $settings['daifushare_image']);?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">代付分享描述(不开代付功能可不填)</label>
							<div class="col-sm-8">
								<textarea style="height:150px;" id="description" name="daifu_desc" class="form-control description" cols="60"><?php  echo $settings['daifu_desc'];?></textarea>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="tab_param">
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">是否开启用户手动退款</label>
							<div class="col-xs-12 col-sm-8">
								<label class="radio radio-inline">
									<input type="radio" name="userrefund" value="1" <?php  if(intval($settings['userrefund']) == 1) { ?>checked="checked"<?php  } ?>> 关闭
								</label>
								<label class="radio radio-inline">
									<input type="radio" name="userrefund" value="2" <?php  if(intval($settings['userrefund']) == 2) { ?>checked="checked"<?php  } ?>> 开启
								</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">微信支付商户号(MchId)</label>
							<div class="col-xs-12 col-sm-8">
								<input type="text" name="mchid" class="form-control" value="<?php  echo $settings['mchid'];?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">商户支付密钥(API密钥)</label>
							<div class="col-xs-12 col-sm-8">
								<input type="text" name="apikey" class="form-control" value="<?php  echo $settings['apikey'];?>" />
							</div>
						</div>
						<div class="form-group">
		                    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">商户支付证书</label>
		                    <div class="col-sm-8 col-xs-12">
		                        <textarea class="form-control" name="cert" rows="8" placeholder="为保证安全性, 不显示证书内容. 若要修改, 请直接输入"></textarea>
		                        <span class="help-block">从商户平台上下载支付证书, 解压并取得其中的 <mark>apiclient_cert.pem</mark> 用记事本打开并复制文件内容, 填至此处</span>
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">支付证书私钥</label>
		                    <div class="col-sm-8 col-xs-12">
		                        <textarea class="form-control" name="key" rows="8" placeholder="为保证安全性, 不显示证书内容. 若要修改, 请直接输入"></textarea>
		                        <span class="help-block">从商户平台上下载支付证书, 解压并取得其中的 <mark>apiclient_key.pem</mark> 用记事本打开并复制文件内容, 填至此处</span>
		                    </div>
		                </div>
					</div>
					<div class="tab-pane" id="tab_param1">
						<div class="panel panel-success">
							<div class="panel-heading">代付模板参数设置</div>
							<div class="panel-body">
								<div class="form-group">
									<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">模板ID</label>
									<div class="col-xs-12 col-sm-8">
										<input type="text" name="m_daipay" class="form-control" value="<?php  echo $settings['m_daipay'];?>" />
										<span class="help-block">公众平台模板消息编号：IT科技——互联网|电子商务——OPENTM200561396[名称：订单代付成功通知]</span>
									</div>
								</div>
							</div>
						</div>
						<div class="panel panel-warning">
							<div class="panel-heading">支付成功模板参数设置</div>
							<div class="panel-body">
								<div class="form-group">
									<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">模板ID</label>
									<div class="col-xs-12 col-sm-8">
										<input type="text" name="m_pay" class="form-control" value="<?php  echo $settings['m_pay'];?>" />
										<span class="help-block">公众平台模板消息编号：IT科技——互联网|电子商务——TM00015[名称：订单支付成功]</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">发送内容主题</label>
									<div class="col-xs-12 col-sm-8">
										<input type="text" name="pay_suc" class="form-control" value="<?php  echo $settings['pay_suc'];?>" />
										<span class="help-block">例：恭喜开团成功，快邀请好友参加吧</span>
									</div>
								</div>
							</div>
						</div>
						<div class="panel panel-success">
							<div class="panel-heading">组团成功模板参数设置</div>
							<div class="panel-body">
								<div class="form-group">
									<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">模板ID</label>
									<div class="col-xs-12 col-sm-8">
										<input type="text" name="m_tuan" class="form-control" value="<?php  echo $settings['m_tuan'];?>" />
										<span class="help-block">公众平台模板消息编号：IT科技——互联网|电子商务——TM00353[名称：团购结果通知]</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">发送内容主题</label>
									<div class="col-xs-12 col-sm-8">
										<input type="text" name="tuan_suc" class="form-control" value="<?php  echo $settings['tuan_suc'];?>" />
										<span class="help-block">例：组团成功，我们尽快发货哟</span>
									</div>
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">取消订单模板参数设置</div>
							<div class="panel-body">
								<div class="form-group">
									<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">模板ID</label>
									<div class="col-xs-12 col-sm-8">
										<input type="text" name="m_cancle" class="form-control" value="<?php  echo $settings['m_cancle'];?>" />
										<span class="help-block">公众平台模板消息编号：IT科技——互联网|电子商务——OPENTM202355776[名称：订单取消通知]</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">发送内容主题</label>
									<div class="col-xs-12 col-sm-8">
										<input type="text" name="cancle" class="form-control" value="<?php  echo $settings['cancle'];?>" />
									</div>
								</div>
							</div>
						</div>
						<div class="panel panel-info">
							<div class="panel-heading">发货模板参数设置</div>
							<div class="panel-body">
								<div class="form-group">
									<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">模板ID</label>
									<div class="col-xs-12 col-sm-8">
										<input type="text" name="m_send" class="form-control" value="<?php  echo $settings['m_send'];?>" />
										<span class="help-block">公众平台模板消息编号：IT科技——互联网|电子商务——OPENTM200565259[名称:订单发货提现]</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">发送内容主题</label>
									<div class="col-xs-12 col-sm-8">
										<input type="text" name="send" class="form-control" value="<?php  echo $settings['send'];?>" />
									</div>
								</div>
							</div>
						</div>
						<div class="panel panel-danger">
							<div class="panel-heading">退款模板参数设置</div>
							<div class="panel-body">
								<div class="form-group">
									<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">模板ID</label>
									<div class="col-xs-12 col-sm-8">
										<input type="text" name="m_ref" class="form-control" value="<?php  echo $settings['m_ref'];?>" />
										<span class="help-block">公众平台模板消息编号：IT科技——互联网|电子商务——TM00004[名称:退款通知]</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">退款原因</label>
									<div class="col-xs-12 col-sm-8">
										<input type="text" name="ref" class="form-control" value="<?php  echo $settings['ref'];?>" />
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="tab_param2">
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">商城名称</label>
							<div class="col-xs-12 col-sm-8">
								<input type="text" name="sname" class="form-control" value="<?php  echo $settings['sname'];?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">商城LOGO</label>
							<div class="col-sm-8">
								<?php  echo tpl_form_field_image('slogo', $settings['slogo']);?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">拼团宣传群二维码</label>
							<div class="col-sm-8">
								<?php  echo tpl_form_field_image('qrcode', $settings['qrcode']);?>
							</div>
							<span class="help-block">用户通过该二维码加入拼团群，可快速拉人成团</span>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">版权信息</label>
							<div class="col-xs-12 col-sm-8">
								<input type="text" name="copyright" class="form-control" value="<?php  echo $settings['copyright'];?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">拼团介绍</label>
							<div class="col-sm-8 col-xs-12">
								<textarea name="content" class="form-control richtext" cols="70"><?php  echo $settings['content'];?></textarea>
								<span class="help-block">为空则为默认介绍</span>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="tab_param5">
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">商品标签1</label>
							<div class="col-xs-12 col-sm-2 input-group" >
								<input type="text" name="tag1" class="form-control" value="<?php  echo $settings['tag1'];?>" />
								<span class="help-block">默认为：上新</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">商品标签2</label>
							<div class="col-xs-12 col-sm-2 input-group" >
								<input type="text" name="tag2" class="form-control" value="<?php  echo $settings['tag2'];?>" />
								<span class="help-block">默认为：疯抢</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">商品标签3</label>
							<div class="col-xs-12 col-sm-2 input-group" >
								<input type="text" name="tag3" class="form-control" value="<?php  echo $settings['tag3'];?>" />
								<span class="help-block">默认为：推荐</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">商品标签4</label>
							<div class="col-xs-12 col-sm-2 input-group" >
								<input type="text" name="tag4" class="form-control" value="<?php  echo $settings['tag4'];?>" />
								<span class="help-block">默认为：优惠</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
			<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
		</div>
	</form>
</div>
<script>
require(['jquery', 'util'], function($, u){
	$(function(){
		u.editor($('.richtext')[0]);
	});
});
$(function () {
		window.optionchanged = false;
		$('#myTab a').click(function (e) {
			e.preventDefault();//阻止a链接的跳转行为
			$(this).tab('show');//显示当前选中的链接及关联的content
		})
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>