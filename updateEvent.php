<?php
// CORS
// 設置允許其他域名訪問
header('Access-Control-Allow-Origin:*');  
// 設置允許的響應類型 
header('Access-Control-Allow-Methods:POST, GET');  
//設置允許的響應頭 
header('Access-Control-Allow-Headers:x-requested-with,content-type');

include "db_connect.php";

$postData = file_get_contents("php://input"); 
$request = json_decode($postData);
if(empty($request)){
    echo 'no request';
}else{
    print_r($request);
}



$imgURL = $request -> file_input;
$title = $request -> title_input;
$limit = $request -> limit_input;
$description = $request -> description_textarea;
$datetime_End = $request -> datetime_End;
$datetime_Start = $request -> datetime_Start;

if(!empty($_GET['eventID']) ){
    $id = $_GET['eventID'];
    //echo $id;
    $sql = 
    " 
   UPDATE `EVENTS` SET 
   `eve_imgURL` = '$imgURL',
   `eve_title` = '$title', 
   `eve_timeStart` = '$datetime_Start', 
   `eve_timeEnd` = '$datetime_End', 
   `eve_limit` = '$limit', 
   `eve_description` = '$description' 
   WHERE `EVENTS`.`eve_id` = $id
    ";
    //echo $sql;
    $statement = $connection -> prepare($sql);// ???
    $statement -> execute();// ???
    // print_r($users);
}else{
    echo 'no id';
}

header("http://localhost:3000");





?>