<?php
require_once '../include.php';
//用来验证用户有没有登录
checkLogined();
$bookId=$_REQUEST['bookId'];
//查询书籍信息
$sql="select * from bookinfo where bookId=".$bookId;
$row=fetchOne($sql);
$arId=$row['anchorId'];
//通过书籍表主播id关联主播表
$sql_anchorInfo="select * from anchorInfo where arId=".$arId;
$anchorInfoRow=fetchOne($sql_anchorInfo);
//通过书籍表主播id关联嘉宾表
$guestsId=$row['guestsId'];
$sql_anchorInfo2="select * from anchorinfo where arId in (".$guestsId.")";
$anchorInfoRow2=fetchAll($sql_anchorInfo2);

?>
<!DOCTYPE html>
<html>
<head>
	<title>类似手机预览</title>
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
	.content{
		margin-left: 15px;
		margin-top: 10px;
		background-image:url(images/bg_10.png);
		min-height: 872px;
		
	}
	.phone6{
		margin-top: 20px;
		margin: 0 auto;
		width: 392px;
		height: 667px;
		background: #eff3f5;
		overflow-y: scroll;
		border: 1px solid #000;
	}
	.phone6-top{
		width: 100%;
		height: 64px;
	}
	img{
		width: 100%;
		display: block;

	}
	.phone6-book{
		width: 100%;
		height: 192px;
		background: #fff; 
		margin-top: 11px;
		margin-bottom: 7px;

	}
	.phone6-book-left{
		width: 157px;
		float: left;
		height: 100%
	}
	.phone6-book-right{
		width: 218px;
		float: right;
		height: 100%;
		color: #515151;
	}
	.book-img{
		margin-left:10px;
		margin-top: 24px;
		width: 100px;
		height: 148px;
		border-radius: 6px;
	}
	.phone6-book-right h3{
		margin-top: 23px;
		font-size: 16px;
	}
	.phone6-book-right p{
		font-size: 14px;
		margin-top: 16px;
	}
	.phone6-book-right span{
		margin-left: 8px;
	}
	.phone6-content{
		min-height: 25px;

	}
	.phone6-content-read{
		width: 100%;
		min-height: 48px;
	}
	.phone6-content-read img{
		border-bottom: 1px solid #ccc;
	}
	.phone6-content-text{
		min-height: 22px;
		line-height: 24px;
		background: #fff;
		text-indent: 28px;
		padding-left: 11px;
		padding-right: 11px;
		color: #515151;
		padding-top:18px; 
	}
	.phone6-content-recommend{
		margin-left: 34px;
	}
	.speaker{
		float: left;
		width: 133px;
		min-height: 173px;
		background: #fff;
	}
	.speaker-introduce{
		width: 220px;
		float: right;
		min-height: 173px;
		background: #fff;
	}
</style>
<body>
<div class="header">
	<center>
		模拟手机预览
	</center>
</div>
<div class="content">
	<div class="phone6 clearfix">
		<div class="phone6-top">
			<img src="images/p6-header.png">
		</div>
		<div class="phone6-book">
			<div class="phone6-book-left">
				<div class="book-img">
					<img src="<?php echo $row['coverOssAddr'];?>"/>
				</div>
			</div>
			<div class="phone6-book-right">
				<h3>《<?php echo $row['bookTitle'];?>》</h3>
				<p>作者：<span><?php echo $row['bookAuthor'];?></span></p>
				<p>
				标签:<span><?php echo $row['bookDoelgroep'];?></span>
				</p>
				<p>出版日期：<?php echo substr($row['bookPubDate'],0,10);?></p>
				<p>出版社：<?php echo $row['bookPress'];?></p>
			</div>
		</div>
		<div class="phone6-content">
		<!--音频解读-->
			<div class="phone6-content-read">
				<img src="images/phone6-content-read.png">
				<div class="phone6-content-text">
					<?php echo $row['bookIntro'];?>
				</div>
			</div>
		<!--推荐理由-->
			<div class="phone6-content-read">
				<img src="images/phone6-content-recommend.png">
				<div class="phone6-content-text">
					<?php
						$arrayList = explode("/",$row['bookRecomd']);
						foreach ($arrayList as $key => $value) :
					?>
				<p> 
					<?php 
						print_r(($key+1).". ".$value) ;
					?>
					
				</p>

				<?php endforeach;	?>
					
				</div>
			</div>
		<!--精美文摘-->
			<div class="phone6-content-read">
				<img src="images/phone6-content-text.png">
				<div class="phone6-content-text">
					<?php echo $row['elegantExcerpt'];?>
				</div>
			</div>
		<!--主讲嘉宾-->
			<div class="phone6-content-read">
				<img src="images/phone6-content-speaker.png">
				<div class="phone6-content-text" style="padding:0;">
					<div class="speaker">
						<img style="width:100px;height:100px;border-radius:50%;background:gray;display:block;margin:0 auto;margin-top:27px;" src="<?php echo $anchorInfoRow['arOssHeadPic'];?>">
					</div>
					<div class="speaker-introduce" style="width:242px">
						<h4 style="margin-top:20px;text-indent:0px;font-size:16px;"><?php echo $anchorInfoRow['arName'];?></h4>
						<h5 style="margin-top:4px;text-indent:0px;font-size:16px;"><?php echo $anchorInfoRow['arIdentity'];?></h5>
						<span style="margin-top:4px;text-indent:0px;font-size:14px;">简介：<?php echo $anchorInfoRow['arIntro'];?></span>
					</div>
				</div>
			</div>
		<!--特邀嘉宾-->
		<?php  
			foreach ($anchorInfoRow2 as $key => $value):
		?>
			<div class="phone6-content-read">
				<img src="images/phone6-content-guest.png">
				<div class="phone6-content-text" style="padding:0;">
					<div class="speaker">
						<img style="width:100px;height:100px;border-radius:50%;background:gray;display:block;margin:0 auto;margin-top:27px;" src="<?php echo $value['arOssHeadPic'];?>">
					</div>
					<div class="speaker-introduce" style="width:242px">
						<h4 style="margin-top:20px;text-indent:0px;font-size:16px;"><?php echo $value['arName'];?></h4>
						<h5 style="margin-top:4px;text-indent:0px;font-size:16px;"><?php echo $value['arIdentity'];?></h5>
						<span style="margin-top:4px;text-indent:0px;font-size:14px;">简介：<?php echo $value['arIntro'];?></span>
					</div>
				</div>
			</div>
			<?php endforeach; ?> 
<!---->
		</div>
	</div>
</div>
</body>
</html>