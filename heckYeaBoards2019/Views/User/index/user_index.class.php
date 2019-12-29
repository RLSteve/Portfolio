<?php
/**
 * Author: Garin Wurschmidt
 * Date: 12/8/2019
 * File: user_index.class.php
 * Description:
 **/
  class UserIndex extends IndexView {

    public function display($message) {
        parent::displayHeader("Login");

        ?>

<div class="top-row">Please log in</div>
<div>
    <p>Enter username and password here</p>
    <?php
    if ($message == 1){
            ?>
            <p><?= "" ?></p>
            <?php
        } else {
            ?>
            <p><?= $message ?></p>
            <?php
        }
    ?>
    <form method="post" action="<?= BASE_URL . '/User/verify' ?>">
        <div><input type="text" name="username" style="width: 15%"  placeholder="Username"></div>
        <div><input type="password" name="password" style="width: 15%"  placeholder="Password, 5 characters minimum"></div>
       <br>
        <div><input type="submit" class="button" value="login"></div>

        <br>
        <br>
        <br>
<table>

        <img  src="http://localhost/I211/FinalProject/www/img/style/fireSkateboard.gif">



        <br>
        <br>
        <br>
        <br>

    </form>
    </div>
<?php
        parent::displayFooter();
    }

  }