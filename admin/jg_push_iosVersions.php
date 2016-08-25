<?php
require_once '../include2.php';
checkLogined();
$iosVersions=$_POST['iosVersions'];
if(!empty($iosVersions)){
    // 简单推送示例
    $push_payload = $client->push()
        ->setPlatform(array('ios'))
        ->addAllAudience()
        ->message('message content', array(
                'title' => '版本更新',
                'content_type' => 'text',
                'extras' => array(
                    'identity' => 'VERSION',
                    'version' => $iosVersions
                    
                ),
            ));
    try {
        $response = $push_payload->send();
    }catch (\JPush\Exceptions\APIConnectionException $e) {
        // try something here
        print $e;
    } catch (\JPush\Exceptions\APIRequestException $e) {
        // try something here
        print $e;
    }
    if($response['http_code']=='200'){
        echo "<script>alert('推送成功');</script>";
        echo "<script>window.location='pushCustom.php';</script>";
    }
}else{
    echo "<script>alert('推送失败推送信息不符合版本信息格式');</script>";
    echo "<script>window.location='pushCustom.php';</script>";
}