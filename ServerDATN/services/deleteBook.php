<?php 

    require('../configs/dbconfig.php');

    $db = new DBConfig();
    $conn = $db ->getConnect();

    $bookId=$_POST['bookId'];
    $sqlDelImage = "delete from tblimages where bookId = :bookId";
    $stmt = $conn -> prepare($sqlDelImage);
    $stmt ->bindParam(':bookId',$bookId);
    if( $stmt->execute()){
        $sqlDelBook="delete from tblbooks where bookId = :bookId";
        $stmt = $conn -> prepare($sqlDelBook);
        $stmt ->bindParam(':bookId',$bookId);
        $stmt ->execute();
    }
   
?>