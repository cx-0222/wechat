<?php
	$appid = "wx466aaa1f091327fb";
	$appsecret = "344edc3736803a0897ca0d5a036ba22f";
	$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
	
	//get 请求方式
	function httpGet($url) {
	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
	    // 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
	    // 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
	    //curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, true);
	    curl_setopt($curl, CURLOPT_URL, $url);
	
	    $res = curl_exec($curl);
	    curl_close($curl);
		
	    return $res;
  }
	
	//post请求方式
	function httpPost($data,$url){
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $url);
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
         curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
         curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
         curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
         curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
         curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         $tmpInfo = curl_exec($ch);
         if (curl_errno($ch)) {
          return curl_error($ch);
       	}
       	curl_close($ch);
        return $tmpInfo;
    }	
?>