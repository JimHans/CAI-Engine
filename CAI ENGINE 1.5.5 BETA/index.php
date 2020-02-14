<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>index</title>
</head>

<body>
	<?php 
	if (isset($_REQUEST)&&$_REQUEST){
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
	}
else
echo"<form action=\"judge.php\" method=\"post\">
输入邀请码,邀请码必须包含数字及字母: <input type=\"text\" name=\"config\">
<input type=\"submit\" value=\"提交\"></form>";
//echo"
//<script type=\"text/javascript\"><!-- CAI ENGINE api using js-->
//var keyword=prompt(\"输入邀请码\",\"邀请码必须包含数字及字母\");
//window.location.href='judge.php?jsonVar2='+keyword;
//</script>";
	
?>
</body>
</html>