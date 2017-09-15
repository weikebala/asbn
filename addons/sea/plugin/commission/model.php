<?php

//decode by QQ:45300551 http://www.iseasoft.cn/
if (!defined('IN_IA')) {
    die('Access Denied');
}
define('TM_COMMISSION_AGENT_NEW', 'commission_agent_new');
define('TM_COMMISSION_ORDER_PAY', 'commission_order_pay');
define('TM_COMMISSION_ORDER_FINISH', 'commission_order_finish');
define('TM_COMMISSION_APPLY', 'commission_apply');
define('TM_COMMISSION_CHECK', 'commission_check');
define('TM_COMMISSION_PAY', 'commission_pay');
define('TM_COMMISSION_UPGRADE', 'commission_upgrade');
define('TM_COMMISSION_BECOME', 'commission_become');
if (!class_exists('CommissionModel')) {
    class CommissionModel extends PluginModel
    {
        public function getSet()
        {
            $_var_0 = parent::getSet();
            $_var_0['texts'] = array('agent' => empty($_var_0['texts']['agent']) ? '加盟商' : $_var_0['texts']['agent'], 'shop' => empty($_var_0['texts']['shop']) ? '小店' : $_var_0['texts']['shop'], 'myshop' => empty($_var_0['texts']['myshop']) ? '我的小店' : $_var_0['texts']['myshop'], 'center' => empty($_var_0['texts']['center']) ? '加盟中心' : $_var_0['texts']['center'], 'become' => empty($_var_0['texts']['become']) ? '成为加盟商' : $_var_0['texts']['become'], 'withdraw' => empty($_var_0['texts']['withdraw']) ? '提现' : $_var_0['texts']['withdraw'], 'commission' => empty($_var_0['texts']['commission']) ? '佣金' : $_var_0['texts']['commission'], 'commission1' => empty($_var_0['texts']['commission1']) ? '加盟佣金' : $_var_0['texts']['commission1'], 'commission_total' => empty($_var_0['texts']['commission_total']) ? '累计佣金' : $_var_0['texts']['commission_total'], 'commission_ok' => empty($_var_0['texts']['commission_ok']) ? '可提现佣金' : $_var_0['texts']['commission_ok'], 'commission_apply' => empty($_var_0['texts']['commission_apply']) ? '已申请佣金' : $_var_0['texts']['commission_apply'], 'commission_check' => empty($_var_0['texts']['commission_check']) ? '待打款佣金' : $_var_0['texts']['commission_check'], 'commission_lock' => empty($_var_0['texts']['commission_lock']) ? '未结算佣金' : $_var_0['texts']['commission_lock'], 'commission_detail' => empty($_var_0['texts']['commission_detail']) ? '佣金明细' : $_var_0['texts']['commission_detail'], 'commission_pay' => empty($_var_0['texts']['commission_pay']) ? '成功提现佣金' : $_var_0['texts']['commission_pay'], 'order' => empty($_var_0['texts']['order']) ? '加盟订单' : $_var_0['texts']['order'], 'myteam' => empty($_var_0['texts']['myteam']) ? '我的团队' : $_var_0['texts']['myteam'], 'c1' => empty($_var_0['texts']['c1']) ? '一级' : $_var_0['texts']['c1'], 'c2' => empty($_var_0['texts']['c2']) ? '二级' : $_var_0['texts']['c2'], 'c3' => empty($_var_0['texts']['c3']) ? '三级' : $_var_0['texts']['c3'], 'mycustomer' => empty($_var_0['texts']['mycustomer']) ? '我的客户' : $_var_0['texts']['mycustomer']);
            return $_var_0;
        }

        /**
         * 计算订单各分销等级分红数据
         * @param int $orderid
         * @param bool $update
         * @return array
         */
        public function calculate($orderid = 0, $update = true)
        {
            global $_W;
            $_var_0 = $this->getSet();
            $_var_3 = $this->getLevels();
            #上一级分销用户id
            $_var_4 = pdo_fetchcolumn('select agentid from ' . tablename('sea_order') . ' where id=:id limit 1', array(':id' => $orderid));
            #订单商品信息
            $goods = pdo_fetchall('select og.id,og.realprice,og.total,g.hascommission,g.nocommission, g.commission1_rate,g.commission1_pay,g.commission2_rate,g.commission2_pay,g.commission3_rate,g.commission3_pay,og.commissions,og.optionid,g.productprice,g.marketprice,g.costprice from ' . tablename('sea_order_goods') . '  og ' . ' left join ' . tablename('sea_goods') . ' g on g.id = og.goodsid' . ' where og.orderid=:orderid and og.uniacid=:uniacid', array(':orderid' => $orderid, ':uniacid' => $_W['uniacid']));
            if ($_var_0['level'] > 0) {
                foreach ($goods as &$cinfo) {
                    #参与分销计算的金额
                    $_var_7 = $this->calculate_method($cinfo);
                    #商品参与分销
                    if (empty($cinfo['nocommission']) && $_var_7 > 0) {
                        #商品有自己的分销计算方式
                        if ($cinfo['hascommission'] == 1) {
                            $cinfo['commission1'] = array('default' => $_var_0['level'] >= 1 ? $cinfo['commission1_rate'] > 0 ? round($cinfo['commission1_rate'] * $_var_7 / 100, 2) . '' : round($cinfo['commission1_pay'] * $cinfo['total'], 2) : 0);
                            $cinfo['commission2'] = array('default' => $_var_0['level'] >= 2 ? $cinfo['commission2_rate'] > 0 ? round($cinfo['commission2_rate'] * $_var_7 / 100, 2) . '' : round($cinfo['commission2_pay'] * $cinfo['total'], 2) : 0);
                            $cinfo['commission3'] = array('default' => $_var_0['level'] >= 3 ? $cinfo['commission3_rate'] > 0 ? round($cinfo['commission3_rate'] * $_var_7 / 100, 2) . '' : round($cinfo['commission3_pay'] * $cinfo['total'], 2) : 0);
                            foreach ($_var_3 as $_var_8) {
                                $cinfo['commission1']['level' . $_var_8['id']] = $cinfo['commission1_rate'] > 0 ? round($cinfo['commission1_rate'] * $_var_7 / 100, 2) . '' : round($cinfo['commission1_pay'] * $cinfo['total'], 2);
                                $cinfo['commission2']['level' . $_var_8['id']] = $cinfo['commission2_rate'] > 0 ? round($cinfo['commission2_rate'] * $_var_7 / 100, 2) . '' : round($cinfo['commission2_pay'] * $cinfo['total'], 2);
                                $cinfo['commission3']['level' . $_var_8['id']] = $cinfo['commission3_rate'] > 0 ? round($cinfo['commission3_rate'] * $_var_7 / 100, 2) . '' : round($cinfo['commission3_pay'] * $cinfo['total'], 2);
                            }
                        } else {#商品没有自己的分销计算方式按后台设置的计算
                            $cinfo['commission1'] = array('default' => $_var_0['level'] >= 1 ? round($_var_0['commission1'] * $_var_7 / 100, 2) . '' : 0);
                            $cinfo['commission2'] = array('default' => $_var_0['level'] >= 2 ? round($_var_0['commission2'] * $_var_7 / 100, 2) . '' : 0);
                            $cinfo['commission3'] = array('default' => $_var_0['level'] >= 3 ? round($_var_0['commission3'] * $_var_7 / 100, 2) . '' : 0);
                            foreach ($_var_3 as $_var_8) {
                                $cinfo['commission1']['level' . $_var_8['id']] = $_var_0['level'] >= 1 ? round($_var_8['commission1'] * $_var_7 / 100, 2) . '' : 0;
                                $cinfo['commission2']['level' . $_var_8['id']] = $_var_0['level'] >= 2 ? round($_var_8['commission2'] * $_var_7 / 100, 2) . '' : 0;
                                $cinfo['commission3']['level' . $_var_8['id']] = $_var_0['level'] >= 3 ? round($_var_8['commission3'] * $_var_7 / 100, 2) . '' : 0;
                            }
                        }
                    } else {#商品不参与分销
                        $cinfo['commission1'] = array('default' => 0);
                        $cinfo['commission2'] = array('default' => 0);
                        $cinfo['commission3'] = array('default' => 0);
                        foreach ($_var_3 as $_var_8) {
                            $cinfo['commission1']['level' . $_var_8['id']] = 0;
                            $cinfo['commission2']['level' . $_var_8['id']] = 0;
                            $cinfo['commission3']['level' . $_var_8['id']] = 0;
                        }
                    }
                    if ($update) {
                        #上级应该分红的钱
                        $_var_9 = array('level1' => 0, 'level2' => 0, 'level3' => 0);
                        if (!empty($_var_4)) {
                            $_var_10 = m('member')->getMember($_var_4);
                            if ($_var_10['isagent'] == 1 && $_var_10['status'] == 1) {
                                #分销商等级
                                $_var_11 = $this->getLevel($_var_10['openid']);
                                $_var_9['level1'] = empty($_var_11) ? round($cinfo['commission1']['default'], 2) : round($cinfo['commission1']['level' . $_var_11['id']], 2);
                                if (!empty($_var_10['agentid'])) {
                                    $_var_12 = m('member')->getMember($_var_10['agentid']);
                                    $_var_13 = $this->getLevel($_var_12['openid']);
                                    $_var_9['level2'] = empty($_var_13) ? round($cinfo['commission2']['default'], 2) : round($cinfo['commission2']['level' . $_var_13['id']], 2);
                                    if (!empty($_var_12['agentid'])) {
                                        $_var_14 = m('member')->getMember($_var_12['agentid']);
                                        $_var_15 = $this->getLevel($_var_14['openid']);
                                        $_var_9['level3'] = empty($_var_15) ? round($cinfo['commission3']['default'], 2) : round($cinfo['commission3']['level' . $_var_15['id']], 2);
                                    }
                                }
                            }
                        }
                        pdo_update('sea_order_goods', array('commission1' => iserializer($cinfo['commission1']), 'commission2' => iserializer($cinfo['commission2']), 'commission3' => iserializer($cinfo['commission3']), 'commissions' => iserializer($_var_9), 'nocommission' => $cinfo['nocommission']), array('id' => $cinfo['id']));
                    }
                }
                unset($cinfo);
            }
            return $goods;
        }
        public function calculate_method($_var_16)
        {
            global $_W;
            $_var_0 = $this->getSet();
            $_var_17 = $_var_16['realprice'];
            if (empty($_var_0['culate_method'])) {
                return $_var_17;
            } else {
                $_var_18 = $_var_16['productprice'] * $_var_16['total'];
                $_var_19 = $_var_16['marketprice'] * $_var_16['total'];
                $_var_20 = $_var_16['costprice'] * $_var_16['total'];
                if ($_var_16['optionid'] != 0) {
                    $_var_21 = pdo_fetch('select productprice,marketprice,costprice from ' . tablename('sea_goods_option') . ' where id=:id and uniacid=:uniacid limit 1', array(':id' => $_var_16['optionid'], ':uniacid' => $_W['uniacid']));
                    $_var_18 = $_var_21['productprice'] * $_var_16['total'];
                    $_var_19 = $_var_21['marketprice'] * $_var_16['total'];
                    $_var_20 = $_var_21['costprice'] * $_var_16['total'];
                }
                if ($_var_0['culate_method'] == 1) {
                    return $_var_18;
                } else {
                    if ($_var_0['culate_method'] == 2) {
                        return $_var_19;
                    } else {
                        if ($_var_0['culate_method'] == 3) {
                            return $_var_20;
                        } else {
                            if ($_var_0['culate_method'] == 4) {
                                $_var_7 = $_var_17 - $_var_20;
                                return $_var_7 > 0 ? $_var_7 : 0;
                            }
                        }
                    }
                }
            }
        }
        public function getOrderCommissions($orderid = 0, $_var_23 = 0)
        {
            global $_W;
            $_var_0 = $this->getSet();
            $_var_24 = pdo_fetchcolumn('select agentid from ' . tablename('sea_order') . ' where id=:id limit 1', array(':id' => $orderid));
            $goods = pdo_fetch('select commission1,commission2,commission3 from ' . tablename('sea_order_goods') . ' where id=:id and orderid=:orderid and uniacid=:uniacid and nocommission=0 limit 1', array(':id' => $_var_23, ':orderid' => $orderid, ':uniacid' => $_W['uniacid']));
            $_var_26 = array('level1' => 0, 'level2' => 0, 'level3' => 0);
            if ($_var_0['level'] > 0) {
                $_var_27 = iunserializer($goods['commission1']);
                $_var_28 = iunserializer($goods['commission2']);
                $_var_29 = iunserializer($goods['commission3']);
                if (!empty($_var_24)) {
                    $_var_30 = m('member')->getMember($_var_24);
                    if ($_var_30['isagent'] == 1 && $_var_30['status'] == 1) {
                        $_var_31 = $this->getLevel($_var_30['openid']);
                        $_var_26['level1'] = empty($_var_31) ? round($_var_27['default'], 2) : round($_var_27['level' . $_var_31['id']], 2);
                        if (!empty($_var_30['agentid'])) {
                            $_var_32 = m('member')->getMember($_var_30['agentid']);
                            $_var_33 = $this->getLevel($_var_32['openid']);
                            $_var_26['level2'] = empty($_var_33) ? round($_var_28['default'], 2) : round($_var_28['level' . $_var_33['id']], 2);
                            if (!empty($_var_32['agentid'])) {
                                $_var_34 = m('member')->getMember($_var_32['agentid']);
                                $_var_35 = $this->getLevel($_var_34['openid']);
                                $_var_26['level3'] = empty($_var_35) ? round($_var_29['default'], 2) : round($_var_29['level' . $_var_35['id']], 2);
                            }
                        }
                    }
                }
            }
            return $_var_26;
        }
        public function getInfo($openid, $options = null)
        {
            if (empty($options) || !is_array($options)) {
                $options = array();
            }
            global $_W;
            $_var_0 = $this->getSet();
            #分销等级 1 2 3
            $_var_38 = intval($_var_0['level']);
            #微信用户
            $_var_39 = m('member')->getMember($openid);
            #微信用户分销等级
            $_var_40 = $this->getLevel($openid);
            #当前时间
            $_var_41 = time();
            #分销体现时间
            $_var_42 = intval($_var_0['settledays']) * 3600 * 24;
            #总的分销商的个数
            $_var_43 = 0;
            #一级订单数量
            $_var_44 = 0;
            #一级订单总金额
            $_var_45 = 0;
            $_var_46 = 0;
            $_var_47 = 0;
            $_var_48 = 0;
            $_var_49 = 0;
            $_var_50 = 0;
            #一级分销得的钱
            $_var_51 = 0;
            $_var_52 = 0;
            $_var_53 = 0;
            $_var_54 = 0;
            $_var_55 = 0;
            $_var_56 = 0;
            $_var_57 = 0;
            $_var_58 = 0;
            #一级订单数量
            $_var_59 = 0;
            $_var_60 = 0;
            $_var_61 = 0;
            $_var_62 = 0;
            $_var_63 = 0;
            $_var_64 = 0;
            $_var_65 = 0;
            $_var_66 = 0;
            $_var_67 = 0;
            $_var_68 = 0;
            $_var_69 = 0;
            $_var_70 = 0;
            $_var_71 = 0;
            $_var_72 = 0;
            $by_var_50=0;
            $by_order_count=0;
            $by_order_money=0;
            if ($_var_38 >= 1) {
                #得到总的分销数据
                if (in_array('ordercount0', $options)) {
                    #获取订单数量 订单总金额
                    $_var_73 = pdo_fetch('select sum(og.realprice) as ordermoney,count(distinct o.id) as ordercount from ' . tablename('sea_order') . ' o ' . ' left join  ' . tablename('sea_order_goods') . ' og on og.orderid=o.id ' . ' where o.agentid=:agentid and o.status>=0 and og.status1>=0 and og.nocommission=0 and o.uniacid=:uniacid  limit 1', array(':uniacid' => $_W['uniacid'], ':agentid' => $_var_39['id']));
                    #订单数量
                    $_var_59 += $_var_73['ordercount'];
                    #订单数量
                    $_var_44 += $_var_73['ordercount'];
                    #订单总金额
                    $_var_45 += $_var_73['ordermoney'];
                }
                if (in_array('ordercount', $options)) {
                    $_var_73 = pdo_fetch('select sum(og.realprice) as ordermoney,count(distinct o.id) as ordercount from ' . tablename('sea_order') . ' o ' . ' left join  ' . tablename('sea_order_goods') . ' og on og.orderid=o.id ' . ' where o.agentid=:agentid and o.status>=1 and og.status1>=0 and og.nocommission=0 and o.uniacid=:uniacid  limit 1', array(':uniacid' => $_W['uniacid'], ':agentid' => $_var_39['id']));
                    $_var_62 += $_var_73['ordercount'];
                    $_var_46 += $_var_73['ordercount'];
                    $_var_47 += $_var_73['ordermoney'];
                    $by_result=pdo_fetch('select sum(og.realprice) as ordermoney,count(distinct o.id) as ordercount from ' . tablename('sea_order') . ' o ' . ' left join  ' . tablename('sea_order_goods') . ' og on og.orderid=o.id ' . ' where o.agentid=:agentid and o.status>=1 and og.status1>=0 and og.nocommission=0 and o.uniacid=:uniacid and FROM_UNIXTIME(paytime,"%Y-%m")="'.date("Y-m").'"  limit 1', array(':uniacid' => $_W['uniacid'], ':agentid' => $_var_39['id']));
                    $by_order_count+=$by_result['ordercount'];
                    $by_order_money+=$by_result['ordermoney'];
                }
                if (in_array('ordercount3', $options)) {
                    $_var_74 = pdo_fetch('select sum(og.realprice) as ordermoney,count(distinct o.id) as ordercount from ' . tablename('sea_order') . ' o ' . ' left join  ' . tablename('sea_order_goods') . ' og on og.orderid=o.id ' . ' where o.agentid=:agentid and o.status>=3 and og.status1>=0 and og.nocommission=0 and o.uniacid=:uniacid  limit 1', array(':uniacid' => $_W['uniacid'], ':agentid' => $_var_39['id']));
                    $_var_65 += $_var_74['ordercount'];
                    $_var_48 += $_var_74['ordercount'];
                    $_var_49 += $_var_74['ordermoney'];
                    $_var_68 += $_var_74['ordermoney'];
                }
                #得到总的数据
                if (in_array('total', $options)) {
                    $_var_75 = pdo_fetchall('select og.commission1,og.commissions  from ' . tablename('sea_order_goods') . ' og ' . ' left join  ' . tablename('sea_order') . ' o on o.id = og.orderid' . ' where o.agentid=:agentid and o.status>=1 and og.nocommission=0 and o.uniacid=:uniacid', array(':uniacid' => $_W['uniacid'], ':agentid' => $_var_39['id']));
                    foreach ($_var_75 as $_var_76) {
                        $_var_26 = iunserializer($_var_76['commissions']);
                        $_var_77 = iunserializer($_var_76['commission1']);
                        if (empty($_var_26)) {
                            $_var_50 += isset($_var_77['level' . $_var_40['id']]) ? $_var_77['level' . $_var_40['id']] : $_var_77['default'];
                        } else {
                            $_var_50 += isset($_var_26['level1']) ? floatval($_var_26['level1']) : 0;
                        }
                    }


                    $by_var_75 = pdo_fetchall('select og.commission3,og.commissions  from ' . tablename('sea_order_goods') . ' og ' . ' left join  ' . tablename('sea_order') . ' o on o.id = og.orderid' . ' where o.agentid=:agentid  and o.status>=1 and og.nocommission=0 and o.uniacid=:uniacid and o.paytime>='.strtotime(date("Y-m")), array(':uniacid' => $_W['uniacid'], ':agentid' => $_var_39['id']));
                    foreach ($by_var_75 as $by_var_76) {
                        $by_var_26 = iunserializer($by_var_76['commissions']);
                        $by_var_77 = iunserializer($by_var_76['commission3']);
                        if (empty($_var_26)) {
                            #这一个月的数据
                            $by_var_50 += isset($by_var_77['level' . $_var_40['id']]) ? $by_var_77['level' . $_var_40['id']] : $by_var_77['default'];
                        } else {
                            $by_var_50 += isset($by_var_26['level3']) ? $by_var_26['level3'] : 0;
                        }
                    }
                }
                #得到可以体现的订单数据
                    if (in_array('ok', $options)) {
                        $_var_75 = pdo_fetchall('select og.commission1,og.commissions  from ' . tablename('sea_order_goods') . ' og ' . ' left join  ' . tablename('sea_order') . ' o on o.id = og.orderid' . " where o.agentid=:agentid and o.status>=3 and og.nocommission=0 and ({$_var_41} - o.createtime > {$_var_42}) and og.status1=0  and o.uniacid=:uniacid", array(':uniacid' => $_W['uniacid'], ':agentid' => $_var_39['id']));
                        foreach ($_var_75 as $_var_76) {
                            #默认分销分成数据
                            $_var_26 = iunserializer($_var_76['commissions']);
                            #一级分销数据
                            $_var_77 = iunserializer($_var_76['commission1']);
                            if (empty($_var_26)) {
                                #一级分销得金额
                                $_var_51 += isset($_var_77['level' . $_var_40['id']]) ? $_var_77['level' . $_var_40['id']] : $_var_77['default'];
                            } else {
                                $_var_51 += isset($_var_26['level1']) ? $_var_26['level1'] : 0;
                            }
                        }
                    }
                if (in_array('lock', $options)) {
                    $_var_78 = pdo_fetchall('select og.commission1,og.commissions  from ' . tablename('sea_order_goods') . ' og ' . ' left join  ' . tablename('sea_order') . ' o on o.id = og.orderid' . " where o.agentid=:agentid and o.status>=3 and og.nocommission=0 and ({$_var_41} - o.createtime <= {$_var_42})  and og.status1=0  and o.uniacid=:uniacid", array(':uniacid' => $_W['uniacid'], ':agentid' => $_var_39['id']));
                    foreach ($_var_78 as $_var_76) {
                        $_var_26 = iunserializer($_var_76['commissions']);
                        $_var_77 = iunserializer($_var_76['commission1']);
                        if (empty($_var_26)) {
                            $_var_54 += isset($_var_77['level' . $_var_40['id']]) ? $_var_77['level' . $_var_40['id']] : $_var_77['default'];
                        } else {
                            $_var_54 += isset($_var_26['level1']) ? $_var_26['level1'] : 0;
                        }
                    }
                }
                if (in_array('apply', $options)) {
                    $_var_79 = pdo_fetchall('select og.commission1,og.commissions  from ' . tablename('sea_order_goods') . ' og ' . ' left join  ' . tablename('sea_order') . ' o on o.id = og.orderid' . ' where o.agentid=:agentid and o.status>=3 and og.status1=1 and og.nocommission=0 and o.uniacid=:uniacid', array(':uniacid' => $_W['uniacid'], ':agentid' => $_var_39['id']));
                    foreach ($_var_79 as $_var_76) {
                        $_var_26 = iunserializer($_var_76['commissions']);
                        $_var_77 = iunserializer($_var_76['commission1']);
                        if (empty($_var_26)) {
                            $_var_52 += isset($_var_77['level' . $_var_40['id']]) ? $_var_77['level' . $_var_40['id']] : $_var_77['default'];
                        } else {
                            $_var_52 += isset($_var_26['level1']) ? $_var_26['level1'] : 0;
                        }
                    }
                }
                if (in_array('check', $options)) {
                    $_var_79 = pdo_fetchall('select og.commission1,og.commissions  from ' . tablename('sea_order_goods') . ' og ' . ' left join  ' . tablename('sea_order') . ' o on o.id = og.orderid' . ' where o.agentid=:agentid and o.status>=3 and og.status1=2 and og.nocommission=0 and o.uniacid=:uniacid ', array(':uniacid' => $_W['uniacid'], ':agentid' => $_var_39['id']));
                    foreach ($_var_79 as $_var_76) {
                        $_var_26 = iunserializer($_var_76['commissions']);
                        $_var_77 = iunserializer($_var_76['commission1']);
                        if (empty($_var_26)) {
                            $_var_53 += isset($_var_77['level' . $_var_40['id']]) ? $_var_77['level' . $_var_40['id']] : $_var_77['default'];
                        } else {
                            $_var_53 += isset($_var_26['level1']) ? $_var_26['level1'] : 0;
                        }
                    }
                }
                if (in_array('pay', $options)) {
                    $_var_79 = pdo_fetchall('select og.commission1,og.commissions  from ' . tablename('sea_order_goods') . ' og ' . ' left join  ' . tablename('sea_order') . ' o on o.id = og.orderid' . ' where o.agentid=:agentid and o.status>=3 and og.status1=3 and og.nocommission=0 and o.uniacid=:uniacid ', array(':uniacid' => $_W['uniacid'], ':agentid' => $_var_39['id']));
                    foreach ($_var_79 as $_var_76) {
                        $_var_26 = iunserializer($_var_76['commissions']);
                        $_var_77 = iunserializer($_var_76['commission1']);
                        if (empty($_var_26)) {
                            $_var_55 += isset($_var_77['level' . $_var_40['id']]) ? $_var_77['level' . $_var_40['id']] : $_var_77['default'];
                        } else {
                            $_var_55 += isset($_var_26['level1']) ? $_var_26['level1'] : 0;
                        }
                    }
                }
                #得到直接下级所有的分销商id数组
                $_var_80 = pdo_fetchall('select id from ' . tablename('sea_member') . ' where agentid=:agentid and isagent=1 and status=1 and uniacid=:uniacid ', array(':uniacid' => $_W['uniacid'], ':agentid' => $_var_39['id']), 'id');
                #直接下级总的分销商的个数
                $_var_56 = count($_var_80);
                $_var_43 += $_var_56;
            }
            if ($_var_38 >= 2) {
                if ($_var_56 > 0) {
                    if (in_array('ordercount0', $options)) {
                        $_var_81 = pdo_fetch('select sum(og.realprice) as ordermoney,count(distinct o.id) as ordercount from ' . tablename('sea_order') . ' o ' . ' left join  ' . tablename('sea_order_goods') . ' og on og.orderid=o.id ' . ' where o.agentid in( ' . implode(',', array_keys($_var_80)) . ')  and o.status>=0 and og.status2>=0 and og.nocommission=0 and o.uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid']));
                        $_var_60 += $_var_81['ordercount'];
                        $_var_44 += $_var_81['ordercount'];
                        $_var_45 += $_var_81['ordermoney'];
                    }
                    if (in_array('ordercount', $options)) {
                        $_var_81 = pdo_fetch('select sum(og.realprice) as ordermoney,count(distinct o.id) as ordercount from ' . tablename('sea_order') . ' o ' . ' left join  ' . tablename('sea_order_goods') . ' og on og.orderid=o.id ' . ' where o.agentid in( ' . implode(',', array_keys($_var_80)) . ')  and o.status>=1 and og.status2>=0 and og.nocommission=0 and o.uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid']));
                        $_var_63 += $_var_81['ordercount'];
                        $_var_46 += $_var_81['ordercount'];
                        $_var_47 += $_var_81['ordermoney'];
                        $by_result=pdo_fetch('select sum(og.realprice) as ordermoney,count(distinct o.id) as ordercount from ' . tablename('sea_order') . ' o ' . ' left join  ' . tablename('sea_order_goods') . ' og on og.orderid=o.id ' . ' where o.agentid in( ' . implode(',', array_keys($_var_80)) . ')  and o.status>=1 and og.status1>=0 and og.nocommission=0 and o.uniacid=:uniacid and o.paytime>='.strtotime(date("Y-m")).'   limit 1', array(':uniacid' => $_W['uniacid']));
                        $by_order_count+=$by_result['ordercount'];
                        $by_order_money+=$by_result['ordermoney'];
                    }
                    if (in_array('ordercount3', $options)) {
                        $_var_82 = pdo_fetch('select sum(og.realprice) as ordermoney,count(distinct o.id) as ordercount from ' . tablename('sea_order') . ' o ' . ' left join  ' . tablename('sea_order_goods') . ' og on og.orderid=o.id ' . ' where o.agentid in( ' . implode(',', array_keys($_var_80)) . ')  and o.status>=3 and og.status2>=0 and og.nocommission=0 and o.uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid']));
                        $_var_66 += $_var_82['ordercount'];
                        $_var_48 += $_var_82['ordercount'];
                        $_var_49 += $_var_82['ordermoney'];
                        $_var_69 += $_var_82['ordermoney'];
                    }
                    if (in_array('total', $options)) {
                        $_var_83 = pdo_fetchall('select og.commission2,og.commissions from ' . tablename('sea_order_goods') . ' og ' . ' left join  ' . tablename('sea_order') . ' o on o.id = og.orderid ' . ' where o.agentid in( ' . implode(',', array_keys($_var_80)) . ')  and o.status>=1 and og.nocommission=0 and o.uniacid=:uniacid', array(':uniacid' => $_W['uniacid']));
                        foreach ($_var_83 as $_var_76) {
                            $_var_26 = iunserializer($_var_76['commissions']);
                            $_var_77 = iunserializer($_var_76['commission2']);
                            if (empty($_var_26)) {
                                $_var_50 += isset($_var_77['level' . $_var_40['id']]) ? $_var_77['level' . $_var_40['id']] : $_var_77['default'];
                            } else {
                                $_var_50 += isset($_var_26['level2']) ? $_var_26['level2'] : 0;
                            }
                        }



                        $by_var_83 = pdo_fetchall('select og.commission3,og.commissions  from ' . tablename('sea_order_goods') . ' og ' . ' left join  ' . tablename('sea_order') . ' o on o.id = og.orderid' . ' where o.agentid in( ' . implode(',', array_keys($_var_80)) . ')  and o.status>=1 and og.nocommission=0 and o.uniacid=:uniacid and o.paytime>='.strtotime(date("Y-m")), array(':uniacid' => $_W['uniacid']));
                        foreach ($by_var_83 as $by_var_76) {
                            $by_var_26 = iunserializer($by_var_76['commissions']);
                            $by_var_77 = iunserializer($by_var_76['commission3']);
                            if (empty($_var_26)) {
                                $by_var_50 += isset($by_var_77['level' . $_var_40['id']]) ? $by_var_77['level' . $_var_40['id']] : $by_var_77['default'];
                            } else {
                                $by_var_50 += isset($by_var_26['level3']) ? $by_var_26['level3'] : 0;
                            }
                        }
                    }
                    if (in_array('ok', $options)) {
                        $_var_83 = pdo_fetchall('select og.commission2,og.commissions  from ' . tablename('sea_order_goods') . ' og ' . ' left join  ' . tablename('sea_order') . ' o on o.id = og.orderid ' . ' where o.agentid in( ' . implode(',', array_keys($_var_80)) . ")  and ({$_var_41} - o.createtime > {$_var_42}) and o.status>=3 and og.status2=0 and og.nocommission=0  and o.uniacid=:uniacid", array(':uniacid' => $_W['uniacid']));
                        foreach ($_var_83 as $_var_76) {
                            $_var_26 = iunserializer($_var_76['commissions']);
                            $_var_77 = iunserializer($_var_76['commission2']);
                            if (empty($_var_26)) {
                                $_var_51 += isset($_var_77['level' . $_var_40['id']]) ? $_var_77['level' . $_var_40['id']] : $_var_77['default'];
                            } else {
                                $_var_51 += isset($_var_26['level2']) ? $_var_26['level2'] : 0;
                            }
                        }
                    }
                    if (in_array('lock', $options)) {
                        $_var_84 = pdo_fetchall('select og.commission2,og.commissions  from ' . tablename('sea_order_goods') . ' og ' . ' left join  ' . tablename('sea_order') . ' o on o.id = og.orderid ' . ' where o.agentid in( ' . implode(',', array_keys($_var_80)) . ")  and ({$_var_41} - o.createtime <= {$_var_42}) and og.status2=0 and o.status>=3 and og.nocommission=0 and o.uniacid=:uniacid", array(':uniacid' => $_W['uniacid']));
                        foreach ($_var_84 as $_var_76) {
                            $_var_26 = iunserializer($_var_76['commissions']);
                            $_var_77 = iunserializer($_var_76['commission2']);
                            if (empty($_var_26)) {
                                $_var_54 += isset($_var_77['level' . $_var_40['id']]) ? $_var_77['level' . $_var_40['id']] : $_var_77['default'];
                            } else {
                                $_var_54 += isset($_var_26['level2']) ? $_var_26['level2'] : 0;
                            }
                        }
                    }
                    if (in_array('apply', $options)) {
                        $_var_85 = pdo_fetchall('select og.commission2,og.commissions  from ' . tablename('sea_order_goods') . ' og ' . ' left join  ' . tablename('sea_order') . ' o on o.id = og.orderid ' . ' where o.agentid in( ' . implode(',', array_keys($_var_80)) . ')  and o.status>=3 and og.status2=1 and og.nocommission=0 and o.uniacid=:uniacid', array(':uniacid' => $_W['uniacid']));
                        foreach ($_var_85 as $_var_76) {
                            $_var_26 = iunserializer($_var_76['commissions']);
                            $_var_77 = iunserializer($_var_76['commission2']);
                            if (empty($_var_26)) {
                                $_var_52 += isset($_var_77['level' . $_var_40['id']]) ? $_var_77['level' . $_var_40['id']] : $_var_77['default'];
                            } else {
                                $_var_52 += isset($_var_26['level2']) ? $_var_26['level2'] : 0;
                            }
                        }
                    }
                    if (in_array('check', $options)) {
                        $_var_86 = pdo_fetchall('select og.commission2,og.commissions  from ' . tablename('sea_order_goods') . ' og ' . ' left join  ' . tablename('sea_order') . ' o on o.id = og.orderid ' . ' where o.agentid in( ' . implode(',', array_keys($_var_80)) . ')  and o.status>=3 and og.status2=2 and og.nocommission=0 and o.uniacid=:uniacid', array(':uniacid' => $_W['uniacid']));
                        foreach ($_var_86 as $_var_76) {
                            $_var_26 = iunserializer($_var_76['commissions']);
                            $_var_77 = iunserializer($_var_76['commission2']);
                            if (empty($_var_26)) {
                                $_var_53 += isset($_var_77['level' . $_var_40['id']]) ? $_var_77['level' . $_var_40['id']] : $_var_77['default'];
                            } else {
                                $_var_53 += isset($_var_26['level2']) ? $_var_26['level2'] : 0;
                            }
                        }
                    }
                    if (in_array('pay', $options)) {
                        $_var_86 = pdo_fetchall('select og.commission2,og.commissions  from ' . tablename('sea_order_goods') . ' og ' . ' left join  ' . tablename('sea_order') . ' o on o.id = og.orderid ' . ' where o.agentid in( ' . implode(',', array_keys($_var_80)) . ')  and o.status>=3 and og.status2=3 and og.nocommission=0 and o.uniacid=:uniacid', array(':uniacid' => $_W['uniacid']));
                        foreach ($_var_86 as $_var_76) {
                            $_var_26 = iunserializer($_var_76['commissions']);
                            $_var_77 = iunserializer($_var_76['commission2']);
                            if (empty($_var_26)) {
                                $_var_55 += isset($_var_77['level' . $_var_40['id']]) ? $_var_77['level' . $_var_40['id']] : $_var_77['default'];
                            } else {
                                $_var_55 += isset($_var_26['level2']) ? $_var_26['level2'] : 0;
                            }
                        }
                    }
                    $_var_87 = pdo_fetchall('select id from ' . tablename('sea_member') . ' where agentid in( ' . implode(',', array_keys($_var_80)) . ') and isagent=1 and status=1 and uniacid=:uniacid', array(':uniacid' => $_W['uniacid']), 'id');
                    $_var_57 = count($_var_87);
                    $_var_43 += $_var_57;
                }
            }
            if ($_var_38 >= 3) {
                if ($_var_57 > 0) {
                    if (in_array('ordercount0', $options)) {
                        $_var_88 = pdo_fetch('select sum(og.realprice) as ordermoney,count(distinct og.orderid) as ordercount from ' . tablename('sea_order') . ' o ' . ' left join  ' . tablename('sea_order_goods') . ' og on og.orderid=o.id ' . ' where o.agentid in( ' . implode(',', array_keys($_var_87)) . ')  and o.status>=0 and og.status3>=0 and og.nocommission=0 and o.uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid']));
                        $_var_61 += $_var_88['ordercount'];
                        $_var_44 += $_var_88['ordercount'];
                        $_var_45 += $_var_88['ordermoney'];
                    }
                    if (in_array('ordercount', $options)) {
                        $_var_88 = pdo_fetch('select sum(og.realprice) as ordermoney,count(distinct og.orderid) as ordercount from ' . tablename('sea_order') . ' o ' . ' left join  ' . tablename('sea_order_goods') . ' og on og.orderid=o.id ' . ' where o.agentid in( ' . implode(',', array_keys($_var_87)) . ')  and o.status>=1 and og.status3>=0 and og.nocommission=0 and o.uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid']));
                        $_var_64 += $_var_88['ordercount'];
                        $_var_46 += $_var_88['ordercount'];
                        $_var_47 += $_var_88['ordermoney'];
                        $by_result=pdo_fetch('select sum(og.realprice) as ordermoney,count(distinct o.id) as ordercount from ' . tablename('sea_order') . ' o ' . ' left join  ' . tablename('sea_order_goods') . ' og on og.orderid=o.id ' . ' where o.agentid in( ' . implode(',', array_keys($_var_87)) . ')  and o.status>=1 and og.status1>=0 and og.nocommission=0 and o.uniacid=:uniacid and o.paytime>='.strtotime(date("Y-m")).'   limit 1', array(':uniacid' => $_W['uniacid']));
                        $by_order_count+=$by_result['ordercount'];
                        $by_order_money+=$by_result['ordermoney'];
                    }
                    if (in_array('ordercount3', $options)) {
                        $_var_89 = pdo_fetch('select sum(og.realprice) as ordermoney,count(distinct og.orderid) as ordercount from ' . tablename('sea_order') . ' o ' . ' left join  ' . tablename('sea_order_goods') . ' og on og.orderid=o.id ' . ' where o.agentid in( ' . implode(',', array_keys($_var_87)) . ')  and o.status>=3 and og.status3>=0 and og.nocommission=0 and o.uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid']));
                        $_var_67 += $_var_89['ordercount'];
                        $_var_48 += $_var_89['ordercount'];
                        $_var_49 += $_var_89['ordermoney'];
                        $_var_70 += $_var_88['ordermoney'];
                    }
                    if (in_array('total', $options)) {
                        $_var_90 = pdo_fetchall('select og.commission3,og.commissions  from ' . tablename('sea_order_goods') . ' og ' . ' left join  ' . tablename('sea_order') . ' o on o.id = og.orderid' . ' where o.agentid in( ' . implode(',', array_keys($_var_87)) . ')  and o.status>=1 and og.nocommission=0 and o.uniacid=:uniacid', array(':uniacid' => $_W['uniacid']));
                        foreach ($_var_90 as $_var_76) {
                            $_var_26 = iunserializer($_var_76['commissions']);
                            $_var_77 = iunserializer($_var_76['commission3']);
                            if (empty($_var_26)) {
                                $_var_50 += isset($_var_77['level' . $_var_40['id']]) ? $_var_77['level' . $_var_40['id']] : $_var_77['default'];
                            } else {
                                $_var_50 += isset($_var_26['level3']) ? $_var_26['level3'] : 0;
                            }
                        }


                        $by_var_90 = pdo_fetchall('select og.commission3,og.commissions  from ' . tablename('sea_order_goods') . ' og ' . ' left join  ' . tablename('sea_order') . ' o on o.id = og.orderid' . ' where o.agentid in( ' . implode(',', array_keys($_var_87)) . ')  and o.status>=1 and og.nocommission=0 and o.uniacid=:uniacid and o.paytime>='.strtotime(date("Y-m")).'', array(':uniacid' => $_W['uniacid']));
                        foreach ($by_var_90 as $by_var_76) {
                            $by_var_26 = iunserializer($by_var_76['commissions']);
                            $by_var_77 = iunserializer($by_var_76['commission3']);
                            if (empty($_var_26)) {
                                $by_var_50 += isset($by_var_77['level' . $_var_40['id']]) ? $by_var_77['level' . $_var_40['id']] : $by_var_77['default'];
                            } else {
                                $by_var_50 += isset($by_var_26['level3']) ? $by_var_26['level3'] : 0;
                            }
                        }
                    }
                    if (in_array('ok', $options)) {
                        $_var_90 = pdo_fetchall('select og.commission3,og.commissions  from ' . tablename('sea_order_goods') . ' og ' . ' left join  ' . tablename('sea_order') . ' o on o.id = og.orderid' . ' where o.agentid in( ' . implode(',', array_keys($_var_87)) . ")  and ({$_var_41} - o.createtime > {$_var_42}) and o.status>=3 and og.status3=0  and og.nocommission=0 and o.uniacid=:uniacid", array(':uniacid' => $_W['uniacid']));
                        foreach ($_var_90 as $_var_76) {
                            $_var_26 = iunserializer($_var_76['commissions']);
                            $_var_77 = iunserializer($_var_76['commission3']);
                            if (empty($_var_26)) {
                                $_var_51 += isset($_var_77['level' . $_var_40['id']]) ? $_var_77['level' . $_var_40['id']] : $_var_77['default'];
                            } else {
                                $_var_51 += isset($_var_26['level3']) ? $_var_26['level3'] : 0;
                            }
                        }
                    }
                    if (in_array('lock', $options)) {
                        $_var_91 = pdo_fetchall('select og.commission3,og.commissions  from ' . tablename('sea_order_goods') . ' og ' . ' left join  ' . tablename('sea_order') . ' o on o.id = og.orderid' . ' where o.agentid in( ' . implode(',', array_keys($_var_87)) . ")  and o.status>=3 and ({$_var_41} - o.createtime > {$_var_42}) and og.status3=0  and og.nocommission=0 and o.uniacid=:uniacid", array(':uniacid' => $_W['uniacid']));
                        foreach ($_var_91 as $_var_76) {
                            $_var_26 = iunserializer($_var_76['commissions']);
                            $_var_77 = iunserializer($_var_76['commission3']);
                            if (empty($_var_26)) {
                                $_var_54 += isset($_var_77['level' . $_var_40['id']]) ? $_var_77['level' . $_var_40['id']] : $_var_77['default'];
                            } else {
                                $_var_54 += isset($_var_26['level3']) ? $_var_26['level3'] : 0;
                            }
                        }
                    }
                    if (in_array('apply', $options)) {
                        $_var_92 = pdo_fetchall('select og.commission3,og.commissions  from ' . tablename('sea_order_goods') . ' og ' . ' left join  ' . tablename('sea_order') . ' o on o.id = og.orderid' . ' where o.agentid in( ' . implode(',', array_keys($_var_87)) . ')  and o.status>=3 and og.status3=1 and og.nocommission=0 and o.uniacid=:uniacid', array(':uniacid' => $_W['uniacid']));
                        foreach ($_var_92 as $_var_76) {
                            $_var_26 = iunserializer($_var_76['commissions']);
                            $_var_77 = iunserializer($_var_76['commission3']);
                            if (empty($_var_26)) {
                                $_var_52 += isset($_var_77['level' . $_var_40['id']]) ? $_var_77['level' . $_var_40['id']] : $_var_77['default'];
                            } else {
                                $_var_52 += isset($_var_26['level3']) ? $_var_26['level3'] : 0;
                            }
                        }
                    }
                    if (in_array('check', $options)) {
                        $_var_93 = pdo_fetchall('select og.commission3,og.commissions  from ' . tablename('sea_order_goods') . ' og ' . ' left join  ' . tablename('sea_order') . ' o on o.id = og.orderid' . ' where o.agentid in( ' . implode(',', array_keys($_var_87)) . ')  and o.status>=3 and og.status3=2 and og.nocommission=0 and o.uniacid=:uniacid', array(':uniacid' => $_W['uniacid']));
                        foreach ($_var_93 as $_var_76) {
                            $_var_26 = iunserializer($_var_76['commissions']);
                            $_var_77 = iunserializer($_var_76['commission3']);
                            if (empty($_var_26)) {
                                $_var_53 += isset($_var_77['level' . $_var_40['id']]) ? $_var_77['level' . $_var_40['id']] : $_var_77['default'];
                            } else {
                                $_var_53 += isset($_var_26['level3']) ? $_var_26['level3'] : 0;
                            }
                        }
                    }
                    if (in_array('pay', $options)) {
                        $_var_93 = pdo_fetchall('select og.commission3,og.commissions  from ' . tablename('sea_order_goods') . ' og ' . ' left join  ' . tablename('sea_order') . ' o on o.id = og.orderid' . ' where o.agentid in( ' . implode(',', array_keys($_var_87)) . ')  and o.status>=3 and og.status3=3 and og.nocommission=0 and o.uniacid=:uniacid', array(':uniacid' => $_W['uniacid']));
                        foreach ($_var_93 as $_var_76) {
                            $_var_26 = iunserializer($_var_76['commissions']);
                            $_var_77 = iunserializer($_var_76['commission3']);
                            if (empty($_var_26)) {
                                $_var_55 += isset($_var_77['level' . $_var_40['id']]) ? $_var_77['level' . $_var_40['id']] : $_var_77['default'];
                            } else {
                                $_var_55 += isset($_var_26['level3']) ? $_var_26['level3'] : 0;
                            }
                        }
                    }
                    $_var_94 = pdo_fetchall('select id from ' . tablename('sea_member') . ' where uniacid=:uniacid and agentid in( ' . implode(',', array_keys($_var_87)) . ') and isagent=1 and status=1', array(':uniacid' => $_W['uniacid']), 'id');
                    $_var_58 = count($_var_94);
                    $_var_43 += $_var_58;
                }
            }
            if (in_array('myorder', $options)) {
                $_var_95 = pdo_fetch('select sum(og.realprice) as ordermoney,count(distinct og.orderid) as ordercount from ' . tablename('sea_order') . ' o ' . ' left join  ' . tablename('sea_order_goods') . ' og on og.orderid=o.id ' . ' where o.openid=:openid and o.status>=3 and o.uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':openid' => $_var_39['openid']));
                $_var_71 = $_var_95['ordermoney'];
                $_var_72 = $_var_95['ordercount'];
            }
            $_var_39['agentcount'] = $_var_43;
            $_var_39['ordercount'] = $_var_46;
            $_var_39['ordermoney'] = $_var_47;
            $_var_39['order1'] = $_var_62;
            $_var_39['order2'] = $_var_63;
            $_var_39['order3'] = $_var_64;
            $_var_39['ordercount3'] = $_var_48;
            $_var_39['ordermoney3'] = $_var_49;
            $_var_39['order13'] = $_var_65;
            $_var_39['order23'] = $_var_66;
            $_var_39['order33'] = $_var_67;
            $_var_39['order13money'] = $_var_68;
            $_var_39['order23money'] = $_var_69;
            $_var_39['order33money'] = $_var_70;
            $_var_39['ordercount0'] = $_var_44;
            $_var_39['ordermoney0'] = $_var_45;
            $_var_39['order10'] = $_var_59;
            $_var_39['order20'] = $_var_60;
            $_var_39['order30'] = $_var_61;
            $_var_39['commission_total'] = round($_var_50, 2);
            $_var_39['by_commission_total']=round($by_var_50,2);
            $_var_39['commission_ok'] = round($_var_51, 2);
            $_var_39['commission_lock'] = round($_var_54, 2);
            $_var_39['commission_apply'] = round($_var_52, 2);
            $_var_39['commission_check'] = round($_var_53, 2);
            $_var_39['commission_pay'] = round($_var_55, 2);
            $_var_39['level1'] = $_var_56;
            $_var_39['level1_agentids'] = $_var_80;
            $_var_39['level2'] = $_var_57;
            $_var_39['level2_agentids'] = $_var_87;
            $_var_39['level3'] = $_var_58;
            $_var_39['level3_agentids'] = $_var_94;
            $_var_39['agenttime'] = date('Y-m-d H:i', $_var_39['agenttime']);
            $_var_39['myoedermoney'] = $_var_71;
            $_var_39['myordercount'] = $_var_72;
            $_var_39['byordercount']=$by_order_count;
            $_var_39['byordermoney']=$by_order_money;
            return $_var_39;
        }
        public function getAgents($orderid = 0)
        {
            global $_W, $_GPC;
            $_var_96 = array();
            $_var_97 = pdo_fetch('select id,agentid,openid from ' . tablename('sea_order') . ' where id=:id and uniacid=:uniacid limit 1', array(':id' => $orderid, ':uniacid' => $_W['uniacid']));
            if (empty($_var_97)) {
                return $_var_96;
            }
            $_var_30 = m('member')->getMember($_var_97['agentid']);
            if (!empty($_var_30) && $_var_30['isagent'] == 1 && $_var_30['status'] == 1) {
                $_var_96[] = $_var_30;
                if (!empty($_var_30['agentid'])) {
                    $_var_32 = m('member')->getMember($_var_30['agentid']);
                    if (!empty($_var_32) && $_var_32['isagent'] == 1 && $_var_32['status'] == 1) {
                        $_var_96[] = $_var_32;
                        if (!empty($_var_32['agentid'])) {
                            $_var_34 = m('member')->getMember($_var_32['agentid']);
                            if (!empty($_var_34) && $_var_34['isagent'] == 1 && $_var_34['status'] == 1) {
                                $_var_96[] = $_var_34;
                            }
                        }
                    }
                }
            }
            return $_var_96;
        }
        public function isAgent($openid)
        {
            if (empty($openid)) {
                return false;
            }
            if (is_array($openid)) {
                return $openid['isagent'] == 1 && $openid['status'] == 1;
            }
            $_var_39 = m('member')->getMember($openid);
            return $_var_39['isagent'] == 1 && $_var_39['status'] == 1;
        }
        public function getCommission($goods)
        {
            global $_W;
            $_var_0 = $this->getSet();
            $_var_77 = 0;
            if ($goods['hascommission'] == 1) {
                $_var_77 = $_var_0['level'] >= 1 ? $goods['commission1_rate'] > 0 ? $goods['commission1_rate'] * $goods['marketprice'] / 100 : $goods['commission1_pay'] : 0;
            } else {
                $openid = m('user')->getOpenid();
                $_var_38 = $this->getLevel($openid);
                if (!empty($_var_38)) {
                    $_var_77 = $_var_0['level'] >= 1 ? round($_var_38['commission1'] * $goods['marketprice'] / 100, 2) : 0;
                } else {
                    $_var_77 = $_var_0['level'] >= 1 ? round($_var_0['commission1'] * $goods['marketprice'] / 100, 2) : 0;
                }
            }
            return $_var_77;
        }
        public function createMyShopQrcode($mid = 0, $posterid = 0)
        {
            global $_W;
            $_var_100 = IA_ROOT . '/addons/sea/data/qrcode/' . $_W['uniacid'];
            if (!is_dir($_var_100)) {
                load()->func('file');
                mkdirs($_var_100);
            }
            $url = $_W['siteroot'] . 'app/index.php?i=' . $_W['uniacid'] . '&c=entry&m=sea&do=plugin&p=commission&method=myshop&mid=' . $mid;
            if (!empty($posterid)) {
                $url .= '&posterid=' . $posterid;
            }
            $_var_102 = 'myshop_' . $posterid . '_' . $mid . '.png';
            $_var_103 = $_var_100 . '/' . $_var_102;
            if (!is_file($_var_103)) {
                require IA_ROOT . '/framework/library/qrcode/phpqrcode.php';
                QRcode::png($url, $_var_103, QR_ECLEVEL_H, 4);
            }
            return $_W['siteroot'] . 'addons/sea/data/qrcode/' . $_W['uniacid'] . '/' . $_var_102;
        }
        private function createImage($url)
        {
            load()->func('communication');
            $_var_104 = ihttp_request($url);
            return imagecreatefromstring($_var_104['content']);
        }
        public function createGoodsImage($goods, $shop_set)
        {
            global $_W, $_GPC;
            $goods = set_medias($goods, 'thumb');
            $openid = m('user')->getOpenid();
            $_var_106 = m('member')->getMember($openid);
            if ($_var_106['isagent'] == 1 && $_var_106['status'] == 1) {
                $_var_107 = $_var_106;
            } else {
                $mid = intval($_GPC['mid']);
                if (!empty($mid)) {
                    $_var_107 = m('member')->getMember($mid);
                }
            }
            $_var_100 = IA_ROOT . '/addons/sea/data/poster/' . $_W['uniacid'] . '/';
            if (!is_dir($_var_100)) {
                load()->func('file');
                mkdirs($_var_100);
            }
            $_var_108 = empty($goods['commission_thumb']) ? $goods['thumb'] : tomedia($goods['commission_thumb']);
            $_var_109 = md5(json_encode(array('id' => $goods['id'], 'marketprice' => $goods['marketprice'], 'productprice' => $goods['productprice'], 'img' => $_var_108, 'openid' => $openid, 'version' => 4)));
            $_var_102 = $_var_109 . '.jpg';
            if (!is_file($_var_100 . $_var_102)) {
                set_time_limit(0);
                $_var_110 = IA_ROOT . '/addons/sea/static/fonts/msyh.ttf';
                $_var_111 = imagecreatetruecolor(640, 1225);
                if (!is_weixin()) {
                    $_var_112 = 196;
                    $_var_113 = imagecreatefromjpeg(IA_ROOT . '/addons/sea/plugin/commission/images/poster_pc.jpg');
                } else {
                    $_var_112 = 50;
                    $_var_113 = imagecreatefromjpeg(IA_ROOT . '/addons/sea/plugin/commission/images/posters.jpg');//sunkang
                }
               // $_var_114 = $_var_107['realname'] ? $_var_107['realname'] : $_var_107['nickname'];
                $_var_114 = $_var_107['nickname'] ? $_var_107['nickname'] : $_var_107['realname'];
                $_var_114 = $_var_114 ? $_var_114 : $_var_107['mobile'];
                imagecopy($_var_111, $_var_113, 0, 0, 0, 0, 640, 1225);
                imagedestroy($_var_113);
                $_var_115 = preg_replace('/\\/0$/i', '/96', $_var_107['avatar']);
                $_var_116 = $this->createImage($_var_115);
                $_var_117 = imagesx($_var_116);
                $_var_118 = imagesy($_var_116);
                imagecopyresized($_var_111, $_var_116, 24, 32, 0, 0, 88, 88, $_var_117, $_var_118);
                imagedestroy($_var_116);
                $_var_119 = $this->createImage($_var_108);
                $_var_117 = imagesx($_var_119);
                $_var_118 = imagesy($_var_119);
                imagecopyresized($_var_111, $_var_119, 0, 160, 0, 0, 640, 640, $_var_117, $_var_118);
                imagedestroy($_var_119);
                $_var_120 = imagecreatetruecolor(640, 127);
                imagealphablending($_var_120, false);
                imagesavealpha($_var_120, true);
                $_var_121 = imagecolorallocatealpha($_var_120, 0, 0, 0, 25);
                imagefill($_var_120, 0, 0, $_var_121);
                imagecopy($_var_111, $_var_120, 0, 678, 0, 0, 640, 127);
                imagedestroy($_var_120);
                $_var_122 = tomedia(m('qrcode')->createGoodsQrcode($_var_107['id'], $goods['id']));
                $_var_123 = $this->createImage($_var_122);
                $_var_117 = imagesx($_var_123);
                $_var_118 = imagesy($_var_123);
               imagecopyresized($_var_111, $_var_123, $_var_112, 835, 0, 0, 250, 250, $_var_117, $_var_118);//sunkang
                imagedestroy($_var_123);
                $_var_124 = imagecolorallocate($_var_111, 0, 3, 51);
                $_var_125 = imagecolorallocate($_var_111, 240, 102, 0);
                $_var_126 = imagecolorallocate($_var_111, 255, 255, 255);
                $_var_127 = imagecolorallocate($_var_111, 255, 255, 0);
                $_var_128 = '我是';
                imagettftext($_var_111, 20, 0, 150, 70, $_var_124, $_var_110, $_var_128);
                imagettftext($_var_111, 20, 0, 210, 70, $_var_125, $_var_110, $_var_114);
                $_var_129 = '我要为';
                imagettftext($_var_111, 20, 0, 150, 105, $_var_124, $_var_110, $_var_129);
                $_var_130 = $shop_set['name'];
                imagettftext($_var_111, 20, 0, 240, 105, $_var_125, $_var_110, $_var_130);
                $_var_131 = imagettfbbox(20, 0, $_var_110, $_var_130);
                $_var_132 = $_var_131[4] - $_var_131[6];
                $_var_133 = '代言';
                imagettftext($_var_111, 20, 0, 240 + $_var_132 + 10, 105, $_var_124, $_var_110, $_var_133);
                $_var_134 = mb_substr($goods['title'], 0, 50, 'utf-8');
                imagettftext($_var_111, 20, 0, 30, 730, $_var_126, $_var_110, $_var_134);
                $_var_135 = '￥' . number_format($goods['marketprice'], 2);
                imagettftext($_var_111, 25, 0, 25, 780, $_var_127, $_var_110, $_var_135);
                $_var_131 = imagettfbbox(26, 0, $_var_110, $_var_135);
                $_var_132 = $_var_131[4] - $_var_131[6];
                if ($goods['productprice'] > 0) {
                    $_var_136 = '￥' . number_format($goods['productprice'], 2);
                    imagettftext($_var_111, 22, 0, 25 + $_var_132 + 10, 780, $_var_126, $_var_110, $_var_136);
                    $_var_137 = 25 + $_var_132 + 10;
                    $_var_131 = imagettfbbox(22, 0, $_var_110, $_var_136);
                    $_var_132 = $_var_131[4] - $_var_131[6];
                    imageline($_var_111, $_var_137, 770, $_var_137 + $_var_132 + 20, 770, $_var_126);
                    imageline($_var_111, $_var_137, 771.5, $_var_137 + $_var_132 + 20, 771, $_var_126);
                }
                imagejpeg($_var_111, $_var_100 . $_var_102);
                imagedestroy($_var_111);
            }
            return $_W['siteroot'] . 'addons/sea/data/poster/' . $_W['uniacid'] . '/' . $_var_102;
        }
        public function createShopImage($shop_set)
        {
            global $_W, $_GPC;
            $shop_set = set_medias($shop_set, 'signimg');
            $_var_100 = IA_ROOT . '/addons/sea/data/poster/' . $_W['uniacid'] . '/';
            if (!is_dir($_var_100)) {
                load()->func('file');
                mkdirs($_var_100);
            }
            $mid = intval($_GPC['mid']);
            $openid = m('user')->getOpenid();
            $_var_106 = m('member')->getMember($openid);
            if ($_var_106['isagent'] == 1 && $_var_106['status'] == 1) {
                $_var_107 = $_var_106;
            } else {
                $mid = intval($_GPC['mid']);
                if (!empty($mid)) {
                    $_var_107 = m('member')->getMember($mid);
                }
            }
            $_var_109 = md5(json_encode(array('openid' => $openid, 'signimg' => $shop_set['signimg'], 'version' => 4)));
            $_var_102 = $_var_109 . '.jpg';
            if (!is_file($_var_100 . $_var_102)) {
                set_time_limit(0);
                @ini_set('memory_limit', '256M');
                $_var_110 = IA_ROOT . '/addons/sea/static/fonts/msyh.ttf';
                $_var_111 = imagecreatetruecolor(640, 880);
                $_var_124 = imagecolorallocate($_var_111, 0, 3, 51);
                $_var_125 = imagecolorallocate($_var_111, 240, 102, 0);
                $_var_126 = imagecolorallocate($_var_111, 255, 255, 255);
                $_var_127 = imagecolorallocate($_var_111, 255, 255, 0);
                if (!is_weixin()) {
                    $_var_113 = imagecreatefromjpeg(IA_ROOT . '/addons/sea/plugin/commission/images/poster_pc.jpg');
                    $_var_112 = 196;
                } else {
                    $_var_113 = imagecreatefromjpeg(IA_ROOT . '/addons/sea/plugin/commission/images/poster.jpg');
                    $_var_112 = 50;
                }
                //$_var_114 = $_var_107['realname'] ? $_var_107['realname'] : $_var_107['nickname'];
                $_var_114 =$_var_107['nickname'] ? $_var_107['nickname'] : $_var_107['realname'];;
                $_var_114 = $_var_114 ? $_var_114 : $_var_107['mobile'];
                imagecopy($_var_111, $_var_113, 0, 0, 0, 0, 640, 880);
                imagedestroy($_var_113);
                $_var_115 = preg_replace('/\\/0$/i', '/96', $_var_107['avatar']);
                $_var_116 = $this->createImage($_var_115);
                $_var_117 = imagesx($_var_116);
                $_var_118 = imagesy($_var_116);
                imagecopyresized($_var_111, $_var_116, 24, 32, 0, 0, 88, 88, $_var_117, $_var_118);
                imagedestroy($_var_116);
                $_var_119 = $this->createImage($shop_set['signimg']);
                $_var_117 = imagesx($_var_119);
                $_var_118 = imagesy($_var_119);
                imagecopyresized($_var_111, $_var_119, 0, 160, 0, 0, 640, 320, $_var_117, $_var_118);
                imagedestroy($_var_119);
                $_var_138 = tomedia($this->createMyShopQrcode($_var_107['id']));
                $_var_123 = $this->createImage($_var_138);
                $_var_117 = imagesx($_var_123);
                $_var_118 = imagesy($_var_123);
                imagecopyresized($_var_111, $_var_123, $_var_112, 495, 0, 0, 250, 250, $_var_117, $_var_118);
                imagedestroy($_var_123);
                $_var_128 = '我是';
                imagettftext($_var_111, 20, 0, 150, 70, $_var_124, $_var_110, $_var_128);
                imagettftext($_var_111, 20, 0, 210, 70, $_var_125, $_var_110, $_var_114);
                $_var_129 = '我要为';
                imagettftext($_var_111, 20, 0, 150, 105, $_var_124, $_var_110, $_var_129);
                $_var_130 = $shop_set['name'];
                imagettftext($_var_111, 20, 0, 240, 105, $_var_125, $_var_110, $_var_130);
                $_var_131 = imagettfbbox(20, 0, $_var_110, $_var_130);
                $_var_132 = $_var_131[4] - $_var_131[6];
                $_var_133 = '代言';
                imagettftext($_var_111, 20, 0, 240 + $_var_132 + 10, 105, $_var_124, $_var_110, $_var_133);
                imagejpeg($_var_111, $_var_100 . $_var_102);
                imagedestroy($_var_111);
            }
            return $_W['siteroot'] . 'addons/sea/data/poster/' . $_W['uniacid'] . '/' . $_var_102;
        }
        public function checkAgent()
        {
            global $_W, $_GPC;
            $_var_0 = $this->getSet();
            if (empty($_var_0['level'])) {
                return;
            }
            $openid = m('user')->getOpenid();
            if (empty($openid)) {
                return;
            }
            $_var_39 = m('member')->getMember($openid);
            if (empty($_var_39)) {
                return;
            }
            #上一级分销者的sea_member数据
            $_var_139 = false;

            $mid = intval($_GPC['mid']);
            if (!empty($mid)) {
                $_var_139 = m('member')->getMember($mid);
            }
            $_var_140 = !empty($_var_139) && $_var_139['isagent'] == 1 && $_var_139['status'] == 1;
            #分销商分享推广次数加一
            if ($_var_140) {
                if ($_var_139['openid'] != $openid) {
                    $_var_141 = pdo_fetchcolumn('select count(*) from ' . tablename('sea_commission_clickcount') . ' where uniacid=:uniacid and openid=:openid and from_openid=:from_openid limit 1', array(':uniacid' => $_W['uniacid'], ':openid' => $openid, ':from_openid' => $_var_139['openid']));
                    if ($_var_141 <= 0) {
                        $_var_142 = array('uniacid' => $_W['uniacid'], 'openid' => $openid, 'from_openid' => $_var_139['openid'], 'clicktime' => time());
                        pdo_insert('sea_commission_clickcount', $_var_142);
                        pdo_update('sea_member', array('clickcount' => $_var_139['clickcount'] + 1), array('uniacid' => $_W['uniacid'], 'id' => $_var_139['id']));
                    }
                }
            }
            #如果当前用户是分销商就不做处理
            if ($_var_39['isagent'] == 1) {
                return;
            }
            #如果推荐者不是分销商，但他是第一个用户就变成分销商
            if ($_var_143 == 0) {
                $_var_144 = pdo_fetchcolumn('select count(*) from ' . tablename('sea_member') . ' where id<:id and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':id' => $_var_39['id']));
                if ($_var_144 <= 0) {
                    pdo_update('sea_member', array('isagent' => 1, 'status' => 1, 'agenttime' => time(), 'agentblack' => 0), array('uniacid' => $_W['uniacid'], 'id' => $_var_39['id']));
                    return;
                }
            }
            $_var_41 = time();
            $_var_145 = intval($_var_0['become_child']);
            #若推荐这是分销商并且当前用户不是分销商是归属分销等级操作
            if ($_var_140 && empty($_var_39['agentid'])) {
                if ($_var_39['id'] != $_var_139['id']) {
                    if (empty($_var_145)) {
                        if (empty($_var_39['fixagentid'])) {
                            pdo_update('sea_member', array('agentid' => $_var_139['id'], 'childtime' => $_var_41), array('uniacid' => $_W['uniacid'], 'id' => $_var_39['id']));
                            #有新的下线时推送微信消息模板消息
                            $this->sendMessage($_var_139['openid'], array('nickname' => $_var_39['nickname'], 'childtime' => $_var_41), TM_COMMISSION_AGENT_NEW);
                            #分销商等级变更
                            $this->upgradeLevelByAgent($_var_139['id']);
                        }
                    } else {
                        #如果成分下级的条件不是点击分享链接者记录邀请者
                        pdo_update('sea_member', array('inviter' => $_var_139['id']), array('uniacid' => $_W['uniacid'], 'id' => $_var_39['id']));
                    }
                }
            }
            $_var_146 = intval($_var_0['become_check']);
            if (empty($_var_0['become'])) {
                if (empty($_var_39['agentblack'])) {
                    pdo_update('sea_member', array('isagent' => 1, 'status' => $_var_146, 'agenttime' => $_var_146 == 1 ? $_var_41 : 0), array('uniacid' => $_W['uniacid'], 'id' => $_var_39['id']));
                    if ($_var_146 == 1) {
                        $this->sendMessage($openid, array('nickname' => $_var_39['nickname'], 'agenttime' => $_var_41), TM_COMMISSION_BECOME);
                        if ($_var_140) {
                            $this->upgradeLevelByAgent($_var_139['id']);
                        }
                    }
                }
            }
        }

        /**
         * 订单分销关系整理，计算分销各等级分销金额数据
         * @param string $orderid
         */
        public function checkOrderConfirm($orderid = '0')
        {
            global $_W, $_GPC;
            if (empty($orderid)) {
                return;
            }
            #分销配置
            $_var_0 = $this->getSet();
            if (empty($_var_0['level'])) {
                return;
            }
            #订单数据
            $_var_147 = pdo_fetch('select id,openid,ordersn,goodsprice,agentid,paytime from ' . tablename('sea_order') . ' where id=:id and status>=0 and uniacid=:uniacid limit 1', array(':id' => $orderid, ':uniacid' => $_W['uniacid']));
            if (empty($_var_147)) {
                return;
            }
            #openid
            $_var_148 = $_var_147['openid'];
            #sea_menber 数据 
            $_var_149 = m('member')->getMember($_var_148);
            if (empty($_var_149)) {
                return;
            }
            #分红插件
            $_var_150 = p('bonus');
            if (!empty($_var_150)) {
                #分红配置
                $_var_151 = $_var_150->getSet();
                if (!empty($_var_151['start'])) {
                    $_var_150->checkOrderConfirm($orderid);
                }
            }
            #成为下线条件  0:点击分享 1首次下单 2首次付款
            $_var_152 = intval($_var_0['become_child']);
            #上一级分销用户数据
            $_var_153 = false;
            if (empty($_var_152)) {
                $_var_153 = m('member')->getMember($_var_149['agentid']);
            } else {
                $_var_153 = m('member')->getMember($_var_149['inviter']);
            }
            #上一级分销用户是否是合法的分销用户
            $_var_154 = !empty($_var_153) && $_var_153['isagent'] == 1 && $_var_153['status'] == 1;
            $_var_155 = time();
            $_var_152 = intval($_var_0['become_child']);
            if ($_var_154) {
                if ($_var_152 == 1) {
                    if (empty($_var_149['agentid']) && $_var_149['id'] != $_var_153['id']) {
                        if (empty($_var_149['fixagentid'])) {
                            $_var_149['agentid'] = $_var_153['id'];
                            pdo_update('sea_member', array('agentid' => $_var_153['id'], 'childtime' => $_var_155), array('uniacid' => $_W['uniacid'], 'id' => $_var_149['id']));
                            $this->sendMessage($_var_153['openid'], array('nickname' => $_var_149['nickname'], 'childtime' => $_var_155), TM_COMMISSION_AGENT_NEW);
                            $this->upgradeLevelByAgent($_var_153['id']);
                        }
                    }
                }
            }
            #订单分销找到上一级
            $_var_4 = $_var_149['agentid'];
            if ($_var_149['isagent'] == 1 && $_var_149['status'] == 1) {
                if (!empty($_var_0['selfbuy'])) {
                    $_var_4 = $_var_149['id'];
                }
            }
            if (!empty($_var_4)) {
                pdo_update('sea_order', array('agentid' => $_var_4), array('id' => $orderid));
            }
            $this->calculate($orderid);
        }
        public function checkOrderPay($orderid = '0')
        {
            global $_W, $_GPC;
            if (empty($orderid)) {
                return;
            }
            $_var_0 = $this->getSet();
            if (empty($_var_0['level'])) {
                return;
            }
            $_var_147 = pdo_fetch('select id,openid,ordersn,goodsprice,agentid,paytime from ' . tablename('sea_order') . ' where id=:id and status>=1 and uniacid=:uniacid limit 1', array(':id' => $orderid, ':uniacid' => $_W['uniacid']));
            if (empty($_var_147)) {
                return;
            }
            $_var_148 = $_var_147['openid'];
            $_var_149 = m('member')->getMember($_var_148);
            if (empty($_var_149)) {
                return;
            }
            $_var_150 = p('bonus');
            if (!empty($_var_150)) {
                $_var_151 = $_var_150->getSet();
                if (!empty($_var_151['start'])) {
                    $_var_150->checkOrderPay($orderid);
                }
            }
            $_var_152 = intval($_var_0['become_child']);
            $_var_153 = false;
            if (empty($_var_152)) {
                $_var_153 = m('member')->getMember($_var_149['agentid']);
            } else {
                $_var_153 = m('member')->getMember($_var_149['inviter']);
            }
            $_var_154 = !empty($_var_153) && $_var_153['isagent'] == 1 && $_var_153['status'] == 1;
            $_var_155 = time();
            $_var_152 = intval($_var_0['become_child']);
            if ($_var_154) {
                if ($_var_152 == 2) {
                    if (empty($_var_149['agentid']) && $_var_149['id'] != $_var_153['id']) {
                        if (empty($_var_149['fixagentid'])) {
                            $_var_149['agentid'] = $_var_153['id'];
                            pdo_update('sea_member', array('agentid' => $_var_153['id'], 'childtime' => $_var_155), array('uniacid' => $_W['uniacid'], 'id' => $_var_149['id']));
                            $this->sendMessage($_var_153['openid'], array('nickname' => $_var_149['nickname'], 'childtime' => $_var_155), TM_COMMISSION_AGENT_NEW);
                            $this->upgradeLevelByAgent($_var_153['id']);
                            if (empty($_var_147['agentid'])) {
                                $_var_147['agentid'] = $_var_153['id'];
                                pdo_update('sea_order', array('agentid' => $_var_153['id']), array('id' => $orderid));
                                $this->calculate($orderid);
                            }
                        }
                    }
                }
            }
            $_var_156 = $_var_149['isagent'] == 1 && $_var_149['status'] == 1;
            if (!$_var_156) {
                if (intval($_var_0['become']) == 4 && !empty($_var_0['become_goodsid'])) {
                    $_var_157 = pdo_fetchall('select goodsid from ' . tablename('sea_order_goods') . ' where orderid=:orderid and uniacid=:uniacid  ', array(':uniacid' => $_W['uniacid'], ':orderid' => $_var_147['id']), 'goodsid');
                    if (in_array($_var_0['become_goodsid'], array_keys($_var_157))) {
                        if (empty($_var_149['agentblack'])) {
                            pdo_update('sea_member', array('status' => 1, 'isagent' => 1, 'agenttime' => $_var_155), array('uniacid' => $_W['uniacid'], 'id' => $_var_149['id']));
                            $this->sendMessage($_var_148, array('nickname' => $_var_149['nickname'], 'agenttime' => $_var_155), TM_COMMISSION_BECOME);
                            if (!empty($_var_153)) {
                                $this->upgradeLevelByAgent($_var_153['id']);
                            }
                        }
                    }
                }
            }
            if (!$_var_156 && empty($_var_0['become_order'])) {
                $_var_155 = time();
                if ($_var_0['become'] == 2 || $_var_0['become'] == 3) {
                    $_var_158 = true;
                    if (!empty($_var_149['agentid'])) {
                        $_var_153 = m('member')->getMember($_var_149['agentid']);
                        if (empty($_var_153) || $_var_153['isagent'] != 1 || $_var_153['status'] != 1) {
                            $_var_158 = false;
                        }
                    }
                    if ($_var_158) {
                        $_var_159 = false;
                        if ($_var_0['become'] == '2') {
                            $_var_160 = pdo_fetchcolumn('select count(*) from ' . tablename('sea_order') . ' where openid=:openid and status>=1 and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':openid' => $_var_148));
                            $_var_159 = $_var_160 >= intval($_var_0['become_ordercount']);
                        } else {
                            if ($_var_0['become'] == '3') {
                                $_var_161 = pdo_fetchcolumn('select sum(og.realprice) from ' . tablename('sea_order_goods') . ' og left join ' . tablename('sea_order') . ' o on og.orderid=o.id  where o.openid=:openid and o.status>=1 and o.uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':openid' => $_var_148));
                                $_var_159 = $_var_161 >= floatval($_var_0['become_moneycount']);
                            }
                        }
                        if ($_var_159) {
                            if (empty($_var_149['agentblack'])) {
                                $_var_162 = intval($_var_0['become_check']);
                                pdo_update('sea_member', array('status' => $_var_162, 'isagent' => 1, 'agenttime' => $_var_155), array('uniacid' => $_W['uniacid'], 'id' => $_var_149['id']));
                                if ($_var_162 == 1) {
                                    $this->sendMessage($_var_148, array('nickname' => $_var_149['nickname'], 'agenttime' => $_var_155), TM_COMMISSION_BECOME);
                                    if ($_var_158) {
                                        $this->upgradeLevelByAgent($_var_153['id']);
                                    }
                                }
                            }
                        }
                    }
                }
            }
            if (!empty($_var_147['agentid'])) {
                $_var_153 = m('member')->getMember($_var_147['agentid']);
                if (!empty($_var_153) && $_var_153['isagent'] == 1 && $_var_153['status'] == 1) {
                    if ($_var_147['agentid'] == $_var_153['id']) {
                        $_var_16 = pdo_fetchall('select g.id,g.title,og.total,og.price,og.realprice, og.optionname as optiontitle,g.noticeopenid,g.noticetype,og.commission1 from ' . tablename('sea_order_goods') . ' og ' . ' left join ' . tablename('sea_goods') . ' g on g.id=og.goodsid ' . ' where og.uniacid=:uniacid and og.orderid=:orderid ', array(':uniacid' => $_W['uniacid'], ':orderid' => $_var_147['id']));
                        $goods = '';
                        $_var_8 = $_var_153['agentlevel'];
                        $_var_163 = 0;
                        $_var_164 = 0;
                        foreach ($_var_16 as $_var_165) {
                            $goods .= '' . $_var_165['title'] . '( ';
                            if (!empty($_var_165['optiontitle'])) {
                                $goods .= ' 规格: ' . $_var_165['optiontitle'];
                            }
                            $goods .= ' 单价: ' . $_var_165['realprice'] / $_var_165['total'] . ' 数量: ' . $_var_165['total'] . ' 总价: ' . $_var_165['realprice'] . '); ';
                            $_var_166 = iunserializer($_var_165['commission1']);
                            $_var_163 += isset($_var_166['level' . $_var_8]) ? $_var_166['level' . $_var_8] : $_var_166['default'];
                            $_var_164 += $_var_165['realprice'];
                        }
                        $this->sendMessage($_var_153['openid'], array('nickname' => $_var_149['nickname'], 'ordersn' => $_var_147['ordersn'], 'price' => $_var_164, 'goods' => $goods, 'commission' => $_var_163, 'paytime' => $_var_147['paytime']), TM_COMMISSION_ORDER_PAY);
                    }
                }
                if (!empty($_var_0['remind_message']) && $_var_0['level'] >= 2) {
                    if (!empty($_var_153['agentid'])) {
                        $_var_153 = m('member')->getMember($_var_153['agentid']);
                        if (!empty($_var_153) && $_var_153['isagent'] == 1 && $_var_153['status'] == 1) {
                            if ($_var_147['agentid'] != $_var_153['id']) {
                                $_var_16 = pdo_fetchall('select g.id,g.title,og.total,og.price,og.realprice, og.optionname as optiontitle,g.noticeopenid,g.noticetype,og.commission2 from ' . tablename('sea_order_goods') . ' og ' . ' left join ' . tablename('sea_goods') . ' g on g.id=og.goodsid ' . ' where og.uniacid=:uniacid and og.orderid=:orderid ', array(':uniacid' => $_W['uniacid'], ':orderid' => $_var_147['id']));
                                $goods = '';
                                $_var_8 = $_var_153['agentlevel'];
                                $_var_163 = 0;
                                $_var_164 = 0;
                                foreach ($_var_16 as $_var_165) {
                                    $goods .= '' . $_var_165['title'] . '( ';
                                    if (!empty($_var_165['optiontitle'])) {
                                        $goods .= ' 规格: ' . $_var_165['optiontitle'];
                                    }
                                    $goods .= ' 单价: ' . $_var_165['realprice'] / $_var_165['total'] . ' 数量: ' . $_var_165['total'] . ' 总价: ' . $_var_165['realprice'] . '); ';
                                    $_var_166 = iunserializer($_var_165['commission2']);
                                    $_var_163 += isset($_var_166['level' . $_var_8]) ? $_var_166['level' . $_var_8] : $_var_166['default'];
                                    $_var_164 += $_var_165['realprice'];
                                }
                                $this->sendMessage($_var_153['openid'], array('nickname' => $_var_149['nickname'], 'ordersn' => $_var_147['ordersn'], 'price' => $_var_164, 'goods' => $goods, 'commission' => $_var_163, 'paytime' => $_var_147['paytime']), TM_COMMISSION_ORDER_PAY);
                            }
                        }
                        if (!empty($_var_153['agentid']) && $_var_0['level'] >= 3) {
                            $_var_153 = m('member')->getMember($_var_153['agentid']);
                            if (!empty($_var_153) && $_var_153['isagent'] == 1 && $_var_153['status'] == 1) {
                                if ($_var_147['agentid'] != $_var_153['id']) {
                                    $_var_16 = pdo_fetchall('select g.id,g.title,og.total,og.price,og.realprice, og.optionname as optiontitle,g.noticeopenid,g.noticetype,og.commission3 from ' . tablename('sea_order_goods') . ' og ' . ' left join ' . tablename('sea_goods') . ' g on g.id=og.goodsid ' . ' where og.uniacid=:uniacid and og.orderid=:orderid ', array(':uniacid' => $_W['uniacid'], ':orderid' => $_var_147['id']));
                                    $goods = '';
                                    $_var_8 = $_var_153['agentlevel'];
                                    $_var_163 = 0;
                                    $_var_164 = 0;
                                    foreach ($_var_16 as $_var_165) {
                                        $goods .= '' . $_var_165['title'] . '( ';
                                        if (!empty($_var_165['optiontitle'])) {
                                            $goods .= ' 规格: ' . $_var_165['optiontitle'];
                                        }
                                        $goods .= ' 单价: ' . $_var_165['realprice'] / $_var_165['total'] . ' 数量: ' . $_var_165['total'] . ' 总价: ' . $_var_165['realprice'] . '); ';
                                        $_var_166 = iunserializer($_var_165['commission3']);
                                        $_var_163 += isset($_var_166['level' . $_var_8]) ? $_var_166['level' . $_var_8] : $_var_166['default'];
                                        $_var_164 += $_var_165['realprice'];
                                    }
                                    $this->sendMessage($_var_153['openid'], array('nickname' => $_var_149['nickname'], 'ordersn' => $_var_147['ordersn'], 'price' => $_var_164, 'goods' => $goods, 'commission' => $_var_163, 'paytime' => $_var_147['paytime']), TM_COMMISSION_ORDER_PAY);
                                }
                            }
                        }
                    }
                }
            }
        }
        #订单确认收货后微信发送分销订单数据信息，以及处理分销商等级升级处理
        public function checkOrderFinish($orderid = '')
        {
            global $_W, $_GPC;
            if (empty($orderid)) {
                return;
            }
            #订单信息
            $_var_147 = pdo_fetch('select id,openid, ordersn,goodsprice,agentid,finishtime from ' . tablename('sea_order') . ' where id=:id and status>=3 and uniacid=:uniacid limit 1', array(':id' => $orderid, ':uniacid' => $_W['uniacid']));
            if (empty($_var_147)) {
                return;
            }
            #分销配置信息
            $_var_0 = $this->getSet();
            if (empty($_var_0['level'])) {
                return;
            }
            #用户openid
            $_var_148 = $_var_147['openid'];
            #用户
            $_var_149 = m('member')->getMember($_var_148);
            if (empty($_var_149)) {
                return;
            }
            $_var_150 = p('bonus');
            if (!empty($_var_150)) {
                $_var_151 = $_var_150->getSet();
                if (!empty($_var_151['start'])) {
                    $_var_150->checkOrderFinish($orderid);
                }
            }
            $_var_155 = time();
            $_var_156 = $_var_149['isagent'] == 1 && $_var_149['status'] == 1;
            #不是分销商并且    消费条件统计的方式为完成后
            if (!$_var_156 && $_var_0['become_order'] == 1) {
                if ($_var_0['become'] == 2 || $_var_0['become'] == 3) {
                    $_var_158 = true;
                    if (!empty($_var_149['agentid'])) {
                        $_var_153 = m('member')->getMember($_var_149['agentid']);
                        if (empty($_var_153) || $_var_153['isagent'] != 1 || $_var_153['status'] != 1) {
                            $_var_158 = false;
                        }
                    }
                    if ($_var_158) {
                        $_var_159 = false;
                        if ($_var_0['become'] == '2') {
                            $_var_160 = pdo_fetchcolumn('select count(*) from ' . tablename('sea_order') . ' where openid=:openid and status>=3 and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':openid' => $_var_148));
                            $_var_159 = $_var_160 >= intval($_var_0['become_ordercount']);
                        } else {
                            if ($_var_0['become'] == '3') {
                                $_var_161 = pdo_fetchcolumn('select sum(goodsprice) from ' . tablename('sea_order') . ' where openid=:openid and status>=3 and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':openid' => $_var_148));
                                $_var_159 = $_var_161 >= floatval($_var_0['become_moneycount']);
                            }
                        }
                        if ($_var_159) {
                            if (empty($_var_149['agentblack'])) {
                                $_var_162 = intval($_var_0['become_check']);
                                pdo_update('sea_member', array('status' => $_var_162, 'isagent' => 1, 'agenttime' => $_var_155), array('uniacid' => $_W['uniacid'], 'id' => $_var_149['id']));
                                if ($_var_162 == 1) {
                                    $this->sendMessage($_var_149['openid'], array('nickname' => $_var_149['nickname'], 'agenttime' => $_var_155), TM_COMMISSION_BECOME);
                                    if ($_var_158) {
                                        $this->upgradeLevelByAgent($_var_153['id']);
                                    }
                                }
                            }
                        }
                    }
                }
            }
            #有上一级
            if (!empty($_var_147['agentid'])) {
                #得到上一级
                $_var_153 = m('member')->getMember($_var_147['agentid']);
                if (!empty($_var_153) && $_var_153['isagent'] == 1 && $_var_153['status'] == 1) {
                    if ($_var_147['agentid'] == $_var_153['id']) {
                        #订单商品
                        $_var_16 = pdo_fetchall('select g.id,g.title,og.total,og.realprice,og.price,og.optionname as optiontitle,g.noticeopenid,g.noticetype,og.commission1 from ' . tablename('sea_order_goods') . ' og ' . ' left join ' . tablename('sea_goods') . ' g on g.id=og.goodsid ' . ' where og.uniacid=:uniacid and og.orderid=:orderid ', array(':uniacid' => $_W['uniacid'], ':orderid' => $_var_147['id']));
                        $goods = '';
                        #上一级分销商的分销等级
                        $_var_8 = $_var_153['agentlevel'];
                        #一级分销得的钱
                        $_var_163 = 0;
                        #商品总金额
                        $_var_164 = 0;
                        foreach ($_var_16 as $_var_165) {
                            $goods .= '' . $_var_165['title'] . '( ';
                            if (!empty($_var_165['optiontitle'])) {
                                $goods .= ' 规格: ' . $_var_165['optiontitle'];
                            }
                            $goods .= ' 单价: ' . $_var_165['realprice'] / $_var_165['total'] . ' 数量: ' . $_var_165['total'] . ' 总价: ' . $_var_165['realprice'] . '); ';
                            $_var_166 = iunserializer($_var_165['commission1']);
                            $_var_163 += isset($_var_166['level' . $_var_8]) ? $_var_166['level' . $_var_8] : $_var_166['default'];
                            $_var_164 += $_var_165['realprice'];
                        }
                        $this->sendMessage($_var_153['openid'], array('nickname' => $_var_149['nickname'], 'ordersn' => $_var_147['ordersn'], 'price' => $_var_164, 'goods' => $goods, 'commission' => $_var_163, 'finishtime' => $_var_147['finishtime']), TM_COMMISSION_ORDER_FINISH);
                    }
                }
                if (!empty($_var_0['remind_message']) && $_var_0['level'] >= 2) {
                    if (!empty($_var_153['agentid'])) {
                        $_var_153 = m('member')->getMember($_var_153['agentid']);
                        if (!empty($_var_153) && $_var_153['isagent'] == 1 && $_var_153['status'] == 1) {
                            if ($_var_147['agentid'] != $_var_153['id']) {
                                $_var_16 = pdo_fetchall('select g.id,g.title,og.total,og.realprice,og.price,og.optionname as optiontitle,g.noticeopenid,g.noticetype,og.commission2 from ' . tablename('sea_order_goods') . ' og ' . ' left join ' . tablename('sea_goods') . ' g on g.id=og.goodsid ' . ' where og.uniacid=:uniacid and og.orderid=:orderid ', array(':uniacid' => $_W['uniacid'], ':orderid' => $_var_147['id']));
                                $goods = '';
                                $_var_8 = $_var_153['agentlevel'];
                                $_var_163 = 0;
                                $_var_164 = 0;
                                foreach ($_var_16 as $_var_165) {
                                    $goods .= '' . $_var_165['title'] . '( ';
                                    if (!empty($_var_165['optiontitle'])) {
                                        $goods .= ' 规格: ' . $_var_165['optiontitle'];
                                    }
                                    $goods .= ' 单价: ' . $_var_165['realprice'] / $_var_165['total'] . ' 数量: ' . $_var_165['total'] . ' 总价: ' . $_var_165['realprice'] . '); ';
                                    $_var_166 = iunserializer($_var_165['commission2']);
                                    $_var_163 += isset($_var_166['level' . $_var_8]) ? $_var_166['level' . $_var_8] : $_var_166['default'];
                                    $_var_164 += $_var_165['realprice'];
                                }
                                $this->sendMessage($_var_153['openid'], array('nickname' => $_var_149['nickname'], 'ordersn' => $_var_147['ordersn'], 'price' => $_var_164, 'goods' => $goods, 'commission' => $_var_163, 'finishtime' => $_var_147['finishtime']), TM_COMMISSION_ORDER_FINISH);
                            }
                        }
                        if (!empty($_var_153['agentid']) && $_var_0['level'] >= 3) {
                            $_var_153 = m('member')->getMember($_var_153['agentid']);
                            if (!empty($_var_153) && $_var_153['isagent'] == 1 && $_var_153['status'] == 1) {
                                if ($_var_147['agentid'] != $_var_153['id']) {
                                    $_var_16 = pdo_fetchall('select g.id,g.title,og.total,og.realprice,og.price,og.optionname as optiontitle,g.noticeopenid,g.noticetype,og.commission3 from ' . tablename('sea_order_goods') . ' og ' . ' left join ' . tablename('sea_goods') . ' g on g.id=og.goodsid ' . ' where og.uniacid=:uniacid and og.orderid=:orderid ', array(':uniacid' => $_W['uniacid'], ':orderid' => $_var_147['id']));
                                    $goods = '';
                                    $_var_8 = $_var_153['agentlevel'];
                                    $_var_163 = 0;
                                    $_var_164 = 0;
                                    foreach ($_var_16 as $_var_165) {
                                        $goods .= '' . $_var_165['title'] . '( ';
                                        if (!empty($_var_165['optiontitle'])) {
                                            $goods .= ' 规格: ' . $_var_165['optiontitle'];
                                        }
                                        $goods .= ' 单价: ' . $_var_165['realprice'] / $_var_165['total'] . ' 数量: ' . $_var_165['total'] . ' 总价: ' . $_var_165['realprice'] . '); ';
                                        $_var_166 = iunserializer($_var_165['commission3']);
                                        $_var_163 += isset($_var_166['level' . $_var_8]) ? $_var_166['level' . $_var_8] : $_var_166['default'];
                                        $_var_164 += $_var_165['realprice'];
                                    }
                                    $this->sendMessage($_var_153['openid'], array('nickname' => $_var_149['nickname'], 'ordersn' => $_var_147['ordersn'], 'price' => $_var_164, 'goods' => $goods, 'commission' => $_var_163, 'finishtime' => $_var_147['finishtime']), TM_COMMISSION_ORDER_FINISH);
                                }
                            }
                        }
                    }
                }
            }
            $this->upgradeLevelByOrder($_var_148);
            $this->upgradeLevelByGood($orderid);
        }
        function getShop($m)
        {
            global $_W;
            $_var_39 = m('member')->getMember($m);
            $_var_168 = pdo_fetch('select * from ' . tablename('sea_commission_shop') . ' where uniacid=:uniacid and mid=:mid limit 1', array(':uniacid' => $_W['uniacid'], ':mid' => $_var_39['id']));
            $_var_169 = m('common')->getSysset(array('shop', 'share'));
            $_var_0 = $_var_169['shop'];
            $_var_170 = $_var_169['share'];
            $_var_171 = $_var_170['desc'];
            if (empty($_var_171)) {
                $_var_171 = $_var_0['description'];
            }
            if (empty($_var_171)) {
                $_var_171 = $_var_0['name'];
            }
            $_var_172 = $this->getSet();
            if (empty($_var_168)) {
                $_var_168 = array('name' => $_var_39['nickname'] . '的' . $_var_172['texts']['shop'], 'logo' => $_var_39['avatar'], 'desc' => $_var_171, 'img' => tomedia($_var_0['img']));
            } else {
                if (empty($_var_168['name'])) {
                    $_var_168['name'] = $_var_39['nickname'] . '的' . $_var_172['texts']['shop'];
                }
                if (empty($_var_168['logo'])) {
                    $_var_168['logo'] = tomedia($_var_39['avatar']);
                }
                if (empty($_var_168['img'])) {
                    $_var_168['img'] = tomedia($_var_0['img']);
                }
                if (empty($_var_168['desc'])) {
                    $_var_168['desc'] = $_var_171;
                }
            }
            return $_var_168;
        }
        function getLevels($all = true)
        {
            global $_W;
            if ($all) {
                return pdo_fetchall('select * from ' . tablename('sea_commission_level') . ' where uniacid=:uniacid order by commission1 asc', array(':uniacid' => $_W['uniacid']));
            } else {
                return pdo_fetchall('select * from ' . tablename('sea_commission_level') . ' where uniacid=:uniacid and (ordermoney>0 or commissionmoney>0) order by commission1 asc', array(':uniacid' => $_W['uniacid']));
            }
        }
        function getLevel($openid)
        {
            global $_W;
            if (empty($openid)) {
                return false;
            }
            $_var_39 = m('member')->getMember($openid);
            if (empty($_var_39['agentlevel'])) {
                return false;
            }
            $_var_38 = pdo_fetch('select * from ' . tablename('sea_commission_level') . ' where uniacid=:uniacid and id=:id limit 1', array(':uniacid' => $_W['uniacid'], ':id' => $_var_39['agentlevel']));
            return $_var_38;
        }
        function upgradeLevelByOrder($openid)
        {
            global $_W;
            if (empty($openid)) {
                return false;
            }
            $_var_0 = $this->getSet();
            if (empty($_var_0['level'])) {
                return false;
            }
            $m = m('member')->getMember($openid);
            if (empty($m)) {
                return;
            }
            $_var_150 = p('bonus');
            if (!empty($_var_150)) {
                $_var_151 = $_var_150->getSet();
                if (!empty($_var_151['start'])) {
                    $_var_150->upgradeLevelByAgent($openid);
                }
            }
            #加盟商等级升级依据
            $_var_174 = intval($_var_0['leveltype']);
            if ($_var_174 == 4 || $_var_174 == 5) {
                if (!empty($m['agentnotupgrade'])) {
                    return;
                }
                $_var_175 = $this->getLevel($m['openid']);
                if (empty($_var_175['id'])) {
                    $_var_175 = array('levelname' => empty($_var_0['levelname']) ? '普通等级' : $_var_0['levelname'], 'commission1' => $_var_0['commission1'], 'commission2' => $_var_0['commission2'], 'commission3' => $_var_0['commission3']);
                }
                $_var_176 = pdo_fetch('select sum(og.realprice) as ordermoney,count(distinct og.orderid) as ordercount from ' . tablename('sea_order') . ' o ' . ' left join  ' . tablename('sea_order_goods') . ' og on og.orderid=o.id ' . ' where o.openid=:openid and o.status>=3 and o.uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':openid' => $openid));
                $_var_47 = $_var_176['ordermoney'];
                $_var_46 = $_var_176['ordercount'];
                if ($_var_174 == 4) {
                    $_var_177 = pdo_fetch('select * from ' . tablename('sea_commission_level') . " where uniacid=:uniacid  and {$_var_47} >= ordermoney and ordermoney>0  order by ordermoney desc limit 1", array(':uniacid' => $_W['uniacid']));
                    if (empty($_var_177)) {
                        return;
                    }
                    if (!empty($_var_175['id'])) {
                        if ($_var_175['id'] == $_var_177['id']) {
                            return;
                        }
                        if ($_var_175['ordermoney'] > $_var_177['ordermoney']) {
                            return;
                        }
                    }
                } else {
                    if ($_var_174 == 5) {
                        $_var_177 = pdo_fetch('select * from ' . tablename('sea_commission_level') . " where uniacid=:uniacid  and {$_var_46} >= ordercount and ordercount>0  order by ordercount desc limit 1", array(':uniacid' => $_W['uniacid']));
                        if (empty($_var_177)) {
                            return;
                        }
                        if (!empty($_var_175['id'])) {
                            if ($_var_175['id'] == $_var_177['id']) {
                                return;
                            }
                            if ($_var_175['ordercount'] > $_var_177['ordercount']) {
                                return;
                            }
                        }
                    }
                }
                pdo_update('sea_member', array('agentlevel' => $_var_177['id']), array('id' => $m['id']));
                $this->sendMessage($m['openid'], array('nickname' => $m['nickname'], 'oldlevel' => $_var_175, 'newlevel' => $_var_177), TM_COMMISSION_UPGRADE);
            } else {
                if ($_var_174 >= 0 && $_var_174 <= 3) {
                    $_var_96 = array();
                    if (!empty($_var_0['selfbuy'])) {
                        $_var_96[] = $m;
                    }
                    if (!empty($m['agentid'])) {
                        $_var_30 = m('member')->getMember($m['agentid']);
                        if (!empty($_var_30)) {
                            $_var_96[] = $_var_30;
                            if (!empty($_var_30['agentid']) && $_var_30['isagent'] == 1 && $_var_30['status'] == 1) {
                                $_var_32 = m('member')->getMember($_var_30['agentid']);
                                if (!empty($_var_32) && $_var_32['isagent'] == 1 && $_var_32['status'] == 1) {
                                    $_var_96[] = $_var_32;
                                    if (empty($_var_0['selfbuy'])) {
                                        if (!empty($_var_32['agentid']) && $_var_32['isagent'] == 1 && $_var_32['status'] == 1) {
                                            $_var_34 = m('member')->getMember($_var_32['agentid']);
                                            if (!empty($_var_34) && $_var_34['isagent'] == 1 && $_var_34['status'] == 1) {
                                                $_var_96[] = $_var_34;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    if (empty($_var_96)) {
                        return;
                    }
                    foreach ($_var_96 as $_var_178) {
                        $_var_179 = $this->getInfo($_var_178['id'], array('ordercount3', 'ordermoney3', 'order13money', 'order13'));
                        if (!empty($_var_179['agentnotupgrade'])) {
                            continue;
                        }
                        $_var_175 = $this->getLevel($_var_178['openid']);
                        if (empty($_var_175['id'])) {
                            $_var_175 = array('levelname' => empty($_var_0['levelname']) ? '普通等级' : $_var_0['levelname'], 'commission1' => $_var_0['commission1'], 'commission2' => $_var_0['commission2'], 'commission3' => $_var_0['commission3']);
                        }
                        if ($_var_174 == 0) {
                            $_var_47 = $_var_179['ordermoney3'];
                            $_var_177 = pdo_fetch('select * from ' . tablename('sea_commission_level') . " where uniacid=:uniacid and {$_var_47} >= ordermoney and ordermoney>0  order by ordermoney desc limit 1", array(':uniacid' => $_W['uniacid']));
                            if (empty($_var_177)) {
                                continue;
                            }
                            if (!empty($_var_175['id'])) {
                                if ($_var_175['id'] == $_var_177['id']) {
                                    continue;
                                }
                                if ($_var_175['ordermoney'] > $_var_177['ordermoney']) {
                                    continue;
                                }
                            }
                        } else {
                            if ($_var_174 == 1) {
                                $_var_47 = $_var_179['order13money'];
                                $_var_177 = pdo_fetch('select * from ' . tablename('sea_commission_level') . " where uniacid=:uniacid and {$_var_47} >= ordermoney and ordermoney>0  order by ordermoney desc limit 1", array(':uniacid' => $_W['uniacid']));
                                if (empty($_var_177)) {
                                    continue;
                                }
                                if (!empty($_var_175['id'])) {
                                    if ($_var_175['id'] == $_var_177['id']) {
                                        continue;
                                    }
                                    if ($_var_175['ordermoney'] > $_var_177['ordermoney']) {
                                        continue;
                                    }
                                }
                            } else {
                                if ($_var_174 == 2) {
                                    $_var_46 = $_var_179['ordercount3'];
                                    $_var_177 = pdo_fetch('select * from ' . tablename('sea_commission_level') . " where uniacid=:uniacid  and {$_var_46} >= ordercount and ordercount>0  order by ordercount desc limit 1", array(':uniacid' => $_W['uniacid']));
                                    if (empty($_var_177)) {
                                        continue;
                                    }
                                    if (!empty($_var_175['id'])) {
                                        if ($_var_175['id'] == $_var_177['id']) {
                                            continue;
                                        }
                                        if ($_var_175['ordercount'] > $_var_177['ordercount']) {
                                            continue;
                                        }
                                    }
                                } else {
                                    if ($_var_174 == 3) {
                                        $_var_46 = $_var_179['order13'];
                                        $_var_177 = pdo_fetch('select * from ' . tablename('sea_commission_level') . " where uniacid=:uniacid  and {$_var_46} >= ordercount and ordercount>0  order by ordercount desc limit 1", array(':uniacid' => $_W['uniacid']));
                                        if (empty($_var_177)) {
                                            continue;
                                        }
                                        if (!empty($_var_175['id'])) {
                                            if ($_var_175['id'] == $_var_177['id']) {
                                                continue;
                                            }
                                            if ($_var_175['ordercount'] > $_var_177['ordercount']) {
                                                continue;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        pdo_update('sea_member', array('agentlevel' => $_var_177['id']), array('id' => $_var_178['id']));
                        $this->sendMessage($_var_178['openid'], array('nickname' => $_var_178['nickname'], 'oldlevel' => $_var_175, 'newlevel' => $_var_177), TM_COMMISSION_UPGRADE);
                    }
                }
            }
        }
        function upgradeLevelByAgent($openid)
        {
            global $_W;
            if (empty($openid)) {
                return false;
            }
            $_var_0 = $this->getSet();
            if (empty($_var_0['level'])) {
                return false;
            }
            $m = m('member')->getMember($openid);
            if (empty($m)) {
                return;
            }
            $_var_150 = p('bonus');
            if (!empty($_var_150)) {
                $_var_151 = $_var_150->getSet();
                if (!empty($_var_151['start'])) {
                    $_var_150->upgradeLevelByAgent($openid);
                }
            }
            $_var_174 = intval($_var_0['leveltype']);
            if ($_var_174 < 6 || $_var_174 > 9) {
                return;
            }
            $_var_179 = $this->getInfo($m['id'], array());
            if ($_var_174 == 6 || $_var_174 == 8) {
                $_var_96 = array($m);
                if (!empty($m['agentid'])) {
                    $_var_30 = m('member')->getMember($m['agentid']);
                    if (!empty($_var_30)) {
                        $_var_96[] = $_var_30;
                        if (!empty($_var_30['agentid']) && $_var_30['isagent'] == 1 && $_var_30['status'] == 1) {
                            $_var_32 = m('member')->getMember($_var_30['agentid']);
                            if (!empty($_var_32) && $_var_32['isagent'] == 1 && $_var_32['status'] == 1) {
                                $_var_96[] = $_var_32;
                            }
                        }
                    }
                }
                if (empty($_var_96)) {
                    return;
                }
                foreach ($_var_96 as $_var_178) {
                    $_var_179 = $this->getInfo($_var_178['id'], array());
                    if (!empty($_var_179['agentnotupgrade'])) {
                        continue;
                    }
                    $_var_175 = $this->getLevel($_var_178['openid']);
                    if (empty($_var_175['id'])) {
                        $_var_175 = array('levelname' => empty($_var_0['levelname']) ? '普通等级' : $_var_0['levelname'], 'commission1' => $_var_0['commission1'], 'commission2' => $_var_0['commission2'], 'commission3' => $_var_0['commission3']);
                    }
                    if ($_var_174 == 6) {
                        $_var_180 = pdo_fetchall('select id from ' . tablename('sea_member') . ' where agentid=:agentid and uniacid=:uniacid ', array(':agentid' => $m['id'], ':uniacid' => $_W['uniacid']), 'id');
                        $_var_181 += count($_var_180);
                        if (!empty($_var_180)) {
                            $_var_182 = pdo_fetchall('select id from ' . tablename('sea_member') . ' where agentid in( ' . implode(',', array_keys($_var_180)) . ') and uniacid=:uniacid', array(':uniacid' => $_W['uniacid']), 'id');
                            $_var_181 += count($_var_182);
                            if (!empty($_var_182)) {
                                $_var_183 = pdo_fetchall('select id from ' . tablename('sea_member') . ' where agentid in( ' . implode(',', array_keys($_var_182)) . ') and uniacid=:uniacid', array(':uniacid' => $_W['uniacid']), 'id');
                                $_var_181 += count($_var_183);
                            }
                        }
                        $_var_177 = pdo_fetch('select * from ' . tablename('sea_commission_level') . " where uniacid=:uniacid  and {$_var_181} >= downcount and downcount>0  order by downcount desc limit 1", array(':uniacid' => $_W['uniacid']));
                    } else {
                        if ($_var_174 == 8) {
                            $_var_181 = $_var_179['level1'] + $_var_179['level2'] + $_var_179['level3'];
                            $_var_177 = pdo_fetch('select * from ' . tablename('sea_commission_level') . " where uniacid=:uniacid  and {$_var_181} >= downcount and downcount>0  order by downcount desc limit 1", array(':uniacid' => $_W['uniacid']));
                        }
                    }
                    if (empty($_var_177)) {
                        continue;
                    }
                    if ($_var_177['id'] == $_var_175['id']) {
                        continue;
                    }
                    if (!empty($_var_175['id'])) {
                        if ($_var_175['downcount'] > $_var_177['downcount']) {
                            continue;
                        }
                    }
                    pdo_update('sea_member', array('agentlevel' => $_var_177['id']), array('id' => $_var_178['id']));
                    $this->sendMessage($_var_178['openid'], array('nickname' => $_var_178['nickname'], 'oldlevel' => $_var_175, 'newlevel' => $_var_177), TM_COMMISSION_UPGRADE);
                }
            } else {
                if (!empty($m['agentnotupgrade'])) {
                    return;
                }
                $_var_175 = $this->getLevel($m['openid']);
                if (empty($_var_175['id'])) {
                    $_var_175 = array('levelname' => empty($_var_0['levelname']) ? '普通等级' : $_var_0['levelname'], 'commission1' => $_var_0['commission1'], 'commission2' => $_var_0['commission2'], 'commission3' => $_var_0['commission3']);
                }
                if ($_var_174 == 7) {
                    $_var_181 = pdo_fetchcolumn('select count(*) from ' . tablename('sea_member') . ' where agentid=:agentid and uniacid=:uniacid ', array(':agentid' => $m['id'], ':uniacid' => $_W['uniacid']));
                    $_var_177 = pdo_fetch('select * from ' . tablename('sea_commission_level') . " where uniacid=:uniacid  and {$_var_181} >= downcount and downcount>0  order by downcount desc limit 1", array(':uniacid' => $_W['uniacid']));
                } else {
                    if ($_var_174 == 9) {
                        $_var_181 = $_var_179['level1'];
                        $_var_177 = pdo_fetch('select * from ' . tablename('sea_commission_level') . " where uniacid=:uniacid  and {$_var_181} >= downcount and downcount>0  order by downcount desc limit 1", array(':uniacid' => $_W['uniacid']));
                    }
                }
                if (empty($_var_177)) {
                    return;
                }
                if ($_var_177['id'] == $_var_175['id']) {
                    return;
                }
                if (!empty($_var_175['id'])) {
                    if ($_var_175['downcount'] > $_var_177['downcount']) {
                        return;
                    }
                }
                pdo_update('sea_member', array('agentlevel' => $_var_177['id']), array('id' => $m['id']));
                $this->sendMessage($m['openid'], array('nickname' => $m['nickname'], 'oldlevel' => $_var_175, 'newlevel' => $_var_177), TM_COMMISSION_UPGRADE);
            }
        }
        function upgradeLevelByCommissionOK($openid)
        {
            global $_W;
            if (empty($openid)) {
                return false;
            }
            $_var_0 = $this->getSet();
            if (empty($_var_0['level'])) {
                return false;
            }
            $m = m('member')->getMember($openid);
            if (empty($m)) {
                return;
            }
            $_var_150 = p('bonus');
            if (!empty($_var_150)) {
                $_var_151 = $_var_150->getSet();
                if (!empty($_var_151['start'])) {
                    $_var_150->upgradeLevelByAgent($openid);
                }
            }
            $_var_174 = intval($_var_0['leveltype']);
            if ($_var_174 != 10) {
                return;
            }
            if (!empty($m['agentnotupgrade'])) {
                return;
            }
            $_var_175 = $this->getLevel($m['openid']);
            if (empty($_var_175['id'])) {
                $_var_175 = array('levelname' => empty($_var_0['levelname']) ? '普通等级' : $_var_0['levelname'], 'commission1' => $_var_0['commission1'], 'commission2' => $_var_0['commission2'], 'commission3' => $_var_0['commission3']);
            }
            $_var_179 = $this->getInfo($m['id'], array('pay'));
            $_var_184 = $_var_179['commission_pay'];
            $_var_177 = pdo_fetch('select * from ' . tablename('sea_commission_level') . " where uniacid=:uniacid  and {$_var_184} >= commissionmoney and commissionmoney>0  order by commissionmoney desc limit 1", array(':uniacid' => $_W['uniacid']));
            if (empty($_var_177)) {
                return;
            }
            if ($_var_175['id'] == $_var_177['id']) {
                return;
            }
            if (!empty($_var_175['id'])) {
                if ($_var_175['commissionmoney'] > $_var_177['commissionmoney']) {
                    return;
                }
            }
            pdo_update('sea_member', array('agentlevel' => $_var_177['id']), array('id' => $m['id']));
            $this->sendMessage($m['openid'], array('nickname' => $m['nickname'], 'oldlevel' => $_var_175, 'newlevel' => $_var_177), TM_COMMISSION_UPGRADE);
        }
        function sendMessage($openid = '', $data = array(), $message_type = '')
        {
            global $_W, $_GPC;
            $_var_0 = $this->getSet();
            $_var_187 = $_var_0['tm'];
            $_var_188 = $_var_187['templateid'];
            $_var_39 = m('member')->getMember($openid);
            $_var_189 = unserialize($_var_39['noticeset']);
            if (!is_array($_var_189)) {
                $_var_189 = array();
            }
            if ($message_type == TM_COMMISSION_AGENT_NEW && !empty($_var_187['commission_agent_new']) && empty($_var_189['commission_agent_new'])) {
                $_var_190 = $_var_187['commission_agent_new'];
                $_var_190 = str_replace('[昵称]', $data['nickname'], $_var_190);
                $_var_190 = str_replace('[时间]', date('Y-m-d H:i:s', $data['childtime']), $_var_190);
                $_var_191 = array('keyword1' => array('value' => !empty($_var_187['commission_agent_newtitle']) ? $_var_187['commission_agent_newtitle'] : '新增下线通知', 'color' => '#73a68d'), 'keyword2' => array('value' => $_var_190, 'color' => '#73a68d'));
                if (!empty($_var_188)) {
                    m('message')->sendTplNotice($openid, $_var_188, $_var_191);
                } else {
                    m('message')->sendCustomNotice($openid, $_var_191);
                }
            } else {
                if ($message_type == TM_COMMISSION_ORDER_PAY && !empty($_var_187['commission_order_pay']) && empty($_var_189['commission_order_pay'])) {
                    $_var_190 = $_var_187['commission_order_pay'];
                    $_var_190 = str_replace('[昵称]', $data['nickname'], $_var_190);
                    $_var_190 = str_replace('[时间]', date('Y-m-d H:i:s', $data['paytime']), $_var_190);
                    $_var_190 = str_replace('[订单编号]', $data['ordersn'], $_var_190);
                    $_var_190 = str_replace('[订单金额]', $data['price'], $_var_190);
                    $_var_190 = str_replace('[佣金金额]', $data['commission'], $_var_190);
                    $_var_190 = str_replace('[商品详情]', $data['goods'], $_var_190);
                    $_var_191 = array('keyword1' => array('value' => !empty($_var_187['commission_order_paytitle']) ? $_var_187['commission_order_paytitle'] : '下线付款通知'), 'keyword2' => array('value' => $_var_190));
                    if (!empty($_var_188)) {
                        m('message')->sendTplNotice($openid, $_var_188, $_var_191);
                    } else {
                        m('message')->sendCustomNotice($openid, $_var_191);
                    }
                } else {
                    if ($message_type == TM_COMMISSION_ORDER_FINISH && !empty($_var_187['commission_order_finish']) && empty($_var_189['commission_order_finish'])) {
                        $_var_190 = $_var_187['commission_order_finish'];
                        $_var_190 = str_replace('[昵称]', $data['nickname'], $_var_190);
                        $_var_190 = str_replace('[时间]', date('Y-m-d H:i:s', $data['finishtime']), $_var_190);
                        $_var_190 = str_replace('[订单编号]', $data['ordersn'], $_var_190);
                        $_var_190 = str_replace('[订单金额]', $data['price'], $_var_190);
                        $_var_190 = str_replace('[佣金金额]', $data['commission'], $_var_190);
                        $_var_190 = str_replace('[商品详情]', $data['goods'], $_var_190);
                        $_var_191 = array('keyword1' => array('value' => !empty($_var_187['commission_order_finishtitle']) ? $_var_187['commission_order_finishtitle'] : '下线确认收货通知', 'color' => '#73a68d'), 'keyword2' => array('value' => $_var_190, 'color' => '#73a68d'));
                        if (!empty($_var_188)) {
                            m('message')->sendTplNotice($openid, $_var_188, $_var_191);
                        } else {
                            m('message')->sendCustomNotice($openid, $_var_191);
                        }
                    } else {
                        if ($message_type == TM_COMMISSION_APPLY && !empty($_var_187['commission_apply']) && empty($_var_189['commission_apply'])) {
                            $_var_190 = $_var_187['commission_apply'];
                            $_var_190 = str_replace('[昵称]', $_var_39['nickname'], $_var_190);
                            $_var_190 = str_replace('[时间]', date('Y-m-d H:i:s', time()), $_var_190);
                            $_var_190 = str_replace('[金额]', $data['commission'], $_var_190);
                            $_var_190 = str_replace('[提现方式]', $data['type'], $_var_190);
                            $_var_191 = array('keyword1' => array('value' => !empty($_var_187['commission_applytitle']) ? $_var_187['commission_applytitle'] : '提现申请提交成功', 'color' => '#73a68d'), 'keyword2' => array('value' => $_var_190, 'color' => '#73a68d'));
                            if (!empty($_var_188)) {
                                m('message')->sendTplNotice($openid, $_var_188, $_var_191);
                            } else {
                                m('message')->sendCustomNotice($openid, $_var_191);
                            }
                        } else {
                            if ($message_type == TM_COMMISSION_CHECK && !empty($_var_187['commission_check']) && empty($_var_189['commission_check'])) {
                                $_var_190 = $_var_187['commission_check'];
                                $_var_190 = str_replace('[昵称]', $_var_39['nickname'], $_var_190);
                                $_var_190 = str_replace('[时间]', date('Y-m-d H:i:s', time()), $_var_190);
                                $_var_190 = str_replace('[金额]', $data['commission'], $_var_190);
                                $_var_190 = str_replace('[提现方式]', $data['type'], $_var_190);
                                $_var_191 = array('keyword1' => array('value' => !empty($_var_187['commission_checktitle']) ? $_var_187['commission_checktitle'] : '提现申请审核处理完成', 'color' => '#73a68d'), 'keyword2' => array('value' => $_var_190, 'color' => '#73a68d'));
                                if (!empty($_var_188)) {
                                    m('message')->sendTplNotice($openid, $_var_188, $_var_191);
                                } else {
                                    m('message')->sendCustomNotice($openid, $_var_191);
                                }
                            } else {
                                if ($message_type == TM_COMMISSION_PAY && !empty($_var_187['commission_pay']) && empty($_var_189['commission_pay'])) {
                                    $_var_190 = $_var_187['commission_pay'];
                                    $_var_190 = str_replace('[昵称]', $_var_39['nickname'], $_var_190);
                                    $_var_190 = str_replace('[时间]', date('Y-m-d H:i:s', time()), $_var_190);
                                    $_var_190 = str_replace('[金额]', $data['commission'], $_var_190);
                                    $_var_190 = str_replace('[提现方式]', $data['type'], $_var_190);
                                    $_var_190 = str_replace('[微信比例]', $_var_0['withdraw_wechat'], $_var_190);
                                    $_var_190 = str_replace('[商城余额比例]', $_var_0['withdraw_balance'], $_var_190);
                                    $_var_190 = str_replace('[税费和服务费比例]', $_var_0['withdraw_factorage'], $_var_190);
                                    $_var_191 = array('keyword1' => array('value' => !empty($_var_187['commission_paytitle']) ? $_var_187['commission_paytitle'] : '佣金打款通知', 'color' => '#73a68d'), 'keyword2' => array('value' => $_var_190, 'color' => '#73a68d'));
                                    if (!empty($_var_188)) {
                                        m('message')->sendTplNotice($openid, $_var_188, $_var_191);
                                    } else {
                                        m('message')->sendCustomNotice($openid, $_var_191);
                                    }
                                } else {
                                    if ($message_type == TM_COMMISSION_UPGRADE && !empty($_var_187['commission_upgrade']) && empty($_var_189['commission_upgrade'])) {
                                        $_var_190 = $_var_187['commission_upgrade'];
                                        $_var_190 = str_replace('[昵称]', $_var_39['nickname'], $_var_190);
                                        $_var_190 = str_replace('[时间]', date('Y-m-d H:i:s', time()), $_var_190);
                                        $_var_190 = str_replace('[旧等级]', $data['oldlevel']['levelname'], $_var_190);
                                        $_var_190 = str_replace('[旧一级加盟比例]', $data['oldlevel']['commission1'] . '%', $_var_190);
                                        $_var_190 = str_replace('[旧二级加盟比例]', $data['oldlevel']['commission2'] . '%', $_var_190);
                                        $_var_190 = str_replace('[旧三级加盟比例]', $data['oldlevel']['commission3'] . '%', $_var_190);
                                        $_var_190 = str_replace('[新等级]', $data['newlevel']['levelname'], $_var_190);
                                        $_var_190 = str_replace('[新一级加盟比例]', $data['newlevel']['commission1'] . '%', $_var_190);
                                        $_var_190 = str_replace('[新二级加盟比例]', $data['newlevel']['commission2'] . '%', $_var_190);
                                        $_var_190 = str_replace('[新三级加盟比例]', $data['newlevel']['commission3'] . '%', $_var_190);
                                        $_var_191 = array('keyword1' => array('value' => !empty($_var_187['commission_upgradetitle']) ? $_var_187['commission_upgradetitle'] : '加盟等级升级通知', 'color' => '#73a68d'), 'keyword2' => array('value' => $_var_190, 'color' => '#73a68d'));
                                        if (!empty($_var_188)) {
                                            m('message')->sendTplNotice($openid, $_var_188, $_var_191);
                                        } else {
                                            m('message')->sendCustomNotice($openid, $_var_191);
                                        }
                                    } else {
                                        if ($message_type == TM_COMMISSION_BECOME && !empty($_var_187['commission_become']) && empty($_var_189['commission_become'])) {
                                            $_var_190 = $_var_187['commission_become'];
                                            $_var_190 = str_replace('[昵称]', $data['nickname'], $_var_190);
                                            $_var_190 = str_replace('[时间]', date('Y-m-d H:i:s', $data['agenttime']), $_var_190);
                                            $_var_191 = array('keyword1' => array('value' => !empty($_var_187['commission_becometitle']) ? $_var_187['commission_becometitle'] : '成为加盟商通知', 'color' => '#73a68d'), 'keyword2' => array('value' => $_var_190, 'color' => '#73a68d'));
                                            if (!empty($_var_188)) {
                                                m('message')->sendTplNotice($openid, $_var_188, $_var_191);
                                            } else {
                                                m('message')->sendCustomNotice($openid, $_var_191);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        function perms()
        {
            return array('commission' => array('text' => $this->getName(), 'isplugin' => true, 'child' => array('cover' => array('text' => '入口设置'), 'agent' => array('text' => '加盟商', 'view' => '浏览', 'check' => '审核-log', 'edit' => '修改-log', 'agentblack' => '黑名单操作-log', 'delete' => '删除-log', 'user' => '查看下线', 'order' => '查看推广订单(还需有订单权限)', 'changeagent' => '设置加盟商'), 'level' => array('text' => '加盟商等级', 'view' => '浏览', 'add' => '添加-log', 'edit' => '修改-log', 'delete' => '删除-log'), 'apply' => array('text' => '佣金审核', 'view1' => '浏览待审核', 'view2' => '浏览已审核', 'view3' => '浏览已打款', 'view_1' => '浏览无效', 'export1' => '导出待审核-log', 'export2' => '导出已审核-log', 'export3' => '导出已打款-log', 'export_1' => '导出无效-log', 'check' => '审核-log', 'pay' => '打款-log', 'cancel' => '重新审核-log'), 'notice' => array('text' => '通知设置-log'), 'increase' => array('text' => '加盟商趋势图'), 'changecommission' => array('text' => '修改佣金-log'), 'set' => array('text' => '基础设置-log'))));
        }
        function upgradeLevelByGood($orderid)
        {
            global $_W;
            $_var_0 = $this->getSet();
            if (!$_var_0['upgrade_by_good']) {
                return;
            }
            $goods = pdo_fetch('select g.commission_level_id from ' . tablename('sea_order_goods') . ' AS og, ' . tablename('sea_goods') . ' AS g WHERE og.goodsid = g.id AND og.orderid=:orderid AND og.uniacid=:uniacid LIMIT 1', array(':orderid' => $orderid, ':uniacid' => $_W['uniacid']));
            $_var_192 = $goods['commission_level_id'];
            if ($_var_192) {
                $_var_3 = $this->getLevels();
                foreach ($_var_3 as $_var_8) {
                    if ($_var_8['id'] == $_var_192) {
                        $_var_193 = $_var_8['commission1'];
                        $_var_194 = $_var_8['commission2'];
                        $_var_195 = $_var_8['commission3'];
                    }
                }
                $_var_148 = pdo_fetchcolumn('select openid from ' . tablename('sea_order') . ' where uniacid=:uniacid and id=:orderid', array(':uniacid' => $_W['uniacid'], ':orderid' => $orderid));
                $_var_196 = $this->getLevel($_var_148);
                if (!$_var_196 || $_var_196['commission1'] < $_var_193 || $_var_196['commission2'] < $_var_194 || $_var_196['commission3'] < $_var_195) {
                    pdo_update('sea_member', array('agentlevel' => $_var_192), array('uniacid' => $_W['uniacid'], 'openid' => $_var_148));
                }
            }
        }
    }
}