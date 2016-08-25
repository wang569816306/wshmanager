<?php
require_once '../include2.php';
checkLogined();
// 简单推送示例
$push_payload = $client->push()
    ->setPlatform(array('ios'))
    ->addAllAudience()
    ->message('message content', array(
            'title' => '打分',
            'content_type' => 'text',
            'extras' => array(
                'identity' => 'MARKING',    
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