<?php
include_once '../models/authors.php';
include_once '../configs/dbconfig.php';
include_once '../models/respone.php';

class AuthorsService
{
    public $connect;
    public function __construct()
    {
        $this->connect = (new DBConfig())->getConnect();
    }

    public function getAllAuthors()
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "SELECT AUTHORID, AUTHORNAME, DOB, DESCRIPTION FROM TBLAUTHORS  ";
            $stmt = $this->connect->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $listAuthors = [];
            while ($row = $stmt->fetch()) {
                extract($row);
                $author = new Authors($AUTHORID, $AUTHORNAME, $DOB, $DESCRIPTION);
                array_push($listAuthors, $author);
            }
            $response->setMessage("get auhthors success");
            $response->setError(false);
            $response->setResponeCode(1);
            $response->setData($listAuthors);
        } catch (Exception $e) {
            $response->setMessage("Have issue with DB" . $e->getMessage());
            $response->setError(true);
            $response->setResponeCode(0);
        }
        return $response;
    }

    public function getAuthorsDetail($authorid)
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "SELECT AUTHORID, AUTHORNAME, DOB, DESCRIPTION FROM TBLAUTHORS WHERE AUTHORID =? ";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $authorid);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $listAuthors = [];
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch();
                extract($row);
                $author = new Authors($AUTHORID, $AUTHORNAME, $DOB, $DESCRIPTION);
                array_push($listAuthors, $author);
            }
            $response->setMessage("get auhthors success");
            $response->setError(false);
            $response->setResponeCode(1);
            $response->setData($listAuthors);
        } catch (Exception $e) {
            $response->setMessage("Have issue with DB" . $e->getMessage());
            $response->setError(true);
            $response->setResponeCode(0);
        }
        return $response;
    }

    public function insertAuthor($data)
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "INSERT INTO TBLAUTHORS SET AUTHORNAME = ?, DOB= ?, DESCRIPTION = ? ";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $data->authorname);
            $stmt->bindParam(2, $data->dob);
            $stmt->bindParam(3, $data->description);
            $this->connect->beginTransaction();

            if ($stmt->execute()) {
                $this->connect->commit();
                $response->setMessage("Insert author success");
                $response->setError(false);
                $response->setResponeCode(1);
            } else {
                $this->connect->rollBack();
                $response->setMessage("Insert author failed");
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
  
    public function updateAuthor($data)
    {
        $response = Response::getDefaultInstance();
        try {
            $query = "UPDATE TBLAUTHORS SET  AUTHORNAME = ?, DOB= ?, DESCRIPTION = ? WHERE AUTHORID = ?";
            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(1, $data->authorname);
            $stmt->bindParam(2, $data->dob);
            $stmt->bindParam(3, $data->description);
            $stmt->bindParam(4, $data->authorid);
            $this->connect->beginTransaction();
            if ($stmt->execute()) {
                $this->connect->commit();
                $response->setMessage("Update  author success");
                $response->setError(false);
                $response->setResponeCode(1);
            } else {
                $this->connect->rollBack();
                $response->setMessage("Update author failed");
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
