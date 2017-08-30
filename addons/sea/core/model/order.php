<?php

//decode by QQ:45300551 http://www.iseasoft.cn/
if (!defined('IN_IA')) {
    die('Access Denied');
}
class Sz_DYi_Order
{ 
    function getDispatchPrice($weight, $d, $_var_2 = 1)
    {
       
        if (empty($d)) {
            return 0;
        }
        $price = 0;
        if ($_var_2 == 1) {
            $_var_2 = $d['calculatetype'];
        }

        if ($_var_2 == 1) {
            if ($weight <= $d['firstnum']) {
                $price = floatval($d['firstnumprice']);
            } else {
                $price = floatval($d['firstnumprice']); 
                $secondweight = $weight - floatval($d['firstnum']);
                $dsecondweight = floatval($d['secondnum']) <= 0 ? 1 : floatval($d['secondnum']);
                $secondprice = 0;
                if ($secondweight % $dsecondweight == 0) {
                    $secondprice = $secondweight / $dsecondweight * floatval($d['secondnumprice']);
                } else {
                    $secondprice = ((int) ($secondweight / $dsecondweight) + 1) * floatval($d['secondnumprice']);
                }
                $price += $secondprice;
            }

        } else {
            if ($weight <= $d['firstweight']) {
                $price = floatval($d['firstprice']);
            } else {
                $price = floatval($d['firstprice']);
                $secondweight = $weight - floatval($d['firstweight']);
                $dsecondweight = floatval($d['secondweight']) <= 0 ? 1 : floatval($d['secondweight']);
                $secondprice = 0;
                if ($secondweight % $dsecondweight == 0) {
                    $secondprice = $secondweight / $dsecondweight * floatval($d['secondprice']);
                } else {
                    $secondprice = ((int) ($secondweight / $dsecondweight) + 1) * floatval($d['secondprice']);
                }
                $price += $secondprice;
            }
        }
        return $price;
    }
    function getCityDispatchPrice($_var_7, $_var_8, $weight, $d)
    {
        if (is_array($_var_7) && count($_var_7) > 0) {
            foreach ($_var_7 as $_var_9) {
                $_var_10 = explode(';', $_var_9['citys']);
                if (in_array($_var_8, $_var_10) && !empty($_var_10)) {
                    return $this->getDispatchPrice($weight, $_var_9, $d['calculatetype']);
                }
            }
        }
        return $this->getDispatchPrice($weight, $d);
    }
    public function payResult($params)
    {
        global $_W;
        $fee = $params['fee'];
        $data = array('status' => $params['result'] == 'success' ? 1 : 0);
        $ordersn = $params['tid'];
        $order = pdo_fetch('select * from ' . tablename('sea_order') . ' where  ordersn=:ordersn and uniacid=:uniacid limit 1', array(':uniacid' => empty($_W['uniacid'])?$params['uniacid']:$_W['uniacid'], ':ordersn' => $ordersn));
        $_var_16 = pdo_fetch('select * from ' . tablename('core_paylog') . ' where `uniacid`=:uniacid and fee=:fee and `module`=:module and `tid`=:tid limit 1', array(':uniacid' => empty($_W['uniacid'])?$params['uniacid']:$_W['uniacid'], ':module' => 'sea', ':fee' => $fee, ':tid' => $order['ordersn']));
        if (empty($_var_16)) {
            show_json(-1, '订单金额错误, 请重试!');
            die;
        }
        $orderid = $order['id'];
        if ($params['from'] == 'return') {
            $address = false;
            if (empty($order['dispatchtype'])) {
                $address = pdo_fetch('select realname,mobile,address from ' . tablename('sea_member_address') . ' where id=:id limit 1', array(':id' => $order['addressid']));
            }
            $carrier = false;
            if ($order['dispatchtype'] == 1 || $order['isvirtual'] == 1) {
                $carrier = unserialize($order['carrier']);
            }
            if ($params['type'] == 'cash') {
                return array('result' => 'success', 'order' => $order, 'address' => $address, 'carrier' => $carrier);
            } else {
                if ($order['status'] == 0) {
                    $pv = p('virtual');
                    if (!empty($order['virtual']) && $pv) {
                        $pv->pay($order);
                    } else {
                        pdo_update('sea_order', array('status' => 1, 'paytime' => time()), array('id' => $orderid));
                        if ($order['deductcredit2'] > 0) {
                            $shopset = m('common')->getSysset('shop');
                            m('member')->setCredit($order['openid'], 'credit2', -$order['deductcredit2'], array(0, $shopset['name'] . "余额抵扣: {$order['deductcredit2']} 订单号: " . $order['ordersn']));
                        }
                        $this->setStocksAndCredits($orderid, 1);
                        if (p('coupon') && !empty($order['couponid'])) {
                            p('coupon')->backConsumeCoupon($order['id']);
                        }
                        m('notice')->sendOrderMessage($orderid);
                        if (p('commission')) {
                            p('commission')->checkOrderPay($order['id']);
                        }
                    }
                }
                if (p('supplier')) {
                    p('supplier')->order_split($orderid);
                }
                $_var_22 = pdo_fetch('select o.dispatchprice,o.ordersn,o.price,og.optionname as optiontitle,og.optionid,og.total from ' . tablename('sea_order') . ' o left join ' . tablename('sea_order_goods') . 'og on og.orderid = o.id  where o.id = :id and o.uniacid=:uniacid', array(':id' => $orderid, ':uniacid' => $_W['uniacid']));
                $_var_23 = 'SELECT og.goodsid,og.total,g.title,g.thumb,og.price,og.optionname as optiontitle,og.optionid FROM ' . tablename('sea_order_goods') . ' og ' . ' left join ' . tablename('sea_goods') . ' g on og.goodsid = g.id ' . ' where og.orderid=:orderid order by og.id asc';
                $_var_22['goods1'] = set_medias(pdo_fetchall($_var_23, array(':orderid' => $orderid)), 'thumb');
                $_var_22['goodscount'] = count($_var_22['goods1']);
                return array('result' => 'success', 'order' => $order, 'address' => $address, 'carrier' => $carrier, 'virtual' => $order['virtual'], 'goods' => $_var_22);
            }
        }
    }
    function setStocksAndCredits($orderid = '', $type = 0)
    {
        global $_W;
        $order = pdo_fetch('select id,ordersn,price,openid,dispatchtype,addressid,carrier,status from ' . tablename('sea_order') . ' where id=:id limit 1', array(':id' => $orderid));
        $goods = pdo_fetchall('select og.goodsid,og.total,g.totalcnf,og.realprice, g.credit,og.optionid,g.total as goodstotal,og.optionid,g.sales,g.salesreal from ' . tablename('sea_order_goods') . ' og ' . ' left join ' . tablename('sea_goods') . ' g on g.id=og.goodsid ' . ' where og.orderid=:orderid and og.uniacid=:uniacid ', array(':uniacid' => $_W['uniacid'], ':orderid' => $orderid));
        $credits = 0;
        foreach ($goods as $g) {
            $stocktype = 0;
            if ($type == 0) {
                if ($g['totalcnf'] == 0) {
                    $stocktype = -1;
                }
            } else {
                if ($type == 1) {
                    if ($g['totalcnf'] == 1) {
                        $stocktype = -1;
                    }
                } else {
                    if ($type == 2) {
                        if ($order['status'] >= 1) {
                            if ($g['totalcnf'] == 1) {
                                $stocktype = 1;
                            }
                        } else {
                            if ($g['totalcnf'] == 0) {
                                $stocktype = 1;
                            }
                        }
                    }
                }
            }
            if (!empty($stocktype)) {
                if (!empty($g['optionid'])) {
                    $option = m('goods')->getOption($g['goodsid'], $g['optionid']);
                    if (!empty($option) && $option['stock'] != -1) {
                        $stock = -1;
                        if ($stocktype == 1) {
                            $stock = $option['stock'] + $g['total'];
                        } else {
                            if ($stocktype == -1) {
                                $stock = $option['stock'] - $g['total'];
                                $stock <= 0 && ($stock = 0);
                            }
                        }
                        if ($stock != -1) {
                            pdo_update('sea_goods_option', array('stock' => $stock), array('uniacid' => $_W['uniacid'], 'goodsid' => $g['goodsid'], 'id' => $g['optionid']));
                        }
                    }
                }
                if (!empty($g['goodstotal']) && $g['goodstotal'] != -1) {
                    $totalstock = -1;
                    if ($stocktype == 1) {
                        $totalstock = $g['goodstotal'] + $g['total'];
                    } else {
                        if ($stocktype == -1) {
                            $totalstock = $g['goodstotal'] - $g['total'];
                            $totalstock <= 0 && ($totalstock = 0);
                        }
                    }
                    if ($totalstock != -1) {
                        pdo_update('sea_goods', array('total' => $totalstock), array('uniacid' => $_W['uniacid'], 'id' => $g['goodsid']));
                    }
                }
            }
            $_var_32 = trim($g['credit']);
            if (!empty($_var_32)) {
                if (strexists($_var_32, '%')) {
                    $credits += intval(floatval(str_replace('%', '', $_var_32)) / 100 * $g['realprice']);
                } else {
                    $credits += intval($g['credit']) * $g['total'];
                }
            }
            if ($type == 0) {
                pdo_update('sea_goods', array('sales' => $g['sales'] + $g['total']), array('uniacid' => $_W['uniacid'], 'id' => $g['goodsid']));
            } elseif ($type == 1) {
                if ($order['status'] >= 1) {
                    $salesreal = pdo_fetchcolumn('select ifnull(sum(total),0) from ' . tablename('sea_order_goods') . ' og ' . ' left join ' . tablename('sea_order') . ' o on o.id = og.orderid ' . ' where og.goodsid=:goodsid and o.status>=1 and o.uniacid=:uniacid limit 1', array(':goodsid' => $g['goodsid'], ':uniacid' => $_W['uniacid']));
                    pdo_update('sea_goods', array('salesreal' => $salesreal), array('id' => $g['goodsid']));
                }
            }
        }
        if ($credits > 0) {
            $shopset = m('common')->getSysset('shop');
            if ($type == 1) {
                m('member')->setCredit($order['openid'], 'credit1', $credits, array(0, $shopset['name'] . '购物积分 订单号: ' . $order['ordersn']));
            } elseif ($type == 2) {
                if ($order['status'] >= 1) {
                    m('member')->setCredit($order['openid'], 'credit1', -$credits, array(0, $shopset['name'] . '购物取消订单扣除积分 订单号: ' . $order['ordersn']));
                }
            }
        }
    }
    function getDefaultDispatch()
    {
        global $_W;
        $_var_34 = 'select * from ' . tablename('sea_dispatch') . ' where isdefault=1 and uniacid=:uniacid and enabled=1 Limit 1';
        $_var_35 = array(':uniacid' => $_W['uniacid']);
        $_var_36 = pdo_fetch($_var_34, $_var_35);
        return $_var_36;
    }
    function getNewDispatch()
    {
        global $_W;
        $_var_34 = 'select * from ' . tablename('sea_dispatch') . ' where uniacid=:uniacid and enabled=1 order by id desc Limit 1';
        $_var_35 = array(':uniacid' => $_W['uniacid']);
        $_var_36 = pdo_fetch($_var_34, $_var_35);
        return $_var_36;
    }
    function getOneDispatch($_var_37)
    {
        global $_W;
        $_var_34 = 'select * from ' . tablename('sea_dispatch') . ' where id=:id and uniacid=:uniacid and enabled=1 Limit 1';
        $_var_35 = array(':id' => $_var_37, ':uniacid' => $_W['uniacid']);
        $_var_36 = pdo_fetch($_var_34, $_var_35);
        return $_var_36;
    }
}