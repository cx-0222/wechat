<?php
include_once "../saeSqlCommon.php";
$nickname = $_GET["nickname"];
$openid = $_GET["openid"];
$img = $_GET["img"];
$score = $_GET["score"];

$query = "select * from user where openid='$openid'";
$result = mysql_query($query);
if (mysql_num_rows($result) == 1) {
	//有这条记录
	$row = mysql_fetch_assoc($result);
	if ($row["score"] < $score) {
		$query = "update user set score='$score' where openid='$openid'";
		mysql_query($query);
	}
} else {
	//没这条记录
	$query = "insert into user (nickname,openid,score,img) values ('$nickname','$openid','$score','$img')";
	mysql_query($query);
}

$query = "select * from user order By score desc limit 0,10";
$result = mysql_query($query);
if (mysql_num_rows($result) > 0) {
	while ($row = mysql_fetch_assoc($result)) {
		$arr[] = $row;
	}
	echo json_encode($arr);
}
?>