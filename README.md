![image](https://raw.githubusercontent.com/JimHans/CAI-Engine/master/CAI%20ENGINE%201.5.5%20BETA/CAI.png)
# CAI-Engine
<p align="center">
 
 <img src="https://img.shields.io/badge/Version-1.5.5 Beta-red.svg?style=flat-square">
<img src="https://img.shields.io/badge/language-PHP-green.svg?style=flat-square">
<img src="https://img.shields.io/badge/Design-ZEROLITE-purple.svg?style=flat-square">
<img src="https://img.shields.io/badge/REQUIRED-PHP 5+&MySQL-blue.svg?style=flat-square">
</p>
### 中文

CAI Engine 是基于PHP语言的用户口令验证系统，通过接收表单提交的用户口令并与数据库进行比对以进行对口令的验证。并且，通过大数与时间戳混合动态加密，可以很好地对返回口令进行加密以加强安全性。
#### 部署

参照index.php，将

  ` echo"<form action=\"judge.php\" method=\"post\">
输入邀请码,邀请码必须包含数字及字母: <input type=\"text\" name=\"config\">
<input type=\"submit\" value=\"提交\"></form>";   `
粘贴到需要调用CAI Engine 的位置。CSS样式可以自行设计，但action与method必须正确。
将
    `if (isset($_REQUEST)&&$_REQUEST){
$req= $_REQUEST['req'];
    if(preg_match('/[a-zA-Z]/',$req)||$req=='') 
		{
	echo"[⛔验证错误]<br />";
	echo"<script>setTimeout(function(){window.location.href=\"./index.php\";}, 2000);</script>";
}
		else{
$reqflor = $req/481562;//时间戳解密
if($reqflor == (floor(time()/10)*floor(time()/1000000000))||$reqflor == ((floor(time()/10)-1)*(floor(time()/1000000000)-1))) echo"[📺]<br />";
else {
	echo"[⛔页面已过期]<br />";
	echo"<script>setTimeout(function(){window.location.href=\"./index.php\";}, 2000);</script>";
}
		}
	}   `
粘贴在需要限制访问的页面。
A PHP-based User Password Verification System
