<?php
require_once '../include.php';
//将上传的图片存到oss
use OSS\OssClient;
use OSS\Core\OssException;
//获取oss的图片地址并存入数据库中
$url='http://bookclub-test.oss-cn-beijing.aliyuncs.com/bgmPicOssAddr/';
//将书的封面图片上传到oss
if ($_FILES["coverOssAddr"]["error"] > 0) {
	//echo "Error: " . $_FILES["coverOssAddr"]["error"] . "<br />"; //由表单file input的到$_FILES的值
	}else {
	// echo "Upload: " . $_FILES["coverOssAddr"]["name"] . "<br />";
	// echo "Type: " . $_FILES["coverOssAddr"]["type"] . "<br />";
	// echo "Size: " . ($_FILES["coverOssAddr"]["size"] / 1024) . " Kb<br />";
	 //echo "Stored in: " . $_FILES["coverOssAddr"]["tmp_name"];
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
	//echo "Error: " . $_FILES["bgmPicOssAddr"]["error"] . "<br />"; //由表单file input的到$_FILES的值
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

//将获取到的数据存往数据库
//必填数据
$bookTitle=$_POST['bookTitle'];//书名varchar
$bookAuthor=$_POST['bookAuthor'];//书作者varchar
$unsbPrices=$_POST['unsbPrices'];//单本解读价格int
$unsbTimeSpan=$_POST['unsbTimeSpan'];//音频解读时长time
$unsbPeriods=$_POST['unsbPeriods'];//解读期数int
$bookstatus=$_POST['bookstatus'];//书籍状态varchar
$anchorId=$_POST['anchorId'];//主播老师IDint

$params=array();
$params['bookTitle']=$bookTitle;
$params['bookAuthor']=$bookAuthor;
$params['unsbPrices']=$unsbPrices;
$params['unsbTimeSpan']=$unsbTimeSpan;
$params['unsbPeriods']=$unsbPeriods;
$params['bookstatus']=$bookstatus;
$params['anchorId']=$anchorId;
$params['coverOssAddr']=$coverOssAddr;
$params['bgmPicOssAddr']=$bgmPicOssAddr;

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

$sql="INSERT into bookinfo ( ".$colums.") values (".$values.")";

//下边这种不能插入int值不存在的情况
// $sql="INSERT into bookinfo (bookTitle,coverOssAddr,bookAuthor,bookPubDate,bookPress,bookPrices,bookIntro,unsbPrices,unsbIntro,unsbTimeSpan,unsbPeriods,bookstatus,bookDoelgroep,bookLabel,guestsId,anchorId,bgmPicOssAddr,createdTime,modifiedTime,bookRecomd,elegantExcerpt,bookFree1,bookFree2,bookFree3) VALUES ('".$bookTitle."','".$coverOssAddr."','".$bookAuthor."',".$bookPubDate.",'".$bookPress."',".$bookPrices.",'".$bookIntro."',".$unsbPrices.",'".$unsbIntro."',".$unsbTimeSpan.",".$unsbPeriods.",'".$bookstatus."','".$bookDoelgroep."','".$bookLabel."','".$guestsId."',".$anchorId.",'".$bgmPicOssAddr."',".$createdTime.",null,'".$bookRecomd."','".$elegantExcerpt."',null,null,null)";
// print_r($sql);
//判断必填字符是否为空
if(!empty($bookTitle)&&!empty($bookAuthor)&&!empty($unsbPrices)&&!empty($unsbTimeSpan)&&!empty($unsbPeriods)&&!empty($bookstatus)&&!empty($anchorId)&&!empty($bgmPicOssAddr)&&!empty($coverOssAddr)){
	@mysql_query($sql);
	alertMes("数据插入成功可以查询数据检查","bookinfoModify.php");
}else{
	alertMes("数据插入失败请检验输入数据","bookinfoAdd.php");
}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<style type="text/css">
	body{
		width: 100%;
		height: 800px;
		background-image:url(images/bg_10.png);
	}
</style>
<body>

</body>
</html>