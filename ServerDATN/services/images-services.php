<?php
include_once '../configs/dbconfig.php';
include_once '../models/images.php';
include_once '../models/respone.php';

class ImagesServices
{
    public $connect;
    public function __construct()
    {
        $this->connect = (new DBConfig())->getConnect();
    }
    public function insertImages($data)
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "INSERT INTO TBLIMAGES SET URL = ?, ISDEFAULT = 0, BOOKID = ?";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $data->url);
            $stmt->bindParam(2, $data->bookid);
            $this->connect->beginTransaction();

            if ($stmt->execute()) {
                $this->connect->commit();
                $response->setMessage("Insert image success");
                $response->setError(false);
                $response->setResponeCode(1);
            } else {
                $this->connect->rollBack();
                $response->setMessage("Insert image failed");
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
    public function removeImages($imageid)
    {

        $response = Response::getDefaultInstance();
        try {
            $query = "DELETE FROM TBLIMAGES WHERE IMAGEID = ?  AND ISDEFAULT = 0";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $imageid);
            $this->connect->beginTransaction();

            if ($stmt->execute()) {
                $this->connect->commit();
                $response->setMessage("Remove image success");
                $response->setError(false);
                $response->setResponeCode(1);
            } else {
                $this->connect->rollBack();
                $response->setMessage("Remove image failed");
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

    public function updateImages($data)
    {

        $response = Response::getDefaultInstance();
        try {
            $query = "UPDATE FROM TBLIMAGES SET URL =? WHERE IMAGEID = ?";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $data->url);
            $stmt->bindParam(2, $data->imageid);
            $this->connect->beginTransaction();

            if ($stmt->execute()) {
                $this->connect->commit();
                $response->setMessage("Update image success");
                $response->setError(false);
                $response->setResponeCode(1);
            } else {
                $this->connect->rollBack();
                $response->setMessage("Update image failed");
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

    public function changeDefaultAllow($imageid)
    {

        $response = Response::getDefaultInstance();
        try {
            $query = "UPDATE FROM TBLIMAGES SET ISDEFAULT =1 WHERE IMAGEID = ?";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $imageid);
            $this->connect->beginTransaction();

            if ($stmt->execute()) {
                $this->connect->commit();
                $response->setMessage("Change default image success");
                $response->setError(false);
                $response->setResponeCode(1);
            } else {
                $this->connect->rollBack();
                $response->setMessage("Change default image failed");
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
    public function changeDefaultDeny($imageid)
    {

        $response = Response::getDefaultInstance();
        try {
            $query = "UPDATE FROM TBLIMAGES SET ISDEFAULT =0 WHERE IMAGEID = ?";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $imageid);
            $this->connect->beginTransaction();

            if ($stmt->execute()) {
                $this->connect->commit();
                $response->setMessage("Change default image success");
                $response->setError(false);
                $response->setResponeCode(1);
            } else {
                $this->connect->rollBack();
                $response->setMessage("Change default image failed");
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
