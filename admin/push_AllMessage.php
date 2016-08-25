<?php
require_once '../include.php';
//用来验证用户有没有登录
checkLogined();
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
		.newBook{
			width: 100%;
			height: 100px;
			text-align: center;
			font-size: 20px;
			line-height: 100px;
			background: #abd4f1;
			opacity: 0.8;
		}
		.book{
			width: 400px;
			margin: 30px auto;
			text-align: right;
		}
</style>
<body>
	<div class="header">
		<center>
			新书上架，直播前通知
		</center>
	</div>
	<div class="main">
		<div class="all">
			<div class="newBook">
				新书上架
			</div>
			<div class="book">
				<form method="post" action="jg_push_newbook.php">
					书名：<input type="text" name="bookTitle">
					<button>推送</button>
				</form>
			</div>
			<div class="newBook">
				直播前通知7.55(通知)
			</div>
			<div class="book">
				<form method="post" action="jg_push_livetime1.php">
					直播时间(2016-8-24 19:55:00)：<input type="text" name="liveTime1">
					<button>推送</button>
				</form>
			</div>
				<div class="newBook">
				直播通知8.00(通知)
			</div>
			<div class="book">
				<form method="post" action="jg_push_livetime2.php">
					直播时间(2016-8-24 20:00:00)：<input type="text" name="liveTime2">
					<button>推送</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>