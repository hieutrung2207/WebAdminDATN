<?php
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Content-Type: application/json; charset=UTF-8");

include_once '../controllers/address-controller.php';
include_once '../models/respone.php';

$data = json_decode(file_get_contents("php://input"));

$response = null;

try {
    if (
        isset($data->userid)
        && isset($data->location)
        && isset($data->ward)
        && isset($data->location)
        && isset($data->district)
        && isset($data->city)
        && isset($data->addressname)
    ) {
        $response = (new AddressController())->insertAdress($data);
    } else {
        $response = new Response(3, true, "Can't take data from client", null);
    }
} catch (Exception $ex) {
    $response = new Response(4, true, "Server has issue", null);
}

echo json_encode($response);
