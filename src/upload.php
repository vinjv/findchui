<?php
/**
 * Created by PhpStorm.
 * User: bokman
 * Date: 2018/7/1
 * Time: 下午10:14
 */

require('./include.php');

//请在此填入AppID与AppKey
$app_id = '1106622245';
$app_key = 'PaIcXsewRzyShjGG';

//设置AppID与AppKey
Configer::setAppInfo($app_id, $app_key);
date_default_timezone_set('Asia/Shanghai');
error_reporting(E_ALL^E_NOTICE);
$targetFolder = '/upload/';
if (!empty($_FILES)) {
    $file_name = iconv("UTF-8","gb2312", $_FILES['file']['name']); //文件名称
    $filenames= explode(".",$file_name);
    $tempFile = $_FILES['file']['tmp_name'];
    $rand = rand(1000, 9999);
    $targetPath = $_SERVER['DOCUMENT_ROOT'] . '/' .ltrim($targetFolder,'/'); //图片存放目录
    $targetFile = rtrim($targetPath,'/') . '/' .time().$rand.".".$filenames[count($filenames)-1]; //图片完整路徑

    // Validate the file type
    $fileTypes = array('jpg', 'jpeg', 'png'); // File extensions
    $fileParts = pathinfo($_FILES['file']['name']);
        if (in_array($fileParts['extension'],$fileTypes)) {
            move_uploaded_file($tempFile,iconv("UTF-8","gb2312", $targetFile));
        }
    // 通用OCR识别
    $image_data = file_get_contents($targetFile);
    $params = array(
        'image' => base64_encode($image_data),
    );
    $response = API::generalocr($params);
//    var_dump($response);
    $arr_json = json_decode($response,true);
//    var_dump($arr_json);
//    echo $arr_json['ret'];
//    echo $arr_json['msg'];
    $arr_json_data = $arr_json['data'];
    $arr_json_items= $arr_json_data['item_list'];
//    var_dump($arr_json_items);
    foreach ($arr_json_items as $value){
        $string = $string.$value['itemstring']."\n";
//        echo $string;
    }
    exit(json_encode(array("code"=>$arr_json['ret'],"msg"=>$arr_json['msg'],"string"=>$string)));
//    exit(json_encode(array("code"=>0,"url"=>$targetFile,"name"=>$file_name)));

    } else {
        echo json_encode(array("code"=>1,"msg"=>"failed"));
    }
?>