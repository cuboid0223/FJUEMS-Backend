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
    //echo 'no request';
}else{
    print_r($request);
}

if(!empty($_GET['eventID']) and !empty($_GET['userID'])){
    $eventId = $_GET['eventID'];
    $userId = $_GET['userID'];
    // user cant join twice 
    $find_sql = 
    "
    SELECT * FROM USERS_EVENTS WHERE user_id = '$userId' and eve_id='$eventId'
    ";
    $sql = 
    "
    INSERT INTO `USERS_EVENTS` (`user_id`, `eve_id`) VALUES ('$userId', '$eventId')
    ";
    //echo $sql;
    $statement = $connection -> prepare($find_sql);// ???
    $statement -> execute();// ???
    $userJoinEvent = $statement -> fetch(PDO::FETCH_ASSOC);// ???
    if(empty($userJoinEvent)){
        $statement = $connection -> prepare($sql);// ???
        $statement -> execute();// ???
    }else{
        echo "you have joined already!!";
    }
    
    // print_r($users);
}

header("http://localhost:3000");





?>