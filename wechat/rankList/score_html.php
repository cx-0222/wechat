<?php
include_once "../day_02/wechatcommon.php";
$code = $_GET["code"];
//var_dump($_GET);
$api = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";
$result = httpGet($api);
$arr = json_decode($result, TRUE);
$access_token = $arr["access_token"];
$openid = $arr["openid"];
$userUrl = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN";
$json = httpGet($userUrl);
//var_dump($json);
$infoArr = json_decode($json, true);

$openid = $infoArr["openid"];
$nickname = $infoArr["nickname"];
$headimgurl = $infoArr["headimgurl"];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<title></title>
		<style type="text/css">.scoreDiv {
	margin: 40px auto;
	height: 150px;
	border: 1px solid red;
	color: red;
	text-align: center;
	line-height: 150px;
	font-size: 25px;
}

.btn {
	margin-top: 20px;
	text-align: center;
}

.start,
.end {
	font-size: 20px;
	color: red;
}

a {
	display: block;
	margin-top: 20px;
	font-size: 30px;
	text-decoration: none;
	color: red;
}</style>
	</head>
	<body>
		<div class="scoreDiv">
			分数：<span class="score">0</span>
		</div>
		<div class="btn">
			<button class="start">
			开始
			</button>
			<button class="end">
			结束
			</button>
			<a href="rank.html">
				排名榜
			</a>
		</div>

		<input id="openid" type="hidden" value="<?php echo $openid ?>"/>
		<input id="nickname" type="hidden" value="<?php echo $nickname ?>"/>
		<input id="headimgurl" type="hidden" value="<?php echo $headimgurl ?>"/>

	</body>
	<script src="../JQuery-3.1.1.min.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">var start = document.getElementsByClassName("start")[0];
var end = document.getElementsByClassName("end")[0];
var score = document.getElementsByClassName("score")[0];

var openid = document.getElementById("openid");
var nickname = document.getElementById("nickname");
var headimgurl = document.getElementById("headimgurl");

//function randomNum(max,min){
//return parseInt(Math.random()*(max-min)+min);
//}
//console.log(randomNum(5,1));
var timer = null;
start.onclick = function() {
	timer = setInterval(function() {
		score.innerHTML = String(Math.random()).substr(2, 2);
	}, 1000);
};
end.onclick = function() {
	//console.log(111);
	clearInterval(timer);
	//console.log(score.innerHTML);

	$.ajax({
		type: "get",
		url: "score.php",
		data: {
			score: score.innerHTML,
			openid: openid.value,
			nickname: nickname.value,
			headimgurl: headimgurl.value
		},
		//dataType:"json",
		success: function(data) {
			console.log("成功");
			console.log(data);
		},
		error: function(errors) {
			console.log("失败");
			console.log(errors);
		}
	});
}</script>
</html>
