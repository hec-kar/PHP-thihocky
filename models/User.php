<?php
<<<<<<< HEAD
class User
{
    public $user_id;
    public $username;
    public $email;
    public $phone;
    public $password;
    public $authentication;
=======

class User
{
    private $user_id;
    private $username;
    private $email;
    private $phone;
    private $password;
    private $authentication;

>>>>>>> 2122ef40fc6586d031c296028bc866d1a60e5675
    public function __construct($user_id = null, $username = null, $email = null, $phone = null, $password = null, $authentication = null)
    {
        if ($user_id !== null) {
            $this->user_id = $user_id;
            $this->username = $username;
            $this->email = $email;
            $this->phone = $phone;
            $this->password = $password;
            $this->authentication = $authentication;
        }
    }

<<<<<<< HEAD

=======
>>>>>>> 2122ef40fc6586d031c296028bc866d1a60e5675
    public function getUserId()
    {
        return $this->user_id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getAuthentication()
    {
        return $this->authentication;
    }
<<<<<<< HEAD
=======

>>>>>>> 2122ef40fc6586d031c296028bc866d1a60e5675
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    public function setUsername($username): void
    {
        $this->username = $username;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function setAuthentication($authentication): void
    {
        $this->authentication = $authentication;
    }
<<<<<<< HEAD





}
=======
}
>>>>>>> 2122ef40fc6586d031c296028bc866d1a60e5675
