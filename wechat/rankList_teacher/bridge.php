<?php
	//中间跳转页面 
	//这个方法与网速有关
	$code = $_GET["code"];
	header("Location:rank_php?code=$code");
?>