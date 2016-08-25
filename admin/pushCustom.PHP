<?php
require_once '../include.php';
//用来验证用户有没有登录
checkLogined();
?>
<!DOCTYPE html>
<html>
<head>
	<title>自定义消息推送</title>
	<meta charset="utf-8">
</head>
	<style type="text/css">
		*{margin: 0;padding: 0}
		.header{
			width:100%;
			height:80px;
			background:#222;
			color: #fff;
			font-size: 20px;
			line-height: 80px;
		}
		.main{
			margin-left: 15px;
			margin-top: 10px;
			background-image:url(images/bg_10.png);
			min-height: 872px;
		}
		.versions{
			border: 1px solid #ccc;
			width: 1000px;
			min-height: 800px;
			margin: 0 auto;
			background: #fff;
		}
		.versions_top{
			width: 100%;
			height: 100px;
			text-align: center;
			font-size: 20px;
			line-height: 100px;
			background: #abd4f1;
			opacity: 0.8;
		}
		.ios{

			width: 400px;
			margin: 30px auto;
			text-align: right;
		}
		.Android{

			margin-top:20px;
			width: 400px;
			margin: 0 auto 110px;
			text-align: right;
		}
		.marking{
			width: 100%;
			height: 80px
			
		}
		.mk{
			width: 80px;
			height: 40px;
			display: block;
			margin:100px auto;
		}
	</style>
<body>
	<div class="header">
		<center>
			版本更新和打分
		</center>
	</div>
	<div class="main">
		<div class="versions">
			<div class="versions_top">
				版本号信息
			</div>
			<br/>
			<div class="ios">
				<form method="post" action="jg_push_iosVersions.php">
					ios版本号 (1.0.0)：<input type="text" name="iosVersions">
					<button>推送</button>
				</form>	
			</div>
			<div class="Android">
				<form method="post" action="jg_push_androidVersions.php">
					Android版本号 (1.0)：<input type="text" name="androidVersions">
					<button>推送</button>
				</form>	
			</div>
			<div class="versions_top">
				提醒用户去苹果商店打分
			</div>
			<div class="marking">
				<form method="post" action="jg_push_marking.php">
					<button class="mk">通知用户打分</button>
				</form>
			</div>
		</div>
		
	</div>
</body>
</html>