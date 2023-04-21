<?php 
   require('../configs/dbconfig.php');

   $db = new DBConfig();
   $conn = $db ->getConnect();

   $bookId = $_POST['bookId'];
   $state = $_POST['state'];
   $sql="UPDATE tblbooks SET state = $state WHERE bookId = $bookId ";
// $sql ="select * from tblbooks where bookId = :bookId";

   $stmt = $conn->prepare($sql);
   $stmt->execute();


   echo json_encode($state);
  

  
   


?>