<?php
require_once '../include.php';
//用来验证用户有没有登录
checkLogined()
?>
<!DOCTYPE html>
<html>
<head>
	<title>消息通知</title>
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
		.all{
			border: 1px solid #ccc;
			width: 1000px;
			min-height: 800px;
			margin: 0 auto;
			background: #fff;
		}
		.incomeMessage{
			width: 100%;
			height: 100px;
			text-align: center;
			font-size: 20px;
			line-height: 100px;
			background: #abd4f1;
			opacity: 0.8;
		}
		.ts{

			width: 400px;
			margin: 30px auto;
			text-align: right;
		}
</style>
<body>
	<div class="header">
		<center>
			收入通知，奖励通知
		</center>
	</div>
	<div class="main">
		<div class="all">
			<div class="incomeMessage">
				推广收入通知提醒
			</div>
			<div class="ts">
				<form method="post" action="jg_push_incomeMessage.php">
					收入人名字：<input type="text" name="nickName">
					<button>推送</button>
				</form>	
			</div>
			<div class="incomeMessage">
				奖励通知提醒
			</div>
			<div class="ts">
				<form method="post" action="jg_push_awardMessage.php">
					受奖励人名字：<input type="text" name="nickName">
					<button>推送</button>
				</form>	
			</div>
		</div>
	</div>
</body>
</html>