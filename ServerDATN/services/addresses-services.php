<?php
include_once '../configs/dbconfig.php';
include_once '../models/addresses.php';
include_once '../models/respone.php';
include_once '../models/users.php';
class AddressServices
{
    public $connect;
    public function __construct()
    {
        $this->connect = (new DBConfig())->getConnect();
    }
    public function getAllAddressesByUserID($userid)
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "SELECT ADDRESSID, USERID, LOCATION, WARD, DISTRICT, CITY, ADDRESSNAME, ISDEFAULT FROM TBLADDRESSES
                WHERE USERID =?";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $userid);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $listAddresss = [];
            while ($row = $stmt->fetch()) {
                extract($row);
                $addresses = new Addresses($ADDRESSID, $USERID, $LOCATION, $WARD, $DISTRICT, $CITY, $ADDRESSNAME, $ISDEFAULT);
                array_push($listAddresss, $addresses);
            }
            $response->setMessage("Get all addresses by user id success");
            $response->setError(false);
            $response->setResponeCode(1);
            $response->setData($listAddresss);
        } catch (Exception $e) {
            $response->setMessage("Have issue with DB" . $e->getMessage());
            $response->setError(true);
            $response->setResponeCode(0);
        }
        return $response;
    }
    public function insertAdress($data)
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "INSERT INTO TBLADDRESSES SET ADDRESSID = NULL, 
                USERID =?, LOCATION =? , WARD =?, DISTRICT =?, CITY =?, ADDRESSNAME =?, ISDEFAULT = 0 ";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $data->userid);
            $stmt->bindParam(2, $data->location);
            $stmt->bindParam(3, $data->ward);
            $stmt->bindParam(4, $data->district);
            $stmt->bindParam(5, $data->city);
            $stmt->bindParam(6, $data->addressname);
            $this->connect->beginTransaction();

            if ($stmt->execute()) {
                $this->connect->commit();
                $response->setMessage("Insert address success");
                $response->setError(false);
                $response->setResponeCode(1);
            } else {
                $this->connect->rollBack();
                $response->setMessage("Insert address failed");
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

    public function updateAdress($data)
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "UPDATE TBLADDRESSES SET LOCATION =? , WARD =?, DISTRICT =?, CITY =?, ADDRESSNAME =? WHERE ADDRESSID = ?";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $data->location);
            $stmt->bindParam(2, $data->ward);
            $stmt->bindParam(3, $data->district);
            $stmt->bindParam(4, $data->city);
            $stmt->bindParam(5, $data->addressname);
            $stmt->bindParam(6, $data->addressid);
            $this->connect->beginTransaction();
            if ($stmt->execute()) {
                $this->connect->commit();
                $response->setMessage("Update address success");
                $response->setError(false);
                $response->setResponeCode(1);
            } else {
                $this->connect->rollBack();
                $response->setMessage("Update address failed");
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

    public function removeAddress($data)
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "DELETE FROM TBLADDRESSES WHERE ADDRESSID = ? AND USERID = ?";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $data->addressid);
            $stmt->bindParam(2, $data->userid);
            $this->connect->beginTransaction();
            if ($stmt->execute()) {
                $this->connect->commit();
                $response->setMessage("Remove address success");
                $response->setError(false);
                $response->setResponeCode(1);
            } else {
                $this->connect->rollBack();
                $response->setMessage("Remove address failed");
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

    // public function setDefaultAddress()
    // {

    //     $response = Response::getDefaultInstance();
    //     try {
    //         $query = "UPDATE TBLADDRESSES SET LOCATION =? , WARD =?, DISTRICT =?, CITY =?, ADDRESSNAME =? WHERE ADDRESSID = ?";
    //         $stmt = $this->connect->prepare($query);
    //         $stmt->bindParam(1, $data->location);
    //         $stmt->bindParam(2, $data->ward);
    //         $stmt->bindParam(3, $data->district);
    //         $stmt->bindParam(4, $data->city);
    //         $stmt->bindParam(5, $data->addressname);
    //         $stmt->bindParam(6, $data->addressid);
    //         $this->connect->beginTransaction();
    //         if ($stmt->execute()) {
    //             $this->connect->commit();
    //             $response->setMessage("Update address success");
    //             $response->setError(false);
    //             $response->setResponeCode(1);
    //         } else {
    //             $this->connect->rollBack();
    //             $response->setMessage("Update address failed");
    //             $response->setError(true);
    //             $response->setResponeCode(0);
    //         }
    //     } catch (Exception $e) {

    //         $response->setMessage("Have issue with DB" . $e->getMessage());
    //         $response->setError(true);
    //         $response->setResponeCode(5);
    //     }
    //     return $response;
    // }

    public function getDefaultAddressByUserID($userid)
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "SELECT ADDRESSID, USERID, LOCATION, WARD, DISTRICT, CITY, ADDRESSNAME, ISDEFAULT FROM TBLADDRESSES
                WHERE USERID =? AND ISDEFAULT = 1";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $userid);
            $stmt->execute();
            $listAddresss = [];
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                extract($row);
                $addresses = new Addresses($ADDRESSID, $USERID, $LOCATION, $WARD, $DISTRICT, $CITY, $ADDRESSNAME, $ISDEFAULT);
                array_push($listAddresss, $addresses);
            }
            $response->setMessage("Get default address by userid success");
            $response->setError(false);
            $response->setResponeCode(1);
            $response->setData($listAddresss);
        } catch (Exception $e) {
            $response->setMessage("Have issue with DB" . $e->getMessage());
            $response->setError(true);
            $response->setResponeCode(0);
        }
        return $response;
    }
}
