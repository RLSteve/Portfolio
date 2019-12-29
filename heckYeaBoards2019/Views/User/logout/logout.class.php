<?php
/**
 * Author: Tyler Faircloth
 * Date: 12/10/2019
 * File: logout.class.php
 * Description:
 */

class Logout extends IndexView
{

    public function display() {
        parent::displayHeader("logout");
        ?>
        <div class="top-row">Login</div>
        <div class="middle-row">
        <form method="get" action="<?= BASE_URL ?>/welcome/index" style="margin-left:88%">
            <input type="submit" name="query-terms" id="Continue" value="Continue"/>
            <br>
            <br>
            <br>
        </form>

        <?php
        parent::displayFooter();
    }

}