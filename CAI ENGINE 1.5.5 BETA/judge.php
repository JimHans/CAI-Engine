<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>CAI Engine Judge</title>
	<style type="text/css">
  .container{
    position: relative;
    width: 100px;
    height: 100px;
    margin: 0 auto;
  }
.image{
    position: absolute;
    width: 100px;
    height: 100px;
	left: -80px;
	top: 95px;
    margin: 0 auto;
	animation: wavefont 3s ease-in-out;
	animation-iteration-count: infinite;
	
  }
		.circle{
    position: absolute;
    left: -156px;
    top: 0px;
    width: 350px;
    height: 350px; 
    border: 8px solid #1E90FF;
    border-radius: 50%; 
    opacity: 0;
	animation: waveCircle2 2s ease-in-out;
	animation-iteration-count: infinite;
  }

  .wave{
    position: absolute;
    left: -155px;
    top: 2px;
    width: 350px;
    height: 350px; 
    border: 6px solid #1E90FF;
    border-radius: 50%; 
    opacity: 0;
    animation: waveCircle 2s ease-in-out;
    animation-iteration-count: infinite;
  }
  @-webkit-keyframes waveCircle {
    0%{
      transform: scale(1);
      opacity: 0.6;
    }
	  
	  50%{
      transform: scale(0.7);
      opacity: 1;
    }
	  100%{
      transform: scale(1);
      opacity: 0.6;
    }
  }
		@-webkit-keyframes waveCircle2 {
			0%{
      transform: scale(0.75);
      opacity: 0.5;
    }
    100%{
      transform: scale(0.75);
      opacity: 0.5;
    }
  }
		@-webkit-keyframes wavefont {

    0%{
      opacity: 0.2;
    }
			50%{
      opacity: 1;
    }
			 100%{
      opacity: 0.2;
    }
  }
	
  </style>
</head>

<body>
<?php 
error_reporting(E_ERROR); 
ini_set("display_errors","Off");//error forbidden
/*************CAI ENGINE V1.5 Alpha*****************/
	if (isset($_REQUEST)&&$_REQUEST){ //judge request exist
$config = $_REQUEST['config'];//get user enter key
/*************CAI ENGINE version*****************/
if($config == "version"||$config == "")//version detect
{
	echo"[🌐版本查询中...] <br />";
	echo"<div class=\"container\">
	
<div align=\"center\" class=\"image\">
	<img src=\"CAI.png\" width=\"210\" height=\"190\" alt=\"\"/></div>
<div class=\"circle\"></div>  
<div class=\"wave\"></div>
</div>";
	echo"[❗ © 2020 ZEROLITE Studio Some Rights Reserved] <br />";
	echo"[❗CAI Engine Judge 版本 V1.5.5 Beta] <br />";
	echo"[❗编译时间 2020-02-12] <br />";
	echo"[❗更新内容：更改模糊查询为精确查询，修复未知变量传参误判问题] <br />";
	echo"[❗支持的PHP版本：5+] <br />";
	echo"[❗自动更新未启用，您可手动访问https://github.com/JimHans/CAI-Engine 进行更新] <br />";
    echo"[✅版本查询完成] <br />";	
}/*****************************************/
else{
	
echo"[💎CAI ENGINE JUDGE 1.5.5 Beta 正在验证...] <br />";
	echo"<div class=\"container\">
	
<div align=\"center\" class=\"image\">
	<img src=\"CAI.png\" width=\"210\" height=\"190\" alt=\"\"/></div>
<div class=\"circle\"></div>  
<div class=\"wave\"></div>
</div>";
/*****mysql 数据库配置****/
$servername = "localhost";
$username = "root";
$password = "";
/**********END**********/
echo"[🌐连接数据库服务器...] <br />";
$con =mysqli_connect($servername,$username,$password,"cai_db"); //connect mysql database cai_db
/**************connect fail detect*************/
if(!$con){
die('[⛔连接数据库失败: ' . mysqli_connect_error().']');
exit();
}
else echo"[✅连接数据库服务器完成] <br />";
//detect complete
mysqli_query($con,"set names gb2312"); //GB2312
echo"[🌐选择数据库与数据表...]<br />";
$result = mysqli_query($con,"SELECT * FROM caidata"); //selest "caidata" sheet
		/**************connect fail detect*************/
if(! $result){
printf("[⛔错误: %s ! CAI ENGINE已停止]<br />", mysqli_error($con));
exit();
} else echo"[✅选择数据库与数据表完成] <br />";
$info = mysqli_fetch_array($result,MYSQLI_BOTH); //get result
echo"[🌐查找验证信息...]<br />";
$sql = mysqli_query($con,"select * from caidata where FIND_IN_SET('".trim($config)."',pass)"); //精确查询
echo"[✅查找验证信息完成]<br />";
$scan = mysqli_fetch_array($sql,MYSQLI_BOTH);
echo"[🌐输出查询结果...]<br />";
if(!$scan){  //如果检索的信息不存在，则输出相对的提示信息
echo"[⛔验证失败]<br />";
mysqli_close($con);
echo"[📊数据库通讯已关闭]<br />";
echo"<script type=\"text/javascript\">
    alert(\"你好，邀请码错误！！\"); 
	window.location.href=\"./index.php\";
</script>";//forbid


}
else {
echo"[✅验证通过]<br />";
$return = time();
$key = floor($return/10)*481562*floor($return/1000000000);
echo"[✅回调ID已加密]<br />";
mysqli_close($con);
echo"[📊数据库通讯已关闭]<br />";
echo"[🌎将于两秒后跳转...]<br />";
echo"<script>setTimeout(function(){window.location.href=\"./index.php?req=".$key."\";}, 2000);</script>";

//header("Location: ./index.php?req=".$key);//locate to homepage
}
}
	mysqli_close($con);}
 ?>
</body>
</html>