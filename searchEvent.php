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

if(!empty($_GET['q']) ){
    $term = $_GET['q'];
    $sql = 
    " 
    SELECT * FROM EVENTS WHERE eve_title LIKE '%$term%' or eve_typeId LIKE '%$term%'
    ";
    //echo $sql;
    $statement = $connection -> prepare($sql);// ???
    $statement -> execute();// ???
    $events = $statement -> fetchAll(PDO::FETCH_ASSOC);// ???
    echo json_encode($events, JSON_UNESCAPED_UNICODE);
    // print_r($users);
}

header("http://localhost:3000");





?>