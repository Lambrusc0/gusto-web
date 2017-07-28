<?php

/**
 *
 * @package opledo
 * @author subrata
 * @link https://www.opeldo.com
 * @license http://opensource.org/licenses/MIT MIT License
 */


define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);  # gives you "C:\xampp\htdocs\opeldo\"
# dirname(__DIR__) gives "C:\xampp\htdocs\opeldo";
# DIRECTORY_SEPARATOR gives "\"



// set a constant that holds the project's "application" folder, like "/var/www/application".
define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);  # gives "C:\xampp\htdocs\opeldo\application\"   ... in real ""


require APP . 'config/config.php';
