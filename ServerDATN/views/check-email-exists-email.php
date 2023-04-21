<?php
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Content-Type: application/json; charset=UTF-8");

include_once '../controllers/user-controller.php';
include_once '../models/respone.php';

$data = json_decode(file_get_contents("php://input"));

$response = null;

try {
    if (isset($data->email)) {
        $response = (new UserController())->getUserByEmail($data->email);
        if ($response->getError() === false) {
            if ($response->getData() === null) {
                $response->setResponeCode(0);
                $response->setMessage("User not existed");
            } else {
                $response->setResponeCode(1);
                $response->setMessage("User existed");
            }
        } else {
            $response->setResponeCode(5);
        }
    } else {
        $response = new Response(3, true, 'client error cannot get email from client', null);
    }
} catch (Exception $ex) {
    $response = new Response(4, true, 'server error' . $ex->getMessage(), null);
}

echo json_encode($response);
