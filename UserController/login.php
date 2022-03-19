<?php 

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../Models/users.php';

    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);

    $user->email = isset($_GET['email']) ? $_GET['email'] : die();
    $user->password = base64_encode(isset($_GET['password']) ? $_GET['password'] : die());
    $record = $user->login();
    $row = mysqli_num_rows($record);

    if ( $row > 0) {

        $dataRow = $record->fetch_assoc();
            if (($user->password == $dataRow['password'])) {
            $user_arr = array (
                'status' => true,
                'message' => "Logged in",
                'email' => $dataRow['firstname'],
            );
            }else {
                $user_arr = array (
                    'status' => false,
                    'message' => "incorrect password",
                    'email' => $dataRow['firstname'],
                );
            }
        
        http_response_code(200);
        print_r(json_encode($user_arr));
    }
    else{
        http_response_code(404);
        print_r(json_encode("User not found"));
    }

    
?>