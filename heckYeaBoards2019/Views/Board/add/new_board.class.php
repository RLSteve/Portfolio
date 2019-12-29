<?php

/**
 * Author: Garin Wurschmidt
 * Date: 11/6/2019
 * File: register.class.php
 * Description:
 **/
class NewBoard extends BoardIndexView
{
    public function display($result)
    {

        //retrieve board details by calling get methods
            parent::displayHeader("Add Board");
            ?>
        <div id="main-header">Add Board</div>
        <br>
        <?php
        if ($result==1){
            ?>
            <p><?= "" ?></p>
            <?php
        } else {
            ?>
            <p><?= $result ?></p>
            <?php
        }
        ?>



            <form action='<?= BASE_URL . "/board/addboard" ?>' method="post" style=" margin-top: 10px; padding: 10px; margin-right: 25%; margin-left: 25%">

                <p><strong>Brand:</strong>
                    <input type='text' name='brand' placeholder="Brand">
                </p>
                <p><strong>Price:</strong> <input name="price" type="text" placeholder="Price"></p>
                <p><strong>Wood Type:</strong>
                    <input name="wood_type" type="text"  placeholder="Wood Type"></p>
                <p><strong>Production Date:</strong> <input name="production_date" type="date" placeholder="Production Date"></p>
                <p><strong>Length:</strong>in inches
                    <input name="length" type="text" placeholder="Length"></p>
                <p><strong>Width:</strong>in inches
                    <input name="width" type="text" placeholder="Width"></p>
                <p><strong>Image:</strong> file name (no path necessary)
                    <input name="image" type="text" placeholder="ImgName.jpg"></p>
                <input type="submit" name="action" value="Add Board">
                <input type="button" value="Cancel" onclick='window.location.href = "<?= BASE_URL . "/index" ?>"'>
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
