<?php 

    header("Access-Control-Allow-Origin: http://localhost:8080/AuthenticationRESTAPI/");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../Models/users.php';
    include_once '../../config/core.php';
    include_once '../../libs/php-jwt-main/src/BeforeValidException.php';
    include_once '../../libs/php-jwt-main/src/ExpiredException.php';
    include_once '../../libs/php-jwt-main/src/SignatureInvalidException.php';
    include_once '../../libs/php-jwt-main/src/JWT.php';
    use \Firebase\JWT\JWT;

    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);

    $data = json_decode(file_get_contents("php://input"));

    $user->email = $data->email;
    $email_exists = $user->emailExists();

    
    

    if ($email_exists && password_verify($data->password, $user->password)){

        $token = array (
            "iat" => $issued_at,
            "exp" => $expiration_time,
            "iss" => $issuer,
            "data" => array (
                "id" => $user->id,
                "firstname" => $user->firstname,
                "lastname" => $user->lastname,
                "email" => $user->email,
            )
        );

        http_response_code(200);

        $jwt = JWT::encode($token, $key, 'HS256');
        echo json_encode(
            array (
                "message" => "Logged in successfully",
                "jwt" => $jwt
            )
            );
    }else {

        http_response_code(400);
        echo json_encode(array("message" => "Unable to login"));
    }

    
?>