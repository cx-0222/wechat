<?php
include_once "../day_02/wechatcommon.php";

$code = $_GET["code"];
$api = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";
$result = httpGet($api);
//var_dump($result);
$arr = json_decode($result, TRUE);
$access_token = $arr["access_token"];
$openid = $arr["openid"];
$userUrl = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN";
$json = httpGet($userUrl);
//var_dump($json);

$infoArr = json_decode($json, TRUE);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<title></title>
		<script src="../zepto.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
		<img src="<?php echo $infoArr["headimgurl"]; ?>" alt="" />
		<button id="play">
		颜值
		</button>
	</body>
	<script type="text/javascript">
var btn = document.getElementById("play");
var openid = '<?php echo $infoArr["openid"]; ?>';
var nickname = '<?php echo $infoArr["nickname"]; ?>';
var img = '<?php echo $infoArr["headimgurl"]; ?>';
btn.addEventListener("click", function() {
	var num = String(Math.random()).substr(2, 2);
	console.log("颜值：" + num);
	console.log(openid);

	$.ajax({
		type: "get",
		url: "rank_sql.php",
		data: {
			openid: openid,
			nickname: nickname,
			img: img,
			score: num
		},
		dataType: "json",
		success: function(data) {
			console.log("成功");
			console.log(data);
		},
		error: function(errors) {
			console.log("失败");
			console.log(errors);
		}
	});

}, false);</script>
</html>
