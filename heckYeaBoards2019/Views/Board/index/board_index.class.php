<?php
/**
 * Author: Tyler Faircloth
 * Date: 11/19/2019
 * File: board_index.class.php
 * Description:
 */

class BoardIndex extends BoardIndexView
{


    public function display($boards) {
        //display page header
        parent::displayHeader("List All Boards");
        ?>
        <div id="main-header">  </div>

        <div class="grid-container">
            <?php
            if ($boards === 0) {
                echo "No board was found.<br><br><br><br><br>";
            } else {

                echo "<tr>";
                foreach ($boards as $i => $board) {
                    $id = $board->getId();
                    $brand = $board->getBrand();
                    $price = $board->getPrice();
                    $production_date = new \DateTime($board->getProductionDate());
                    $image = $board->getImage();
                    if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
                        $image = BASE_URL . "/" . BOARD_IMG . $image;
                    }
                    if ($i % 3== 0) {
                        echo "<div class='row'>";
                    }

                    echo "<div class='col'><p id='midfloat'><a href='", BASE_URL, "/board/detail/$id'><img id='pics' src='" . $image .
                        "'></a><span><br>$$price<br></span></p></div>";
                    
                    ?>

                    <?php
                    if ($i % 3 == 2 || $i == count($boards) - 1) {
                        echo "</div>";
                    }
                }
            }
            echo "<tr>"
            ?>

        </div>

        <?php
        //display page footer
        parent::displayFooter();
    } //end of display method
}