<?php
require_once '../include.php';
//用来验证用户有没有登录
checkLogined();
$artId=$_REQUEST['artId'];
$sql="select * from articleinfo where artId=".$artId;
$row=fetchOne($sql);
$onerow=$row['artContent'];
// $COMPRESS_CONTENT=@hex2bin($onerow["COMPRESS_CONTENT"]);
// print_r($COMPRESS_CONTENT);


?>
<!DOCTYPE html>
<html>
<head>
	<title>预览</title>
</head>
<body>
<?php
echo $onerow;
?>
</body>
</html>