<?php
/*=============================================================================
#     FileName: category.php
#         Desc:  
#       Author: HaiRuan - http://www.iseasoft.cn
#        Email: 45300551@qq.com
#     HomePage: http://www.iseasoft.cn
#      Version: 0.0.1
#   LastChange: 2016-02-05 02:39:24
#      History:
=============================================================================*/
if (!defined('IN_IA')) {
    exit('Access Denied');
}
global $_GPC, $_W;

$shopset   = m('common')->getSysset('shop');
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$children  = array();
$category  = pdo_fetchall("SELECT * FROM " . tablename('sea_brand') . " WHERE uniacid = '{$_W['uniacid']}' ORDER BY  displayorder DESC");

if ($operation == 'display') {
    if (!empty($_GPC['datas'])) {
        $datas = json_decode(html_entity_decode($_GPC['datas']), true);
        if (!is_array($datas)) {
            message('品牌保存失败，请重试!', '', 'error');
        }
        $cateids      = array();
        $displayorder = count($datas);
        foreach ($datas as $row) {
            $cateids[] = $row['id'];
            pdo_update('sea_brand', array(
                'displayorder' => $displayorder
            ), array(
                'id' => $row['id']
            ));
            // if ($row['children'] && is_array($row['children'])) {
                // $displayorder_child = count($row['children']);
                // foreach ($row['children'] as $child) {
                    // $cateids[] = $child['id'];
                    // pdo_query('update ' . tablename('sea_category') . ' set  parentid=:parentid,displayorder=:displayorder,level=2 where id=:id', array(
                        // ':displayorder' => $displayorder_child,
                        // ":parentid" => $row['id'],
                        // ":id" => $child['id']
                    // ));
                    // $displayorder_child--;
                    // if ($child['children'] && is_array($child['children'])) {
                        // $displayorder_third = count($child['children']);
                        // foreach ($child['children'] as $third) {
                            // $cateids[] = $third['id'];
                            // pdo_query('update ' . tablename('sea_category') . ' set  parentid=:parentid,displayorder=:displayorder,level=3 where id=:id', array(
                                // ':displayorder' => $displayorder_third,
                                // ":parentid" => $child['id'],
                                // ":id" => $third['id']
                            // ));
                            // $displayorder_third--;
                        // }
                    // }
                // }
            // }
            $displayorder--;
        }
        // if (!empty($cateids)) {
            // pdo_query('delete from ' . tablename('sea_category') . ' where id not in (' . implode(',', $cateids) . ') and uniacid=:uniacid', array(
                // ':uniacid' => $_W['uniacid']
            // ));
        // }
        plog('shop.brand.edit', '批量修改品牌的层级及排序');
        message('品牌更新成功！', $this->createWebUrl('shop/brand', array(
            'op' => 'display'
        )), 'success');
    }
} elseif ($operation == 'post') {
    $id       = intval($_GPC['id']);
    if (!empty($id)) {
        $item     = pdo_fetch("SELECT * FROM " . tablename('sea_brand') . " WHERE id = '$id' limit 1");
    } 
    if (checksubmit('submit')) {
        if (empty($_GPC['catename'])) {
            message('抱歉，请输入品牌名称！');
        }
        $data = array(
            'uniacid' => $_W['uniacid'],
            'name' => trim($_GPC['catename']),
            'enabled' => intval($_GPC['enabled']),
            'displayorder' => intval($_GPC['displayorder']),
            'isrecommand' => intval($_GPC['isrecommand']),
            'description' => $_GPC['description'],
            'thumb' => save_media($_GPC['thumb']),
            'thumbs' => save_media($_GPC['thumbs'])
        );
        if (!empty($id)) {
            pdo_update('sea_brand', $data, array(
                'id' => $id
            ));
            load()->func('file');
            file_delete($_GPC['thumb_old']);
            plog('shop.brand.edit', "修改品牌 ID: {$id}");
        } else {
            pdo_insert('sea_brand', $data);
            $id = pdo_insertid();
            plog('shop.brand.add', "添加品牌 ID: {$id}");
        }
        message('更新品牌成功！', $this->createWebUrl('shop/brand', array(
            'op' => 'display'
        )), 'success');
    }
} elseif ($operation == 'delete') {
    $id   = intval($_GPC['id']);
    $item = pdo_fetch("SELECT id, name FROM " . tablename('sea_brand') . " WHERE id = '$id'");
    if (empty($item)) {
        message('抱歉，品牌不存在或是已经被删除！', $this->createWebUrl('shop/brand', array(
            'op' => 'display'
        )), 'error');
    }
    pdo_delete('sea_brand', array(
        'id' => $id
    ));
    plog('shop.brand.delete', "删除品牌 ID: {$id} 品牌名称: {$item['name']}");
    message('品牌删除成功！', $this->createWebUrl('shop/brand', array(
        'op' => 'display'
    )), 'success');
}
load()->func('tpl');
include $this->template('web/shop/brand');
