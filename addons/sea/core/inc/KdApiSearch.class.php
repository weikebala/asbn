<?php
///订单搜索
//电商ID
defined('EBusinessID') or define('EBusinessID', 1270949);
//电商加密私钥，快递鸟提供，注意保管，不要泄漏
defined('AppKey') or define('AppKey', '04bdfa41-b008-46ef-8234-7f83832080dc');
//请求url
defined('ReqURL') or define('ReqURL', 'http://api.kdniao.cc/Ebusiness/EbusinessOrderHandle.aspx');

class KdApiSearch{
    /**
     * Json方式 查询订单物流轨迹
     */
    public function getOrderTracesByJson($code,$codeId){
        $requestData= "{'OrderCode':'','ShipperCode':'".$code."','LogisticCode':'".$codeId."'}";

        $datas = array(
            'EBusinessID' => EBusinessID,
            'RequestType' => '1002',
            'RequestData' => urlencode($requestData) ,
            'DataType' => '2',
        );
        $datas['DataSign'] =$this->encrypt($requestData, AppKey);
        $result=$this->sendPost(ReqURL, $datas);

        //根据公司业务处理返回的信息......

        return $result;
    }

    /**
     *  post提交数据
     * @param  string $url 请求Url
     * @param  array $datas 提交的数据
     * @return url响应返回的html
     */
    function sendPost($url, $datas) {
        include "Curl.class.php";
        $curl=new Curl();
        return  $curl->post($url,$datas);
    }

    /**
     * 电商Sign签名生成
     * @param data 内容
     * @param appkey Appkey
     * @return DataSign签名
     */
    function encrypt($data, $appkey) {
        return urlencode(base64_encode(md5($data.$appkey)));
    }

}