<?php
//header("content-type:text/json");

echo "<pre>";
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

define("LOCAL_ROOT", $_SERVER["DOCUMENT_ROOT"] . dirname($_SERVER["REQUEST_URI"]));
define("HTTP_ROOT", $protocol . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']));
define("SIMPLEPHP_DIR", LOCAL_ROOT . DIRECTORY_SEPARATOR . "SimplePhp");
define("DRIVERS_DIR", LOCAL_ROOT . DIRECTORY_SEPARATOR . "Drivers");
//start session
if (!isset($_SESSION)) {
    session_start();
}
//load class Exception
if (!file_exists(SIMPLEPHP_DIR . DIRECTORY_SEPARATOR . "Exception.php")) {
    die("Exception.json is not exist! Exception.php:" . SIMPLEPHP_DIR . DIRECTORY_SEPARATOR . "Exception.php");
} else {
    require_once SIMPLEPHP_DIR . DIRECTORY_SEPARATOR . "Exception.php";
}

set_error_handler("\SimplePhp\Exception::error_handler", E_ALL);
set_exception_handler("\SimplePhp\Exception::exception_handler");

//load config.json
if (!file_exists(LOCAL_ROOT . DIRECTORY_SEPARATOR . "config.json")) {
    throw new \SimplePhp\Exception("config.json is not exist! config.json: " . LOCAL_ROOT . DIRECTORY_SEPARATOR . "config.json");
} else {
    define("CONFIG_FILE", LOCAL_ROOT . DIRECTORY_SEPARATOR . "config.json");
    require_once SIMPLEPHP_DIR . DIRECTORY_SEPARATOR . "Config.php";
}

$model = $_GET["model"];
$methods = $_GET["methods"];
$args = $_GET["args"];
print_r($_GET);