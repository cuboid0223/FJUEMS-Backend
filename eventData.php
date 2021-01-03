<?php
// CORS
// 設置允許其他域名訪問
header('Access-Control-Allow-Origin:*');  
// 設置允許的響應類型 
header('Access-Control-Allow-Methods:POST, GET');  
//設置允許的響應頭 
header('Access-Control-Allow-Headers:x-requested-with,content-type');

session_start();
include "db_connect.php";
$postData = file_get_contents("php://input"); 
$request = json_decode($postData);
if(empty($request)){
    //echo 'no request';
}else{
    //print_r($request);
}
$sql = "select * from EVENTS ORDER BY eve_id DESC";

$statement = $connection -> prepare($sql);// ???
$statement -> execute();// ???
$data = $statement -> fetchAll(PDO::FETCH_ASSOC);// ???
//echo $sql;
//print_r($data);
echo json_encode($data, JSON_UNESCAPED_UNICODE);
// foreach($data as $singleData){
//     //print_r($singleData);
//     // echo $singleData;
//     //echo json_encode($singleData, JSON_UNESCAPED_UNICODE);
    
// }

?>

