<?php
require_once '../include.php';
//用来验证用户有没有登录
checkLogined();
?>
<!DOCTYPE html>
<html>
<head>
	<title>添加书籍</title>
	<meta charset="utf-8">
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
	.cx{width: 100%;list-style: none;height: 80px;}
	.cx li{width: 25%;height: 80px;float: left;color: #fff;display: block;}
	.cx li div{margin-top: 25px}
	.clearfix:after {
	    content:".";
	    display:block;
	    height:0;
	    visibility:hidden;
	    clear:both; 
	}
	.main{
		margin-left: 15px;
		margin-top: 10px;
		background-image:url(images/bg_10.png);
		min-height: 872px;
		
	}
	.add1{
		margin-left: 50px;
		margin-right: 50px;
	}
	.allBookAdd{
		border:1px solid #ccc;
		width: 500px;
		height: 848px;
		background: #fff;
		padding-left: 10px;
		padding-right: 10px;
		float: left;
	}
	.bookAdd1{
		height: 210px;
	}
	.bookAdd1 p{
		margin-right: 162px;
		margin-top: 10px;
		float: right;

	}
	.bookAdd1 p input{
		border:1px solid #0c89ff;
	}

	.bookAdd2{
		height: 200px;
	}
	.bookAdd2Img{
		width: 200px;
		height: 100%;
		float: left;
	}
	.bookAdd2Img i{
		width: 160px;
		height: 99%;
		display: block;
		margin-left: 80px;
		border:1px solid #0c89ff;
	}
	.bookAdd2cot{
		float: left
	}
	.bookAdd2cot input{
		border:0;
		width: 172px;
		margin: 64px;
		background: #0c89ff;
		text-align: center;
		color: #fff;
	}
	textarea{
		width: 100%;
	    height: 272px;
	    color: #000;
	    font-size: 16px;
	    resize:none;
	    outline:none;
	    margin-top: 10px;
	    border:1px solid #0c89ff;
	}
	.bookAdd3{
		height: 310px;

	}
	.bookAdd3 p{
		color: #0c89ff;
	}

	.bookAdd4{
		height: 30px;

	}
	.bookAdd4 input{
		border: 1px solid #0c89ff;

	}
	.button button{
		width: 200px;
		height: 50px;
		margin-top: 34px;
		color: #fff;
		background: #0c89ff;
		border:0;
	}
	img{
		width: 100%;
		display: block;
		height: 100%;
	}
</style>
<body>
<div class="header">
	<center>
		添加书籍
	</center>
</div>
<div class="main">
<!--enctype="multipart/form-data"可以正常向oss提交图片-->
	<form method="post" action="" enctype="multipart/form-data" id="from">
		<div class="allBookAdd add1">
			<h3>书籍基础信息<span style="color:red">*</span>：</h3>
			<div class="bookAdd1">
				<p>书名：<input type="text" name="bookTitle" class="cot" value=""></p>
				<p>作者：<input type="text" name="bookAuthor" value=""></p>
				<p>单本解读价格：<input type="number" name="unsbPrices" class="cot" value=""></p>
				<p>音频解读时长：<input type="text" name="unsbTimeSpan" class="cot" value=""></p>
				<p>解读期数：<input type="number" name="unsbPeriods" class="cot" value=""></p>
				<p>书籍状态<input type="text" name="bookstatus" class="cot" value=""></p>
				<p>主播老师ID：<input type="number" name="anchorId" class="cot" value=""></p>
			</div>
			<h3>书籍封面<span style="color:red">*</span>：</h3>
			<div class="bookAdd2">
				<div class="bookAdd2Img">
					<i id="fileImg1"></i>
				</div>
				<div class="bookAdd2cot">
					<input id="file1" name="coverOssAddr" type="file" accept="image/png,image/jpg" value="选择图片">
				</div>
			</div>
			<h3>书籍播放器背景图片<span style="color:red">*</span>：</h3>
			<div class="bookAdd2">
				<div class="bookAdd2Img">
					<i id="fileImg2"></i>
				</div>
				<div class="bookAdd2cot">
					<input id="file2" type="file" accept="image/png,image/jpg" name="bgmPicOssAddr" value="选择图片">
				</div>
			</div>
			<h3>书籍适应人群（不超过5个）：</h3>
			<div class="bookAdd4">
				<input type="text" name="bookDoelgroep" value="">
			</div>
			<h3>书籍标签（不超过5个）：</h3>
			<div class="bookAdd4">
				<input type="text" name="bookLabel" value="">
			</div>
		</div>
		<div class="allBookAdd">
			<h3>书籍基础信息：</h3>
			<div class="bookAdd1" style="height:154px">
				<p>书籍出版日期：<input type="date" name="bookPubDate" style="width:169px;height:15px" value="null"></p>
				<p>出版社：<input type="text" name="bookPress" value=""></p>
				<p>实体书价：<input type="number" name="bookPrices" value="null"></p>
				<p>嘉宾ID：<input type="number" name="guestsId" value="null"></p>
				<p>创建时间：<input type="date" name="createdTime"  style="width:169px;height:15px" value="null"></p>
			</div>
			<h3>书籍前言:</h3>
			<div class="bookAdd3" style="height:144px">
				<textarea  name="bookIntro" id="suggest" class="suggest1" style="height:104px" value="null"></textarea>
				<p><span>500</span>个字，现在剩余<span id="word">500</span></p>
			</div>
			<h3>音频解读(音频内容):</h3>
			<div class="bookAdd3" style="height:144px">
				<textarea name="unsbIntro" id="suggest" class="suggest2" style="height:104px" value="null"></textarea>
				<p><span>500</span>个字，现在剩余<span id="word">500</span></p>
			</div>
			<h3>推荐理由:</h3>
			<div class="bookAdd3" style="height:144px">
				<textarea name="bookRecomd" id="suggest" class="suggest3" style="height:104px" value="null"></textarea>
				<p><span>500</span>个字，现在剩余<span id="word">500</span></p>
			</div>
			<h3>精美文摘:</h3>
			<div class="bookAdd3" style="height:144px;border:none">
				<textarea  name="elegantExcerpt" id="suggest" class="suggest4" style="height:104px" value="null"></textarea>
				<p><span>500</span>个字，现在剩余<span id="word">500</span></p>
			</div>
		</div>
		<div class="button" style="float:left;margin-left:50px;width:200px;height:200px;margin-top:300px;">
				<button class="save">保存</button>
				<button style="background:red" onclick="reset()">重置</button>
		</div>
	</form>
</div>
</body>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
	$(function(){
		$(".suggest1").on("click",function(){
		  	$(".suggest1").html("")
		  	$(".suggest1").css({"color":"#000","font-size":"18px"});
		});
		$(".suggest2").on("click",function(){
		  	$(".suggest2").html("")
		  	$(".suggest2").css({"color":"#000","font-size":"18px"});
		});
		$(".suggest3").on("click",function(){
		  	$(".suggest3").html("")
		  	$(".suggest3").css({"color":"#000","font-size":"18px"});
		});
		$(".suggest4").on("click",function(){
		  	$(".suggest4").html("")
		  	$(".suggest4").css({"color":"#000","font-size":"18px"});
		});
		//限制文本框字数
		  $("#suggest").keyup(function(){
			   var len = $(this).val().length;
			   if(len > 499){
			    $(this).val($(this).val().substring(0,499));
			   }
			   var num = 500 - len;
			   $("#word").text(num);
		 });

		  $("#file1").change(function(){
		  	var fileImg1=getObjectURL(this.files[0]);
		  //	console.log(fileImg1);
		  	// var coverOssAddr=$("#file1").val();
		  	// var bgmPicOssAddr=$("#file2").val();
		  // 	console.log(coverOssAddr);
		  	$("#fileImg1").prepend("<img src='"+fileImg1+"'/>");
		  // 	//通过ajax向ossFile传递图片信息
		  // 	$.ajax({
		  // 		cache:false,
				// async:true,
		  // 		url:"http://localhost/admin/bookInfoAddData.php",
		  // 		type:'post',
		  // 		traditional:true,
		  // 		data:{'coverOssAddr':coverOssAddr,"bgmPicOssAddr":bgmPicOssAddr},
		  // 		error:function(){
				// 	alert("不行啊");
				// },
		  // 		success:function(data){
		  // 			alert(data);
    //         		}
		  // 	});
		  // 	//window.location.href = 'http://localhost/admin/ossFile.php';

		  });
		  $("#file2").change(function(){
		  	var fileImg1=getObjectURL(this.files[0]);
		  	$("#fileImg2").prepend("<img src='"+fileImg1+"'/>");
		  });
		  //点击提交按钮时判断是否将必选的填好
		  $(".save").click(function(){
		  	if($(".cot").val()==''){
		  		alert("左边为必选项不能为空");
		  	}else{
		  		$("#from").attr("action", "bookInfoAddData.php");
		  	}
		  });
		  //建立一個可存取到該file的url
			function getObjectURL(file) {
			  var url = null ;
			  if (window.createObjectURL!=undefined) { // basic
			    url = window.createObjectURL(file) ;
			  } else if (window.URL!=undefined) { // mozilla(firefox)
			    url = window.URL.createObjectURL(file) ;
			  } else if (window.webkitURL!=undefined) { // webkit or chrome
			    url = window.webkitURL.createObjectURL(file) ;
			  }
			  return url ;
			}
			function reset(){
				window.location="bookInfoAdd.php";
			}
	});
	
	
</script>
</html>