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
   SELECT eve_id, eve_title, eve_imgURL, eve_timeStart, eve_timeEnd, 
    eve_limit, eve_description, type_name, user_account, user_name, type_id,auth_name, dep_name
    from EVENTS 
    LEFT JOIN EVENTS_TYPES ON EVENTS.eve_typeId = EVENTS_TYPES.type_id
    LEFT JOIN 
    (
        SELECT user_id, user_account, user_name, auth_name, dep_name
        FROM USERS
        LEFT JOIN USERS_AUTH ON user_auth = auth_id
        LEFT JOIN DEPARTMENTS ON user_depId = dep_id
    ) AS userInfo
    ON EVENTS.eve_userId = userInfo.user_id 
 ";

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

