<?php
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Content-Type: application/json; charset=UTF-8");

include_once '../controllers/user-controller.php';
include_once '../models/respone.php';

$data = json_decode(file_get_contents("php://input"));

$response = null;

try {
    if (
        isset($data->email) && isset($data->password) && isset($data->fullname) && isset($data->phonenumber)

    ) {
        $response = (new UserController())->getRegiserUser($data);
    } else {
        $response = new Response(3, true, "Can't take data from client", null);
    }
    // if (
    //     isset($data->email) && isset($data->password)
    // ) {
    //     $response = (new UserController())->getRegiserUser($data);
    // } else {
    //     $response = new Response(3, true, "Client error" . "Not enough parameters", null);
    // }
} catch (Exception $ex) {
    $response = new Response(4, true, "Server has issue", null);
}

echo json_encode($response);
