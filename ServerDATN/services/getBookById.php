<?php

require('../configs/dbconfig.php');

$db = new DBConfig();
$conn = $db->getConnect();

$bookId = $_POST['bookId'];
$sqlGetBook = "select * from tblbooks where bookId = :bookId";
$stmt = $conn->prepare($sqlGetBook);
$stmt->bindParam(':bookId', $bookId);
$stmt->execute();
$item = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($item);


?>
