<?php
session_start();
/**
 * Author: Tyler Faircloth
 * Date: 11/19/2019
 * File: board_detail.class.php
 * Description:
 */

class BoardDetail extends BoardIndexView
{



    public function display($board, $confirm = "") {
        //display page header
        parent::displayHeader("Board Details");
        //retrieve board details by calling get methods
        $id = $board->getId();
        $brand = $board->getBrand();
        $price = $board->getPrice();
        $wood_type = $board->getWoodType();
        $width = $board->getWidth();
        $length = $board->getLength();
        $production_date = new \DateTime($board->getProductiondate());
        $image = $board->getImage();



        if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
            $image = BASE_URL . '/' . BOARD_IMG . $image;
        }

        ?>

        <div id="main-header">Board Details</div>

        <!-- display board details in a table -->
        <table id="detail">



                <!--<td style="width: 160px;">
                    <p><strong>Brand:</strong></p>
                    <p><strong>Price:</strong></p>
                    <p><strong>Wood Type:</strong></p>
                    <p><strong>Production Date:</strong></p>
                    <p><strong>Length:</strong></p>
                    <p><strong>Width:</strong></p>-->



            <tr>
                <td style="width: 150px;"rowspan="6">
                    <img src="<?= $image ?>" alt="<?= $brand ?>" />
                </td>
                <td><p><strong>Brand:</strong></p></td>
                <td> <p><?= $brand ?></p></td>
            </tr>
            <tr>
                <td><p><strong>Price:</strong></p></td>
                <td> <p>$<?= $price ?></p></td>
            </tr>
            <tr>
                <td> <p><strong>Wood Type:</strong></p></td>
                <td><p><?= $wood_type ?></p></td>
            </tr>
            <tr>
                <td><p><strong>Production Date:</strong></p></td>
                <td> <p><?= $production_date->format('m-d-Y') ?></p></td>
            </tr>
            <tr>
                <td><p><strong>Length:</strong></p></td>
                <td><p><?= $length ?>"</p></td>
            </tr>
            <tr>
                <td><p><strong>Width:</strong></p></td>
                <td><p><?= $width ?>"</p></td>
            </tr>
            </tbody>
        </table>
                    <div id="button-group" style="margin-right: 54%">
                        <?php
                        if (isset($_SESSION['admin'])) {
                            ?>
                            <input type="button" id="edit-button" value="   Edit   "
                                   onclick="window.location.href = '<?= BASE_URL ?>/board/edit/<?= $id ?>'">
                            <br>
                            <br>
                            <input type="button" id="delete-button" value="Delete"
                                   onclick="window.location.href='<?= BASE_URL ?>/board/delete/<?= $id ?>'">
                            <?php
                        }
                        ?>
                    </div>
                <!--</td>
                <td style="width: 160px">
                    <p><?/*= $brand */?></p>
                    <p>$<?/*= $price */?></p>
                    <p><?/*= $wood_type */?></p>
                    <p><?/*= $production_date->format('m-d-Y') */?></p>
                    <p><?/*= $length */?>"</p>
                    <p><?/*= $width */?>"</p>-->
        <br>
        <br>
                    <div style="margin-right: 54%" id="confirm-message"><?= $confirm ?></div>

        <br>
        <a href="<?= BASE_URL ?>/board/index">See all Boards</a>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>


        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}