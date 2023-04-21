<?php
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Content-Type: application/json; charset=UTF-8");

include_once '../controllers/cart-controller.php';


$data = json_decode(file_get_contents("php://input"));

$response = null;

try {
    if (
        isset($data->userID) && isset($data->bookID) && isset($data->quantity)
    ) {
        $response = (new CartController())->getAllCartsByUserID($data->userID, $data->bookID, $data->quantity);
    } else {
        $response = new Response(3, true, "Can't load carts by user you login", null);
    }
} catch (Exception $ex) {
    $response = new Response(4, true, "Server down", null);
}

echo json_encode($response);
