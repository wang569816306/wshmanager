<?php
require_once '../include2.php';
checkLogined();
$nickName=$_POST['nickName'];
$sql='select * from userinfo where nickName = '."'".$nickName."'";
$row=fetchOne($sql);
$id=$row['id'];

if(!empty($id)){
    // 简单推送示例
    try {
    $response = $client->push()
        ->setPlatform(array('ios', 'android'))
        //->addAlias("'".$id."'")
        ->addAllAudience("'".$id."'")
        ->iosNotification('推广收入', array(
            'sound' => 'default',
            'badge' => 2,
            'content-available' => true,
            'category' => 'jiguang',
            'extras' => array(
                'identity' => 'WBCHANGE-INCOME',
            ),
        ))
        ->androidNotification('推广收入', array(
            'title' => 'hello jpush',
            'build_id' => 2,
            'extras' => array(
                'identity' => 'WBCHANGE-INCOME',
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
        echo "<script>window.location='push_SingleMessage.php';</script>";
    }
}else{
    echo "<script>alert('推送失败推送信息不符合版本信息格式');</script>";
    echo "<script>window.location='push_SingleMessage.php';</script>";
}