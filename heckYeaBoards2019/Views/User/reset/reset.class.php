<?php
/**
 * Author: Tyler Faircloth
 * Date: 12/11/2019
 * File: reset.class.php
 * Description:
 */

class Reset extends IndexView
{

    public function display($reset) {
        parent::displayHeader("Reset");
        if (isset($_SESSION['admin'])){
            $username = $_SESSION['admin'];
        }
        if (isset($_SESSION['user'])){
            $username = $_SESSION['user'];
        }

        ?>

        <div class="top-row">Reset password</div>
        <div class="middle-row">
            <p>Please enter a new password.</p>
         <?php
            if ($reset == $username){
            ?>
            <p><?= "" ?></p>
            <?php
        } else {
            ?>
            <p><?= $reset ?></p>
            <?php
        }
            ?>
            <form method="post" action="<?= BASE_URL ?>/user/do_reset" style="margin-left:25%; margin-right: 25%">
                <div><input type="text" name="username" style="width: 99%" value="<?= $username ?>" readonly="readonly"></div>
                <div><input type="password" name="password" style="width: 99%;" placeholder="Password, 5 characters minimum"></div>
                <div><input type="submit" class="button" value="Reset Password"></div>
            </form>
        </div>
        <div class="bottom-row">
            <br>


            <span style="margin-left:25%; margin-right: 25%">Cancel password reset? <a href="<?= BASE_URL ?>/welcome/index">Cancel Reset</a></span>
            <span></span>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <img src="http://localhost/I211/FinalProject/www/img/style/narutogif.gif" alt="naruto">

        <?php
        parent::displayFooter();
    }

}