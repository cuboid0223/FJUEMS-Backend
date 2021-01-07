<?php
// CORS
// 設置允許其他域名訪問
header('Access-Control-Allow-Origin:*');  
// 設置允許的響應類型 
header('Access-Control-Allow-Methods:POST, GET');  
//設置允許的響應頭 
header('Access-Control-Allow-Headers:x-requested-with,content-type');
include "db_connect.php";
$sql = "
  SELECT * from USERS_EVENTS 
    LEFT JOIN EVENTS ON USERS_EVENTS.eve_id = EVENTS.eve_id  
 ";

if(!empty($_GET['userId'])){
    //echo $_GET['userId'];
    $userId = $_GET['userId'];
    // echo $id;
    $sql .= "where user_id = $userId ORDER BY userEvent_id DESC";
}

$statement = $connection -> prepare($sql);// ???
$statement -> execute([":id" => $id]);
$data = $statement -> fetchAll(PDO::FETCH_ASSOC);// ???
//echo $sql;
// print_r($data);
echo json_encode($data, JSON_UNESCAPED_UNICODE);


?>

