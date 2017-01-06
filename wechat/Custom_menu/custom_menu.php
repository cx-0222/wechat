<?php
	include_once "3.access_token_sql.php";
	
	//需要获取到sccess_token
	$access_token = getAccessTokenSql();
	//var_dump($access_token);
	
	
	//自定义菜单接口请求  需要获取到sccess_token
	$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$access_token";
	
	$data = '{
	     "button":[
	     	{
	     		"name":"click",
           		"sub_button":[
           			{
           				"type":"click",
          				"name":"文字推送",
         				"key":"sendtext"
           			},
           			{
           				"type":"click",
          				"name":"音乐推送",
         				"key":"sendmusic"
           			},
           			{
           				"type":"click",
          				"name":"视频推送",
         				"key":"sendvideo"
           			}
           		]
	     	},
	     	{
	     		"name":"图片",
           		"sub_button":[
           			 {
	                    "type": "scancode_push", 
	                    "name": "扫码推事件", 
	                    "key": "rselfmenu_0_1"
                		},
                		{
	                    "type": "scancode_waitmsg", 
	                    "name": "扫码带提示", 
	                    "key": "rselfmenu_0_2"
               	 	},
                		{
	                    "type": "pic_sysphoto", 
	                    "name": "系统拍照发图", 
	                    "key": "rselfmenu_0_3"
                 	}, 
	                {
	                    "type": "pic_photo_or_album", 
	                    "name": "拍照或者相册发图", 
	                    "key": "rselfmenu_0_4"
	                }, 
	                {
	                    "type": "pic_weixin", 
	                    "name": "微信相册发图", 
	                    "key": "rselfmenu_0_5"
	                }
           		]
	     	},
	     	{
	     		"name":"其他",
           		"sub_button":[
           			{
			            "name": "发送位置", 
			            "type": "location_select", 
			            "key": "rselfmenu_2_0"
			        },
			        {
			            "name": "网页跳转", 
			            "type": "view", 
			            "url":"http://www.soso.com/"
		        		}
           		]
	     	}
	     ]
 	}';
	
	$result = httpPost($data, $url);
	
	var_dump($result);
?>