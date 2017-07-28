<?php

/**
 * Configuration
 *
 * For more info about constants please @see http://php.net/manual/en/function.define.php
 */

 /**
 * Configuration for: Error reporting
 * Useful to show every little problem during development, but only show hard errors in production
 */
define('ENVIRONMENT', 'development');

if (ENVIRONMENT == 'development' || ENVIRONMENT == 'dev') {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}

/**
 * Configuration for: URL
 * Here we auto-detect your applications URL and the potential sub-folder. Works perfectly on most servers and in local
 * development environments (like WAMP, MAMP, etc.). Don't touch this unless you know what you do.
 *
 * URL_PUBLIC_FOLDER:
 * The folder that is visible to public, users will only have access to that folder so nobody can have a look into
 * "/application" or other folder inside your application or call any other .php file than index.php inside "/public".
 *
 * URL_PROTOCOL:
 * The protocol. Don't change unless you know exactly what you do. This defines the protocol part of the URL, in older
 * versions of MINI it was 'http://' for normal HTTP and 'https://' if you have a HTTPS site for sure. Now the
 * protocol-independent '//' is used, which auto-recognized the protocol.
 *
 * URL_DOMAIN:
 * The domain. Don't change unless you know exactly what you do.
 * If your project runs with http and https, change to '//'
 *
 * URL_SUB_FOLDER:
 * The sub-folder. Leave it like it is, even if you don't use a sub-folder (then this will be just "/").
 *
 * URL:
 * The final, auto-detected URL (build via the segments above). If you don't want to use auto-detection,
 * then replace this line with full URL (and sub-folder) and a trailing slash.
 */
date_default_timezone_set('UTC');

ini_set('SMTP', "send.one.com"); // Overide The Default Php.ini settings for sending mail

define('URL_PUBLIC_FOLDER', 'public');
define('URL_PROTOCOL', '//');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']); // this will set URL_DOMAIN as-- 'localhost'
define('URL_SUB_FOLDER', str_replace(URL_PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME']))); 
define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER); 



# Uncomment the below lines to see the output of the various CONSTANTS.
/*
    echo 'URL_PUBLIC_FOLDER:- '. URL_PUBLIC_FOLDER;
    echo "<br>";
    echo 'URL_PROTOCOL:- '.URL_PROTOCOL;
    echo "<br>";
    echo 'URL_DOMAIN:- ' .URL_DOMAIN;
    echo "<br>";
    echo 'URL_SUB_FOLDER:- '.URL_SUB_FOLDER;
    echo "<br>";
    echo 'URL:-'.URL;

*/


/**
 * Configuration for: Database
 * This is the place where you define your database credentials, database type etc.
 */
 $local = array('localhost', '127.0.0.1');

    if(in_array($_SERVER['HTTP_HOST'], $local)){

        define('DB_TYPE', 'mysql');
        define('DB_HOST', '127.0.0.1');
        define('DB_NAME', 'gusto');
        define('DB_USER', 'root');
        define('DB_PASS', '');
        define('DB_CHARSET', 'utf8');

    } else {

        define('DB_TYPE', 'mysql');
        define('DB_HOST', 'gaborjuhasz.co.uk.mysql');
        define('DB_NAME', 'gaborjuhasz_co_uk_gusto');
        define('DB_USER', 'gaborjuhasz_co_uk_gusto');
        define('DB_PASS', '@Kakamaki12');
        define('DB_CHARSET', 'utf8');

        } 


# spl_autoload_register() allows you to register a function -
# that PHP will put into a stack/queue and call sequentially when a "new Class" is declared.

spl_autoload_register('baseClassLoader');

function baseClassLoader($className)
{
    $path = APP.'core/';

    require_once $path.$className.'.php';
}

/***

# Or if you want to auto load from different classes from different directories -
# then put them in an array and with file_exists function check whether that class file exists.   

spl_autoload_register ( function ($class) {

$sources = array(APP."core/$class.php", 
                 APP."controller/$class.php", 
                 APP."model/$class.php " );

    foreach ($sources as $source) {
        if (file_exists($source)) {
            require_once $source;
        } 
    } 
});

*/


# Manual loading 

 // require_once APP . 'core/Application.php';
 // require_once APP . 'core/BaseController.php';
 // require_once APP . 'core/BaseModel.php';

# Now start the application.

$app = new Application();

?>
