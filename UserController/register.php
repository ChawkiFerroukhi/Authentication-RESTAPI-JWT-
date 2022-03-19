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


    $user->firstname = $_POST['firstname'];
    $user->lastname = $_POST['lastname'];
    $user->email = $_POST['email'];
    $user->age = $_POST['age'];
    $user->phone = $_POST['phone'];
    $user->joindate = date('Y-m-d H:i:s');
    $user->image = $_POST['image'];
    $user->password = base64_encode($_POST['password']);

    if ($user->register()) {
        $user_arr = array (
            "status" => true,
            "message" => "Registred Successfully",
            "email" => $user->email,
        );
    }

    print_r(json_encode($user_arr));



?>