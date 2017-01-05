<?php
include_once "wechatcommon.php";
//!!!!!
use sinacloud\sae\Storage as Storage;

function storageAccessToken() {
	global $url;

	$s = new Storage();

	//getUrl()得到外网能访问的路径 (获取一个 Object 的外网直接访问 URL)
	//echo $s->getUrl("cxiner","64B325F6648EA141A2E76B85CA9AC7D5.jpg");
	//var_dump($s->getObject("cxiner","access_token.txt"));

	//上传一个字符串到 cxiner 这个 Bucket 的 access_token.txt 中 第五个参数的charset保证写入的中文不乱码
	//$s->putObject('"access_token":"Ch2zl7bj_48er3YnvLeqCutniTE_LEw7x7wN8eUyDb6uMIcWTUPqi2kZydsCQ0xwc_JTbum1n9rBcfI05f5B-7_KR2zG8ER6DPZyDjTHjFTdowX-Q-RXdEn2cxgUfU-aUYEgADABFL","expires_in":148351666', "cxiner", "access_token.txt",array(), array('Content-Type' => 'text/plain;charset=utf-8'));

	//getObject()获取一个 Object 的内容
	$obj = $s -> getObject("cxiner", "access_token.txt");
	//body 为 Object 的内容
	$content = $obj -> body;
	//var_dump($content);
	//json_decode()必须保证上面文件获取到的是json字符串
	$arr = json_decode($content, true);
	//var_dump($arr);
	if ($arr) {
		if ($arr["expires_in"] < time()) {
			//过期
			$result = json_decode(httpGet($url), TRUE);
			$access_token = $result["access_token"];
			$times = time() + $result["expires_in"] / 2;

			$setArr["access_token"] = $access_token;
			$setArr["expires_in"] = $times;
			$json = json_encode($setArr);
			$s -> putObject($json, "cxiner", "access_token.txt", array(), array('Content-Type' => 'text/plain;charset=utf-8'));
		} else {
			//没过期
			$access_token = $arr["access_token"];
		}
	} else {
		$arr = json_decode(httpGet($url), TRUE);
		$access_token = $arr["access_token"];
		$times = time() + $arr["expires_in"] / 2;

		$setArr["access_token"] = $access_token;
		$setArr["expires_in"] = $times;
		$json = json_encode($setArr);
		$s -> putObject($json, "cxiner", "access_token.txt", array(), array('Content-Type' => 'text/plain;charset=utf-8'));

	}

	return $access_token;
}
?>