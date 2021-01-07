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
$user_id = $request -> user_id;
$imgURL = $request -> file_input;
$title = $request -> title_input;
$limit = $request -> limit_input;
$type =  $request -> type_input;
$description = $request -> description_textarea;
$datetime_End = $request -> datetime_End;
$datetime_Start = $request -> datetime_Start;

if(!empty($datetime_Start) and !empty($title) and !empty($description) ){

    $sql = 
    "INSERT INTO `EVENTS` (`eve_id`, `eve_title`, `eve_imgURL`, `eve_timeStart`, `eve_timeEnd`, `eve_limit`, `eve_description`, `eve_userId`, `eve_typeId`) 
    VALUES (NULL, '$title', '$imgURL', '$datetime_Start', '$datetime_End', '$limit', '$description', '$user_id', '$type')
    ";
    //echo $sql;
    $statement = $connection -> prepare($sql);// ???
    $statement -> execute();// ???
    $events = $statement -> fetchAll(PDO::FETCH_ASSOC);// ???
    
    // print_r($users);
}



header("http://localhost:3000/");





?>