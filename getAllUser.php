<?php
// CORS
// 設置允許其他域名訪問
header('Access-Control-Allow-Origin:*');  
// 設置允許的響應類型 
header('Access-Control-Allow-Methods:POST, GET');  
//設置允許的響應頭 
header('Access-Control-Allow-Headers:x-requested-with,content-type');

include "db_connect.php";


$sql = 
" 
    SELECT user_id, user_account, user_name, auth_name, dep_name
    FROM USERS
    LEFT JOIN USERS_AUTH ON user_auth = auth_id
    LEFT JOIN DEPARTMENTS ON user_depId = dep_id
";
//echo $sql;
$statement = $connection -> prepare($sql);// ???
$statement -> execute();// ???
$data = $statement -> fetchAll(PDO::FETCH_ASSOC);// ???
// print_r($users);
echo json_encode($data, JSON_UNESCAPED_UNICODE);





?>