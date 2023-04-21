<?php 
   require('../configs/dbconfig.php');

   $db = new DBConfig();
   $conn = $db ->getConnect();

   $bookId = $_POST['bookId'];
   $sql="UPDATE tblbooks SET state = 0 WHERE bookId = :bookId ";
// $sql ="select * from tblbooks where bookId = :bookId";

   $stmt = $conn->prepare($sql);
   $stmt -> bindParam(':bookId',$bookId);
   $stmt->execute();
  
  
   


?>