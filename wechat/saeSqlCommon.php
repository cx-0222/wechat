<?php
		//防止中文乱码
	    header("Content-type:text/html;charset=utf-8");
	    //设置使用东八区时间格式
		date_default_timezone_set('PRC');
		
		$db = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
		mysql_select_db(SAE_MYSQL_DB, $db);
		//防止插入中的中文出现乱码
		mysql_query("set names utf8");  
?>