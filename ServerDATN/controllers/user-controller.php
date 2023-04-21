<?php
include_once '../services/users-services.php';

class UserController
{
    private $services;
    public function __construct()
    {
        $this->services = new UserServices();
    }
    public function getUserByEmail($email)
    {
        return $this->services->getUserByEmail($email);
    }

    public function checkLogin($email, $password)
    {
        $response = $this->services->getUserByEmail($email);
        if ($response->getError() === false) {
            if ($response->getData() !== null) {
                if (strcmp($password, $response->getData()[0]->getPassword()) == 0) {
                    $response->setResponeCode(1);
                    $response->setMessage("Login successfull");
                    $response->getData()[0]->setPassword(null);
                } else {
                    $response->setResponeCode(0);
                    $response->setMessage("Login failed");
                    $response->setData(null);
                }
            } else {
                $response->setResponeCode(0);
                $response->setMessage("Login failed");
            }
        } else {
            $response->setResponeCode(5);
            $response->setMessage("Server error");
        }
        return $response;
    }

    public function getRegiserUser($data)
    {
        return $this->services->getRegiserUser($data);
    }

    public function getUpdateFullName($data)
    {
        return $this->services->getUpdateFullName($data);
    }

    public function getUpdatePhoneNumber($data)
    {
        return $this->services->getUpdatePhoneNumber($data);
    }

    public function getUpdatePassword($data)
    {
        return $this->services->getUpdatePassword($data);
    }

    public function getUpdateEmail($data)
    {
        return $this->services->getUpdateEmail($data);
    }

    public function setActiveUser($email)
    {
        return $this->services->setActiveUser($email);
    }

    public function setDeactiveUser($email)
    {
        return $this->services->setDeactiveUser($email);
    }
    public function getPasswordByEmail($email)
    {
        return $this->services->getPasswordByEmail($email);
    }
}
