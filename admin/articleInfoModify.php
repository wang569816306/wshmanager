<?php
require_once '../include.php';
//用来验证用户有没有登录
checkLogined();
$bookId=$_POST['bookId'];
$artStatus=$_POST['artStatus'];
$mgId=$_POST['mgId'];

$putawayId=$_REQUEST['putawayId'];
//通过获取的id修改数据库书籍为上架状态状态
oneUpdateArticle('articleinfo','2',$putawayId);
$outId=$_REQUEST['outId'];
//通过获取的id修改数据库书籍为下架状态状态
oneUpdateArticle('articleinfo','3',$outId);

$sql="select * from articleinfo ";
if($artStatus=='上架'){
	$artStatus='2';
}if($artStatus=='未上架'){
	$artStatus='3';
}
$quStr=""; //拼装条件；
$queryStr="";//分页所需要的参数
//查询数据判读
if(!empty($bookId)){
    $queryStr=$queryStr." bookId = ".$bookId;
    $quStr = $quStr." bookId = ".$bookId;
}
if(!empty($artStatus)){
    $queryStr=$queryStr." artStatus = "."'".$artStatus."'";
    if(!empty($quStr)){
        $quStr = $quStr." or "." artStatus = "."'".$artStatus."'";
    }else{
        $quStr = $quStr." artStatus = ".$artStatus;
    }
}
if(!empty($mgId)){
    $queryStr=$queryStr." mgId = ".$mgId;
    if(!empty($quStr)){
        $quStr = $quStr." or "." mgId = ".$mgId;
    }else{
        $quStr = $quStr." mgId = ".$mgId;
    }
}
//只要有条件，就拼接，否则就不拼接
if ($quStr!='') {
    $sql = $sql." where " .$quStr;
}
$row=allFeedBack($sql);
$rows=pageSql($row,$sql,8);

?>
<!DOCTYPE html>
<html>
<head>
	<title>文章查询</title>
	<meta charset="utf-8">
</head>
<link rel="stylesheet" type="text/css" href="css/Iframe.css" />
<link rel="stylesheet" href="utilLib/bootstrap.min.css" type="text/css" media="screen" />
<style type="text/css">
	 *{margin: 0;padding: 0}
    .header{
        width:100%;
        height:80px;
        background:#222;
    }
    .cx{width: 100%;list-style: none;height: 80px;}
    .cx li{width: 25%;height: 80px;float: left;color: #fff;display: block;}
    .cx li div{margin-top: 25px}
    input{color:#000;}
    .clearfix:after {
        content:".";
        display:block;
        height:0;
        visibility:hidden;
        clear:both; 
    }
    .btn{height: 30px;width: 50px;margin-top: 22px}
</style>
<body>
<div class="header">
    <form method="post" action="articleInfoModify.php">
	    <center>
	        <ul class="cx clearfix">
	            <li><div><span>书id:</span><input type="value" name="bookId" value="<?php echo $bookId?>"></div></li>
	            <li><div><span>书籍状态:</span><input type="value" name="artStatus" value="<?php echo $bookId?>"></div></li>
	            <li><div><span>创建人id:</span><input type="value" name="mgId" value="<?php echo $bookId?>"></div></li>
	            <button class="btn" type="submit">查询</button>
	        </ul>
	    </center>
    </form>
 </div>
 <span class="cp_title">书籍管理</span>
	<div class="table_con">
	    <table>
	        <tr class="tb_title">
	            <td width="8%">书籍ID</td>
	            <td width="8%">文章ID</td>
	            <td width="8%">管理员ID</td>
	            <td width="20%">解读音频Oss地址</td>
	            <td width="27%">文稿内容导读</td>
	            <td width="8%">文章状态</td>
	            <td width="20%">操作</td>    
	        </tr>
	        <?php
	            if(empty($rows)){
	                echo "暂无此查询结果";
	            }
         	?>
	        <?php foreach ($rows as $key => $value):?> 
	        	<tr>
	        		<td width="8%"><?php echo $value['bookId'];?></td>
	        		<td width="8%"><?php echo $value['artId'];?></td>
	        		<td width="8%"><?php echo $value['mgId'];?></td>
	        		<td width="20%" style="overflow:hidden"><?php echo $value['unsbOssAddr'];?></td>
	        		<td width="27%" style="overflow:hidden"><?php echo $value['artPreread'];?></td>
	        		<td width="8%">	
	        		<?php
	        			if($value['artStatus']==2){
	        				echo "发布";
	        			}else if($value['artStatus']==3){
	        				echo "下架";
	        			}
	        		?>	
	        		</td>
	        		<td width="20%">
	        			<input class="bj_btn" type="button" onclick="editArticle(<?php echo $value['artId'];?>)" value="修改" />
		                <input class="sj_btn" type="button" onclick="putawayArticle(<?php echo $value['artId'];?>)"  value="上架" />
		                <input class="del_btn" type="button" onclick="outArticle(<?php echo $value['artId'];?>)" value="下架" />
		                <input class="pvw_btn" type="button" onclick="pvwArticle(<?php echo $value['artId'];?>)" value="预览" />
	        		</td>
	        	</tr>
	        <?php endforeach?>
	        <?php if($rows>$pageSize):?>
	            <tr><td colspan="4"><?php echo showPage($page,$totalPage,$queryStr);?></td></tr>
	        <?php endif;?> 
	    </table>
	</div>
</body>
<script type="text/javascript">
    function editArticle(artId){
    	window.location="editArticleInfo.php?artId="+artId;
     }
     
     function putawayArticle(putawayId){
        window.location="articleInfoModify.php?putawayId="+putawayId;
     }
     function outArticle(outId){
        window.location="articleInfoModify.php?outId="+outId;
     }
     function pvwArticle(artId){
        window.location="pvwArticle.php?artId="+artId;
     }
</script>
</html>