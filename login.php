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
    echo 'no request';
}else{
    //print_r($request);

}
$account = $request -> account;
$password = $request -> password;

function validate($data){// 驗證機制？
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$account = validate($account) ;
$password =  validate($password);
// $password = md5($password);
$password = md5($password);
$sql = "SELECT * FROM USERS LEFT JOIN USERS_AUTH ON USERS.user_auth = USERS_AUTH.auth_id where user_account = '$account' and user_password = '$password' ";

$statement = $connection -> prepare($sql);// ???
$statement -> execute();// ???
$users = $statement -> fetchAll(PDO::FETCH_ASSOC);// ???
//echo $sql;
// print_r($users);

if(!empty($users)){// 如果有這個人，回傳 true
        //echo "hello"; 
        //echo $users[0]['user_account'];
        foreach( $users as $user ){
            //echo $user['user_account'];
            if($user['user_account'] === $account and $user['user_password'] === $password){// 如果 資料庫有這個人 
                //echo "logged in";
                echo json_encode($user, JSON_UNESCAPED_UNICODE);
                // $_SESSION['user_account'] = $user['user_account'];
                // $_SESSION['user_name'] = $user['user_name'];
                // $_SESSION['user_id'] = $user['id'];
                //header("Location: http://localhost:3000/");
                // header("http://localhost:3000/");// 
                exit();
            }else{// 如果 沒有這個人
                header("http://localhost:3000?error= Incorrect User Name or Password");
                exit();
            }
        }
       
        // foreach( $users as  $user){
        //     echo $user['user_account'];
        // };
       

}else{
    header("http://localhost:3000/error= Incorrect User Name or Password");
    exit();
    
}


?>