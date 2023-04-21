<?php
include_once '../configs/dbconfig.php';
include_once '../models/respone.php';
include_once '../models/publishers.php';

class PublishersService
{
    public $connect;
    public function __construct()
    {
        $this->connect = (new DBConfig())->getConnect();
    }
    public function getAllPublishers()
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "SELECT PUBLISHERID, PUBLISHERNAME FROM TBLPUBLISHERS";
            $stmt = $this->connect->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $listPublishers = [];
            while ($row = $stmt->fetch()) {
                extract($row);
                $publisher = new Publishers($PUBLISHERID, $PUBLISHERNAME);
                array_push($listPublishers, $publisher);
            }
            $response->setMessage("get all publishers success");
            $response->setError(false);
            $response->setResponeCode(1);
            $response->setData($listPublishers);
        } catch (Exception $e) {
            $response->setMessage("Have issue with DB" . $e->getMessage());
            $response->setError(true);
            $response->setResponeCode(0);
        }
        return $response;
    }
    public function insertPublisher($publishername)
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "INSERT INTO TBLPUBLISHERS SET PUBLISHERID = NULL, PUBLISHERNAME = ? ";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $publishername);

            $this->connect->beginTransaction();

            if ($stmt->execute()) {
                $this->connect->commit();
                $response->setMessage("Insert publisher success");
                $response->setError(false);
                $response->setResponeCode(1);
            } else {
                $this->connect->rollBack();
                $response->setMessage("Insert publisher failed");
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
    public function updatePublisher($data)
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "UPDATE TBLPUBLISHERS SET  PUBLISHERNAME = ? WHERE PUBLISHERID = ?";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $data->publishername);
            $stmt->bindParam(2, $data->publisherid);
            $this->connect->beginTransaction();
            if ($stmt->execute()) {
                $this->connect->commit();
                $response->setMessage("Update publisher name success");
                $response->setError(false);
                $response->setResponeCode(1);
            } else {
                $this->connect->rollBack();
                $response->setMessage("Update publisher name failed");
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
