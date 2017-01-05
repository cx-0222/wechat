<?php
//day_02/wechatcommon.php在 因为在引入的文件jssdk.php中也有引用 同一个文件不可以引入两次 所以要用同一个名字
include_once "../day_02/wechatcommon.php";
require_once "jssdk.php";
$jssdk = new JSSDK("$appid", "$appsecret");
$signPackage = $jssdk -> GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<title></title>
	</head>
	<body>
		<button id="btn">
		选择
		</button>
	</body>
	<!--第二步-->
	<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<script>/*
 * 注意：
 * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
 * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
 * 3. 常见问题及完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
 *
 * 开发中遇到问题详见文档“附录5-常见错误及解决办法”解决，如仍未能解决可通过以下渠道反馈：
 * 邮箱地址：weixin-open@qq.com
 * 邮件主题：【微信JS-SDK反馈】具体问题
 * 邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
 */
wx.config({
			debug: true,
			appId: '<?php echo $signPackage["appId"]; ?>',
timestamp:<?php echo $signPackage["timestamp"]; ?>,
nonceStr: '<?php echo $signPackage["nonceStr"]; ?>',
signature: '<?php echo $signPackage["signature"]; ?>',
jsApiList: [
//所有要调用的api的名字  第三步 分享朋友圈试哩
"onMenuShareTimeline",
"onMenuShareAppMessage",
"chooseImage"
]
});
wx.ready(function() {
	// 在这里调用 API
	wx.onMenuShareTimeline({
		title: '他的猫', // 分享标题
		link: 'www.baidu.com', // 分享链接
		imgUrl: 'http://lcks.applinzi.com/miao.jpg', // 分享图标
		success: function() {
			// 用户确认分享后执行的回调函数
			alert("成功");
		},
		cancel: function() {
			// 用户取消分享后执行的回调函数
		}
	});

	wx.onMenuShareAppMessage({
		title: '他的猫', // 分享标题
		desc: 'hello', // 分享描述
		link: 'www.taobao.com', // 分享链接
		imgUrl: 'http://lcks.applinzi.com/miao.jpg', // 分享图标
		type: '', // 分享类型,music、video或link，不填默认为link
		dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
		success: function() {
			// 用户确认分享后执行的回调函数
		},
		cancel: function() {
			// 用户取消分享后执行的回调函数
		}
	});
});

var btn = document.getElementById("btn");
btn.addEventListener("click", function() {
	wx.chooseImage({
		count: 1, // 默认9
		sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
		sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
		success: function(res) {
			var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
		}
	});
}, false)</script>
</html>
