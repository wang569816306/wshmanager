<?php
require_once '../include.php';
checkLogined();
$artId=$_REQUEST['artId'];
$sql="select * from articleinfo where artId = ".$artId;
$row=fetchOne($sql);
$artPreread=$_POST['artPreread'];//文章导读varchar
$artContent=$_POST['artContent'];//文章varchar
$artId=$_POST['artId'];
if(!empty($artPreread)&&!empty($artContent)){
	$sql="update articleinfo set artPreread = '".$artPreread."', artContent  = '".$artContent."' where artId = ".$artId;
	@mysql_query($sql);
	alertMes("数据修改成功请查看","articleinfoModify.php");
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>修改</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <script type="text/javascript" charset="utf-8" src="utf8-php/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="utf8-php/ueditor.all.min.js"> </script>
</head>
<body>
<form method="post" action="editArticleInfo.php">
	文章导读修改：<br/>
	<input type="text" name="artId" style="display:none" value="<?php echo $row['artId'];?>">
	<textarea  name="artPreread"  style="height:104px;width:800px" value="null">
		<?php
			echo $row['artPreread'];
		?>
	</textarea>
	<br/>
	文章修改：<br/>
	<script id="editor" type="text/plain" style="width:1400px;height:500px;" name="artContent">
		<?php
			echo $row['artContent'];
		?>
	</script>
	<script type="text/javascript">
	    //实例化编辑器
	    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
	    var ue = UE.getEditor('editor');
	    UE.getEditor('editor').setHeight(500);
	</script>
	<button type="submit">修改</button>
</form>
</body>
</html>