<?php
if (!defined('IN_IA')) {
	exit('Access Denied');
} 
class Welian_Indiana_Codes {
	public function code($openid='',$tid = '',$uniacid=0,$machine_time = '') {
		global $_W,$_GPC;
		$record_array=array();
		$myCart=self::getCart($openid,$uniacid);
		$machine_time = $machine_time;
		if($machine_time != ''){
			$consumerecord_time = $machine_time;
		}else{
			$consumerecord_time = TIMESTAMP;
		}
		
		if(strstr($openid,'machine') == ''){
			//判断是否是真实用户。并且判断是否非法访问
			/****************检索购买夺宝码开始*****************/
			$record = pdo_fetch("SELECT * FROM " . tablename('weliam_indiana_rechargerecord') . " WHERE ordersn ='{$tid}'");//获取商品ID
			$num_money = pdo_fetchall("select * from".tablename('weliam_indiana_cart')."where uniacid = '{$_W['uniacid']}' and openid = '{$openid}'");
			$money = 0;
			foreach($num_money as $key =>$value){
				$goodsid = pdo_fetchcolumn("select goodsid from".tablename('weliam_indiana_period')."where period_number = '{$value['period_number']}'");
				$init_money = pdo_fetchcolumn("select init_money from".tablename('weliam_indiana_goodslist')."where id = '{$goodsid}'");
				$money = $money+$init_money*$value['num'];
			}
			if($record['num'] < 1 || $record['num'] != $money || $record['num'] == '' || $record['type'] == 1){
				echo '非法操作,如果该操作产生较大影响，将追究您的责任';
				exit;
			}
			/****************检索购买夺宝码结束****************/
		}
		file_put_contents(WELIAM_INDIANA."machine.log", var_export($consumerecord_time, true).PHP_EOL, FILE_APPEND);
		foreach($myCart as$key=>$value){
			$mymember = m('member') -> getInfoByOpenid($openid);
			$flag=FALSE;
			$buy_codes=$value['num'];
			$period1 = pdo_fetch("SELECT codes,shengyu_codes,zong_codes,id,periods,uniacid,goodsid,canyurenshu,period_number FROM " . tablename('weliam_indiana_period') . " where 1 and uniacid={$uniacid} and period_number='{$value['period_number']}'");
			$period = pdo_fetch("SELECT codes,shengyu_codes,zong_codes,id,periods,uniacid,goodsid,canyurenshu,period_number FROM " . tablename('weliam_indiana_period') . " where 1 and uniacid={$uniacid} and goodsid='{$period1['goodsid']}' and status=1");
		if($period){
			$goods = pdo_fetch("select canyurenshu,id,maxperiods,price,jiexiao_time,couponid,uniacid,init_money,next_init_money from".tablename('weliam_indiana_goodslist')."where uniacid={$uniacid} and id='{$period['goodsid']}'");
			$record = pdo_fetch("select code,count,id from".tablename('weliam_indiana_record')."where uniacid={$uniacid} and openid='{$openid}' and period_number='{$period['period_number']}' and status=1");
			$codes=unserialize($period['codes']);//本期剩余夺宝码codes
			$cha = intval($buy_codes) - intval($period['shengyu_codes']) ;
			if($cha<0){
				//正常购买分配
				$new_period = array();
				$new_goods = array();
				$code=array_slice($codes,0,$buy_codes);
				$new_period['shengyu_codes']=$period['shengyu_codes']-$buy_codes;
				$new_period['codes']=array_slice($codes,$buy_codes,$new_period['shengyu_codes']);
				$new_period['codes']=serialize($new_period['codes']);
				$new_period['canyurenshu'] = $period['canyurenshu']+$buy_codes;
				$new_period['scale']=@round((1-$new_period['shengyu_codes'] / $period['zong_codes'])*100);
				$new_goods['canyurenshu']=$goods['canyurenshu']+$buy_codes;
				//执行数据库更新
				pdo_update('weliam_indiana_period', $new_period, array('id' => $period['id']));
				pdo_update('weliam_indiana_goodslist', $new_goods, array('id' => $goods['id']));
				if($record){
					//有购买记录
					$newcode = array();
					$recordcode = unserialize($record['code']);//本期已有codes
					
					$newcode = array_merge($code,$recordcode);
					$newcode=serialize($newcode);
					pdo_update('weliam_indiana_record', array('code'=>$newcode,'count'=>$record['count']+$buy_codes,'goodsid'=>$period['goodsid']), array('id' => $record['id']));
				}else{
					$code = serialize($code);
					$ordersn=date('Ymd').substr(time(), -5).substr(microtime(), 2, 5).sprintf('%02d', rand(0, 99));
					$data=array(
						'openid'=>$value['openid'],
						'uniacid'=>$value['uniacid'],
						'ordersn'=>$ordersn,
						'status'=>1,
						'goodsid'=>$goods['id'],
						'count'=>$value['num'],
						'createtime' => $consumerecord_time,
						'period_number'=>$period['period_number'],
						'code'=>$code
					);
					pdo_insert('weliam_indiana_record',$data);
					$recordid = pdo_insertid();
				}
	 			
				//产生消费记录
				$data2=array(
					'openid'=>$value['openid'],
					'uniacid'=>$value['uniacid'],
					'status'=>1,
					'num'=>$value['num']*$goods['init_money'],
					'createtime' => $consumerecord_time,
					'period_number'=>$period['period_number'],
					'ip'=>$value['ip'],
					'ipaddress'=>$value['ipaddress']
				);
				pdo_insert('weliam_indiana_consumerecord',$data2);
				//购买完成消耗夺宝币
				m('credit')->updateCredit2($openid,$_W['uniacid'],0-$buy_codes*$goods['init_money']);
				$flag=TRUE;
				//生成优惠卷
				$url = $_W['siteroot']."addons/weliam_indiana/core/model/receive.php";
				$param = array('couponid'=>$goods['couponid'],'num'=>$buy_codes,'openid'=>$openid);  
				$result = self::doRequest($url, $param);
			}else{
				//买多了
					//先更新这期数据
					$new_period = array();
					$new_goods = array();
					$new_period['endtime']=$consumerecord_time+$goods['jiexiao_time']*60;
					$code=array_slice($codes,0,$period['shengyu_codes']);
					$new_period['shengyu_codes']=0;
					$new_period['codes']=array();
					$new_period['codes']=serialize($new_period['codes']);
					$new_period['canyurenshu'] = $period['zong_codes'];
					$new_period['scale']=100;
					$new_period['status']=2;
					
					$new_goods['canyurenshu']=$goods['canyurenshu']+$period['shengyu_codes'];
					//执行数据库更新
					pdo_update('weliam_indiana_period', $new_period, array('id' => $period['id']));
					pdo_update('weliam_indiana_goodslist', $new_goods, array('id' => $goods['id']));
					
					if($record){
						//有购买记录
						$newcode = array();
						$recordcode = unserialize($record['code']);//本期已有codes
						$newcode = array_merge($code,$recordcode);
						$newcode=serialize($newcode);
						pdo_update('weliam_indiana_record', array('code'=>$newcode,'count'=>$record['count']+$period['shengyu_codes'],'goodsid'=>$period['goodsid']), array('id' => $record['id']));
					}else{
						$code = serialize($code);
						$ordersn=date('Ymd').substr(time(), -5).substr(microtime(), 2, 5).sprintf('%02d', rand(0, 99));
						$data=array(
							'openid'=>$value['openid'],
							'uniacid'=>$value['uniacid'],
							'ordersn'=>$ordersn,
							'status'=>1,
							'goodsid'=>$period['goodsid'],
							'count'=>$period['shengyu_codes'],
							'createtime' => $consumerecord_time,
							'period_number'=>$period['period_number'],
							'code'=>$code
						);
						pdo_insert('weliam_indiana_record',$data);
					}
					//产生消费记录
					$data2=array(
						'openid'=>$value['openid'],
						'uniacid'=>$value['uniacid'],
						'status'=>1,
						'num'=>$period['shengyu_codes']*$goods['init_money'],
						'createtime' => $consumerecord_time,
						'period_number'=>$period['period_number'],
						'ip'=>$value['ip'],
						'ipaddress'=>$value['ipaddress']
					);
					pdo_insert('weliam_indiana_consumerecord',$data2);
					//更新完毕，计算获奖信息
					$records = pdo_fetchall("SELECT * FROM " . tablename('weliam_indiana_record') . " WHERE uniacid =:uniacid and period_number=:period_number",array(':uniacid'=>$uniacid,':period_number'=>$period['period_number']));//获取本期商品所有交易记录]
					if (empty($period['code'])) {
						$wincode = $this->comcode($period['id'],$uniacid);
					}else{
						$wincode=$period['code'];
					}
					//计算获奖人
					foreach ($records as$k=> $v) {
						$scodes=unserialize($v['code']);//转换商品code
						for ($i=0; $i < count($scodes) ; $i++) { 
							if ($scodes[$i]==$wincode) {
								$lack_period['openid']=$v['openid'];
								$lack_period['recordid']=$v['id'];
								break;
							}
						}
					}
					$pro_m = m('member')->getInfoByOpenid($lack_period['openid']);//获奖用户信息
					$lack_record = pdo_fetch("select count from".tablename('weliam_indiana_record')."where uniacid={$uniacid} and openid='{$lack_period['openid']}' and period_number='{$period['period_number']}'");
					$lack_period['code']=$wincode;
					$lack_period['nickname']=$pro_m['nickname'];
					$lack_period['avatar']=$pro_m['avatar'];
					$lack_period['partakes']=$lack_record['count'];
					//更新中奖信息到这期数据
					pdo_update('weliam_indiana_period', $lack_period, array('id' => $period['id']));
					//请求待揭晓->已揭晓 进程
					$url = $_W['siteroot']."addons/weliam_indiana/core/model/receive.php";
					$url2 = $_W['siteroot']."app/index.php?i=".$_W['uniacid']."&c=entry&do=order_get&m=weliam_indiana";
					$param = array('period_number'=>$period['period_number'],'jiexiao_time'=>$goods['jiexiao_time'],'lackopenid'=>$lack_period['openid'],'url2'=>$url2,'goodsid'=>$goods['id'],'uniacid'=>$goods['uniacid']);  
					$result = self::doRequest($url, $param);
				if($goods['maxperiods']>$period['periods']){
					//可以生成下一期
					//生成优惠卷
					$url = $_W['siteroot']."addons/weliam_indiana/core/model/receive.php";
					$param = array('couponid'=>$goods['couponid'],'num'=>$buy_codes,'openid'=>$openid);  
					$result = self::doRequest($url, $param);
					//生成新一期
					if($goods['next_init_money'] !=0 && $cha == 0){
						//判定是否重新定义了专区价格
						$goods['init_money'] = $goods['next_init_money'];
						pdo_update('weliam_indiana_goodslist',array('init_money'=>$goods['next_init_money'],'next_init_money'=>0),array('id'=>$goods['id']));
					}
					$CountNum=intval($goods['price'])/$goods['init_money'];
					$newcodes=array();
					for($i=1;$i<=$CountNum;$i++){
						$newcodes[$i]=1000000+$i;
					}
					shuffle($newcodes);
					$newcodes=serialize($newcodes);
					
					$next_period =array();
					$next_period['period_number']=date('Ymd').substr(time(), -5).substr(microtime(), 2, 5).sprintf('%02d', rand(0, 99));
					$next_period['periods'] = intval($period['periods'])+1;
					$next_period['uniacid'] = $period['uniacid'];
					$next_period['codes'] = $newcodes;
					$next_period['canyurenshu'] = 0;
					$next_period['goodsid'] = $goods['id'];
					$next_period['shengyu_codes'] = $CountNum;
					$next_period['zong_codes'] = $CountNum;
					$next_period['allcodes'] = $newcodes;
					$next_period['status'] = 1;
					$next_period['scale'] = 0;
					$next_period['createtime'] = TIMESTAMP;
					//更新商品期数
					pdo_update('weliam_indiana_goodslist',array('periods'=>$next_period['periods']), array('id' => $goods['id']));
					if(pdo_insert('weliam_indiana_period', $next_period)){
						$orderid = pdo_insertid();
						if($cha>0){
							//更新下期数据
							$new_next_codes = unserialize($next_period['codes']);
							$new_next_period = array();
							$new_next_goods = array();
							$chacode=array_slice($new_next_codes,0,$cha);
							$new_next_period['shengyu_codes']=$next_period['shengyu_codes']-$cha;;
							$new_next_period['codes']=array_slice($new_next_codes,$cha,$new_next_period['shengyu_codes']);
							$new_next_period['codes']=serialize($new_next_period['codes']);
							$new_next_period['canyurenshu'] += $cha;
							$new_next_period['scale']=@round((1-$new_next_period['shengyu_codes'] / $next_period['zong_codes'])*100);
							$newgoods = pdo_fetch("select canyurenshu from".tablename('weliam_indiana_goodslist')."where uniacid={$uniacid} and id='{$period['goodsid']}'");
							$new_next_goods['canyurenshu']=$newgoods['canyurenshu']+$cha;
							//执行数据库更新
							pdo_update('weliam_indiana_period', $new_next_period, array('id' => $orderid));
							pdo_update('weliam_indiana_goodslist', $new_next_goods, array('id' => $goods['id']));
							$chacode = serialize($chacode);
							$ordersn=date('Ymd').substr(time(), -5).substr(microtime(), 2, 5).sprintf('%02d', rand(0, 99));
							$data=array(
								'openid'=>$value['openid'],
								'uniacid'=>$value['uniacid'],
								'ordersn'=>$ordersn,
								'status'=>1,
								'goodsid'=>$period['goodsid'],
								'count'=>$cha,
								'createtime' => $consumerecord_time,
								'period_number'=>$next_period['period_number'],
								'code'=>$chacode
							);
							pdo_insert('weliam_indiana_record',$data);
							$recordid = pdo_insertid();
							//产生消费记录
							$data2=array(
								'openid'=>$value['openid'],
								'uniacid'=>$value['uniacid'],
								'status'=>1,
								'num'=>$cha*$goods['init_money'],
								'createtime' => $consumerecord_time,
								'period_number'=>$next_period['period_number'],
								'ip'=>$value['ip'],
								'ipaddress'=>$value['ipaddress']
							);
							pdo_insert('weliam_indiana_consumerecord',$data2);
						}
					}
					//购买完成消耗夺宝币
					m('credit')->updateCredit2($openid,$_W['uniacid'],-$buy_codes*$goods['init_money']);
					$flag=TRUE;
				}else{
					//不可生成下一期
					$url = $_W['siteroot']."addons/weliam_indiana/core/model/receive.php";
					$param = array('couponid'=>$goods['couponid'],'num'=>$period['shengyu_codes'],'openid'=>$openid); 
					$result = self::doRequest($url, $param); 
					if($cha>=0){
						//部分购买完成消耗夺宝币,剩下的在余额里
						m('credit')->updateCredit2($openid,$_W['uniacid'],0-$period['shengyu_codes']*$goods['init_money']);
					}
					//商品下架
					pdo_update('weliam_indiana_goodslist',array('status'=>1), array('id' => $goods['id']));
					$flag=TRUE;
				}
			}
			//购买完毕清除购物车
			if($flag){
				pdo_delete('weliam_indiana_cart',array('id'=>$value['id']));
			}
			unset($myCart[$key]);
		}
		} 
			
		return $flag;		
	}
	/*获取购物车所有商品*/
	function getCart($openid='',$uniacid=0){
		$myCart = pdo_fetchall("select * from".tablename('weliam_indiana_cart')."where openid='{$openid}' and uniacid={$uniacid}");	
		return $myCart;
	}
	// 计算夺宝码
	public function comcode($periodid,$uniacid) {
		$src = 'http://f.apiplus.cn/cqssc.json';
		$src .= '?_='.time();
		$json = file_get_contents(urldecode($src));
		$json = json_decode($json);
		$periods = $json->data[0]->expect;
		$s_record = pdo_fetchall("SELECT openid,createtime FROM " . tablename('weliam_indiana_consumerecord') . " WHERE uniacid = '{$uniacid}' ORDER BY `id` DESC LIMIT 0 , 20");//获取商品所有交易记录
		foreach ($s_record as $key => $value) {
			$member = m('member') -> getInfoByOpenid($value['openid']);
			$s_record[$key]['nickname'] =  base64_encode($member['nickname']);
		}
		$numa = floatval(0);
		$arecord = array();
		foreach ($s_record as $key => $value) {
			$sourceNumber = rand(0, 999);
    		$microtime = substr(strval($sourceNumber+1000),1,3);
			$arecord[$key]['createtime'] = $value['createtime'];
			$arecord[$key]['nickname'] = $value['nickname'];
			$arecord[$key]['microtime'] = $microtime;
			$numa = $numa + intval(date('His', $value['createtime']).$microtime);
		}
		$numb = str_replace(array(","),"",$json ->data[0]->opencode);
		$period = pdo_fetch("SELECT id,goodsid,zong_codes,code FROM " . tablename('weliam_indiana_period') . " WHERE id ='{$periodid}'");//获取商品详情
		if($period['code']){
			$wincode = $period['code'];
		}else{
			$wincode = fmod(($numa + $numb),$period['zong_codes']) + 1000001;
		}
		$comdata = array(
			'uniacid' => $uniacid, 
			'numa' => $numa, 
			'numb' => $numb, 
			'periods' => $periods, 
			'pid' => $period['id'], 
			'wincode' => intval($wincode), 
			'arecord' => serialize($arecord), 
			'createtime' => TIMESTAMP
		);
		pdo_insert('weliam_indiana_comcode',$comdata);
		return $wincode;
	}
	function doRequest($url, $param=array()){  
  
	    $urlinfo = parse_url($url);  
	  
	    $host = $urlinfo['host'];  
	    $path = $urlinfo['path'];  
	    $query = isset($param)? http_build_query($param) : '';  
	  
	    $port = 80;  
	    $errno = 0;  
	    $errstr = '';  
	    $timeout = 10;  
	  
	    $fp = fsockopen($host, $port, $errno, $errstr, $timeout);  
	  
	    $out = "POST ".$path." HTTP/1.1\r\n";  
	    $out .= "host:".$host."\r\n";  
	    $out .= "content-length:".strlen($query)."\r\n";  
	    $out .= "content-type:application/x-www-form-urlencoded\r\n";  
	    $out .= "connection:close\r\n\r\n";  
	    $out .= $query;  
	  
	    fputs($fp, $out);  
	    fclose($fp);  
	}
	public function sendTplNotice($touser, $template_id, $postdata, $url = '', $account = null) {
		global $_W;
		load() -> model('account');
		$sql = 'SELECT `settings` FROM ' . tablename('uni_account_modules') . ' WHERE `uniacid` = :uniacid AND `module` = :module';
		$settings = pdo_fetchcolumn($sql, array(':uniacid' => $_W['uniacid'], ':module' => 'weliam_indiana'));
		$settings = iunserializer($settings);
		$template_id = $settings['config']['m_suc'];
		if (!$account) {
			if (!empty($_W['acid'])) {
				$account= WeAccount :: create($_W['acid']);
			} else {
				$acid = pdo_fetchcolumn("SELECT acid FROM " . tablename('account_wechats') . " WHERE `uniacid`=:uniacid LIMIT 1", array(':uniacid' => $_W['uniacid']));
				$account= WeAccount :: create($acid);
			} 
		} 
		if (!$account) {
			return;
		} 
		return $account -> sendTplNotice($touser, $template_id, $postdata, $url);
	} 
} 
