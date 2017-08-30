<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?>
<form id="setform"  action="" method="post" class="form-horizontal form" onclick='return formcheck()'>
    <div class='panel panel-default'>
           <div class='panel-heading'>
            积分商城心入口设置
        </div>
        <div class='panel-body'>
           <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">直接链接</label>
                <div class="col-sm-9 col-xs-12">
                    <p class='form-control-static'><a href='javascript:;' title='点击复制连接' id='cp'><?php  echo $this->createPluginMobileUrl('creditshop')?></a></p>
                </div>
            </div>
            
           <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span> 关键词</label>
                <div class="col-sm-9 col-xs-12">
                     <input type='text' class='form-control' name='cover[keyword]' value="<?php  echo $keyword['content'];?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">封面标题</label>
                <div class="col-sm-9 col-xs-12">
                     <input type='text' class='form-control' name='cover[title]' value="<?php  echo $cover['title'];?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">封面图片</label>
                <div class="col-sm-9 col-xs-12">
                     <?php  echo tpl_form_field_image('cover[thumb]',$cover['thumb'])?>
                </div>
            </div>
              <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">封面描述</label>
                <div class="col-sm-9 col-xs-12">
                    <textarea name='cover[desc]' class='form-control'><?php  echo $cover['description'];?></textarea>
                </div>
            </div>
               <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
                <div class="col-sm-9">
                    <label class="radio-inline">
                        <input type="radio" name="cover[status]" value="0" <?php  if(empty($rule['status'])) { ?> checked="checked"<?php  } ?>/>
                               禁用
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="cover[status]" value="1" <?php  if($rule['status']==1) { ?> checked="checked"<?php  } ?>/>
                               启用
                    </label>
                </div>
            </div>
          
         <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
            <div class="col-sm-9">
                <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
                <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
            </div>
        </div>
        </div>
     
    </div>
</form>
<script language='javascript'>
    $(function(){
        $('form').submit(function(){
            if($(':input[name="cover[keyword]"]').isEmpty()){
                Tip.focus($(':input[name="cover[keyword]"]'),'请输入关键词!');
                return false;
            }
            return true;
        })
        
    })
    require(['util'],function(u){
    $('#cp').each(function(){
	u.clip(this, $(this).text());
	}); 
    })
    </script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>