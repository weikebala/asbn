<?php 
class Sms 
{
	var $sms_url;
	var $sms_account;
	var $sms_password;
	
	function sms(){
		//$this->sms_url = $sms_url; 
		$this->sms_url = 'http://sdk.zyer.cn/SmsService/SmsService.asmx/SendEx'; 
		//$this->sms_account = $sms_account; 
		$this->sms_account = 'taocai66'; //taocai66
		//$this->sms_password = $sms_password;
		//substr(md5('tao66ah2766'),8,16)
		$this->sms_password = 'E705A735D015D042';//tao66ah2766
		//$this->sms_password = substr(md5('tao66ah2766'),8,16);//tao66ah2766
	}           
	 function sendsms($phone,$content){
		$str = mb_convert_encoding($content, "GBK", "UTF-8");
		$sdata="LoginName=".$this->sms_account."&Password=".$this->sms_password."&SmsKind=808&ExpSmsId=&SendSim=".$phone."&MsgContext=".$str;
		$header = "Content-type: text/xml";
		$ch = curl_init();
		@curl_setopt($ch, CURLOPT_URL, $this->sms_url);
		@curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		@curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		@curl_setopt($ch, CURLOPT_POST, 1);
		@curl_setopt($ch, CURLOPT_POSTFIELDS, $sdata);
		$response = curl_exec($ch);
		if(curl_errno($ch)){
			print curl_error($ch);
		}
		curl_close($ch);
		
		$xml = simplexml_load_string($response);	
		//print_r($xml );	
		$result=json_decode(json_encode($xml),TRUE);
		if($result['SuccessCount']==1)return true;
		
        return false;		 
	} 
}
?> 