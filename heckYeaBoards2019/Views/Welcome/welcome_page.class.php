<?php
class WelcomePage extends IndexView
{


    public function display() {
        //display page header
        parent::displayHeader("Boards Home");
        //echo "admin: " . $_SESSION['admin'] . "<br>";
        //echo "user: " . $_SESSION['user'] . "<br>";
       // echo "test" . $_SESSION['test'];
        ?>
        <div id="add">
            <?php
            if (isset($_SESSION['admin'])){
            ?>
            <form method="get" action="<?= BASE_URL ?>/board/add" style="float: left">
                <input type="submit" name="query-terms" id="addbutton" value="Add Board"/>
                <br>
                <br>
                <?php
                }
                ?>
            </form>
        </div>
        <div id="addUser">
            <?php
            if (isset($_SESSION['admin'])){
            ?>
            <form method="get" action="<?= BASE_URL ?>/user/addUser" style="float: left">
                <input type="submit" name="query-terms" id="adduser" value="Add User"/></form>
                <?php
                }
                ?>
            </form>
        </div>
        <div id="logout">
            <form method="get" action="<?= BASE_URL ?>/user/logout" style="float: right">
                <input type="submit" name="query-terms" id="logout" value="logout"/>
                <br>
                <br>
            </form>
        </div>
        <div id="reset">
            <form method="get" action="<?= BASE_URL ?>/user/reset" style="float: right">
                <input type="submit" name="query-terms" id="reset" value="reset"/>
            </form>
        </div>
        <div id="main-header">Welcome to Heck Yea Boards</div>
        <p></p>
        <br>
        <table style="border: none; width: 700px; margin-left: 39%">
            <tr>
                <td colspan="2" style="text-align: center"><strong></strong></td>
            </tr>
            <tr>
                <td style="text-align: left">
                    <ul>
                        <li>List Boards</li>
                        <li>Display Boards</li>
                        <li>Be the Boards</li>
                        <li>Feel the Boards</li>
                    </ul>
                </td>
                <td style="text-align: left">
                    <ul>
                        <li>Eat the Boards</li>
                        <li>Break the Boards</li>
                        <li>Throw the Boards</li>
                        <li>Sit on the Boards</li>
                        <li>Click Below to SEE the Boards</li>
                    </ul></td>
            </tr>
        </table>

        <br>
        <br>

        <div id="thumbnails" style="text-align: center; border: none">


            <a href="<?= BASE_URL ?>/Board/index">
                <img src="<?= BASE_URL ?>/www/img/boards/element1.jpg" title="Board Inventory"/>
            </a>

        </div>
        <br>
        <br>
        <br>
        <br>


        <?php
        //display page footer
        parent::displayFooter();
    }

}
