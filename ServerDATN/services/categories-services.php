<?php
include_once '../configs/dbconfig.php';
include_once '../models/respone.php';
include_once '../models/categories.php';

class CategoriesService
{
    public $connect;
    public function __construct()
    {
        $this->connect = (new DBConfig())->getConnect();
    }
    public function getAllCategories()
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "SELECT CATEGORYID, CATEGORYNAME FROM TBLCATEGORIES";
            $stmt = $this->connect->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $listCates = [];
            while ($row = $stmt->fetch()) {
                extract($row);
                $cates = new Categories($CATEGORYID, $CATEGORYNAME);
                array_push($listCates, $cates);
            }
            $response->setMessage("get all cate success");
            $response->setError(false);
            $response->setResponeCode(1);
            $response->setData($listCates);
        } catch (Exception $e) {
            $response->setMessage("Have issue with DB" . $e->getMessage());
            $response->setError(true);
            $response->setResponeCode(0);
        }
        return $response;
    }
    public function getInsertCategory($categoryname)
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "INSERT INTO TBLCATEGORIES SET CATEGORYNAME =? ";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $categoryname);
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

    public function updateCategory($data)
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "UPDATE TBLCATEGORIES SET  CATEGORYNAME = ? WHERE CATEGORYID = ?";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $data->categoryname);
            $stmt->bindParam(2, $data->categoryid);
            $this->connect->beginTransaction();
            if ($stmt->execute()) {
                $this->connect->commit();
                $response->setMessage("Update Category name success");
                $response->setError(false);
                $response->setResponeCode(1);
            } else {
                $this->connect->rollBack();
                $response->setMessage("Update Category name failed");
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
