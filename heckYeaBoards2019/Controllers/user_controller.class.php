<?php
/**
 * Author: Tyler Faircloth
 * Date: 12/8/2019
 * File: user_controller.class.php
 * Description:
 */

class UserController
{

    private $user_model;  //an object of the UserModel class

    //create an instance of the UserModel class in the default constructor

    public function __construct() {
        $this->user_model = new UserModel();
    }

    //display the login in.
    public function index() {
        $view = new UserIndex();
        $view->display("");
    }

    //verify username and password by calling the verifyUser method defined in the model.
    //It then calls the display method defined in a view class and pass true or false.
    public function verify() {
        //call the verifyUser method of the UserModel object
       $message = $this->user_model->verify_user();


        if (isset($_SESSION['user']) || isset($_SESSION['admin'])) {
            //display result
            $view = new WelcomePage();
            $view->display();
        } else {

            $view = new UserIndex();
            $view->display($message);

        }
    }

    //create a user account by calling the addUser method of a userModel object
    public function register() {
        //call the addUser method of the UserModel object
        $message = $this->user_model->add_user();
        if (strpos($message, "successful") == true) {
            //display result
            $view = new WelcomePage();
            $view->display();
        } else {
            $view = new AddUser();
            $view->display($message);
        }
    }

    //display the login form
    public function addUser() {

        $view = new AddUser();
        $view->display("");
    }



    //log out a user by calling the logout method defined in the model and then
    //display a confirmation message
    public function logout() {
        $result = $this->user_model->logout();
        $view = new UserIndex();
        $view->display($result);
    }

    //display the password reset form or an error message.
    public function reset() {
        //if the user has logged in.

        if(isset($_SESSION['admin'])){
            $admin = $_SESSION['admin'];
            $view = new Reset();
            $view->display($admin);
        }

        if(isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            $view = new Reset();
            $view->display($user);
        }
    }

    //reset password by calling the resetPassword method in user model
    public function do_reset() {

        $message = $this->user_model->reset_password();
        //exit($result);
        if (strpos($message, "successful") == true) {

            $view = new WelcomePage();
            $view->display();
        } else {
            $view = new Reset();
            $view->display($message);
        }
    }

    //display an error message
    public function error($message) {
        $view = new UserError();
        $view->display($message);
    }

}