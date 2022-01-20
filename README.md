
 <div align=center><img width="150" height="150" src="https://raw.githubusercontent.com/JimHans/CAI-Engine/master/CAI%20ENGINE%201.5.5%20BETA/CAI.png"/></div>
 
# CAI-Engine
<p align="center">

 <img src="https://img.shields.io/badge/Version-1.6.7 Stable-red.svg?style=flat-square">
<img src="https://img.shields.io/badge/language-PHP-green.svg?style=flat-square">
<img src="https://img.shields.io/badge/Design-ZEROLITE-purple.svg?style=flat-square">
<img src="https://img.shields.io/badge/PHP Requirement-PHP 5+-blue.svg?style=flat-square">
</p>

## 关于本项目 中文

作为一个学习PHP与MySQL开发的学习作品，CAI Engine 是基于PHP语言与MySQL数据表查询的用户口令验证系统，通过接收表单提交的用户口令并与数据库进行比对以进行对口令的验证。由于技术的限制，它很菜（因此叫CAI-Engine :P）而且使用了明文传递Token。为了避免明文传输的不安全性，此项目通过大数与时间戳混合动态加密，可以很好地对返回口令进行加密以加强安全性。当然，由于并未采用非对称非明文传输，整体安全性仍然不允许您正式地部署在生产环境中。

## English
- CAI Engine:A PHP-based User Password Verification System improvised by JimHan

## 部署

#### 1.

参照index.php，将

`
    echo"<form action=\"judge.php\" method=\"post\">输入校验口令:<input type=\"text\" name=\"config\"><input type=\"submit\" value=\"提交\"></form>";
    	`
	
提交表单代码粘贴到需要调用CAI Engine 的位置。CSS样式可以自行设计，但action与method必须正确。通过这个调用了Judge.php的表单，你将可以提交用户的输入信息给后端判断器。完成表单添加之后，将
<pre>
    <code>if (isset($_REQUEST)&&$_REQUEST){
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
	}  </code>
</pre>
解码组件粘贴在需要限制访问的页面。并将judge.php 移至网页目录。
在这里，php在获得判断器的判断结果数据时使用url获取参数，并使用素数进行同步解密，并用当前时间戳进行了二次解密。因为时间戳的存在，因此使得该token具有1min的生命周期。

#### 2.

- 在MySQL中创建名为cai_db的数据库，并在其下创建名为caidata的数据表。
- 在caidata下创建名为pass的text类型字段。
- 在该字段下添加你的口令。
- 你也可以使用其他类型的数据库结构，但这需要你在judge.php中更改数据库读取字段。
#### 3.
现在，你可以在[📺]处添加你想要显示的HTML。它们将只在口令验证正确后才会被加载。

### Tips
- 1.可以使用如index.php的将输入组件与解码组件写在一起的样式，但将它们拆分为两个文件更优。
- 2.PHP版本必须为5+（因为只有在这之上的版本才能执行MySQL指令）
- 3.在你更改了MySQL服务器或登录用户名密码时，请在judge.php中同样更改你的配置。
- 4.由于基于session进行数据传输，尽管回调ID具有加密及时效性，还是建议你使用TLS1.2或更高版本的加密协议加密连接。
- 5.请不要将此系统用于安全性要求较高的系统！
