<?php
require_once '../include2.php';
checkLogined();
$bookTitle=$_POST['bookTitle'];
$sql='select * from bookinfo where bookTitle = '."'".$bookTitle."'";
$row=fetchOne($sql);
$bookId=$row['bookId'];
if(!empty($bookId)){
    // 简单推送示例
    try {
    $response = $client->push()
        ->setPlatform(array('ios', 'android'))
        ->addAllAudience()
        ->iosNotification('新书速递', array(
            'sound' => 'default',
            'badge' => 2,
            'content-available' => true,
            'category' => 'jiguang',
            'extras' => array(
                'identity' => 'NEW-BOOK',
                'bookID' => $bookId
            ),
        ))
        ->androidNotification('新书速递', array(
            'title' => 'hello jpush',
            'build_id' => 2,
            'extras' => array(
                'identity' => 'NEW-BOOK',
                'bookID' => $bookId
            ),
        ))
        ->options(array(
            'apns_production' => 0,
        ))
        ->send();
} catch (\JPush\Exceptions\APIConnectionException $e) {
    // try something here
    print $e;
} catch (\JPush\Exceptions\APIRequestException $e) {
    // try something here
    print $e;
}
    if($response['http_code']=='200'){
        echo "<script>alert('推送成功');</script>";
        echo "<script>window.location='push_AllMessage.php';</script>";
    }
}else{
    echo "<script>alert('推送失败推送信息不符合版本信息格式');</script>";
    echo "<script>window.location='push_AllMessage.php';</script>";
}



?>