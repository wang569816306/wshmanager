<?php
header("Content-Type: text/html;charset=utf-8"); 
require_once __DIR__ . '/autoload.php';
require_once __DIR__ . '/al-confing.php';

use OSS\OssClient;
use OSS\Core\OssException;

echo "<br/>";
$paths =  "E:\\驱动\\xxx.txt";
echo $paths;
echo $bucket;
$object = "ab/xxx.txt";
//$content = "Hello, OSSzzzz!"; // 上传的文件内容

try {
  $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);
  $ossClient->uploadFile($bucket, $object, $paths,  NULL);
  echo "<br/>kkkkkk";
  
} catch (OssException $e) {
    print $e->getMessage();
}

//上传例子在 文件中不起作用
?>
