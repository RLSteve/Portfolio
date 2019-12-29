<?php
/**
 * Author: Tyler Faircloth
 * Date: 11/11/2019
 * File: book_search.class.php
 * Description:
 */

class BoardSearch extends BoardIndexView
{
   //Display an array in a grid

    public function display($terms, $boards) {
        //display page header
        parent::displayHeader("Search Results");
        ?>
        <div id="main-header"> Search Results for <i><?= $terms ?></i></div>
        <span class="rcd-numbers">
            <?php
            echo ((!is_array($boards)) ? "( 0 - 0 )" : "( 1 - " . count($boards) . " )");
            ?>
        </span>
        <br>
        <br>


        <div class="grid-container">
            <?php
            if ($boards === 0) {
                echo "No boards found dude.<br><br><br><br><br>
                    <br>
                    <br>
                    <br>";
            } else {
                //display boards in a grid; three books per row
                foreach ($boards as $i => $board) {
                    $id = $board->getId();
                    $brand = $board->getBrand();
                    $price = $board->getPrice();
                    $production_date = new \DateTime($board->getProductionDate());
                    $image = $board->getImage();
                    if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
                        $image = BASE_URL . "/" . BOARD_IMG . $image;
                    }
                    if ($i % 3 == 0) {
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
            ?>
        </div>
        <a href="<?= BASE_URL ?>/board/index/">See All Boards</a>
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