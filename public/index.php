<?php
use Core\Classes\DataBase;
use Core\Classes\App;

require_once dirname(__DIR__) . "/config/config.php";
require_once CORE . "/autoLoadClasses.php";

session_start();

$db_config = require CONFIG . "/database.php";
$database = new DataBase($db_config);
$router = require CONFIG . "/router.php";

$app = new App();

$app->use("DB", $database);
$app->use("ROUTER", $router);

$app->init();