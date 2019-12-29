<?php
/**
 * Author: Garin Wurschmidt
 * Date: 12/8/2019
 * File: add_user.class.php
 * Description:
 **/
  class AddUser extends IndexView {
      public function display($message) {
          parent::displayHeader("Admin ONLY");
          ?>

          <div class="top-row">CREATE AN ACCOUNT</div>
          <div class="middle-row">
              <p>Please fill out all fields</p>
              <p><?= $message ?></p>
              <form method="post" action="<?= BASE_URL . '/user/register' ?>">
                  <div><input type="text" name="username" style="width: 99%"  placeholder="Username"></div>
                  <div><input type="password" name="password" style="width: 99%"  placeholder="Password, 5 characters minimum"></div>
                  <div><input type="text" name="email" style="width: 99%" placeholder="Email"></div>
                  <div><input type = 'text' name="first_name" style="width: 99%"  placeholder="First name"></div>
                  <div><input type="text" name="last_name" style="width: 99%" placeholder="Last name"></div>
                  <div><input type="text" name="admin" style="width: 99%" placeholder="admin"></div>
                   <div><input type="submit" name="action" value="Add User"></div>

              </form>
          </div>
          <?php
          parent::displayFooter();
      }


  }