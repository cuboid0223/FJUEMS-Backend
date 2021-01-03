<?php
// CORS
// 設置允許其他域名訪問
header('Access-Control-Allow-Origin:*');  
// 設置允許的響應類型 
header('Access-Control-Allow-Methods:POST, GET');  
//設置允許的響應頭 
header('Access-Control-Allow-Headers:x-requested-with,content-type');
include "db_connect.php";
$sql = "select * from EVENTS ";
   
if(!empty($_GET['eventID'])){
    //echo $_GET['eventID'];
    $id = $_GET['eventID'];
    // echo $id;
    $sql .= "where eve_id = :id";
}
$statement = $connection -> prepare($sql);// ???
$statement -> execute([":id" => $id]);// ???
$data = $statement -> fetchAll(PDO::FETCH_OBJ);// ???
//echo $sql;
// print_r($data);
echo json_encode($data, JSON_UNESCAPED_UNICODE);


?>

