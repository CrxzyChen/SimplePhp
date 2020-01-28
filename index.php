<?php
header("content-type:text/json");

$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

define("LOCAL_ROOT", $_SERVER["DOCUMENT_ROOT"] . dirname($_SERVER["SCRIPT_NAME"]));
define("HTTP_ROOT", $protocol . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']));
define("SIMPLEPHP_DIR", LOCAL_ROOT . DIRECTORY_SEPARATOR . "SimplePhp");
define("DRIVERS_DIR", LOCAL_ROOT . DIRECTORY_SEPARATOR . "Drivers");
//start session
if (!isset($_SESSION)) {
    session_start();
}
//load class Exception
if (!file_exists(SIMPLEPHP_DIR . DIRECTORY_SEPARATOR . "Exception.php")) {
    die("Exception.php is not exist! Exception.php:" . SIMPLEPHP_DIR . DIRECTORY_SEPARATOR . "Exception.php");
} else {
    require_once SIMPLEPHP_DIR . DIRECTORY_SEPARATOR . "Exception.php";
}

//load handle method of exception
set_error_handler("\SimplePhp\Exception::error_handler", E_ALL);
set_exception_handler("\SimplePhp\Exception::exception_handler");
spl_autoload_register("\SimplePhp\Exception::autoload_register");

//load config.json
if (!file_exists(LOCAL_ROOT . DIRECTORY_SEPARATOR . "config.json")) {
    throw new \SimplePhp\Exception("config.json is not exist! config.json: " . LOCAL_ROOT . DIRECTORY_SEPARATOR . "config.json");
} else {
    define("CONFIG_FILE", LOCAL_ROOT . DIRECTORY_SEPARATOR . "config.json");
    require_once SIMPLEPHP_DIR . DIRECTORY_SEPARATOR . "Config.php";
}

if (!isset($_GET["controller"])) {
    $default_controller = \SimplePhp\Config::get("default.controller");
    $default_method = \SimplePhp\Config::get("default.controller");

    $controller = new ReflectionClass("Controllers\\$default_controller");
    $instance = $controller->newInstance();

    if ($controller->hasMethod($default_method))
        $instance->{$default_method}();
}