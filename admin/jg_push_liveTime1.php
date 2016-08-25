<?php
require_once '../include2.php';
checkLogined();
$liveTime1=$_POST['liveTime1'];
$payload = $client->push()
    ->setPlatform(array('ios', 'android'))
    ->addAllAudience()
    ->iosNotification('可以进直播间聊天了', array(
            'sound' => 'default',
            'badge' => 2,
            'content-available' => true,
            'category' => 'jiguang',
            'extras' => array(
                'identity' => 'LIVE-TIME',
            ),
        ))
     ->androidNotification('可以进直播间聊天了', array(
            'title' => 'hello jpush',
            'build_id' => 2,
            'extras' => array(
                'identity' => 'LIVE-TIME',
            ),
        ))
    ->options(array(
	    'apns_production' => 0,
	        ))
    ->build();
// 创建一个2016-12-22 13:45:00触发的定时任务
$response = $client->schedule()->createSingleSchedule("每周三8点开始直播", $payload, array("time"=>$liveTime1));
	
if($response['http_code']=='200'){
        echo "<script>alert('推送成功');</script>";
        echo "<script>window.location='push_AllMessage.php';</script>";
    }
?>