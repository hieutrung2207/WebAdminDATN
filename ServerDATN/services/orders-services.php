<?php
include_once '../configs/dbconfig.php';
include_once '../models/respone.php';
include_once '../models/orders.php';
class OrdersServices
{
    public $connect;
    public function __construct()
    {
        $this->connect = (new DBConfig())->getConnect();
    }
    public function insertOrder($data)
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "INSERT INTO TBLORDERS SET STATE = 1, NOTE= ?,
                 FULLNAME=?, PHONENUMBER = ?,ADDRESS =?, PAYMENT = ?, USERID = ? ";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $data->note);
            $stmt->bindParam(2, $data->fullname);
            $stmt->bindParam(3, $data->phonenumber);
            $stmt->bindParam(4, $data->address);
            $stmt->bindParam(5, $data->payment);
            $stmt->bindParam(6, $data->userid);
            $this->connect->beginTransaction();

            if ($stmt->execute()) {
                $this->connect->commit();
                $response->setMessage("Insert order success");
                $response->setError(false);
                $response->setResponeCode(1);
            } else {
                $this->connect->rollBack();
                $response->setMessage("Insert order failed");
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

    public function insertOrderDetail($data)
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "INSERT INTO TBLORDERDETAILS SET ORDERID = (SELECT ORDERID FROM TBLORDERS WHERE USERID = ? ORDER BY CREATEDATE DESC LIMIT 1), AMOUNT = ?, BOOKID =? ";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $data->userid);
            $stmt->bindParam(2, $data->quantity);
            $stmt->bindParam(3, $data->bookid);
            $this->connect->beginTransaction();
            if ($stmt->execute()) {
                $this->connect->commit();
                $response->setMessage("Insert order detail success");
                $response->setError(false);
                $response->setResponeCode(1);
            } else {
                $this->connect->rollBack();
                $response->setMessage("Insert order detail fail");
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
    public function getAllOrderByUserID($userid)
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "SELECT ORDERID, USERID, CREATEDATE, NOTE, FULLNAME, PHONENUMBER, ADDRESS, PAYMENT, STATE FROM TBLORDERS WHERE USERID =?";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $userid);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $listOrder = [];
            while ($row = $stmt->fetch()) {
                extract($row);
                $order = new Orders($ORDERID, $USERID, $CREATEDATE, $NOTE, $FULLNAME, $PHONENUMBER, $ADDRESS, $PAYMENT, $STATE);
                array_push($listOrder, $order);
            }
            $response->setMessage("get all orders success");
            $response->setError(false);
            $response->setResponeCode(1);
            $response->setData($listOrder);
        } catch (Exception $e) {
            $response->setMessage("Have issue with DB" . $e->getMessage());
            $response->setError(true);
            $response->setResponeCode(0);
        }
        return $response;
    }
    public function getOrderDetailByOrderID($orderid)
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "SELECT ORDERDETAILID, ORDERID, TBLBS.TITLE  , AMOUNT, TBLBS.PRICE, TBLBS.PRICE * AMOUNT AS TOTAL, TBLIS.URL FROM TBLORDERDETAILS TBLODS
                    INNER JOIN TBLBOOKS TBLBS ON TBLODS.BOOKID = TBLBS.BOOKID
                    INNER JOIN TBLiMAGES TBLIS ON TBLBS.BOOKID = TBLIS.BOOKID
                    WHERE ORDERID = ? AND TBLIS.ISDEFAULT = 1";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $orderid);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $listOrder = [];
            while ($row = $stmt->fetch()) {
                extract($row);
                $order = new OrderDetail($ORDERDETAILID, $ORDERID, $TITLE, $PRICE, $AMOUNT, $TOTAL, $URL);
                array_push($listOrder, $order);
            }
            $response->setMessage("get all order detail of order success");
            $response->setError(false);
            $response->setResponeCode(1);
            $response->setData($listOrder);
        } catch (Exception $e) {
            $response->setMessage("Have issue with DB" . $e->getMessage());
            $response->setError(true);
            $response->setResponeCode(0);
        }
        return $response;
    }
    public function getOrderStatusDelivery($userid)
    {

        $response = Response::getDefaultInstance();
        try {
            $query = "SELECT ORDERID, USERID, CREATEDATE, NOTE, FULLNAME, PHONENUMBER, ADDRESS, PAYMENT, STATE FROM TBLORDERS WHERE USERID =? AND STATE = 2";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $userid);

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $listOrder = [];
            while ($row = $stmt->fetch()) {
                extract($row);
                $order = new Orders($ORDERID, $USERID, $CREATEDATE, $NOTE, $FULLNAME, $PHONENUMBER, $ADDRESS, $PAYMENT, $STATE);
                array_push($listOrder, $order);
            }
            $response->setMessage("get all orders delivery");
            $response->setError(false);
            $response->setResponeCode(1);
            $response->setData($listOrder);
        } catch (Exception $e) {
            $response->setMessage("Have issue with DB" . $e->getMessage());
            $response->setError(true);
            $response->setResponeCode(0);
        }
        return $response;
    }
    public function getOrderStatusCancel($userid)
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "SELECT ORDERID, USERID, CREATEDATE, NOTE, FULLNAME, PHONENUMBER, ADDRESS, PAYMENT, STATE FROM TBLORDERS WHERE USERID =? AND STATE = 0";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $userid);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $listOrder = [];
            while ($row = $stmt->fetch()) {
                extract($row);
                $order = new Orders($ORDERID, $USERID, $CREATEDATE, $NOTE, $FULLNAME, $PHONENUMBER, $ADDRESS, $PAYMENT, $STATE);
                array_push($listOrder, $order);
            }
            $response->setMessage("get all orders cancel");
            $response->setError(false);
            $response->setResponeCode(1);
            $response->setData($listOrder);
        } catch (Exception $e) {
            $response->setMessage("Have issue with DB" . $e->getMessage());
            $response->setError(true);
            $response->setResponeCode(0);
        }
        return $response;
    }
    public function getOrderStatusSuccess($userid)
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "SELECT ORDERID, USERID, CREATEDATE, NOTE, FULLNAME, PHONENUMBER, ADDRESS, PAYMENT, STATE FROM TBLORDERS WHERE USERID =? AND STATE = 3";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $userid);

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $listOrder = [];
            while ($row = $stmt->fetch()) {
                extract($row);
                $order = new Orders($ORDERID, $USERID, $CREATEDATE, $NOTE, $FULLNAME, $PHONENUMBER, $ADDRESS, $PAYMENT, $STATE);
                array_push($listOrder, $order);
            }
            $response->setMessage("get all orders success");
            $response->setError(false);
            $response->setResponeCode(1);
            $response->setData($listOrder);
        } catch (Exception $e) {
            $response->setMessage("Have issue with DB" . $e->getMessage());
            $response->setError(true);
            $response->setResponeCode(0);
        }
        return $response;
    }
}
