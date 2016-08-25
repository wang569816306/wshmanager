<?php
require_once '../include.php';
//用来验证用户有没有登录
checkLogined();
$bookId=$_POST['bookId'];
$bookTitle=$_POST['bookTitle'];
$bookAuthor=$_POST['bookAuthor'];
//上架书籍
$putawayId=$_REQUEST['putawayId'];
//通过获取的id修改数据库书籍为上架状态状态
oneUpdate('bookinfo','2',$putawayId);
$outId=$_REQUEST['outId'];
//通过获取的id修改数据库书籍为下架状态状态
oneUpdate('bookinfo','1',$outId);
$sql="select * from bookinfo ";
$quStr=""; //拼装条件；
$queryStr="";//分页所需要的参数
//查询数据判读
if(!empty($bookId)){
    $queryStr=$queryStr." bookId = ".$bookId;
    $quStr = $quStr." bookId ="."'$bookId' ";
}
if(!empty($bookTitle)){
    $queryStr=$queryStr." bookTitle = ".$bookTitle;
    if(!empty($quStr)){
        $quStr = $quStr." or "." bookTitle LIKE"."'%$bookTitle%'";
    }else{
        $quStr = $quStr." bookTitle LIKE "."'%$bookTitle%'";
    }
}
if(!empty($bookAuthor)){
    $queryStr=$queryStr." bookAuthor = ".$bookAuthor;
    if(!empty($quStr)){
        $quStr = $quStr." or "." bookAuthor LIKE"."'%$bookAuthor%'";
    }else{
        $quStr = $quStr." bookAuthor LIKE "."'%$bookAuthor%'";
    }
}
//只要有条件，就拼接，否则就不拼接
if ($quStr!='') {
    $sql = $sql." where " .$quStr;
}
$row=allFeedBack($sql);
$rows=pageSql($row,$sql,9);

?>
<!DOCTYPE html>
<html>
<head>
<title>书籍添加</title>
<link rel="stylesheet" type="text/css" href="css/Iframe.css" />
<link rel="stylesheet" href="utilLib/bootstrap.min.css" type="text/css" media="screen" />
</head>
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
    <form method="post" action="bookInfoModify.php">
    <center>
        <ul class="cx clearfix">
            <li><div><span>书籍id:</span><input type="value" name="bookId" value="<?php echo $_REQUEST['bookId'];?>"></div></li>
            <li><div><span>书名:</span><input type="value" name="bookTitle" value="<?php echo $_REQUEST['bookTitle'];?>"></div></li>
            <li><div><span>作者:</span><input type="value" name="bookAuthor" value="<?php echo $_REQUEST['bookAuthor'];?>"></div></li>
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
            <td width="21%">书名</td>
            <td width="10%">封面</td>
            <td width="15%">作者</td>
            <td width="12%">书籍状态</td>      
            <td width="10%">单本解读价格</td>
            <td width="18%">操作</td>    
        </tr>
        <?php
            if(empty($rows)){
                echo "暂无此查询结果";
            }
         ?>
         <?php foreach ($rows as $key => $value):?> 
        <tr>
            <td width="8%"><?php echo $value['bookId'];?></td>
            <td width="21%"><?php echo $value['bookTitle'];?></td>
            <td style="height:60px" width="10%">
                <img style="width:60px;height:60px;" src="<?php echo $value['coverOssAddr'];?>"/>
            </td>
            <td width="15%"><?php echo $value['bookAuthor'];?></td>
            <td width="12%">
                <?php
                    //根据状态显示上架未上架信息
                    if($value['bookstatus']==2){
                        echo "已上架";
                    }else if($value['bookstatus']==1){
                        echo "待上架";
                    }else if($value['bookstatus']==0){
                        echo "创建";
                    }else{
                        echo "删除";
                    }
                ?>
            </td>
            <td width="10%"><?php echo $value['unsbPrices'];?></td>
            <td width="18%">
                <input class="bj_btn" type="button" onclick="editBookInfo(<?php echo $value['bookId'];?>)" value="修改" />
                <input class="sj_btn" type="button" onclick="putawayBookInfo(<?php echo $value['bookId'];?>)"  value="上架" />
                <input class="del_btn" type="button" onclick="outBookInfo(<?php echo $value['bookId'];?>)" value="下架" />
                <input class="pvw_btn" type="button" onclick="pvwBookInfo(<?php echo $value['bookId'];?>)" value="预览" />
            </td>
        </tr>
        <?php endforeach;?>
        <?php if($rows>$pageSize):?>
            <tr><td colspan="4"><?php echo showPage($page,$totalPage,$queryStr);?></td></tr>
        <?php endif;?> 
    </table>
</div>
</body>
<script type="text/javascript">
    function putawayBookInfo(putawayId){
        window.location="bookInfoModify.php?putawayId="+putawayId;
     }
     function outBookInfo(outId){
        window.location="bookInfoModify.php?outId="+outId;
     }
     function editBookInfo(bookId){
        window.location="editBookInfo.php?bookId="+bookId;
     }
     function pvwBookInfo(bookId){
        window.location="pvwBookInfo.php?bookId="+bookId;
     }
</script>
</html>





