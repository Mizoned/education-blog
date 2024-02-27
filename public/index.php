<?php
use Core\Classes\DataBase;
use Core\Classes\Router;
use Core\Classes\App;

require_once dirname(__DIR__) . "/config/config.php";
require_once CORE . "/autoLoadClasses.php";

session_start();

$db_config = require CONFIG . "/database.php";
$database = new DataBase($db_config);
$router = require CONFIG . "/router.php";

App::use(DataBase::class, $database);
App::use(Router::class, $router);

App::init();