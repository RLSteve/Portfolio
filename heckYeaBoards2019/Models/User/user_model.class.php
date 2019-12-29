<?php
session_start();
/**
 * Author: Tyler Jump
 * Date: 2019-12-08
 * File: user_model.class.php
 * Description:
 */

class UserModel {

    //private data members
    private $db;
    private $dbConnection;
    private $tblUser;
    public function __construct() {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblUser = $this->db->getUserTable();

    }

    //add a user into the "users" table in the database
    public function add_user() {
        try {
        //retrieve user inputs from the registration form
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
        $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
        $lastname = filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_STRING);
        $firstname = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $admin = filter_input(INPUT_POST, 'admin', FILTER_SANITIZE_NUMBER_INT);

        if ($username == ""){
            throw new MissingDataException("All fields required Error: <br>Username is required <br>");
        }elseif ($password == ""){
            throw new MissingDataException("All fields required Error: <br>Password is required <br>");
        }elseif ($email == "") {
            throw new MissingDataException("All fields required Error: <br>Email is required <br>");
        }elseif ($firstname == ""){
            throw new MissingDataException("All fields required Error: <br> First name is required <br>");
        }elseif ($lastname == ""){
            throw new MissingDataException("All fields required Error: <br>Last name is required <br>");

        }elseif ($admin == ""){
            throw new MissingDataException("All fields required Error: <br>Admin is required <br>");
        }else {
            //hash the password
            if (strlen($password) < 5) {
                throw new DataLengthException("Password length Error: Password must contain at least 5 characters <br>");
            }
            if(Utilities::checkemail($email) == false){
                throw new EmailFormatException("Error: <br>email format must contain example@examplesite.com <br>");
            }
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            //construct an INSERT query
            $sql = "INSERT INTO " . $this->db->getUserTable() . " VALUES(NULL, '$username', '$hashed_password', '$email', '$firstname', '$lastname', '$admin')";
                //exit ($sql);
            //execute the query and return true if successful or false if failed
            if ($this->dbConnection->query($sql) === TRUE) {
                return "You have successfully registered";
            } else {
                throw new DbException("Database Error: <br> Database could not execute <br>");
            }
        }
    } catch(MissingDataException $e) {
$message = $e->getMessage();
return $message;
} catch(DataLengthException $e) {
    $message = $e->getMessage();
    return $message;
} catch (EmailFormatException $e){
    $message = $e->getMessage();
    return $message;
} catch (DbException $e){
    $message = $e->getMessage();
    return $message;
} catch (Exception $e){
    $message=$e->getMessage();
    return $message;
}
    }


    //verify username and password against a database record
    public function verify_user()
    {
        //session_start();
        $_SESSION['hellotest'] = "Hello";
        try {
            //retrieve username and password
            $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
            $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
//As soon as variables are created test them.
            if ($username == ""){
                throw new MissingDataException("Fatal Error: <br>Username is required");
            }elseif ($password == ""){
                throw new MissingDataException("Fatal Error: <br>Password is required");
            }else {
                //sql statement to filter the users table data with a username
                $sql = "SELECT password, admin FROM " . $this->db->getUserTable() . " WHERE username='$username'";

                //execute the query
                $query = $this->dbConnection->query($sql);
                if(!$query){
                    throw new DbException("Database Error: <br> Could not execute query");
                }


                //verify password; if password is valid, set a temporary cookie
                if ($query AND $query->num_rows > 0) {
                    $result_row = $query->fetch_assoc();
                    $hash = $result_row['password'];
                    if (password_verify($password, $hash)) {

                        $int = (int)$result_row['admin'];
                        $_SESSION['test'] = $int;
                        if($int == 0) {
                            //setcookie("user", $username, time() + 3600, '/');
                            $_SESSION['user'] = $username;
                        }

                        if ($int == 1){
                            //setcookie("admin", $username, time() + 3600, '/');
                            $_SESSION['admin'] = $username;
                        }
                        return true;

                    } else {

                        throw new Exception("Error: <br> Password and or username does not match");

                    }
                } else {
                    throw new DbException("Database Error: <br> Could not verify user");
                }


            }
        } catch (MissingDataException $e){
            $message = $e->getMessage();
            return $message;
        } catch (DbException $e){
            $message = $e->getMessage();
            return $message;
        } catch (Exception $e){
            $message = $e->getMessage();
            return $message;
        }
    }
    //logout user: destroy session data
    public function logout() {
        //destroy session data
        session_unset();
        /*if (isset($_COOKIE['user'])) {
                setcookie("user", "", time() - 3600, '/');
            }
        if (isset($_COOKIE['admin'])){
                setcookie("admin", "", time() - 3600, '/');
            }*/
        return true;
    }

    //reset password
    public function reset_password()  {
        try {
            //retrieve username and password from a form
            $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
            $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));

            if ($username == ""){
                throw new MissingDataException("Fatal Error: <br>Username is required");
            }elseif ($password == ""){
                throw new MissingDataException("Fatal Error: <br>Password is required");
            }else {

                if (strlen($password) < 5) {
                    throw new DataLengthException("Password length Error: Password must contain at least 5 characters <br>");
                }
                //hash the password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                //the sql statement for update
                $sql = "UPDATE  " . $this->db->getUserTable() . " SET password='$hashed_password' WHERE username='$username'";

                //execute the query
                $query = $this->dbConnection->query($sql);


                //return false if no rows were affected
                if (!$query || $this->dbConnection->affected_rows == 0) {

                    throw new DbException("Database Error: <br> Could not execute query");
                }

                return "You have successfully updated your password";
            }
        } catch (MissingDataException $e){
            $message = $e->getMessage();
            return $message;
        } catch (DataLengthException $e){
            $message = $e->getMessage();
            return $message;
        } catch (DbException $e){
            $message = $e->getMessage();
            return $message;
        } catch (Exception $e){
            $message = $e->getMessage();
            return $message;
        }
    }
}