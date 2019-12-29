<?php
/**
 * Author: Tyler Jump
 * Date: 2019-12-08
 * File: user.class.php
 * Description:
 */

class User
{
                //username password firstname lastname email

    private $id, $username, $password, $firstname, $lastname, $email;

    public function __construct( $username, $password, $firstname, $lastname, $email)
    {

        $this->username=$username;
        $this->password=$password;
        $this->firstname=$firstname;
        $this->lastname=$lastname;
        $this->email=$email;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername(){
        return $this->username;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getFirstName(){
        return $this->username;
    }
    public function getLastName(){
        return $this->lastname;
    }
    public function getEmail(){
        return $this->email;
    }
    public function setID($id){
        $this->id = $id;
    }
}