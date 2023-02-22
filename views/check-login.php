<?php
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Content-Type: application/json; charset=UTF-8");

include_once '../controllers/user-controllers.php';


$data = json_decode(file_get_contents("php://input"));

$response = null;

try {
    if (isset($data->email) && isset($data->password)) {
        $response = (new UserController())->checkLogin($data->email, $data->password);
    } else {
        $response = new Response(3, true, 'Client error cannot get email from client', null);
    }
} catch (Exception $ex) {
    $response = new Response(4, true, 'Server error' . $ex->getMessage(), null);
}

echo json_encode($response);