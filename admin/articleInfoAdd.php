<?php
require_once '../include.php';
//将上传的图片存到oss
checkLogined();
$sql="select * from bookinfo where bookstatus = 1";
$rows=fetchAll($sql);
?>
<!DOCTYPE html>
<html>
<head>
	<title>文章发布</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <script type="text/javascript" charset="utf-8" src="utf8-php/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="utf8-php/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="utf8-php/lang/zh-cn/zh-cn.js"></script>
</head>
<style type="text/css">
	*{margin: 0;padding: 0}
	.header{
		width:100%;
		height:80px;
		background:#222;
		line-height: 80px;
		color: #fff;
	}
	.main{
		margin-left: 15px;
		margin-top: 10px;
		background-image:url(images/bg_10.png);
		height: 872px;
		
	}
	.main-top{
		width: 1000px;
		height: 110px;
		margin:auto;
		text-align: center;
	}
	.main-2{
		margin: 20px auto;
		width: 1400px;
		background: #fff;
		min-height: 600px;
		border: 1px solid #ccc;
	}
	.main-bottom{
		margin: 20px auto;
		width: 1400px;
		background: #fff;
		height: 70px;
		border: 1px solid #ccc;
	}

</style>
<body>
<div class="header">
	<center>
		添加文章
	</center>
</div>
<form method="post" action="articleInfoData.php">
	<div class="main">
		<div class="main-top">
			<div class="select">
				选择书籍：
				<select name="bookTitle">
					<?php
						foreach ($rows as $key => $value) :
					?>
						<option><?php echo $value['bookTitle'];?></option>
					<?php
						endforeach;
					?>
				</select>
			</div>	
			<div class="dd">
				<textarea name="artPreread" id="suggest1" style="height:80px;width:1000px;margin-top:10px">添加文章导读：</textarea>
			</div>
		</div>
		<div class="main-2">
		文稿内容：
			<script id="editor" type="text/plain" style="width:1400px;height:500px;" name="artContent"></script>
			<script type="text/javascript">
			    //实例化编辑器
			    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
			    var ue = UE.getEditor('editor');
			    UE.getEditor('editor').setHeight(500);
			</script>
		</div>
		<div class="main-bottom">
			音频地址：<input type="text" style="margin-top:10px" name="unsbOssAddr" id="unsbOssAddr"><br/>
			<audio id="unsbOssAddrAudio" src="" controls="controls" style="height:40px;width:400px;">您的浏览器不支持 video 标签。</audio>
			<button style="width:50px;height:30px;background:#ccc;border:none;margin-left:300px" type="submit">保存</button>
		</div>
	</div>
</form>
</body>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
	window.onload =function(){
		var unsbOssAddr=document.getElementById('unsbOssAddr');
		var unsbOssAddrAudio=document.getElementById('unsbOssAddrAudio');
		unsbOssAddr.onblur=function(){
			unsbOssAddrVal=unsbOssAddr.value;
			unsbOssAddrAudio.src=unsbOssAddrVal;
		}
		var suggest1=document.getElementById("suggest1");
		console.log(suggest1);
		suggest1.onclick=function(){
			suggest1.value='';
		}
	}
</script>
</html>