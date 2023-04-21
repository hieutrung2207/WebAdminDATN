<?php
include_once '../configs/dbconfig.php';
include_once '../models/users.php';
include_once '../models/respone.php';

class UserServices
{
    public $connect;

    public function __construct()
    {
        $this->connect = (new DBConfig())->getConnect();
    }

    public function getUserByEmail($email)
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "SELECT USERID, EMAIL, PASSWORD, FULLNAME, PHONENUMBER, ROLE, STATE FROM TBLUSERS WHERE EMAIL = ?";

            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $email);
            $stmt->execute();
            $listUsers = [];
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                extract($row);
                $user = new User($USERID, $EMAIL, $PASSWORD, $FULLNAME, $PHONENUMBER, $ROLE, $STATE);
                array_push($listUsers, $user);
                $response->setData($listUsers);
                $response->setResponeCode(1);
            }
        } catch (Exception $e) {
            $response->setError(true);
            $response->setMessage($e->getMessage());
        }
        return $response;
    }
    public function getAllUsers()
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "SELECT USERID, EMAIL, PASSWORD, FULLNAME, PHONENUMBER, ROLE, STATE FROM TBLUSERS";
    
            $stmt = $this->connect->prepare($query);
            $stmt->execute();
            $listUsers = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $user = new User($USERID, $EMAIL, $PASSWORD, $FULLNAME, $PHONENUMBER, $ROLE, $STATE);
                array_push($listUsers, $user);
            }
            $totalUsers = count($listUsers);
            $response->setData($listUsers);
            $response->setResponeCode(1);
            $response->setMessage("Total users: " . $totalUsers);
        } catch (Exception $e) {
            $response->setError(true);
            $response->setMessage($e->getMessage());
        }
        return $response;
    }
    
    
    public function getRegiserUser($data)
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "INSERT INTO TBLUSERS SET USERID = NULL, EMAIL =?, PASSWORD =?, FULLNAME = ?, PHONENUMBER = ?, ROLE = 1, STATE = 1";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $data->email);
            $stmt->bindParam(2, $data->password);
            $stmt->bindParam(3, $data->fullname);
            $stmt->bindParam(4, $data->phonenumber);
            $this->connect->beginTransaction();

            if ($stmt->execute()) {
                $this->connect->commit();
                $response->setMessage("Regiser user success");
                $response->setError(false);
                $response->setResponeCode(1);
            } else {
                $this->connect->rollBack();
                $response->setMessage("Regiser user failed");
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

    public function getUpdateFullName($data)
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "UPDATE TBLUSERS SET  FULLNAME = ? WHERE EMAIL = ?";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $data->fullname);
            $stmt->bindParam(2, $data->email);

            $this->connect->beginTransaction();

            if ($stmt->execute()) {
                $this->connect->commit();
                $response->setMessage("Update fullname success");
                $response->setError(false);
                $response->setResponeCode(1);
            } else {
                $this->connect->rollBack();
                $response->setMessage("Update fullname failed");
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

    public function getUpdatePhoneNumber($data)
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "UPDATE  TBLUSERS SET  PHONENUMBER = ? WHERE EMAIL = ?";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $data->phonenumber);
            $stmt->bindParam(2, $data->email);

            $this->connect->beginTransaction();

            if ($stmt->execute()) {
                $this->connect->commit();
                $response->setMessage("Update phone number success");
                $response->setError(false);
                $response->setResponeCode(1);
            } else {
                $this->connect->rollBack();
                $response->setMessage("Update phone number failed");
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

    public function getUpdatePassword($data)
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "UPDATE TBLUSERS SET
                PASSWORD = ?
                WHERE EMAIL = ?";
            $stmt = $this->connect->prepare($query);

            $stmt->bindParam(1, $data->password);
            $stmt->bindParam(2, $data->email);
            $this->connect->beginTransaction();

            if ($stmt->execute()) {
                $this->connect->commit();
                $response->setMessage("Update password success");
                $response->setError(false);
                $response->setResponeCode(1);
            } else {
                $this->connect->rollBack();
                $response->setMessage("Update password failed");
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

    public function getUpdateEmail($data)
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "UPDATE TBLUSERS SET
                EMAIL = ?
                WHERE USERID = ?";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $data->email);
            $stmt->bindParam(2, $data->userid);
            $this->connect->beginTransaction();
            if ($stmt->execute()) {
                $this->connect->commit();
                $response->setMessage("Update email success");
                $response->setError(false);
                $response->setResponeCode(1);
            } else {
                $this->connect->rollBack();
                $response->setMessage("Update email failed");
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

    public function setActiveUser($email)
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "UPDATE TBLUSERS SET
                STATE = 1
                WHERE EMAIL = ?";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $email);
            $this->connect->beginTransaction();
            if ($stmt->execute()) {
                $this->connect->commit();
                $response->setMessage("Active user success");
                $response->setError(false);
                $response->setResponeCode(1);
            } else {
                $this->connect->rollBack();
                $response->setMessage("Active user failed");
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

    public function setDeactiveUser($email)
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "UPDATE TBLUSERS SET
                STATE = 0
                WHERE EMAIL = ?";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $email);
            $this->connect->beginTransaction();
            if ($stmt->execute()) {
                $this->connect->commit();
                $response->setMessage("Deactive user success");
                $response->setError(false);
                $response->setResponeCode(1);
            } else {
                $this->connect->rollBack();
                $response->setMessage("Deactive user failed");
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
    public function getPasswordByEmail($email)
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "SELECT PASSWORD FROM TBLUSERS WHERE
                EMAIL = ?";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $email);
            $stmt->execute();
            $listUsers = [];
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                extract($row);
                $user = new User($USERID, $EMAIL, $PASSWORD, $FULLNAME, $PHONENUMBER, $ROLE, $STATE);
                array_push($listUsers, $user);
                $response->setData($listUsers);
                $response->setResponeCode(1);
            }
        } catch (Exception $e) {
            $response->setError(true);
            $response->setMessage($e->getMessage());
        }
    }
}
