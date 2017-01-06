<?php
	include_once "muban.php";
	include_once "wechatcommon.php";
	
	function getAccessTokenSql(){
		global $url;
		$query = "select * from accessToken";
		$result = mysql_query($query);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_assoc($result);
			if($row["times"] < time()){
				//过期了
				$result = json_decode(httpGet($url),TRUE);
				$access_token = $result["access_token"];
				$time = time()+$result["expires_in"];
				$query = "update accessToken set access_token='$access_token',times='$time'";
				mysql_query($query);
			}else{
				//没有过期
				$access_token = $row["access_token"];
			}
		}else{
			$result = json_decode(httpGet($url),TRUE);
			$access_token = $result["access_token"];
			$time = time()+$result["expires_in"];
			$query = "insert into accessToken (access_token,times) values ('$access_token','$time')";
			mysql_query($query);
		}
		return $access_token;
	}
	
	
?>