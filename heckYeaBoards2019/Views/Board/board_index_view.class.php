<?php
/**
 * Author: Tyler Faircloth
 * Date: 11/19/2019
 * File: board_index_view.class.php
 * Description:
 */

class BoardIndexView extends IndexView
{

    public static function displayHeader($title) {
        parent::displayHeader($title)
        ?>
        <script>
            //the media type
            var media = "board";
        </script>
        <div id="searchbar">
            <form method="get" action="<?= BASE_URL ?>/board/search" style="margin-left:88%">
                <input type="text" name="query-terms" id="searchtextbox" placeholder="Search boards by brand" autocomplete="off" onkeyup="handleKeyUp(event)">
                <input type="submit" value="Go"/>
                <br>
                <br>
                <br>
            </form>
            <div id="suggestionDiv"></div>
        </div>
        <?php

    }

    public static function displayFooter() {
        parent::displayFooter();
    }
}