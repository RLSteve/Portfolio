<?php
session_start();
/**
 * Author: Tyler Faircloth
 * Date: 11/21/2019
 * File: welcome_controller.class.php
 * Description:
 */

class WelcomeController
{

    public function index()
    {
        if (isset($_SESSION["user"]) || isset($_SESSION["admin"])) {
            $view = new WelcomePage();
            $view->display();
        } else {
            $user = new UserIndex();
            $user->display("");
        }
    }

}