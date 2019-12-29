<?php
/**
 * Author: Tyler Faircloth
 * Date: 11/18/2019
 * File: index_view.class.php
 * Description:
 */

class IndexView
{

    //this method displays the page header
    static public function displayHeader($page_title)
    {
        ?>
        <!DOCTYPE html>
        <html>

        <head>
            <title> <?php echo $page_title ?> </title>
            <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>


            <link type='text/css' rel='stylesheet' href='<?= BASE_URL ?>/www/css/style.css'/>

            <script>
                //create the JavaScript variable for the base url
                var base_url = "<?= BASE_URL ?>";


            </script>
        </head>
        <body>
        <div id="top"></div>
        <div id='wrapper'>
        <div class="header" id="banner">
            <a href="<?= BASE_URL ?>/welcome/index" style="text-decoration: none; text-align: center" title="BOARDSSSSSSSSSSSS">
                <div id="left">


                    <span style='color: yellow; font-size: 36pt; font-weight: bold; vertical-align: middle; position: center; margin: auto'>

                                    HECK YEA!

                                </span>
                    <div style='color: #000; font-size: 14pt; font-weight: bold;
                    animation-name: ourBoards; animation-duration: 2.8s; animation-iteration-count: infinite; margin: auto; vertical-align: middle'>

                        OUR BOARDS

                    </div>
                </div>
            </a>
            <div id="right">


            </div>
        </div>
        <?php
    }//end of displayHeader function

    //this method displays the page footer
    public static function displayFooter()
    {
        ?>
        <br><br><br>
        <div id="push"></div>
        </div>
        <div id="footer" style="background-color: black; color: rgba(236,236,236,1) ">This stuff is ours don't take it.
            Created by TT&G&copy;
        </div>
        <script type="text/javascript" src="<?= BASE_URL ?>/www/js/ajax_autosuggestion.js"></script>
        </body>
        </html>
        <?php
    } //end of displayFooter function
}
