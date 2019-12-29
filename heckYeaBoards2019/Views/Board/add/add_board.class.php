<?php
/**
 * Author: Tyler Faircloth
 * Date: 12/5/2019
 * File: add_board.class.php
 * Description:
 */

class AddBoard extends BoardIndexView
{
    public function display($result)
    {
parent::displayHeader("Add Board Verification")

        ?>
        <div class="top-row">Add new board</div>
        <?php
        if ($result == true) {
            //success
            echo "<p>", "You have successfully added a board", "</p>";
        } //call error class
        else {
            echo "<p>Could not add board</p>";
        }
        ?>
        <div class="bottom-row">
            <a href="<?= BASE_URL ?>/board/index">See all Boards</a>

        </div>


        <?php

        parent::displayFooter();
    }
}
