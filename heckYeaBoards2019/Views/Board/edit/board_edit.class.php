<?php
/**
 * Author: Tyler Faircloth
 * Date: 12/4/2019
 * File: board_edit.class.php
 * Description:
 */

class BoardEdit extends BoardIndexView
{


    public function display($board) {
        //display page header
        parent::displayHeader("Edit Board");


        if (isset($_SESSION['board_brand'])) {
            $boards = $_SESSION['board_brand'];
        }

        //retrieve board details by calling get methods
        $id = $board->getId();
        $brand = $board->getBrand();
        $price = $board->getPrice();
        $wood_type = $board->getWoodType();
        $width = $board->getWidth();
        $length = $board->getLength();
        $production_date = $board->getProductionDate();
        $image = $board->getImage();
        ?>

        <div id="main-header">Edit Board Details</div>

        <!-- display board details in a form -->
        <form action='<?= BASE_URL . "/board/update/" . $id ?>' method="post" style=" margin-top: 10px; padding: 10px;">
            <input type="hidden" name="id" value="<?= $id ?>">
            <p><strong>Brand</strong><br>
                <?php
                foreach ($boards as $b_brand => $b_id) {
                    $checked = ($brand == $b_brand ) ? "checked" : "";
                    echo "<input type='radio' name='brand' value='$b_id' $checked> $b_brand &nbsp;&nbsp;";
                }
                ?>
            </p>
            <p><strong>Price</strong>: <input name="price" type="text" value="<?= $price ?>" ></p>
            <p><strong>Wood Type</strong>:
                <input name="wood_type" type="text" size="100" value="<?= $wood_type ?>" autofocus></p>
            <p><strong>Production Date</strong>: <input name="production_date" type="date" value="<?= $production_date ?>"></p>
            <p><strong>Length</strong>: In inches<br>
                <input name="length" type="text" size="40" value="<?= $length ?>"></p>
            <p><strong>Width</strong>: In inches<br>
                <input name="width" type="text" size="40" value="<?= $width ?>"></p>
            <p><strong>Image</strong>: file name (no path necessary)<br>
                <input name="image" type="text" size="100" value="<?= $image ?>"></p>
            <input type="submit" name="action" value="Update Board">
            <input type="button" value="Cancel" onclick='window.location.href = "<?= BASE_URL . "/board/detail/" . $id ?>"'>
        </form>
        <br>
        <br>
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


}