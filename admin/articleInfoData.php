<?php
require_once '../include.php';
//将上传的图片存到oss
checkLogined();
$artType='1';
$mgId=$_SESSION['adminId'];//管理员id
$bookTitle=$_POST['bookTitle'];//书名varchar
$bookInfoSql='select * from bookInfo where bookTitle = '."'".$bookTitle."'";
$bookId=fetchOne($bookInfoSql)['bookId'];//书籍id
$bookstatus=fetchOne($bookInfoSql)['bookstatus'];//书籍状态2上架
$artPreread=$_POST['artPreread'];//文章内容导读
$artContent=$_POST['artContent'];//文章内容varchar
// print_r($artContent);
// $COMPRESS_CONTENT = bin2hex(gzcompress($artContent));//最终存入数据库的内容。
// print_r($COMPRESS_CONTENT);
$unsbOssAddr=$_POST['unsbOssAddr'];//音频解读地址varchar
$createTime=date('Y-m-d', time());
$artStatus='1';
$sql = "insert into articleinfo (artType,unsbOssAddr,artContent,createTime,mgId,artStatus,bookId,artPreread) values ('".$artType."','".$unsbOssAddr."','".$artContent."',".$createTime.",".$mgId.",".$artStatus.",".$bookId.",'".$artPreread."')";
if($bookstatus==1){
	@mysql_query($sql);
	alertMes("插入成功","articleInfo.php");
}else{
	alertMes("插入失败重新插入","articleInfo.php");
}

?>