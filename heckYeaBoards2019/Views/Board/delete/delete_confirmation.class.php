<?php

class DeleteConfirmation extends BoardIndexView{

    public function display($message){


        parent::displayHeader("Delete Confirmation");

        echo $message;
?>
        <br>
        <a href="<?= BASE_URL ?>/board/index">See all Boards</a>
<?php

    parent::displayFooter();


    }
}