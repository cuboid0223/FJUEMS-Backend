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

$name = $request -> resign_name;
$account = $request -> resign_account;
$password = $request -> resign_password;

if(!empty($name) and !empty($account) and !empty($password) ){
    function validate($data){// 驗證機制？
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }

    $account = validate($account) ;
    $password =  validate($password);
    $password = md5($password);
    $sql = 
    "INSERT INTO `USERS` (`user_id`, `user_account`, `user_name`, `user_password`, `user_auth`, `user_depId`) 
    VALUES (NULL, '$account', '$name', '$password', '3', Null)";
    echo $sql;
    $statement = $connection -> prepare($sql);// ???
    $statement -> execute();// ???
    $users = $statement -> fetchAll(PDO::FETCH_ASSOC);// ???
    // // //echo $sql;
    // print_r($users);
}


header("http://localhost:3000/");





?>