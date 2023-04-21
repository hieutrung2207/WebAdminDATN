<?php
include_once '../configs/dbconfig.php';
include_once '../models/carts.php';
include_once '../models/respone.php';
class CartsServices
{
    public $connect;
    public function __construct()
    {
        $this->connect = (new DBConfig())->getConnect();
    }
    public function getAllCartsByUserID($userid)
    {
        $response = Response::getDefaultInstance();
        try {
            $query = " SELECT USERID, TBLCS.BOOKID, AMOUNT,TITLE, PRICE, URL,ISDEFAULT FROM TBLCARTS TBLCS
                    INNER JOIN TBLBOOKS TBLBS ON TBLCS.BOOKID = TBLBS.BOOKID
                    INNER JOIN TBLIMAGES TBLIMG ON TBLBS.BOOKID = TBLIMG.BOOKID 
                    HAVING ISDEFAULT = 1 AND USERID = ?";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $userid);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $listCarts = [];
            while ($row = $stmt->fetch()) {
                extract($row);
                $cart = new Carts($USERID, $BOOKID, $AMOUNT, $TITLE, $PRICE, $URL, $ISDEFAULT);
                array_push($listCarts, $cart);
            }
            $response->setMessage("get carts by userID success");
            $response->setError(false);
            $response->setResponeCode(1);
            $response->setData($listCarts);
        } catch (Exception $e) {
            $response->setMessage("Have issue with DB" . $e->getMessage());
            $response->setError(true);
            $response->setResponeCode(0);
        }
        return $response;
    }

    public function insertCart($data)
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "INSERT INTO TBLCARTS SET USERID =?, BOOKID = ?, AMOUNT = ? ";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $data->userid);
            $stmt->bindParam(2, $data->bookid);
            $stmt->bindParam(3, $data->amount);
            $this->connect->beginTransaction();
            if ($stmt->execute()) {
                $this->connect->commit();
                $response->setMessage("Insert cart success");
                $response->setError(false);
                $response->setResponeCode(1);
            } else {
                $this->connect->rollBack();
                $response->setMessage("Insert cart fail");
                $response->setError(true);
                $response->setResponeCode(0);
            }
        } catch (Exception $e) {

            $response->setMessage("Already have that book in your cart " . $e->getMessage());
            $response->setError(true);
            $response->setResponeCode(5);
        }
        return $response;
    }

    public function getRemoveCart($data)
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "DELETE FROM TBLCARTS WHERE  USERID = ? AND BOOKID = ?";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $data->userid);
            $stmt->bindParam(2, $data->bookid);

            $this->connect->beginTransaction();

            if ($stmt->execute()) {
                $this->connect->commit();
                $response->setMessage("Minus quantity success");
                $response->setError(false);
                $response->setResponeCode(1);
            } else {
                $this->connect->rollBack();
                $response->setMessage("Minus quantity failed");
                $response->setError(true);
                $response->setResponeCode(0);
            }
        } catch (Exception $e) {

            $response->setMessage("Have issue with DB" . $e->getMessage());
            $response->setError(true);
            $response->setResponeCode(5);
        }
        return $response;
    }

    public function getAddQuantity($data)
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "UPDATE TBLCARTS SET  AMOUNT = AMOUNT + 1  WHERE  USERID = ? AND BOOKID = ?";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $data->userid);
            $stmt->bindParam(2, $data->bookid);

            $this->connect->beginTransaction();

            if ($stmt->execute()) {
                $this->connect->commit();
                $response->setMessage("Add quantity success");
                $response->setError(false);
                $response->setResponeCode(1);
            } else {
                $this->connect->rollBack();
                $response->setMessage("Add quantity failed");
                $response->setError(true);
                $response->setResponeCode(0);
            }
        } catch (Exception $e) {

            $response->setMessage("Have issue with DB" . $e->getMessage());
            $response->setError(true);
            $response->setResponeCode(5);
        }
        return $response;
    }

    public function getMinusQuantity($data)
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "UPDATE TBLCARTS SET  AMOUNT = AMOUNT - 1  WHERE  USERID = ? AND BOOKID = ?";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $data->userid);
            $stmt->bindParam(2, $data->bookid);

            $this->connect->beginTransaction();

            if ($stmt->execute()) {
                $this->connect->commit();
                $response->setMessage("Minus quantity success");
                $response->setError(false);
                $response->setResponeCode(1);
            } else {
                $this->connect->rollBack();
                $response->setMessage("Minus quantity failed");
                $response->setError(true);
                $response->setResponeCode(0);
            }
        } catch (Exception $e) {

            $response->setMessage("Have issue with DB" . $e->getMessage());
            $response->setError(true);
            $response->setResponeCode(5);
        }
        return $response;
    }

    public function getRemoveCartIfQuantity0($data)
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "DELETE FROM TBLCARTS WHERE  USERID = ? AND BOOKID = ? AND AMOUNT = 0";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $data->userid);
            $stmt->bindParam(2, $data->bookid);

            $this->connect->beginTransaction();

            if ($stmt->execute()) {
                $this->connect->commit();
                $response->setMessage("Remove quantity success");
                $response->setError(false);
                $response->setResponeCode(1);
            } else {
                $this->connect->rollBack();
                $response->setMessage("Remove quantity failed");
                $response->setError(true);
                $response->setResponeCode(0);
            }
        } catch (Exception $e) {

            $response->setMessage("Have issue with DB" . $e->getMessage());
            $response->setError(true);
            $response->setResponeCode(5);
        }
        return $response;
    }
}
