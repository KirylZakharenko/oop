<?php

class Users {
    public $firstName;

    public $lastName;

    public function __construct()
    {
        $this->firstName = 'Vasya';
    }

    public function register()
    {
        return ">> registered";
    }

    public function mail()
    {
        return ">> email sent";
    }

    public function hello(): Users
    {
        echo "hello " . $this->firstName;
        return $this;
    }
}

$user = new Users();

echo $user->hello();