<?php
/**
 * Author: Tyler Faircloth
 * Date: 11/18/2019
 * File: index.php
 * Description:
 */

require_once ("Application/config.php");

//load autoloader
require_once ("Vendor/autoload.php");

//load the dispatcher that dissects a request URL
new Dispatcher();