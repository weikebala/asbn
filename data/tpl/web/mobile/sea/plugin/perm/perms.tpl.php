<?php defined('IN_IA') or exit('Access Denied');?><div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">操作权限</label>
                    <div class="col-sm-9 col-xs-12">
                        <div class='panel panel-default' >
                        <?php  if(is_array($perms)) { foreach($perms as $pk => $pt) { ?>
                           <?php  if($pt['isplugin']==1) { ?>
                              <?php  if(!cp($pk)) { ?>
                                <?php  continue;?>
                              <?php  } ?>
                           <?php  } ?>
                            <div class='panel-heading'>
                                    <label class='checkbox-inline'>
                                      
                                         <input type='checkbox' name='perms[]' value='<?php  echo $pk;?>' class='perm-all' data-group='<?php  echo $pk;?>' 
                                                <?php  if(in_array($pk,$role_perms) || in_array($pk,$user_perms) ) { ?> checked<?php  } ?> 
                                                <?php  if(in_array($pk,$role_perms) && $_GPC['method']=='user') { ?> disabled<?php  } ?> 
                                                /><?php  echo $pt['text'];?> 
                                             
                                     </label>
                            </div>
                            <div class='panel-body perm-group'>
                                 <?php  if(isset($pt['child'])) { ?>
                                     <?php  if(is_array($pt['child'])) { foreach($pt['child'] as $ck => $ct) { ?>  
                                     <span>
                                        <?php  if(is_array($ct)) { foreach($ct as $ctk => $ctt) { ?>
                                      
                                           <?php  if($ctk!='text' && $ctk!='isplugin') { ?>
                                            <label class='checkbox-inline'>
                                                <input type='checkbox' name='perms[]'  value='<?php  echo $pk;?>.<?php  echo $ck;?>.<?php  echo $ctk;?>' class='perm-item' 
                                                       data-group='<?php  echo $pk;?>' data-child='<?php  echo $ck;?>' data-op='<?php  echo $ctk;?>' 
                                                       <?php  if(in_array($pk.".".$ck.".".$ctk,$role_perms) || in_array($pk.".".$ck.".".$ctk,$user_perms) ) { ?> checked<?php  } ?>
                                                       <?php  if(in_array($pk.".".$ck.".".$ctk,$role_perms) && $_GPC['method']=='user') { ?> disabled<?php  } ?>
                                                       /> <?php  echo str_replace("-log", "", $ctt)?>
                                            </label>
                                           <?php  } else { ?>
                                           <label class='checkbox-inline' style='width:100px;'>
                                               <input type='checkbox'  name='perms[]' value='<?php  echo $pk;?>.<?php  echo $ck;?>' class='perm-all-item' 
                                                      data-group='<?php  echo $pk;?>' data-child='<?php  echo $ck;?>' 
                                                      <?php  if(in_array($pk.".".$ck,$role_perms) || in_array($pk.".".$ck,$user_perms)) { ?> checked<?php  } ?>
                                                      <?php  if(in_array($pk.".".$ck,$role_perms) && $_GPC['method']=='user') { ?> disabled<?php  } ?>
                                                      /> <b> <?php  echo str_replace("-log", "", $ctt)?></b>
                                           </label>
                                           <?php  } ?>
                                           
                                        <?php  } } ?>
                                        <br/>
                                      
                                     <?php  } } ?>  
                                     
                                     </span>
                                 <?php  } else { ?>
                                   <span>
                                 <?php  if(is_array($pt)) { foreach($pt as $pk1 => $pt1) { ?>
                                   <?php  if($pk1!='text' && $pk1!='isplugin') { ?>
                                 
                                     <label class='checkbox-inline'>
                                         <input type='checkbox'  name='perms[]'  value='<?php  echo $pk;?>.<?php  echo $pk1;?>' class='perm-item' 
                                                data-group='<?php  echo $pk;?>' data-child='<?php  echo $pk1;?>' 
                                                <?php  if(in_array($pk.".".$pk1,$role_perms) || in_array($pk.".".$pk1,$user_perms)) { ?> checked<?php  } ?>
                                                <?php  if(in_array($pk.".".$ck,$role_perms) && $_GPC['method']=='user') { ?> disabled<?php  } ?>
                                                />  <?php  echo str_replace("-log", "", $pt1)?>
                                     </label>
                                   <?php  } ?>
                                 <?php  } } ?>
                                 </span>
                                 <?php  } ?>
                            </div>
                     
                        <?php  } } ?>   </div>
                    </div>
                </div>
<script language="javascript">
       $(function(){
        $('.perm-all').click(function(){
            var checked = $(this).get(0).checked;
            var group = $(this).data('group');
            $(".perm-item[data-group='" +group + "'],.perm-all-item[data-group='" +group + "']").each(function(){
                $(this).get(0).checked = checked;
            })
        })
        $('.perm-all-item').click(function(){
            var checked = $(this).get(0).checked;
            var group = $(this).data('group');
            var child = $(this).data('child');
            $(".perm-item[data-group='" +group + "'][data-child='" +child + "']").each(function(){
                $(this).get(0).checked = checked;
            })
        });
         $('.perm-item').click(function(){
            var group = $(this).data('group');
            var child = $(this).data('child');
            var check = false;
            $(this).closest('span').find(".perm-item").each(function(){
                if($(this).get(0).checked){
                     check =true;
                     return false;
                }
            });
            var allitem = $(".perm-all-item[data-group=" + group + "][data-child=" + child + "]");
            if( allitem.length==1 ){
                allitem.get(0).checked = check;
            }
           $(".perm-all[data-group=" + group + "]").get(0).checked = check;
            
        });
//        $('.perm-group').find(':checked').click(function(){   
//             $('.perm-group').each(function(){
//                var check = false;
//                $(this).find(":checkbox").each(function(){
//                    if($(this).get(0).checked){
//                         check =true;
//                         return false;
//                    }
//                });
//                $(this).prev().find('.perm-all').get(0).checked = check;
//            })
//        });
       
        
    })
    </script>