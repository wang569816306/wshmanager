<?php
require_once '../include.php';
//用来验证用户有没有登录
checkLogined();
// 通过 post获取要修改的属性
// 将上传的图片存到oss
use OSS\OssClient;
use OSS\Core\OssException;
//获取oss的图片地址并存入数据库中
$url='http://bookclub-test.oss-cn-beijing.aliyuncs.com/bgmPicOssAddr/';
//将书的封面图片上传到oss
if ($_FILES["coverOssAddr"]["error"] > 0) {
	}else {
	$paths =  $_FILES["coverOssAddr"]["tmp_name"];
	$object = "coverOssAddr/".$_FILES["coverOssAddr"]["name"];
	try {
	  $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);
	  $ossClient->uploadFile($bucket, $object, $paths,  NULL);
	  $coverOssAddr=$url.$_FILES["coverOssAddr"]["name"];//头像地址
	} catch (OssException $e) {
	    print $e->getMessage();
	}

}
//将书籍播放器背景图片上传到oss
if ($_FILES["bgmPicOssAddr"]["error"] > 0) {
	}else {
	$paths =  $_FILES["bgmPicOssAddr"]["tmp_name"];
	$object = "bgmPicOssAddr/".$_FILES["bgmPicOssAddr"]["name"];
	try {
	  $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);
	  $ossClient->uploadFile($bucket, $object, $paths,  NULL);
	  $bgmPicOssAddr=$url.$_FILES["bgmPicOssAddr"]["name"];//书籍播放器背景图片
	} catch (OssException $e) {
	    print $e->getMessage();
	}

}
//获取文本框的值
//必填数据
$bookTitle=$_POST['bookTitle'];//书名varchar
$bookAuthor=$_POST['bookAuthor'];//书作者varchar
$unsbPrices=$_POST['unsbPrices'];//单本解读价格int
$unsbTimeSpan=$_POST['unsbTimeSpan'];//音频解读时长time
$unsbPeriods=$_POST['unsbPeriods'];//解读期数int
$bookstatus=$_POST['bookstatus'];//书籍状态varchar
$anchorId=$_POST['anchorId'];//主播老师IDint
//非必填数据
$bookPubDate=$_POST['bookPubDate'];//书籍出版日期datetime
$bookPress=$_POST['bookPress'];//出版社varchar
$bookPrices=$_POST['bookPrices'];//实体书价格int
$bookIntro=$_POST['bookIntro'];//书籍前言varchar
$unsbIntro=$_POST['unsbIntro'];//音频解读varchar
$bookDoelgroep=$_POST['bookDoelgroep'];//书籍适应人群varcher
$bookLabel=$_POST['bookLabel'];//书籍标签varchar
$guestsId=$_POST['guestsId'];//嘉宾id列表varchar
$bookRecomd=$_POST['bookRecomd'];//推荐理由varchar
$elegantExcerpt=$_POST['elegantExcerpt'];//精美文摘varchar
$createdTime=$_POST['createdTime'];//创建时间datetime

$params=array();
$params['bookTitle']=$bookTitle;
$params['bookAuthor']=$bookAuthor;
$params['unsbPrices']=$unsbPrices;
$params['unsbTimeSpan']=$unsbTimeSpan;
$params['unsbPeriods']=$unsbPeriods;
$params['bookstatus']=$bookstatus;
$params['anchorId']=$anchorId;
$params['bookPubDate']=$bookPubDate;
$params['bookPress']=$bookPress;
$params['bookIntro']=$bookIntro;
$params['unsbIntro']=$unsbIntro;
$params['bookLabel']=$bookLabel;
$params['guestsId']=$guestsId;
$params['bookRecomd']=$bookRecomd;
$params['elegantExcerpt']=$elegantExcerpt;
$params['createdTime']=$createdTime;

if(!empty($coverOssAddr)){
	$params['coverOssAddr']=$coverOssAddr;
}

if(!empty($bookPubDate)){
	$params['bgmPicOssAddr']=$bgmPicOssAddr;
}

if(!empty($bookPubDate)){
	$params['bookPubDate']=$bookPubDate;
}
if(!empty($bookPress)){
	$params['bookPress']=$bookPress;
}
if(!empty($bookPrices)){
	$params['bookPrices']=$bookPrices;
}
if(!empty($bookIntro)){
	$params['bookIntro']=$bookIntro;
}
if(!empty($unsbIntro)){
	$params['unsbIntro']=$unsbIntro;
}
if(!empty($bookDoelgroep)){
	$params['bookDoelgroep']=$bookDoelgroep;
}
if(!empty($bookLabel)){
	$params['bookLabel']=$bookLabel;
}
if(!empty($guestsId)){
	$params['guestsId']=$guestsId;
}
if(!empty($bookRecomd)){
	$params['bookRecomd']=$bookRecomd;
}
if(!empty($elegantExcerpt)){
	$params['elegantExcerpt']=$elegantExcerpt;
}
if(!empty($createdTime)){
	$params['createdTime']=$createdTime;
}
//根据条件拼接sql
$colums="";
$values="";
$i=0;
foreach ($params as $key=>$value){
	if($i>0){
		$colums=$colums.",";	
		$values=$values.",";
	}
	$colums=$colums.$key;
	if(is_numeric($value)){
	    $values=$values.$value;
	}else{
		$values=$values."'".$value."'";
	}
	
	$i++;
}
//根据条件去更新数据
$bookId=$_POST['bookId'];
update(bookinfo,$params,bookId,$bookId);
alertMes("数据修改成功请查看","bookInfoModify.php");