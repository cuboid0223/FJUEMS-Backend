<?php
// CORS
// 設置允許其他域名訪問
header('Access-Control-Allow-Origin:*');  
// 設置允許的響應類型 
header('Access-Control-Allow-Methods:POST, GET');  
//設置允許的響應頭 
header('Access-Control-Allow-Headers:x-requested-with,content-type');

include "db_connect.php";

if(!empty($_GET['eventID']) and !empty($_GET['userID'])){
    $eve_id = $_GET['eventID'];
    $user_id = $_GET['userID'];
    $find_sql = 
    "
    SELECT * FROM USERS_EVENTS WHERE user_id = '$user_id' AND eve_id='$eve_id'
    ";
    $sql = 
    "
    DELETE FROM `USERS_EVENTS` WHERE `USERS_EVENTS`.`user_id` = $user_id AND `USERS_EVENTS`.`eve_id` = $eve_id;
    ";
    $statement = $connection -> prepare($find_sql);// ???
    $statement -> execute();// ???
    $userJoinEvent = $statement -> fetch(PDO::FETCH_ASSOC);// ???
    if($userJoinEvent){
        $statement = $connection -> prepare($sql);// ???
        $statement -> execute();// ???
        echo "取消成功";
    }else{
        echo "未報名";
    }
}





?>