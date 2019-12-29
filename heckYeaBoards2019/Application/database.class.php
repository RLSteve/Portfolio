<?php
/**
 * Author: Tyler Faircloth
 * Date: 11/19/2019
 * File: database.class.php
 * Description:
 */

class Database
{

    //define database parameters
    private $param = array(
        'host' => 'localhost',
        'login' => 'phpuser',
        'password' => 'phpuser',
        'database' => 'i211_final_db',
        'tblBoard' => 'board',
        'tblUser' => 'user',
        'tblBoardBrand' => 'board_brand'
    );
    //define the database connection object
    private $objDBConnection = NULL;
    static private $_instance = NULL;

    //constructor
    private function __construct() {
        $this->objDBConnection = @new mysqli(
            $this->param['host'], $this->param['login'], $this->param['password'], $this->param['database']
        );
        if (mysqli_connect_errno() != 0) {
            $message = "Connecting database failed: " . mysqli_connect_error() . ".";
            include 'error.php';
            exit();
        }
    }


    static public function getDatabase() {
        if (self::$_instance == NULL)
            self::$_instance = new Database();
        return self::$_instance;
    }


    public function getConnection() {
        return $this->objDBConnection;
    }

    public function getBoardTable() {
        return $this->param['tblBoard'];
    }


        public function getUserTable() {
            return $this->param['tblUser'];
        }


    public function getBoardBrandTable() {
        return $this->param['tblBoardBrand'];
    }



}